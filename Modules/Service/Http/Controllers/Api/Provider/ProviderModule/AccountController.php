<?php

namespace Modules\Service\Http\Controllers\Api\Provider\ProviderModule;

use App\Models\DataSetting;
use App\Models\Module;
use App\Models\StoreSubscription;
use App\Models\SubscriptionBillingAndRefundHistory;
use App\Models\SubscriptionPackage;
use App\Models\SubscriptionTransaction;
use App\Models\UserAccount;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\BookingModule\BookingDetailsAmount;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\TransactionModule\Transaction;

class AccountController extends Controller
{
    private Provider $provider;
    private UserAccount $account;
    private DataSetting $business_settings;
    private StoreSubscription $packageSubscriber;
    private SubscriptionPackage $subscriptionPackage;
    private Transaction $transaction;
    private BookingDetailsAmount $booking_details_amount;

    public function __construct(Transaction $transaction, Provider $provider, UserAccount $account, DataSetting $business_settings, StoreSubscription $packageSubscriber, SubscriptionPackage $subscriptionPackage, BookingDetailsAmount $booking_details_amount)
    {
        $this->provider = $provider;
        $this->account = $account;
        $this->business_settings = $business_settings;
        $this->packageSubscriber = $packageSubscriber;
        $this->subscriptionPackage = $subscriptionPackage;
        $this->transaction = $transaction;
        $this->booking_details_amount = $booking_details_amount;
    }

