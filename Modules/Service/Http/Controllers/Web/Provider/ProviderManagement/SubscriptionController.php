<?php

namespace Modules\Service\Http\Controllers\Web\Provider\ProviderManagement;

use App\Models\DataSetting;
use App\Models\Store;
use App\Models\StoreWallet;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use Illuminate\Support\Carbon;
use App\Models\BusinessSetting;
use App\Mail\SubscriptionCancel;
use App\Models\StoreSubscription;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPackage;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use App\Models\SubscriptionTransaction;
use Illuminate\Support\Facades\Session;
use App\Exports\SubscriptionTransactionsExport;
use App\Models\SubscriptionBillingAndRefundHistory;
use Modules\Rental\Emails\ProviderSubscriptionCancel;
use Modules\Service\Entities\ProviderManagement\Provider;

class SubscriptionController extends Controller
{
    public function subscriberDetail()
    {
        $provider = Provider::where('id',Helpers::get_provider_id())->withcount(['store_all_sub_trans'])->first();
        $packages = SubscriptionPackage::where('status',1)->ofModule('service')->latest()->get();
        $admin_commission = DataSetting::where('key', 'default_commission')->first()?->value ;
        $business_name = BusinessSetting::where('key', 'business_name')->first()?->value ;
        $index = 0;

        return view('service::provider.provider-management.subscription',compact('provider','packages','business_name','admin_commission','index'));
    }
    public function cancelSubscription(Request $request, $id)
    {
        StoreSubscription::where(['store_id' => Helpers::get_provider_id(), 'id' => $request->subscription_id])->where('store_type', 'service_provider')
            ->update([
                'is_canceled' => 1,
                'canceled_by' => 'store',
            ]);

        try {

            $provider = Provider::where('id',Helpers::get_provider_id())->first();

            if( Helpers::getNotificationStatusData('provider','store_subscription_cancel','push_notification_status', $provider->id)
                &&  $provider->fcm_token){
                $data = [
                    'title' => translate('subscription_canceled'),
                    'description' => translate('Your_subscription_has_been_canceled'),
                    'order_id' => '',
                    'image' => '',
                    'type' => 'subscription',
                    'order_status' => '',
                ];

                Helpers::send_push_notif_to_device($provider->fcm_token, $data);

                DB::table('user_notifications')->insert([
                    'data' => json_encode($data),
                    'vendor_id' => $provider->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            if (config('mail.status') && Helpers::get_mail_status('subscription_cancel_mail_status_store') == '1' &&
                Helpers::getNotificationStatusData('provider','store_subscription_cancel','mail_status' ,$provider?->id)) {
                Mail::to($provider->email)->send(new SubscriptionCancel($provider->name));
            }

        } catch (\Exception $ex) {
            info($ex->getMessage());
        }

        return response()->json(200);
    }
    public function switchToCommission($id)
    {
        $provider = Provider::where('id',$id)->with('store_sub')->first();
        $provider_subscription = $provider->store_sub;

        if($provider->business_model == 'subscription' && $provider_subscription?->is_canceled === 0 && $provider_subscription?->is_trial === 0){
            Helpers::serviceProviderCalculateSubscriptionRefundAmount(store:$provider);
        }

        $provider->business_model = 'commission';
        $provider->save();

        StoreSubscription::where(['store_id' => Helpers::get_provider_id()])->where('store_type', 'service_provider')
            ->update([
                'status' => 0,
            ]);

        return response()->json(200);
    }
    public function packageView($id,$provider_id)
    {
        $provider_subscription = StoreSubscription::where('store_id', $provider_id)->where('store_type', 'service_provider')->with(['package'])->latest()->first();
        $package = SubscriptionPackage::where('status',1)->where('id',$id)->first();

        $provider = Provider::Where('id',$provider_id)->first();
        $pending_bill = SubscriptionBillingAndRefundHistory::where(['store_id' => $provider->id, 'transaction_type' => 'pending_bill', 'is_success' => 0])?->sum('amount') ?? 0;

        $balance = BusinessSetting::where('key', 'wallet_status')->first()?->value == 1 ? StoreWallet::where('vendor_id',$provider->id)->first()?->balance ?? 0 : 0;
        $payment_methods = Helpers::getActivePaymentGateways();
        $disable_item_count = null;

        if(data_get(Helpers::subscriptionConditionsCheck(store_id:$provider->id,
                package_id:$package->id),
                'disable_item_count') > 0 && ( !$provider_subscription || $package->id != $provider_subscription->package_id)){
            $disable_item_count = data_get(Helpers::subscriptionConditionsCheck(store_id:$provider->id,
                package_id:$package->id),
                'disable_item_count');
        }

        $provider_business_model = $provider->store_business_model;
        $admin_commission = BusinessSetting::where('key', "admin_commission")->first()?->value ?? 0 ;
        $cash_backs = [];

        if($provider->store_business_model == 'subscription' &&  $provider_subscription->status == 1 && $provider_subscription->is_canceled == 0 &&
            $provider_subscription->is_trial == 0  && $provider_subscription->package_id !=  $package->id){
            $cash_backs = Helpers::calculateSubscriptionRefundAmount(store:$provider, return_data:true);
        }

        return response()->json([
            'disable_item_count' => $disable_item_count,
            'view' => view('service::provider.provider-management.partials._package_selected',
                compact('provider_subscription', 'package','provider_id','balance','payment_methods',
                    'pending_bill','provider_business_model','admin_commission','cash_backs'))->render()
        ]);
    }
    public function packageBuy(Request $request)
    {
        $request->validate([
            'package_id' => 'required',
            'store_id' => 'required',
            'payment_gateway' => 'required'
        ]);

        $provider = Provider::Where('id',$request->store_id)->first(['id']);
        $package = SubscriptionPackage::withoutGlobalScope('translate')->find($request->package_id);
        $pending_bill = SubscriptionBillingAndRefundHistory::where(['store_id' => $provider->id,
        'transaction_type' => 'pending_bill', 'is_success' => 0])?->sum('amount') ?? 0;

        if(!in_array($request->payment_gateway,['wallet'])){
            $url = route('provider.service.subscriptionackage.subscriberDetail',$provider->id);
            return redirect()->away(Helpers::serviceProviderSubscriptionPayment(
                provider_id: $provider->id,
                package_id: $package->id,
                payment_gateway: $request->payment_gateway,
                url: $url,
                pending_bill: $pending_bill,
                type: $request?->type,
                payment_platform: 'web')
            );
        }

        if($request->payment_gateway == 'wallet')
        {
            $wallet = StoreWallet::firstOrNew(['vendor_id'=> $provider->id]);
            $balance = BusinessSetting::where('key', 'wallet_status')->first()?->value == 1 ? $wallet?->balance ?? 0 : 0;

            if($balance >= ($package?->price + $pending_bill)){
                $reference = 'wallet_payment_by_vendor';
                $plan_data = Helpers::service_provider_subscription_plan_chosen(provider_id:$provider->id,
                    package_id:$package->id,
                    payment_method:$reference,
                    discount:0,
                    pending_bill:$pending_bill,
                    reference:$reference,
                    type: $request?->type
                );

                if($plan_data != false){
                    $wallet->total_withdrawn = $wallet?->total_withdrawn + $package->price + $pending_bill;
                    $wallet?->save();
                }
            }
            else{
                Toastr::error( translate('messages.Insufficient_balance_in_wallet'));
                return to_route('provider.service.subscriptionackage.subscriberDetail',$provider->id);

            }
        }

        $plan_data != false ? Toastr::success(  $request?->type == 'renew' ?
            translate('Subscription_Package_Renewed_Successfully.'): translate('Subscription_Package_Shifted_Successfully.')  ) :
            Toastr::error( translate('Something_went_wrong!.'));
        return to_route('provider.service.subscriptionackage.subscriberDetail',$provider->id);

    }
    public function subscriberTransactions($id,Request $request)
    {
        $filter = $request['filter'];
        $plan_type = $request['plan_type'];
        $from = $request['start_date'] ?? Carbon::now()->format('Y-m-d');
        $to = $request['end_date'] ?? Carbon::now()->format('Y-m-d');
        $provider = Provider::where('id',Helpers::get_provider_id())->with([
            'store_sub_update_application.package'
        ])
        ->first();

        $key = explode(' ', $request['search']);
        $transactions = SubscriptionTransaction::where('store_id',Helpers::get_provider_id())
        ->when(isset($key), function($query) use($key){
            $query->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('id', 'like', "%{$value}%");
                }
            });
        })
        ->when($filter == 'this_year' , function($query){
            $query->whereYear('created_at', Carbon::now()->year );
        })
        ->when($filter == 'this_month' , function($query){
            $query->whereMonth('created_at', Carbon::now()->month );
        })
        ->when($filter == 'this_week' , function($query){
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()] );
        })
        ->when($filter == 'custom' , function($query) use($from,$to) {
            $query->whereBetween('created_at', [$from . " 00:00:00", $to . " 23:59:59"]);
        })
        ->when( in_array( $plan_type,['renew','new_plan','first_purchased','free_trial'])  , function($query) use($plan_type){
            $query->where('plan_type', $plan_type );
        })
        ->latest()->paginate(config('default_pagination'));
            $subscription_deadline_warning_days = BusinessSetting::where('key','subscription_deadline_warning_days')->first()?->value ?? 7;
        return view('service::provider.provider-management.transaction',compact('provider','transactions','id','filter','subscription_deadline_warning_days'));
    }
    public function invoice($id)
    {
        $BusinessData = ['admin_commission' ,'business_name','address','phone','logo','email_address'];
        $transaction = SubscriptionTransaction::with(['store','package:id,package_name,price'])->find($id);
        $BusinessData = BusinessSetting::whereIn('key', $BusinessData)->pluck('value' ,'key') ;
        $logo = BusinessSetting::where('key', "logo")->first() ;

        $mpdf_view = View::make('subscription-invoice', compact('transaction','BusinessData','logo'));
        Helpers::gen_mpdf(view: $mpdf_view,file_prefix: 'Subscription',file_postfix: $id);
        return back();
    }
    public function subscriberTransactionExport(Request $request)
    {
        $filter = $request['filter'];
        $plan_type = $request['plan_type'];
        $from = $request['start_date'] ?? Carbon::now()->format('Y-m-d');
        $to = $request['end_date'] ?? Carbon::now()->format('Y-m-d');
        $provider = Provider::where('id',Helpers::get_provider_id())->first();

        $key = explode(' ', $request['search']);
        $transactions = SubscriptionTransaction::where('store_id', $provider->id)
        ->when(isset($key), function($query) use($key){
            $query->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('id', 'like', "%{$value}%");
                }
            });
        })
        ->when($filter == 'this_year' , function($query){
            $query->whereYear('created_at', Carbon::now()->year );
        })
        ->when($filter == 'this_month' , function($query){
            $query->whereMonth('created_at', Carbon::now()->month );
        })
        ->when($filter == 'this_week' , function($query){
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()] );
        })
        ->when($filter == 'custom' , function($query) use($from,$to) {
            $query->whereBetween('created_at', [$from . " 00:00:00", $to . " 23:59:59"]);
        })
        ->when( in_array( $plan_type,['renew','new_plan','first_purchased','free_trial'])  , function($query) use($plan_type){
            $query->where('plan_type', $plan_type );
        })
        ->latest()->get();

        $data = [
            'data' => $transactions,
            'plan_type' => $request['plan_type'] ?? 'all',
            'filter' => $request['filter'] ?? 'all',
            'search' => $request['search'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'store' => $provider->name,
        ];
        if ($request->export_type == 'excel') {
            return Excel::download(new SubscriptionTransactionsExport($data), 'SubscriptionTransactionsExport.xlsx');
        }
        return Excel::download(new SubscriptionTransactionsExport($data), 'SubscriptionTransactionsExport.csv');
    }
    public function addToSession(Request $request)
    {
        Session::put($request->value, true);
        return response()->json(['success' => true]);
    }
    public function subscriberWalletTransactions(Request $request)
    {
        $provider = Provider::where('id', Helpers::get_provider_id())->first();
        $transactions = SubscriptionBillingAndRefundHistory::where('store_id', $provider->id)->with('package')
        ->where('transaction_type','refund')
        ->latest()->paginate(config('default_pagination'));

        return view('service::provider.provider-management.wallet-transaction',compact('transactions','provider'));

    }
}
