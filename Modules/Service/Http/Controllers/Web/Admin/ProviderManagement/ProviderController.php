<?php

namespace Modules\Service\Http\Controllers\Web\Admin\ProviderManagement;

use App\CentralLogics\Helpers;
use App\Exports\ProviderWithdrawTransactionExport;
use App\Models\BusinessSetting;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\NotificationSetting;
use App\Models\StoreSubscription;
use App\Models\SubscriptionBillingAndRefundHistory;
use App\Models\SubscriptionPackage;
use App\Models\UserInfo;
use App\Models\Zone;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Service\Exports\ProviderExport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Modules\Service\Entities\ProviderManagement\ProviderNotificationSetup;
use Modules\Service\Entities\Review\Review;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\ProviderSchedule;
use Modules\Service\Entities\ProviderManagement\ProviderSetting;
use Modules\Service\Entities\ProviderManagement\Serviceman;
use Modules\Service\Entities\ProviderManagement\SubscribedService;
use Modules\Service\Entities\ProviderManagement\WithdrawRequest;
use Modules\Service\Entities\ServiceManagement\Service;
use Modules\Service\Mail\ProviderModule\AccountSuspendMail;
use Modules\Service\Mail\ProviderModule\AccountUnsuspendMail;
use Modules\Service\Mail\ProviderModule\RegistrationApprovedMail;
use Modules\Service\Mail\ProviderModule\RegistrationDeniedMail;

class ProviderController extends Controller
{
    protected Provider $provider;
    // protected User $owner;
    // protected User $user;
    protected Service $service;
    protected SubscribedService $subscribedService;
    private Booking $booking;
    private Serviceman $serviceman;
    private SubscriptionPackage $subscriptionPackage;
    protected ProviderSetting $providerSetting;
    // private PackageSubscriber $packageSubscriber;
    // private PackageSubscriberFeature $packageSubscriberFeature;
    // private PackageSubscriberLimit $packageSubscriberLimit;
    // private Review $review;
    // protected Transaction $transaction;
    protected Zone $zone;
    // protected BankDetail $bank_detail;
    // protected PaymentRequest $paymentRequest;
    // protected BookingRepeat $bookingRepeat;
    // private BookingStatusHistory $bookingStatusHistory;

    // use SubscriptionTrait;

    public function __construct
    (
        // Transaction $transaction,
        // Review $review,
        Serviceman $serviceman,
        Provider $provider,
        // User $owner,
        // Service $service,
        SubscribedService $subscribedService,
        Booking $booking,
        Zone $zone,
        // BankDetail $bank_detail,
        // PackageSubscriber $packageSubscriber,
        SubscriptionPackage $subscriptionPackage,
        ProviderSetting $providerSetting,
        // PackageSubscriberFeature $packageSubscriberFeature,
        // PackageSubscriberLimit $packageSubscriberLimit,
        // PaymentRequest $paymentRequest,
        // BookingRepeat $bookingRepeat,
        // BookingStatusHistory $bookingStatusHistory
    )
    {
        $this->provider = $provider;
        // $this->owner = $owner;
        // $this->user = $owner;
        // $this->service = $service;
        $this->subscribedService = $subscribedService;
        $this->booking = $booking;
        $this->serviceman = $serviceman;
        // $this->review = $review;
        // $this->transaction = $transaction;
        $this->zone = $zone;
        // $this->bank_detail = $bank_detail;
        $this->subscriptionPackage = $subscriptionPackage;
        $this->providerSetting = $providerSetting;
        // $this->packageSubscriber = $packageSubscriber;
        // $this->packageSubscriberFeature = $packageSubscriberFeature;
        // $this->packageSubscriberLimit = $packageSubscriberLimit;
        // $this->paymentRequest = $paymentRequest;
        // $this->bookingRepeat = $bookingRepeat;
        // $this->bookingStatusHistory = $bookingStatusHistory;
    }