    private function currentModule() {
        return config('module.current_module_data') ?? Module::where('module_type','service')->first();
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function overview(Request $request): JsonResponse
    {
        if (!$request->hasHeader('X-localization')) {

            $errors = [];
            array_push($errors, ['code' => 'current_language_key', 'message' => translate('messages.current_language_key_required')]);
            return response()->json([
                'errors' => $errors
            ], 200);
        }

        $vat   = (int)0;
        $provider = $this->provider->withoutGlobalScope('translate')->with(['translations','schedules'])->where('id', $request->user('provider')->id)->first();
        $current_language = $request->header('X-localization');
        $provider->current_language_key = $current_language;
        $provider->save();
        $provider_account = getUserAccount($provider->id, PROVIDER);
        $limitStatus = provider_warning_amount_calculate($provider->account->payable_balance,$provider->account->receivable_balance);
        $provider['cash_limit_status'] = $limitStatus == false ? 'available' : $limitStatus;
        $bookingOverview = DB::table('service_bookings')->where('provider_id', $request->user('provider')->id)
            ->where('module_id', $this->currentModule()?->id)
            ->where('booking_status', '!=', 'pending')
            ->select('booking_status', DB::raw('count(*) as total'))
            ->groupBy('booking_status')
            ->get();

        $providerId = $provider->id;
        $maxBookingAmount = business_config('provider_maximum_booking_amount', 'service_business_settings')->value;
        $serviceAtProviderPlace = (int)((business_config('service_at_provider_place', 'service_business_settings'))->value ?? 0);
        $serviceAtProviderPlace = (int) getProviderSettings(
            providerId: $providerId,
            key: 'service_at_provider_location',
            type: 'provider_config'
        );

        $serviceAtCustomerPlace = (int) getProviderSettings(
            providerId: $providerId,
            key: 'service_at_customer_location',
            type: 'provider_config'
        );

        $pendingBookingOverview = Booking::whereDoesntHave('ignores', function ($query) use ($providerId) {
                $query->where('provider_id', $providerId);
            })
            ->where('booking_status', 'pending')
            ->where(function ($q) use ($providerId, $provider, $maxBookingAmount) {
                $q->providerPendingBookings($provider, $maxBookingAmount);
            })
            ->when($serviceAtProviderPlace == 1 && $serviceAtCustomerPlace == 0, function ($query) {
                $query->where('service_location', 'provider');
            })
            ->when($serviceAtCustomerPlace == 1 && $serviceAtProviderPlace == 0, function ($query) {
                $query->where('service_location', 'customer');
            })
            ->when($serviceAtProviderPlace == 1 && $serviceAtCustomerPlace == 1, function ($query) {
                $query->where(function($q) {
                    $q->where('service_location', 'provider')
                        ->orWhere('service_location', 'customer');
                });
            })
            ->select('booking_status', DB::raw('count(*) as total'))
            ->groupBy('booking_status')
            ->first();
        $bookingOverview->push($pendingBookingOverview ?? ['booking_status' => 'pending', 'total' => 0]);

        $promotionalCosts = $this->business_settings->whereIn('key', ['service_coupon_cost_bearer','service_discount_cost_bearer','service_campaign_cost_bearer'])->get();
        $promotionalCostPercentage = [];

        $data = json_decode($promotionalCosts->where('key', 'service_discount_cost_bearer')->first()->value, true);
        $promotionalCostPercentage['discount'] = $data['provider_percentage'];

        $data = json_decode($promotionalCosts->where('key', 'service_campaign_cost_bearer')->first()->value, true);
        $promotionalCostPercentage['campaign'] = $data['provider_percentage'];

        $data = json_decode($promotionalCosts->where('key', 'service_coupon_cost_bearer')->first()->value, true);
        $promotionalCostPercentage['coupon'] = $data['provider_percentage'];

        $transactionsCount = $this->transaction
            ->whereIn('trx_type', ['subscription_purchase', 'subscription_renew', 'subscription_shift', 'subscription_refund'])
            ->where('from_user_id', $provider->id)
            ->orWhere('to_user_id', $provider->id)->count();

        $provider['subscription_transactions']= (boolean) SubscriptionTransaction::where('store_id',$provider->id)->count() > 0? true : false;
            if(isset($provider?->store_sub_update_application)){
                    $provider['subscription'] =$provider?->store_sub_update_application;

                    if($provider['subscription']->max_product== 'unlimited' ){
                        $max_product_uploads= -1;
                    }
                    else{
                        $max_product_uploads= $provider['subscription']->max_product - $provider?->subscribed_services()->count() > 0?  $provider['subscription']->max_product - $provider?->subscribed_services()->count() : 0 ;
                        
                    }

                    $pending_bill= SubscriptionBillingAndRefundHistory::where(['store_id'=>$provider->id,
                                        'transaction_type'=>'pending_bill', 'is_success' =>0])?->sum('amount') ?? 0;
                    $provider['subscription_other_data'] =  [
                        'total_bill'=>  (float) $provider['subscription']->package?->price * ($provider['subscription']->total_package_renewed + 1),
                        'max_product_uploads' => (int) $max_product_uploads,
                        'pending_bill' => (float) $pending_bill,
                    ];
                }


        $packageSubscriber = $this->packageSubscriber->where('store_id', $provider->id)->where('store_type', 'service_provider')
            ->with('package')
            ->first();

        $formattedPackage = null;
        $renewal = null;
        $totalSubscription = 0;
        $status = 'commission_base';
        if ($packageSubscriber) {
            // $formattedPackage = apiPackageSubscriber($packageSubscriber, PACKAGE_FEATURES);
            $formattedPackage = $packageSubscriber;

            $renewal = $this->subscriptionPackage->where('id', $packageSubscriber?->package_id)->first();

            if($packageSubscriber->expiry_date >= now()) {
                $status = 'subscription_base';
            }
        }


        // if (is_array($formattedPackage) || is_object($formattedPackage)) {
        //     $numberOfUses = $formattedPackage['number_of_uses'] ?? ($formattedPackage->number_of_uses ?? 0);
        //     $totalSubscription = $numberOfUses;
        //     $status = $numberOfUses < 0 ? 'commission_base' : 'subscription_base';
        // }

        $packageInfo = [
            'total_subscription' => $transactionsCount,
            'status' => $status,
            'subscribed_package_details' => $formattedPackage,
            'renewal_package_details' => $renewal,
            'applicable_vat' => $vat
        ];

        $earningSummary = $this->getProviderCompletedBookingSummary($request->user('provider')->id);

        return response()->json(response_formatter(DEFAULT_200, [
            'provider_info' => $provider,
            'booking_overview' => $bookingOverview,
            'promotional_cost_percentage' => $promotionalCostPercentage,
            'subscription_info' => $packageInfo,
            'booking_summary' => $earningSummary
        ]), 200);
    }

    public function getProviderCompletedBookingSummary($provider_id)
    {
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $baseQuery = $this->booking_details_amount
            ->where(function ($q) use ($provider_id) {
                $q->whereHas('booking', function ($query) use ($provider_id) {
                    $query->where('provider_id', $provider_id)->ofBookingStatus('completed');
                })
                ->orWhereHas('repeat', function ($subQuery) use ($provider_id) {
                    $subQuery->where('provider_id', $provider_id)->ofBookingStatus('completed');
                });
            });

        $todayCount = (clone $baseQuery)
            ->whereDate('created_at', $today)
            ->count();

        $thisWeekCount = (clone $baseQuery)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $thisMonthCount = (clone $baseQuery)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        return [
            'todays_completed_booking' => $todayCount,
            'this_week_completed_booking' => $thisWeekCount,
            'this_month_completed_booking' => $thisMonthCount,
        ];
    }


    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function accountEdit(Request $request): JsonResponse
    {
        $provider = $this->provider->with('owner')->find($request->user('provider')->id);
        if (isset($provider)) {
            return response()->json(response_formatter(DEFAULT_200, $provider), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function accountUpdate(Request $request): JsonResponse
    {
        $provider = $this->provider->with('owner')->find($request->user('provider')->id);
        $validator = Validator::make($request->all(), [
            'contact_person_name' => 'required',
            'contact_person_phone' => 'required',
            'contact_person_email' => 'required',

            'password' => 'string|min:8',
            'confirm_password' => 'same:password',
            'account_first_name' => 'required',
            'account_last_name' => 'required',
            'account_phone' => 'required',

            'company_name' => 'required',
            'company_phone' => 'required|unique:providers,company_phone,' . $provider->id . ',id',
            'company_address' => 'required',
            'logo' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        //email & phone check
        if (User::where('phone', $request['account_phone'])->where('id', '!=', $provider->user_id)->exists()) {
            return response()->json(response_formatter(DEFAULT_400, null, [["error_code"=>"account_phone","message"=>translate('Phone already taken')]]), 400);
        }

        $provider->company_name = $request->company_name;
        $provider->company_phone = $request->company_phone;
        if ($request->has('logo')) {
            $provider->logo = file_uploader('provider/logo/', 'png', $request->file('logo'));
        }
        $provider->company_address = $request->company_address;
        $provider->contact_person_name = $request->contact_person_name;
        $provider->contact_person_phone = $request->contact_person_phone;
        $provider->contact_person_email = $request->contact_person_email;

        $owner = $provider->owner()->first();
        $owner->first_name = $request->account_first_name;
        $owner->last_name = $request->account_last_name;
        $owner->phone = $request->account_phone;
        if ($request->has('password')) {
            $owner->password = bcrypt($request->password);
        }
        $owner->user_type = 'provider-admin';

        DB::transaction(function () use ($provider, $owner, $request) {
            $owner->save();
            $provider->save();
        });

        return response()->json(response_formatter(PROVIDER_STORE_200), 200);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function commissionInfo(Request $request): JsonResponse
    {
        $provider = $this->provider->with('owner')->where('user_id',$request->user('provider')->id)->first();
        if (isset($provider)) {
            return response()->json(response_formatter(DEFAULT_200, [
                'commission_status' => $provider['commission_status'],
                'commission_percentage' => $provider['commission_percentage']
            ]), 200);
        }
        return response()->json(response_formatter(DEFAULT_204), 200);
    }
}