    private function currentModuleId(): int
    {
        return Config::get('module.current_module_id');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {

        Validator::make($request->all(), [
            'search' => 'string',
            'status' => 'required|in:active,inactive,all'
        ]);

        $search = $request->has('search') ? $request['search'] : '';
        $status = $request->has('status') ? $request['status'] : 'all';
        $queryParam = ['search' => $search, 'status' => $status];

        $providers = $this->provider->with(['zone'])->where(['is_approved' => 1])
            ->withCount(['subscribed_services', 'bookings'])
            ->when($request->zone_id != null, function ($query) use ($request) {
                return $query->where('zone_id', $request->zone_id);
            })
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('company_phone', 'LIKE', '%' . $key . '%')
                            ->orWhere('company_email', 'LIKE', '%' . $key . '%')
                            ->orWhere('company_name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->ofApproval(1)
            ->when($request->has('status') && $request['status'] != 'all', function ($query) use ($request) {
                return $query->ofStatus(($request['status'] == 'active') ? 1 : 0);
            })
            ->latest()
            ->paginate(pagination_limit())->appends($queryParam);

        $topCards = [];
        $topCards['total_providers'] = $this->provider->ofApproval(1)->count();
        $topCards['total_onboarding_requests'] = $this->provider->ofApproval(2)->count();
        $topCards['total_active_providers'] = $this->provider->ofApproval(1)->ofStatus(1)->count();
        $topCards['total_inactive_providers'] = $this->provider->ofApproval(1)->ofStatus(0)->count();
        return view('service::admin.provider-management.provider.index', compact('providers', 'topCards', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        $zones = $this->zone->get();
        $commission = (int)((business_config('provider_commision', 'service_business_settings'))->value ?? null);
        $subscription = (int)((business_config('provider_subscription', 'service_business_settings'))->value ?? null);
        $duration = (int)((business_config('free_trial_period', 'service_business_settings'))->value ?? null);
        $freeTrialStatus = (int)((business_config('free_trial_period', 'service_business_settings'))->value ?? 0);
        $packages = $this->subscriptionPackage->OfStatus(1)
            ->ofModule('service')
            ->get();
        // $formattedPackages = $subscriptionPackages->map(function ($subscriptionPackage) {
        //     return formatSubscriptionPackage($subscriptionPackage, PACKAGE_FEATURES);
        // });
        $language = getWebConfig('language');
        return view('service::admin.provider-management.provider.create', compact('zones','commission','subscription','packages', 'duration', 'freeTrialStatus', 'language'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'business_email' => 'required|email|unique:service_providers,company_email',
            'business_phone' => 'required|unique:service_providers,company_phone',
            'logo' => 'required|image|mimes:jpeg,jpg,png,gif',
            'cover_photo' => 'required|image|mimes:jpeg,jpg,png,gif',
            'zone_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
//            'minimum_service_time' => 'required|integer|min:0',
//            'maximum_service_time' => 'required|integer|min:0',
//            'service_time_type' => 'required|in:min,hours,days',
            'f_name' => 'required|string|max:191',
            'l_name' => 'required|string|max:191',
            'phone' => 'required|unique:service_providers,phone',
            'email' => 'required|email|unique:service_providers,email',
            'password' => 'required|min:8|confirmed',

            'identity_type' => 'required|in:passport,driving_license,nid,trade_license,company_id',
            'identity_number' => 'required',
            'identity_images' => 'nullable|array',
            'identity_images.*' => 'image|mimes:jpeg,jpg,png,gif',
        ]);

        if (Provider::where('email', $request['email'])->first()) {
            Toastr::error(translate('Email already taken'));
            return back();
        }
        if (Provider::where('phone', $request['phone'])->first()) {
            Toastr::error(translate('Phone already taken'));
            return back();
        }

        if ($request->zone_id && !$this->isValidZone($request)) {
            Toastr::error(translate('messages.coordinates_out_of_zone'));
            return back()->withInput();
        }

        if ($request->business_plan == 'subscription-base' && !$request->package_id) {
            Toastr::error(translate('messages.You_must_select_a_package'));
            return back()->withInput();
        }
        if($request->business_plan == 'subscription-base') {
            $package = $this->subscriptionPackage->where('id',$request->package_id)
                ->ofStatus(1)
                ->where('module_type', 'service')
                ->first();
            if (!$package) {
                Toastr::error(translate('Please Select valid plan'));
                return back();
            }

            $packageId                 = $package?->id;
            $packagePrice              = $package?->price;
            $packageName               = $package?->name;
        }

        $identityImages = [];
        if ($request->has('identity_images')) {
            foreach ($request->identity_images as $image) {
                $imageName = file_uploader('provider/identity/', 'png', $image);
                $identityImages[] = ['image'=>$imageName, 'storage'=> getDisk()];
            }
        }
        /* if ($request->business_plan == "subscription-base") {
            Helpers::service_provider_subscription_plan_chosen(store_id:$provider->id,package_id:$request->package_id,payment_method:'manual_payment_by_admin',discount:0,reference:'manual_payment_by_admin',type: 'new_join');
        } */
        DB::beginTransaction();

        $provider = $this->provider;
        $provider->module_id = $this->currentModuleId();
        $provider->zone_id = $request->zone_id;
        $provider->coordinates = ['latitude' => $request['latitude'], 'longitude' => $request['longitude']];
        $provider->first_name = $request->f_name;
        $provider->last_name = $request->l_name;
        $provider->phone = $request->phone;
        $provider->email = $request->email;
        $provider->password = bcrypt($request->password);
        $provider->identification_type = $request->identity_type;
        $provider->identification_number = $request->identity_number;
        $provider->identification_image = json_encode($identityImages);

        $provider->company_name = $request->name[array_search('default', $request->lang)];
        $provider->company_email = $request->business_email;
        $provider->company_phone = $request->business_phone;
        $provider->company_address = $request->address[array_search('default', $request->lang)];
        $provider->logo = file_uploader('provider/logo/', 'png', $request->file('logo'));
        $provider->cover_image = file_uploader('provider/cover-image/', 'png', $request->file('cover_photo'));

        $provider->minimum_service_time = 0;
        $provider->maximum_service_time = 0;
        $provider->service_time_type = '';
        $provider->is_approved = 1; // auto approved
        $provider->business_model = ($request->business_plan == "subscription-base") ? 'subscription' : 'commission';
        $provider->save();

        $adminNotification = NotificationSetting::where('module_type', 'service')->whereIn('type', ['provider','serviceman'])->get();
        foreach ($adminNotification as $notification) {
            ProviderNotificationSetup::create([
                'provider_id' => $provider->id,
                'title' => $notification['title'],
                'sub_title' => $notification['sub_title'],
                'key' => $notification['key'],
                'type' => $notification['type'],
                'mail_status' => $notification['mail_status'],
                'sms_status' => $notification['sms_status'],
                'push_notification_status' => $notification['push_notification_status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'company_name',
            name_field:'name',
            model_name: get_class($provider),
            data_id: $provider->id,
            data_value: $provider->company_name,
            model_class: true
        );

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'company_address',
            name_field:'address',
            model_name: get_class($provider),
            data_id: $provider->id,
            data_value: $provider->company_address,
            model_class: true
        );
        //////// Working


        try {
            // Mail::to($provider->email)->send(new NewJoiningRequestMail($provider));
        } catch (\Exception $exception) {
            info($exception);
        }

        if ($request->business_plan == "subscription-base") {
            Helpers::service_provider_subscription_plan_chosen(provider_id:$provider->id,package_id:$request->package_id,payment_method:'manual_payment_by_admin',discount:0,reference:'manual_payment_by_admin',type: 'new_join');
        }
        DB::commit();

        /* if ($request->business_plan == "subscription-base") {
            $provider_id = $provider?->id;

            $payment = $this->paymentRequest;
            $payment->payment_amount = $price;
            $payment->success_hook = 'subscription_success';
            $payment->failure_hook = 'subscription_fail';
            $payment->payer_id = $provider->user_id;
            $payment->payment_method = 'manually';
            $payment->additional_data = json_encode($request->all());
            $payment->attribute = 'provider-reg';
            $payment->attribute_id = $provider_id;
            $payment->payment_platform = 'web';
            $payment->is_paid = 1;
            $payment->save();
            $request['payment_id'] = $payment->id;

            $result = $this->handlePurchasePackageSubscription($id, $provider_id, $request->all() , $price, $name);

            if (!$result) {
                Toastr::error(translate('Something error'));
                return back();
            }
            if ($request->plan_price == 'free_trial') {
                $result = $this->handleFreeTrialPackageSubscription($id, $provider_id, $price, $name);
                if (!$result) {
                    Toastr::error(translate('Something error'));
                    return back();
                }
            }
        } */

        Toastr::success(translate(PROVIDER_STORE_200['message']));
        return back();
    }

     /**
     * @param Request $request
     * @return bool
     */
    private function isValidZone(Request $request): bool
    {
        $zone = $this->zone->query()
            ->whereContains('coordinates', new Point($request->latitude, $request->longitude, POINT_SRID))
            ->where('id', $request->zone_id)
            ->first();
        return (bool)$zone;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function details($id, Request $request): \Illuminate\Foundation\Application|View|Factory|RedirectResponse|Application
    {
        $request->validate([
            'tab' => 'nullable|in:overview,subscribed_services,bookings,serviceman_list,settings,bank_information,reviews,subscription,transactions,conversations,meta-data,business-plan',
        ]);

        $webPage = $request->has('tab') ? $request['tab'] : 'overview';
        $provider = $this->provider->withoutGlobalScope('translate')->withCount(['bookings'])->find($id);
        getUserAccount($provider->id, PROVIDER);
        //overview
        if ($webPage == 'overview') {
            $bookingOverview = DB::table('service_bookings')->where('provider_id', $id)
                ->select('booking_status', DB::raw('count(*) as total'))
                ->groupBy('booking_status')
                ->get();
            $status = ['accepted', 'ongoing', 'completed', 'canceled'];
            $total = [];
            foreach ($status as $item) {
                if ($bookingOverview->where('booking_status', $item)->first() !== null) {
                    $total[$item] = $bookingOverview->where('booking_status', $item)->first()->total;
                } else {
                    $total[$item] = 0;
                }
            }
            $total['all'] = array_sum($total);
            return view('service::admin.provider-management.provider.detail.overview', compact('provider', 'webPage', 'total'));

        } //bookings
        elseif ($webPage == 'bookings') {

            $search = $request->has('search') ? $request['search'] : '';
            $queryParam = [
                'tab' => $webPage,
                'search' => $search,
                'service_type' => $request['service_type'] ?? 'all'
            ];

            $bookings = $this->booking->where('provider_id', $id)
                ->with(['customer'])
                ->when($request['service_type'] != 'all', function ($query) use ($request) {
                    return $query->ofRepeatBookingStatus(
                        $request['service_type'] === 'repeat' ? 1 :
                            ($request['service_type'] === 'regular' ? 0 : null)
                    );
                })
                ->where(function ($query) use ($request) {
                    $keys = explode(' ', $request['search']);
                    foreach ($keys as $key) {
                        $query->where('id', 'LIKE', '%' . $key . '%');
                    }
                })
                ->latest()
                ->paginate(pagination_limit())
                ->appends($queryParam);


            return view('service::admin.provider-management.provider.detail.bookings', compact('provider', 'bookings', 'webPage', 'search'));

        } //subscribed_services
        elseif ($webPage == 'subscribed_services') {
            $search = $request->has('search') ? $request['search'] : '';
            $status = $request->has('status') ? $request['status'] : 'all';
            $queryParam = ['web_page' => $webPage, 'status' => $status, 'search' => $search];

            $subCategories = Category::with(['services', 'parent'])
                ->ofType('sub')
                ->ofStatus(1)
                ->when($request->has('searchq'), function ($query) use ($request) {
                    $keys = explode(' ', $request['searchq']);
                    return $query->where(function ($query) use ($keys) {
                        foreach ($keys as $key) {
                            $query->orWhere('name', 'LIKE', '%' . $key . '%');
                        }
                    });
                })
                ->get();

            $subscribedCategoryIds = $this->subscribedService->where('provider_id', $id)
                ->ofSubscription(1)
                ->pluck('sub_category_id')
                ->toArray();

            return view('service::admin.provider-management.provider.detail.subscribed-services', compact('provider', 'subCategories', 'webPage', 'status', 'search', 'subscribedCategoryIds'));

        } //reviews
        elseif ($webPage == 'reviews') {

            $search = $request->has('search') ? $request['search'] : '';
            $queryParam = ['search' => $search, 'web_page' => $request['web_page']];

            $reviews = $this->booking->with(['reviews.service'])
                ->when($request->has('search'), function ($query) use ($request) {
                    $keys = explode(' ', $request['search']);
                    $query->whereHas('reviews', function ($query) use ($keys) {
                        foreach ($keys as $key) {
                            $query->where('review_comment', 'LIKE', '%' . $key . '%')
                                ->orWhere('readable_id', 'LIKE', '%' . $key . '%');
                        }
                    });
                })
                ->whereHas('reviews', function ($query) use ($id) {
                    $query->where('provider_id', $id);
                })
                ->latest()
                ->paginate(pagination_limit())
                ->appends($queryParam);

            $bookingOverview = DB::table('service_bookings')
                ->where('provider_id', $id)
                ->select('booking_status', DB::raw('count(*) as total'))
                ->groupBy('booking_status')
                ->get();

            $status = ['accepted', 'ongoing', 'completed', 'canceled'];
            $total = [];
            foreach ($status as $item) {
                if ($bookingOverview->where('booking_status', $item)->first() !== null) {
                    $total[] = $bookingOverview->where('booking_status', $item)->first()->total;
                } else {
                    $total[] = 0;
                }
            }


            return view('service::admin.provider-management.provider.detail.review', compact('webPage', 'provider', 'reviews', 'search', 'provider', 'total'));

        } //serviceman_list
        elseif ($webPage == 'serviceman_list') {
            $search = $request->has('searchq') ? $request['searchq'] : '';
            $queryParam = ['web_page' => $webPage, 'searchq' => $search];

            $servicemen = $this->serviceman
                ->where('service_provider_id', $id)
                ->when($request->has('searchq'), function ($query) use ($request) {
                    $keys = explode(' ', $request['searchq']);
                    return $query->where(function ($query) use ($keys) {
                        foreach ($keys as $key) {
                            $query->orWhere('first_name', 'LIKE', '%' . $key . '%')
                                ->orWhere('last_name', 'LIKE', '%' . $key . '%');
                        }
                    });
                })
                ->latest()
                ->paginate(pagination_limit())
                ->appends($queryParam);

            foreach ($servicemen as $serviceman) {

                $bookingOverview = DB::table('service_bookings')
                    ->select('booking_status', DB::raw('count(*) as total'))
                    ->where('serviceman_id', $serviceman->id)
                    ->groupBy('booking_status');

                $repeatOverview = DB::table('service_booking_repeats')
                    ->select('booking_status', DB::raw('count(*) as total'))
                    ->where('serviceman_id', $serviceman->id)
                    ->groupBy('booking_status');

                $combinedOverview = collect($bookingOverview->unionAll($repeatOverview)->get());

                $serviceman->total_booking = $combinedOverview->sum('total') ?? 0;
            }


            return view('service::admin.provider-management.provider.detail.serviceman-list', compact('provider', 'servicemen', 'webPage'));

        } //transactions
        elseif ($webPage == 'transactions') {
            // $provider = $this->provider->find($id);
            return view('service::admin.provider-management.provider.detail.transactions', compact('webPage', 'provider'));

        } //conversations
        elseif ($webPage == 'conversations') {
            // $provider = $this->provider->find($id);
            $user = UserInfo::where(['provider_id' => $id])->first();
            if ($user) {
                $conversations = Conversation::with(['sender', 'receiver', 'last_message'])->WhereUser($user->id)
                    ->paginate(8);
            } else {
                $conversations = [];
            }
            return view('service::admin.provider-management.provider.detail.conversations', compact('webPage', 'provider', 'conversations'));

        } //meta-data
        elseif ($webPage == 'meta-data') {
            // $provider = $this->provider->find($id);
            return view('service::admin.provider-management.provider.detail.meta-data', compact('webPage', 'provider'));

        } //business-plan
        elseif ($webPage == 'business-plan') {
            // $provider = $this->provider->find($id);
            $admin_commission = business_config('default_commission', 'service_business_settings')->value ?? 0;
            $packages = $this->subscriptionPackage->OfStatus(1)
                ->ofModule('service')
                ->get();
            return view('service::admin.provider-management.provider.detail.business_plan', compact('webPage', 'provider', 'admin_commission', 'packages'));

        } //settings
        elseif ($webPage == 'settings') {
            $settings = $this->providerSetting->where('provider_id', $id)
                ->where('type', 'provider_config')
                ->pluck('value', 'key')
                ->toArray();

            return view('service::admin.provider-management.provider.detail.settings', compact('webPage', 'provider', 'settings'));
        }
        /* //bank_info
        elseif ($webPage == 'bank_information') {
            $provider = $this->provider->with('owner.account', 'bank_detail')->find($id);
            return view('providermanagement::admin.provider.detail.bank-information', compact('webPage', 'provider'));

        } //subscription
        elseif ($webPage == 'subscription') {

            $provider = $this->provider->where('id', $id)->first();
            $providerId = $provider->id;
            $subscriptionStatus = (int)((business_config('provider_subscription', 'provider_config'))->live_values);
            $commission = $provider->commission_status == 1 ? $provider->commission_percentage : (business_config('default_commission', 'business_information'))->live_values;
            $subscriptionDetails = $this->packageSubscriber->where('provider_id', $id)->first();

            if ($subscriptionDetails){
                $subscriptionPrice = $this->subscriptionPackage->where('id', $subscriptionDetails?->subscription_package_id)->value('price');
                $vatPercentage      = (int)((business_config('subscription_vat', 'subscription_Setting'))->live_values ?? 0);

                $start = Carbon::parse($subscriptionDetails?->package_start_date)->subDay() ?? '';
                $end = Carbon::parse($subscriptionDetails?->package_end_date)?? '';
                $daysDifference = $start->diffInDays($end, false);

                $bookingCheck = $subscriptionDetails?->limits->where('provider_id', $id)->where('key', 'booking')->first();
                $categoryCheck = $subscriptionDetails?->limits->where('provider_id', $id)->where('key', 'category')->first();
                $isBookingLimit = $bookingCheck?->is_limited;
                $isCategoryLimit = $categoryCheck?->is_limited;

                $totalBill = $subscriptionDetails?->logs->where('provider_id', $providerId)->sum('package_price') ?? 0.00;
                $totalPurchase = $subscriptionDetails?->logs->where('provider_id', $providerId)->count() ?? 0;
                $calculationVat = $subscriptionPrice * ($vatPercentage / 100);
                $renewalPrice = $subscriptionPrice + $calculationVat;

                return view('providermanagement::admin.provider.detail.subscription', compact('webPage', 'subscriptionDetails', 'daysDifference', 'bookingCheck', 'categoryCheck', 'isBookingLimit', 'isCategoryLimit', 'totalBill', 'totalPurchase', 'renewalPrice'));
            }

            return view('providermanagement::admin.provider.detail.subscription', compact('webPage','subscriptionDetails','commission', 'subscriptionStatus'));

        } */
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function updateAccountInfo($id, Request $request): RedirectResponse
    {
        $this->authorize('provider_update');

        $this->bank_detail::updateOrCreate(
            ['provider_id' => $id],
            [
                'bank_name' => $request->bank_name,
                'branch_name' => $request->branch_name,
                'acc_no' => $request->acc_no,
                'acc_holder_name' => $request->acc_holder_name,
            ]
        );

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function deleteAccountInfo($id, Request $request): JsonResponse
    {
        $this->authorize('provider_delete');

        $provider = $this->provider->with(['bank_detail'])->find($id);

        if (!$provider->bank_detail) {
            return response()->json(response_formatter(DEFAULT_404), 200);
        }
        $provider->bank_detail->delete();
        return response()->json(response_formatter(DEFAULT_STATUS_UPDATE_200), 200);
    }


    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return RedirectResponse
     */
    public function updateSubscription(Request $request, $id): RedirectResponse
    {
        $subCategory = Category::where('id', $id)
            ->ofType('sub')
            ->ofStatus(1)
            ->first();
        if (!$subCategory) {
            Toastr::error(translate('messages.sub_category_not_found'));
            return back();
        }

        $subscribedService = $this->subscribedService->where('provider_id', $request->provider_id)
            ->where('sub_category_id', $id)
            ->first();
        if (empty($subscribedService)) {
            $subscribedService = new SubscribedService();
            $subscribedService->provider_id = $request->provider_id;
            $subscribedService->category_id = $subCategory->parent_id;
            $subscribedService->sub_category_id = $id;
            $subscribedService->is_subscribed = 1;
        } else {
            $subscribedService->is_subscribed = !$subscribedService->is_subscribed;
        }
        $subscribedService->save();

        // $this->subscribedService->where('id', $id)->update(['is_subscribed' => !$subscribedService->is_subscribed]);


        Toastr::success(translate(DEFAULT_STATUS_UPDATE_200['message']));
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return Application|Factory|View
     */
    public function edit(string $id): View|Factory|Application
    {

        $zones = $this->zone->active()->get();
        $provider = $this->provider->withoutGlobalScope('translate')->with(['zone'])->find($id);
        $commission = (int)((business_config('provider_commision', 'service_business_settings'))->value ?? null);
        $subscription = (int)((business_config('provider_subscription', 'service_business_settings'))->value ?? null);
        $duration = (int)((business_config('free_trial_period', 'service_business_settings'))->value ?? null);
        $freeTrialStatus = (int)((business_config('free_trial_period', 'service_business_settings'))->is_active ?? 0);
        $packages = $this->subscriptionPackage->OfStatus(1)
            ->ofModule('service')
            ->get();
        // $packageSubscription = $this->packageSubscriber->where('provider_id', $id)->first();
        $language = getWebConfig('language');
        return view('service::admin.provider-management.provider.edit', compact('provider', 'zones', 'commission','subscription','packages', 'duration', 'freeTrialStatus', 'language'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $provider = $this->provider->find($id);

        Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'business_email' => 'required|email|unique:service_providers,company_email,'.$provider->id,
            'business_phone' => 'required|unique:service_providers,company_phone,'.$provider->id,
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'cover_photo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'zone_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
//            'minimum_service_time' => 'required|integer|min:0',
//            'maximum_service_time' => 'required|integer|min:0',
//            'service_time_type' => 'required|in:min,hours,days',
            'f_name' => 'required|string|max:191',
            'l_name' => 'required|string|max:191',
            'phone' => 'required|unique:service_providers,phone,'.$provider->id,
            'email' => 'required|email|unique:service_providers,email,'.$provider->id,
            'password' => 'nullable|min:8|confirmed',

            'identity_type' => 'required|in:passport,driving_license,nid,trade_license,company_id',
            'identity_number' => 'required',
            'identity_images' => 'nullable|array',
            'identity_images.*' => 'image|mimes:jpeg,jpg,png,gif',
        ])->validate();

        if (Provider::where('email', $request['email'])->where('id', '!=', $provider->id)->first()) {
            Toastr::error(translate('Email already taken'));
            return back();
        }
        if (Provider::where('phone', $request['phone'])->where('id', '!=', $provider->id)->first()) {
            Toastr::error(translate('Phone already taken'));
            return back();
        }

        if ($request->zone_id && !$this->isValidZone($request)) {
            Toastr::error(translate('messages.coordinates_out_of_zone'));
            return back()->withInput();
        }

        if ($request->business_plan == 'subscription-base' && !$request->package_id) {
            Toastr::error(translate('messages.You_must_select_a_package'));
            return back()->withInput();
        }
        if($request->business_plan == 'subscription-base') {
            $package = $this->subscriptionPackage->where('id',$request->package_id)
                ->ofStatus(1)
                ->where('module_type', 'service')
                ->first();
            if (!$package) {
                Toastr::error(translate('Please Select valid plan'));
                return back();
            }

            $packageId                 = $package?->id;
            $packagePrice              = $package?->price;
            $packageName               = $package?->name;
        }


        $identityImages = [];
        if (!is_null($request->identity_images)) {
            foreach ($request->identity_images as $image) {
                $imageName = file_uploader('provider/identity/', 'png', $image);
                $identityImages[] = ['image'=>$imageName, 'storage'=> getDisk()];
            }
        } else {
            $identityImages = json_decode($provider->identification_image ?? []);
        }
        // dd($identityImages);

        $provider->module_id = $this->currentModuleId();
        $provider->zone_id = $request->zone_id;
        $provider->coordinates = ['latitude' => $request['latitude'], 'longitude' => $request['longitude']];
        $provider->first_name = $request->f_name;
        $provider->last_name = $request->l_name;
        $provider->phone = $request->phone;
        $provider->email = $request->email;
        if($request->password != null) {
            $provider->password = bcrypt($request->password);
        }
        $provider->identification_type = $request->identity_type;
        $provider->identification_number = $request->identity_number;
        $provider->identification_image = json_encode($identityImages);

        $provider->company_name = $request->name[array_search('default', $request->lang)];
        $provider->company_email = $request->business_email;
        $provider->company_phone = $request->business_phone;
        $provider->company_address = $request->address[array_search('default', $request->lang)];
        if($request->hasFile('logo')) {
            $provider->logo = file_uploader('provider/logo/', 'png', $request->file('logo'));
        }
        if($request->hasFile(('cover_photo'))) {
            $provider->cover_image = file_uploader('provider/cover-image/', 'png', $request->file('cover_photo'));
        }

        $provider->minimum_service_time = 0;
        $provider->maximum_service_time = 0;
        $provider->service_time_type = '';
        $provider->is_approved = 1; // auto approved
        $provider->business_model = ($request->business_plan == "subscription-base") ? 'subscription' : 'commission';
        $provider->save();

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'company_name',
            name_field:'name',
            model_name: get_class($provider),
            data_id: $provider->id,
            data_value: $provider->company_name,
            model_class: true
        );

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'company_address',
            name_field:'address',
            model_name: get_class($provider),
            data_id: $provider->id,
            data_value: $provider->company_address,
            model_class: true
        );

        if ($provider->is_approved == '2' || $provider->is_approved == '0') {
            $provider->is_approved = 1;
            try {
                // Mail::to($provider?->owner?->email)->send(new RegistrationApprovedMail($provider));
            } catch (\Exception $exception) {
                info($exception);
            }
        }

        /* DB::transaction(function () use ($provider, $owner, $request) {
            $owner->save();
            $owner->zones()->sync($request->zone_id);
            $provider->save();
        });

        if ($request->plan_type == 'subscription_based') {
            $provider_id = optional($provider)->id;
            $result = true;

            $packageSubscription = $this->packageSubscriber->where('provider_id', $id)->first();

            if ($packageSubscription === null || $packageSubscription->subscription_package_id != $packageId) {

                if ($request->plan_price == 'received_money') {

                    $payment = $this->paymentRequest;
                    $payment->payment_amount = $price;
                    $payment->success_hook = 'subscription_success';
                    $payment->failure_hook = 'subscription_fail';
                    $payment->payer_id = $provider->user_id;
                    $payment->payment_method = 'manually';
                    $payment->additional_data = json_encode($request->all());
                    $payment->attribute = 'provider-reg';
                    $payment->attribute_id = $provider_id;
                    $payment->payment_platform = 'web';
                    $payment->is_paid = 1;
                    $payment->save();
                    $request['payment_id'] = $payment->id;

                    $result = $packageSubscription === null
                        ? $this->handlePurchasePackageSubscription($packageId, $provider_id, $request->all(), $price, $name)
                        : $this->handleShiftPackageSubscription($packageId, $provider_id, $request->all(), $price, $name);
                } elseif ($request->plan_price == 'free_trial') {
                    $result = $this->handleFreeTrialPackageSubscription($packageId, $provider_id, $price, $name);
                } else {
                    Toastr::error(translate('Invalid plan price'));
                    return back();
                }
            }

            if (!$result) {
                Toastr::error(translate('Something went wrong'));
                return back();
            }
        }

        if ($request->plan_type == 'commission_based'){
            $this->packageSubscriber->where('provider_id', $id)->delete();
        } */


        Toastr::success(translate(PROVIDER_STORE_200['message']));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        // $this->authorize('provider_delete');

        Validator::make($request->all(), [
            'provider_id' => 'required'
        ]);

        $providers = $this->provider->where('id', $id);
        if ($providers->count() > 0) {
            foreach ($providers->get() as $provider) {
                file_remover('provider/logo/', $provider->logo);
                if (!empty($provider->owner->identification_image)) {
                    foreach ($provider->owner->identification_image as $image) {
                        file_remover('provider/identity/', $image);
                    }
                }

                /* $provider->servicemen->each(function ($serviceman) {
                    $serviceman->user->update(['is_active' => 0]);
                });

                $provider->owner()->delete(); */
            }
            $providers->delete();
            Toastr::success(translate(DEFAULT_DELETE_200['message']));
            return back();
        }

        Toastr::error(translate(DEFAULT_FAIL_200['message']));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return RedirectResponse
     */
    public function statusUpdate($id): RedirectResponse
    {

        $provider = $this->provider->where('id', $id)->first();
        $this->provider->where('id', $id)->update(['is_active' => !$provider->is_active]);
        /*
        if ($owner?->is_active == 1) {
            try {
                Mail::to($provider?->owner?->email)->send(new AccountUnsuspendMail($provider));
            } catch (\Exception $exception) {
                info($exception);
            }
        } else {
            try {
                Mail::to($provider?->owner?->email)->send(new AccountSuspendMail($provider));
            } catch (\Exception $exception) {
                info($exception);
            }
        } */

        Toastr::success(translate(DEFAULT_STATUS_UPDATE_200['message']));
        return redirect()->back();
        // return response()->json(response_formatter(DEFAULT_STATUS_UPDATE_200), 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return JsonResponse
     */
    public function serviceAvailability($id): JsonResponse
    {
        $this->authorize('provider_manage_status');

        $provider = $this->provider->where('id', $id)->first();
        $this->provider->where('id', $id)->update(['service_availability' => !$provider->service_availability]);
        return response()->json(response_formatter(DEFAULT_STATUS_UPDATE_200), 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return JsonResponse
     */
    public function suspendUpdate($id): JsonResponse
    {
        $provider = $this->provider->where('id', $id)->first();
        $this->provider->where('id', $id)->update(['is_suspended' => !$provider->is_suspended]);
        $provider_info = $this->provider->where('id', $id)->first();

        if ($provider_info?->is_suspended == '1') {
            $provider = $provider_info;
            $title = get_push_notification_message('provider_provider_suspend', $provider?->current_language_key);
            if ($provider?->fcm_token && $title) {
                device_notification($provider?->fcm_token, $title, null, null, $provider_info->id, 'suspend');
            }
            try {
                Mail::to($provider?->email)->send(new AccountSuspendMail($provider));
            } catch (\Exception $exception) {
                info($exception);
            }
        } else {
            $provider = $provider_info;
            $title = get_push_notification_message('provider_provider_suspension_remove', $provider?->current_language_key);
            if ($provider?->fcm_token && $title) {
                device_notification($provider?->fcm_token, $title, null, null, $provider_info->id, 'suspend');
            }
            try {
                Mail::to($provider?->email)->send(new AccountUnsuspendMail($provider));
            } catch (\Exception $exception) {
                info($exception);
            }
        }

        return response()->json(response_formatter(DEFAULT_SUSPEND_UPDATE_200), 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function commissionUpdate($id, Request $request): RedirectResponse
    {

        $provider = $this->provider->where('id', $id)->first();
        $provider->commission_type = ($request->commission_status == '1') ? 'custom' : 'default';
        if ($provider->commission_type == 'custom') {
            $provider->commission = $request->commission;
        }
        $provider->save();

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    public function cancelSubscription($id, $subscription_id): RedirectResponse
    {
        $provider = $this->provider->where('id', $id)->first();
        StoreSubscription::where([
                'store_id' => $provider->id,
                'store_type' => 'service_provider',
                'id' => $subscription_id
            ])
            ->update([
                'is_canceled' => 1,
                'canceled_by' => 'admin',
            ]);

        Toastr::success(translate(DEFAULT_STATUS_UPDATE_200['message']));
        return back();
    }

    public function subscriptionPackageView($id,$store_id){
        $store_subscription= StoreSubscription::where('store_id', $store_id)
            ->where('store_type', 'service_provider')
            ->with(['package'])
            ->latest()
            ->first();
        $package = SubscriptionPackage::where('status',1)->where('id',$id)->first();
        $store= Provider::Where('id',$store_id)->first();
        $pending_bill= SubscriptionBillingAndRefundHistory::whereHas('storeSubscription', function ($query) use ($store) {
            $query->where('store_id', $store->id)
                ->where('store_type', 'service_provider');
        })->where(['transaction_type'=>'pending_bill', 'is_success' =>0])->sum('amount');

        // $balance = BusinessSetting::where('key', 'wallet_status')->first()?->value == 1 ? StoreWallet::where('vendor_id',$store->vendor_id)->first()?->balance ?? 0 : 0;
        $balance = 0;
        $payment_methods = Helpers::getActivePaymentGateways();
        $disable_item_count=null;
        /* if(data_get(Helpers::subscriptionConditionsCheck(store_id:$store->id,package_id:$package->id) , 'disable_item_count') > 0 && ( !$store_subscription || $package->id != $store_subscription->package_id)){
            $disable_item_count=data_get(Helpers::subscriptionConditionsCheck(store_id:$store->id,package_id:$package->id) , 'disable_item_count');
        } */
        $store_business_model=$store->business_model;
        // $admin_commission=BusinessSetting::where('key', "admin_commission")->first()?->value ?? 0 ;
        $admin_commission = 0;
        $admin_commission = business_config('default_commission', 'service_business_settings')->value ?? 0;
        $cash_backs=[];
        if($store->business_model == 'subscription' &&  $store_subscription->status == 1 && $store_subscription->is_canceled == 0 && $store_subscription->is_trial == 0  && $store_subscription->package_id !=  $package->id){
            $cash_backs= Helpers::calculateSubscriptionRefundAmount(store:$store, return_data:true);
        }

        return response()->json([
            'disable_item_count'=> $disable_item_count,
            'view' => view('service::admin.provider-management.provider.detail.partials._package_selected', compact('store_subscription','package','store_id','balance','payment_methods','pending_bill','store_business_model','admin_commission','cash_backs'))->render()
        ]);

    }

    public function subscribePackage(Request $request){

        $request->validate([
            'package_id' => 'required',
            'store_id' => 'required',
            'payment_gateway' => 'required'
        ]);
        $store= Provider::Where('id',$request->store_id)->first();
        $package = SubscriptionPackage::withoutGlobalScope('translate')->find($request->package_id);


        $pending_bill= SubscriptionBillingAndRefundHistory::whereHas('storeSubscription', function ($query) use ($store) {
                $query->where('store_id', $store->id)
                    ->where('store_type', 'service_provider');
            })->where(['transaction_type'=>'pending_bill', 'is_success' =>0])?->sum('amount')?? 0;

        if(!in_array($request->payment_gateway,['wallet','manual_payment_by_admin'])){
            $url= route('admin.business-settings.subscriptionackage.subscriberDetail',$store->id);
            return redirect()->away(Helpers::subscriptionPayment(store_id:$store->id,package_id:$package->id,payment_gateway:$request->payment_gateway,payment_platform:'web',url:$url,pending_bill:$pending_bill,type: $request?->type));
        }

        if($request->payment_gateway == 'wallet'){
            $wallet= getUserAccount($store->id, PROVIDER);
            $balance = BusinessSetting::where('key', 'wallet_status')->first()?->value == 1 ? $wallet?->wallet_balance ?? 0 : 0;
            if($balance >= ($package?->price + $pending_bill)){
                $reference= 'wallet_payment_by_admin';
                $plan_data=   Helpers::service_provider_subscription_plan_chosen(provider_id:$store->id,package_id:$package->id,payment_method:$reference,discount:0,pending_bill:$pending_bill,reference:$reference,type: $request?->type);
                if($plan_data != false){
                    $wallet->total_withdrawn= $wallet?->total_withdrawn + $package->price + $pending_bill;
                    $wallet?->save();
                }
            }
            else{
                Toastr::error( translate('messages.Insufficient_balance_in_wallet'));
                return back();
            }
        } elseif($request->payment_gateway == 'manual_payment_by_admin'){
            $reference= 'manual_payment_by_admin';
            $plan_data=   Helpers::service_provider_subscription_plan_chosen(provider_id:$store->id,package_id:$package->id,payment_method:$reference,discount:0,pending_bill:$pending_bill,reference:$reference,type: $request?->type);
        }
        // dump($plan_data);
        // dd($request->payment_gateway);
        $plan_data != false ?  Toastr::success(  $request?->type == 'renew' ?  translate('Subscription_Package_Renewed_Successfully.'): translate('Subscription_Package_Shifted_Successfully.') ) : Toastr::error( translate('Something_went_wrong!.'));
        return back();

    }

    public function switchToCommission($id){

        $store=  Provider::where('id',$id)->with('store_sub')->first();

        $store_subscription=  $store->store_sub;
        if($store->business_model == 'subscription'  && $store_subscription?->is_canceled === 0 && $store_subscription?->is_trial === 0){
            Helpers::serviceProviderCalculateSubscriptionRefundAmount(store:$store);
        }

        $store->business_model = 'commission';
        $store->save();

        StoreSubscription::where(['store_id' => $id])
            ->where('store_type', 'service_provider')
            ->update([
                'status' => 0,
            ]);

        Toastr::success(translate(DEFAULT_STATUS_UPDATE_200['message']));
        return back();

    }

    public function onboardingRequest(Request $request): Factory|View|Application
    {
        $status = $request->status == 'denied' ? 'denied' : 'onboarding';
        $search = $request['search'];
        $queryParam = ['status' => $status, 'search' => $request['search']];

        $providers = $this->provider->with(['zone'])
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                foreach ($keys as $key) {
                    $query->orWhere('company_name', 'LIKE', '%' . $key . '%')
                        ->orWhere('first_name', 'LIKE', '%' . $key . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $key . '%')
                        ->orWhere('phone', 'LIKE', '%' . $key . '%')
                        ->orWhere('email', 'LIKE', '%' . $key . '%');
                }
            })
            ->ofApproval($status == 'onboarding' ? 0 : 2)
            ->latest()
            ->paginate(pagination_limit())
            ->appends($queryParam);

        $providersCount = [
            'onboarding' => $this->provider->ofApproval(0)->get()->count(),
            'denied' => $this->provider->ofApproval(2)->get()->count(),
        ];

        return view('service::admin.provider-management.provider.onboarding', compact('providers', 'search', 'status', 'providersCount'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @param Request $request
     */
    public function onboardingDetails($id, Request $request)
    {
        $provider = $this->provider->with('account')->withCount(['bookings'])->find($id);
        if($provider->is_approved == 1) {
            Toastr::error(translate('messages.This provider is already approved'));
            return redirect()->route('admin.service.provider.onboarding_request');
        }
        return view('service::admin.provider-management.provider.onboarding-details', compact('provider'));
    }

    public function updateApproval($id, $status, Request $request)
    {
        if ($status == 'approve') {
            $this->provider->where('id', $id)->update(['is_active' => 1, 'is_approved' => 1]);
            $provider = $this->provider->where('id', $id)->first();

            $approval  = isNotificationActive(null, 'registration', 'email', 'provider');
            if ($approval) {
                try {
                    Mail::to($provider?->email)->send(new RegistrationApprovedMail($provider));
                } catch (\Exception $exception) {
                    info($exception);
                }
            }

        } elseif ($status == 'deny') {
            $this->provider->where('id', $id)->update(['is_active' => 0, 'is_approved' => 2]);
            $provider = $this->provider->where('id', $id)->first();
            $deny  = isNotificationActive(null, 'registration', 'email', 'provider');
            if ($deny) {
                try {
                    Mail::to($provider?->email)->send(new RegistrationDeniedMail($provider));
                } catch (\Exception $exception) {
                    info($exception);
                }
            }

        } else {
            Toastr::error(translate('messages.Invalid status'));
            return redirect()->back();
        }

        Toastr::success(translate('messages.Status updated successfully'));

        return redirect()->route('admin.service.provider.onboarding_request');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return string|StreamedResponse
     */
    public function download(Request $request)
    {
        $providers = $this->provider->with(['zone'])->where(['is_approved' => 1])->withCount(['subscribed_services', 'bookings'])
            ->when($request->zone_id != null, function ($query) use ($request) {
                return $query->where('zone_id', $request->zone_id);
            })
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('company_phone', 'LIKE', '%' . $key . '%')
                            ->orWhere('company_email', 'LIKE', '%' . $key . '%')
                            ->orWhere('company_name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->ofApproval(1)
            ->when($request->has('status') && $request['status'] != 'all', function ($query) use ($request) {
                return $query->ofStatus(($request['status'] == 'active') ? 1 : 0);
            })
            ->latest()
            ->get();

        $fileName = 'providers.xlsx';
        $search = $request->input('search') ?? '';
        $zone_id = $request->zone_id ?? 'All Zones';

        return Excel::download(new ProviderExport([
            'providers' => $providers,
            'search' => $search,
            'zone' => $zone_id,
        ]), $fileName);
    }

    public function reviewsDownload(Request $request)
    {
        $items = Review::with(['booking'])
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                foreach ($keys as $key) {
                    $query->orWhere('id', 'LIKE', '%' . $key . '%');
                }
            })
            ->where('provider_id', $request->provider_id)
            ->latest()
            ->get();
        return (new FastExcel($items))->download(time() . '-file.xlsx');
    }

    public function availableProviderList(Request $request): JsonResponse
    {
        $sortBy = $request->sort_by ?? 'default';
        $search = $request->search;
        $sortBy = $request->sort_by;
        $bookingId = $request->booking_id;
        $booking = $this->booking->where('id', $bookingId)->first();

        if (!isset($booking)) {
            $bookingRepeat = $this->bookingRepeat->where('id', $bookingId)->first();
            if ($bookingRepeat) {
                $booking = $this->booking->where('id', $bookingRepeat->booking_id)->first();
                if ($booking) {
                    $bookingId = $bookingRepeat->booking_id;
                }
            }
        }


        $allProviders = $this->provider
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('company_phone', 'LIKE', '%' . $key . '%')
                            ->orWhere('company_email', 'LIKE', '%' . $key . '%')
                            ->orWhere('company_name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($sortBy === 'top-rated', function ($query) {
                return $query->orderBy('avg_rating', 'desc');
            })
            ->when($sortBy === 'bookings-completed', function ($query) {
                $query->withCount(['bookings' => function ($query) {
                    $query->where('booking_status', 'completed');
                }]);
                $query->orderBy('bookings_count', 'desc');
            })
            ->when($sortBy !== 'bookings-completed', function ($query) {
                return $query->withCount('bookings');
            })
            ->whereHas('subscribed_services', function ($query) use ($request, $booking) {
                $query->where('sub_category_id', $booking->sub_category_id)->where('is_subscribed', 1);
            })
            ->when(business_config('provider_suspend_on_exceed_cash_limit')->value, function ($query) {
                $query->where('is_suspended', 0);
            })
            ->where('service_availability', 1)
            ->withCount('reviews')
            ->ofApproval(1)->ofStatus(1)->get();

        $providers = [];

        foreach ($allProviders as $provider) {
            $serviceLocation = getProviderServiceLocation(providerId: $provider->id);

            if (in_array($booking->service_location, $serviceLocation)) {
                $providers[] = $provider;
            }
        }

        $booking = $this->booking->with(['detail.service' => function ($query) {
            $query->withTrashed();
        }, 'detail.service.category', 'detail.service.subCategory', 'detail.variation', 'customer', 'provider', 'service_address', 'serviceman', 'service_address', 'status_histories.user'])->find($bookingId);

        return response()->json([
            'view' => view('providermanagement::admin.partials.details.provider-info-modal-data', compact('providers', 'booking', 'search', 'sortBy'))->render()
        ]);
    }

    public function providerInfo(Request $request): JsonResponse
    {
        $booking = $this->booking->where('id', $request->booking_id)->first();

        return response()->json([
            'view' => view('providermanagement::admin.partials.details._provider-data', compact('booking'))->render(),
            'serviceman_view' => view('providermanagement::admin.partials.details._serviceman-data', compact('booking'))->render(),
        ]);
    }

    public function reassignProvider(Request $request): JsonResponse
    {
        $changedBy = $request->user()->id;
        $providerId = $request->provider_id;

        if (!$providerId || !$request->booking_id) {
            return response()->json(['message' => 'Invalid request data'], 400);
        }

        $sortBy = $request->sort_by ?? 'default';
        $search = $request->search;

        $booking = $this->booking->find($request->booking_id);
        $bookingRepeat = $this->bookingRepeat->where('id', $request->booking_id)->with('booking')->first();

        if ($booking) {
            $this->updateBooking($booking, $providerId, $changedBy);

            if (!is_null($booking->repeat)) {
                $this->updateRepeatBookings($booking->repeat, $providerId, $booking->provider_id ? 1 : 0);
            }

            $this->sendProviderNotification($providerId, $booking->id, 'booking');
            $providers = $this->fetchProviders($request, $booking->sub_category_id);

            return response()->json([
                'view' => view('providermanagement::admin.partials.details.provider-info-modal-data', compact('providers', 'booking', 'search', 'sortBy'))->render(),
            ]);
        }

        if ($bookingRepeat) {
            $this->updateBookingRepeat($bookingRepeat, $providerId, $changedBy);
            $this->sendProviderNotification($providerId, $bookingRepeat->id, 'repeat');
            $providers = $this->fetchProviders($request, $bookingRepeat->booking->sub_category_id);

            return response()->json([
                'view' => view('providermanagement::admin.partials.details.provider-info-modal-data', [
                    'providers' => $providers,
                    'booking' => $bookingRepeat,
                    'search' => $search,
                    'sortBy' => $sortBy,
                ])->render(),

            ]);
        }

        return response()->json(response_formatter(DEFAULT_204), 200);
    }

    private function updateBooking($booking, $providerId, $changedBy): void
    {
        $booking->update([
            'provider_id' => $providerId,
            'serviceman_id' => null,
            'booking_status' => 'accepted',
        ]);

        $this->bookingStatusHistory->create([
            'booking_id' => $booking->id,
            'changed_by' => $changedBy,
            'booking_status' => 'accepted',
        ]);
    }

    private function updateRepeatBookings($repeats, $providerId, $isReassign): void
    {
        foreach ($repeats->whereIn('booking_status', ['pending', 'accepted', 'ongoing']) as $repeat) {
            $repeat->update([
                'provider_id' => $providerId,
                'serviceman_id' => null,
                'booking_status' => 'accepted',
                'is_reassign' => $isReassign,
            ]);
        }
    }

    private function updateBookingRepeat($bookingRepeat, $providerId, $changedBy): void
    {
        $allBookingRepeat = $this->bookingRepeat->where('booking_id', $bookingRepeat->booking_id)->get();
        foreach ($allBookingRepeat as $item){
            $item->update([
                'provider_id' => $providerId,
                'serviceman_id' => null,
                'booking_status' => 'accepted',
            ]);

            $this->bookingStatusHistory->create([
                'booking_id' => 0,
                'booking_repeat_id' => $item->id,
                'changed_by' => $changedBy,
                'booking_status' => 'accepted',
            ]);
        }

        if ($bookingRepeat->booking) {
            $this->updateBooking($bookingRepeat->booking, $providerId, $changedBy);
        }
    }

    private function sendProviderNotification($providerId, $bookingId, $type): void
    {
        $provider = $this->provider->find($providerId);

        if ($provider) {
            $fcmToken = $provider->fcm_token;
            $languageKey = $provider->current_language_key;

            $bookingNotificationStatus = business_config('booking_notification')->value;
            if ($fcmToken && $bookingNotificationStatus) {
                $readableId = $this->booking->where('id', $bookingId)->value('id');
                $title = translate('Admin has assigned you booking ID') . ' ' . $readableId;
                device_notification($fcmToken, $title, null, null, $bookingId, 'booking', '', '', '', '', $type);
            }
        }
    }

    private function fetchProviders(Request $request, $subCategoryId)
    {
        return $this->provider
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request->search);
                $query->where(function ($q) use ($keys) {
                    foreach ($keys as $key) {
                        $q->orWhere('company_phone', 'LIKE', "%{$key}%")
                            ->orWhere('company_email', 'LIKE', "%{$key}%")
                            ->orWhere('company_name', 'LIKE', "%{$key}%");
                    }
                });
            })
            ->when($request->sort_by === 'top-rated', fn($q) => $q->orderBy('avg_rating', 'desc'))
            ->when($request->sort_by === 'bookings-completed', function ($q) {
                $q->withCount(['bookings' => fn($query) => $query->where('booking_status', 'completed')])
                    ->orderBy('bookings_count', 'desc');
            })
            ->whereHas('subscribed_services', fn($q) => $q->where('sub_category_id', $subCategoryId)->where('is_subscribed', 1))
            ->when($request->sort_by !== 'bookings-completed', fn($q) => $q->withCount('bookings'))
            ->where('service_availability', 1)
            ->ofApproval(1)
            ->ofStatus(1)
            ->get();
    }

    public function getProviderInfo($providerId): JsonResponse
    {
        $provider = $this->provider->with('reviews')->findOrFail($providerId);
        $reviews = DB::table('reviews')->where('provider_id', $provider->id)->count();
        return response()->json(['reviews' => $reviews, 'rating' => $provider->avg_rating]);
    }


    public function getProviders(Request $request){
        $zone_ids = isset($request->zone_ids)?(count($request->zone_ids)>0?$request->zone_ids:[]):0;
        $data = $this->provider
        ->when($zone_ids, function($query) use($zone_ids){
            $query->whereIn('stores.zone_id', [$zone_ids]);
        })
        ->where('module_id', $this->currentModuleId())
        ->when($request->module_type, function($query)use($request){
            $query->whereHas('module', function($q)use($request){
                $q->where('module_type', $request->module_type);
            });
        })
        ->where('company_name', 'like', '%'.$request->q.'%')
        ->limit(8)->get()
        ->map(function ($store) {
            return [
                'id' => $store->id,
                'text' => $store->company_name . ' (' . $store->zone?->name . ')',
            ];
        });
        if(isset($request->all))
        {
            $data[]=(object)['id'=>'all', 'text'=>translate('messages.all')];
        }
        return response()->json($data);
    }

    public function getAccountData($providerId) {
        // $provider = $this->provider->findOrFail($providerId);
        $account = getUserAccount($providerId, PROVIDER);
        return response()->json([
            'cash_in_hand' => $account->payable_balance ?? 0,
            'earning_balance' => $account->received_balance + $account->total_withdrawn,
        ]);
    }

    public function updateMetaData(Request $request, $providerId)
    {
        $provider = $this->provider->findOrFail($providerId);
        $provider->meta_title = $request->meta_title[array_search('default', $request->lang)];
        $provider->meta_description = $request->meta_description[array_search('default', $request->lang)];
        if($request->hasFile('meta_image')) {
            $provider->meta_image = file_uploader('provider/meta-image/', 'png', $request->file('meta_image'));
        }

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'meta_title',
            name_field:'meta_title',
            model_name: get_class($provider),
            data_id: $provider->id,
            data_value: $provider->meta_title,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $request,
            key_data:'meta_description',
            name_field:'meta_description',
            model_name: get_class($provider),
            data_id: $provider->id,
            data_value: $provider->meta_description,
            model_class: true
        );

        $provider->save();

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    public function updateSettings(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $provider = $this->provider->findOrFail($id);
            $provider->service_availability = $request->service_availability ? 1 : 0;
            $provider->minimum_service_time = $request->minimum_service_time ?? 0;
            $provider->maximum_service_time = $request->maximum_service_time ?? 0;
            $provider->service_time_type = $request->service_time_type ?? 'minutes';
            $provider->save();

            $keys = [
                // 'provider_vat_percent' => 'int',
                'instant_booking' => 'bool',
                'repeat_booking' => 'bool',
                'schedule_booking' => 'bool',
                'time_restriction_on_schedule_booking' => 'bool',
                'time_restriction_on_schedule_booking_value' => 'int',
                'time_restriction_on_schedule_booking_type' => 'string',
                'service_at_customer_location' => 'bool',
                'service_at_provider_location' => 'bool',
                'serviceman_can_cancel_booking' => 'bool',
                'serviceman_can_edit_booking' => 'bool'
            ];

            foreach ($keys as $key => $type) {
                $value = $request->$key;
                if ($type === 'int') {
                    $value = (int)$value;
                } elseif ($type === 'bool') {
                    $value = 0;
                    if($request->has($key) && ($request->$key == '1')) {
                        $value = 1;
                    }
                } elseif ($type === 'string') {
                    $value = (string)$value;
                } else {
                    continue;
                }

                $this->providerSetting->updateOrCreate(['key' => $key, 'provider_id' => $id, 'type' => 'provider_config'], [
                    'value' => $value,
                    'is_active' => 1,
                ]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Toastr::error(translate(DEFAULT_FAIL_200['message']));
            return back();
        }
        DB::commit();

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    public function add_schedule(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'start_time'=>'required|date_format:H:i',
            'end_time'=>'required|date_format:H:i|after:start_time',
            'service_provider_id'=>'required',
        ],[
            'end_time.after'=>translate('messages.End time must be after the start time')
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        $temp = ProviderSchedule::where('day', $request->day)->where('service_provider_id',$request->service_provider_id)
        ->where(function($q)use($request){
            return $q->where(function($query)use($request){
                return $query->where('opening_time', '<=' , $request->start_time)->where('closing_time', '>=', $request->start_time);
            })->orWhere(function($query)use($request){
                return $query->where('opening_time', '<=' , $request->end_time)->where('closing_time', '>=', $request->end_time);
            });
        })
        ->first();

        if(isset($temp))
        {
            return response()->json(['errors' => [
                ['code'=>'time', 'message'=>translate('messages.schedule_overlapping_warning')]
            ]]);
        }

        $provider = Provider::find($request->service_provider_id);
        $store_schedule = $this->insert_schedule($request->service_provider_id, [$request->day], $request->start_time, $request->end_time.':59');

        return response()->json([
            'view' => view('service::admin.provider-management.provider.detail.partials._schedule', compact('provider'))->render(),
        ]);
    }

    public function insert_schedule(int $service_provider_id, array $days=[0,1,2,3,4,5,6], String $opening_time='00:00:00', String $closing_time='23:59:59')
    {
        $data = array_map(function($item)use($service_provider_id, $opening_time, $closing_time){
            return     ['service_provider_id'=>$service_provider_id,'day'=>$item,'opening_time'=>$opening_time,'closing_time'=>$closing_time];
        },$days);
        try{
            ProviderSchedule::upsert($data,['service_provider_id','day','opening_time','closing_time']);
            return true;
        }catch(\Exception $e)
        {
            return $e;
        }
        return false;

    }

    public function remove_schedule($store_schedule)
    {
        $schedule = ProviderSchedule::find($store_schedule);
        if(!$schedule)
        {
            return response()->json([],404);
        }
        $provider = $schedule->provider;
        $schedule->delete();
        return response()->json([
            'view' => view('service::admin.provider-management.provider.detail.partials._schedule', compact('provider'))->render(),
        ]);
    }

    public function conversation_list(Request $request)
    {

        $user = UserInfo::where('provider_id', $request->user_id)->first();


        $conversations = Conversation::WhereUser($user->id);

        if ($request->query('key') != null) {
            $key = explode(' ', $request->get('key'));
            $conversations = $conversations->where(function ($qu) use ($key) {

                $qu->whereHas('sender', function ($query) use ($key) {
                    foreach ($key as $value) {
                        $query->where('f_name', 'like', "%{$value}%")->orWhere('l_name', 'like', "%{$value}%")->orWhere('phone', 'like', "%{$value}%");
                    }
                })->orWhereHas('receiver', function ($query1) use ($key) {
                    foreach ($key as $value) {
                        $query1->where('f_name', 'like', "%{$value}%")->orWhere('l_name', 'like', "%{$value}%")->orWhere('phone', 'like', "%{$value}%");
                    }
                });
            });
        }

        $conversations = $conversations->paginate(8);

        $view = view('service::admin.provider-management.provider.detail.partials._conversation_list', compact('conversations'))->render();
        return response()->json(['html' => $view]);
    }

    public function conversation_view($conversation_id, $user_id)
    {
        $convs = Message::where(['conversation_id' => $conversation_id])->get();
        $conversation = Conversation::find($conversation_id);
        $receiver = UserInfo::find($conversation->receiver_id);
        $sender = UserInfo::find($conversation->sender_id);
        $user = UserInfo::find($user_id);
        return response()->json([
            'view' => view('service::admin.provider-management.provider.detail.partials._conversations', compact('convs', 'user', 'receiver'))->render()
        ]);
    }


    public function status_filter(Request $request){
        session()->put('withdraw_status_filter',$request['withdraw_status_filter']);
        return response()->json(session('withdraw_status_filter'));
    }


    public function withdraw_list(Request $request)
    {
        $key = isset($request['search']) ? explode(' ', $request['search']) : [];
        $all = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all' ? 1 : 0;
        $active = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved' ? 1 : 0;
        $denied = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied' ? 1 : 0;
        $pending = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending' ? 1 : 0;

        $withdraw_req =WithdrawRequest::with(['provider'])
            ->when($all, function ($query) {
                return $query;
            })
            ->when($active, function ($query) {
                return $query->where('request_status', 'approved');
            })
            ->when($denied, function ($query) {
                return $query->where('request_status', 'denied');
            })
            ->when($pending, function ($query) {
                return $query->where('request_status', 'pending');
            })
            ->when(isset($key), function ($query) use ($key) {
                return $query->whereHas('provider', function ($query) use ($key) {
                        foreach ($key as $value) {
                            $query->where('first_name', 'like', "%{$value}%");
                        }
                    });
            })
            ->latest()
            ->paginate(config('default_pagination'));

        return view('service::admin.provider-management.provider.withdraw', compact('withdraw_req'));
    }
    public function withdraw_export(Request $request)
    {
        $key = isset($request['search']) ? explode(' ', $request['search']) : [];
        $all = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all' ? 1 : 0;
        $active = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved' ? 1 : 0;
        $denied = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied' ? 1 : 0;
        $pending = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending' ? 1 : 0;

        $withdraw_req =WithdrawRequest::with(['provider'])
            ->when($all, function ($query) {
                return $query;
            })
            ->when($active, function ($query) {
                return $query->where('request_status', 'approved');
            })
            ->when($denied, function ($query) {
                return $query->where('request_status', 'denied');
            })
            ->when($pending, function ($query) {
                return $query->where('request_status', 'pending');
            })
            ->when(isset($key), function ($query) use ($key) {
                return $query->whereHas('provider', function ($query) use ($key) {
                        foreach ($key as $value) {
                            $query->where('first_name', 'like', "%{$value}%");
                        }
                    });
            })
            ->latest()
            ->get();

        $data = [
            'withdraw_requests'=>$withdraw_req,
            'search'=>$request->search??null,
            'request_status'=>session()->has('withdraw_status_filter')?session('withdraw_status_filter'):null,

        ];

        if ($request->type == 'excel') {
            return Excel::download(new ProviderWithdrawTransactionExport($data), 'WithdrawRequests.xlsx');
        } else if ($request->type == 'csv') {
            return Excel::download(new ProviderWithdrawTransactionExport($data), 'WithdrawRequests.csv');
        }
    }

    public function getWithdrawDetails(Request $request)
    {
        $withdraw = WithdrawRequest::with(['provider'])->where(['id' => $request->withdraw_id])->first();
        return response()->json([
            'view' => view('service::admin.provider-management.provider.withdraw-partials._side_view', compact('withdraw'))->render(),
        ]);
    }

    public function withdraw_search(Request $request){
        $key = explode(' ', $request['search']);
        $withdraw_req = WithdrawRequest::
        whereHas('provider', function ($query) use ($key) {
            foreach ($key as $value) {
                $query->where('first_name', 'like', "%{$value}%")
                    ->orWhere('last_name', 'like', "%{$value}%");
            }
        })->get();
        $total=$withdraw_req->count();
        return response()->json([
            'view'=>view('service::admin.provider-management.provider.withdraw-partials._table',compact('withdraw_req'))->render(), 'total'=>$total
        ]);
    }

    public function withdraw_view($withdraw_id, $seller_id)
    {
        $wr = WithdrawRequest::with(['provider'])->where(['id' => $withdraw_id])->first();
        return view('service::admin.provider-management.provider.wallet.withdraw-view', compact('wr'));
    }

    public function withdrawStatus(Request $request, $id)
    {
        $request->validate([
            'note' => 'max:255',
        ]);

        $withdrawRequest = WithdrawRequest::find($id);

        if ($request->approved == 1) {
            withdrawRequestAcceptTransaction($withdrawRequest['request_updated_by'], $withdrawRequest['amount']);

            $withdrawRequest->request_status = 'approved';
            $withdrawRequest->request_updated_by = 1;
            $withdrawRequest->updated_by_type = 'admin';
            $withdrawRequest->admin_note = $request->note;
            $withdrawRequest->is_paid = 1;
            $withdrawRequest->save();


            $provider = Provider::where('id', $withdrawRequest['user_id'])->first();
            $notification = isNotificationActive($provider?->id, 'booking', 'notification', 'provider');

            $title = get_push_notification_message('provider_widthdraw_request_approve', $provider?->current_language_key);
            if ($title && $provider && $provider->fcm_token && $notification) {
                $dataInfo = [
                    'provider_name' => $provider->company_name,
                ];
                device_notification($provider->fcm_token, $title, null, null, null, 'withdraw', null, $provider->id, $dataInfo);
            }

            Toastr::success(translate('messages.rider_withdraw_request_approved'));
            return redirect()->route('admin.transactions.service.provider.withdraw_list');

        // } else if ($request['status'] == 'settled') {
        //     $withdrawRequest->request_status = 'settled';
        //     $withdrawRequest->request_updated_by = 1;
        //     $withdrawRequest->admin_note = $request->note;
        //     $withdrawRequest->save();

        } else if ($request->approved == 2) {
            withdrawRequestDenyTransaction($withdrawRequest['request_updated_by'], $withdrawRequest['amount']);

            $withdrawRequest->request_status = 'denied';
            $withdrawRequest->request_updated_by = 1;
            $withdrawRequest->updated_by_type = 'admin';
            $withdrawRequest->admin_note = $request->note;
            $withdrawRequest->is_paid = 0;
            $withdrawRequest->save();

            $provider = Provider::where('id', $withdrawRequest['user_id'])->first();
            $notification = isNotificationActive($provider?->id, 'booking', 'notification', 'provider');

            $dataInfo = [
                'provider_name' => $provider?->company_name,
            ];
            $title = get_push_notification_message('provider_widthdraw_request_deny', $provider?->current_language_key);
            if ($title && $provider && $provider->fcm_token && $notification) {
                device_notification($provider->fcm_token, $title, null, null, null, 'withdraw', null, $provider->id, $dataInfo);
            }

            Toastr::info(translate('messages.rider_withdraw_request_denied'));
            return redirect()->route('admin.transactions.service.provider.withdraw_list');

        }

        Toastr::error(translate('messages.not_found'));
        return back();
    }

}
