<?php

namespace Modules\Service\Http\Controllers\Web\Provider;

use App\CentralLogics\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\WithdrawalMethod;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\WithdrawRequest;
use Modules\Service\Entities\TransactionModule\Transaction;

class WalletController extends Controller
{
    // public function index()
    // {
    //        //payment gateways
    //         $isPublished = 0;
    //         try {
    //             $fullData = include('Modules/Gateways/Addon/info.php');
    //             $isPublished = $fullData['is_published'] == 1 ? 1 : 0;
    //         } catch (\Exception $exception) {
    //         }

    //         $paymentGateways = collect($this->getWithdrawMethods())
    //             ->filter(function ($query) use ($isPublished) {
    //                 if (!$isPublished) {
    //                     return in_array($query['gateway'], array_column(PAYMENT_METHODS, 'key'));
    //                 } else return $query;
    //             })->map(function ($query) {
    //                 $query['label'] = ucwords(str_replace('_', ' ', $query['gateway']));
    //                 return $query;
    //             })->values();
    //         $provider = Provider::with('account')->withCount(['bookings'])->where('id', Helpers::get_provider_id())->first();
    //         $bookingOverview = DB::table('service_bookings')->where('provider_id', Helpers::get_provider_id())
    //             ->select('booking_status', DB::raw('count(*) as total'))
    //             ->groupBy('booking_status')
    //             ->get();

    //         $status = ['accepted', 'ongoing', 'completed', 'canceled'];
    //         $total = [];
    //         foreach ($status as $item) {
    //             if ($bookingOverview->where('booking_status', $item)->first() !== null) {
    //                 $total[] = $bookingOverview->where('booking_status', $item)->first()->total;
    //             } else {
    //                 $total[] = 0;
    //             }
    //         }

    //         //total earning
    //         $account = getUserAccount(Helpers::get_provider_id(), PROVIDER);
    //         $totalEarning = $account['received_balance'] + $account['total_withdrawn'];

    //         //adjust &
    //         $withdrawRequestAmount = [
    //             'minimum' => (float)(business_config('minimum_withdraw_amount', 'business_information'))?->value ?? null,
    //             'maximum' => (float)(business_config('maximum_withdraw_amount', 'business_information'))?->value ?? null,
    //         ];

    //         $min = $withdrawRequestAmount['minimum'];
    //         $max = $withdrawRequestAmount['maximum'];

    //         $mid = round(($min + $max) / 2 / 10) * 10;
    //         $mid1 = round(($min + $mid) / 2 / 10) * 10;
    //         $mid2 = round(($mid + $max) / 2 / 10) * 10;
    //         $num4 = ceil($max / 10) * 10;

    //         if ($min == 0 && $max == 0) {
    //             $num5 = 0;
    //         } else {
    //             if ($min >= $max || $max - $min > 10000) {
    //                 $min = 1;
    //                 $max = 100; // Set reasonable range
    //             }

    //             $mid = round(($min + $max) / 2);
    //             $mid1 = round(($min + $mid) / 2);
    //             $mid2 = round(($mid + $max) / 2);
    //             $num4 = $max;

    //             $excluded = array_unique([$mid, $mid1, $mid2, $num4]);

    //             $step = 10; // Prevent excessive range
    //             $validValues = range($min, $max, $step);
    //             $validValues = array_filter($validValues, fn($value) => !in_array($value, $excluded));

    //             $num5 = empty($validValues) ? $min : $validValues[array_rand($validValues)];
    //         }

    //         $withdrawRequestAmount['random'] = array($mid, $mid1, $num5, $mid2, $num4);
    //         //end

    //         $account = getUserAccount(Helpers::get_provider_id(), PROVIDER);
    //         $receivable = $account->receivable_balance;
    //         $payable = $account->payable_balance;

    //         if ($receivable > $payable) {
    //             $collectable_cash = $receivable - $payable ?? 0;
    //         } elseif ($payable > $receivable) {
    //             $collectable_cash = $payable - $receivable ?? 0;
    //         } else {
    //             $collectable_cash = 0;
    //         }

    //         $withdrawalMethods = WithdrawalMethod::ofStatus(1)->get();

    //     return view('service::provider.wallet.index', compact('provider', 'total', 'totalEarning', 'paymentGateways', 'collectable_cash', 'withdrawalMethods', 'withdrawRequestAmount'));
    // }

    public function index(Request $request)
    {
        // Search validation
        Validator::make($request->all(), [
            'search' => 'string',
        ]);

        $search = $request->has('search') ? $request['search'] : '';
        $queryParam = ['search' => $search];

        /**
         * -----------------------------
         * Withdraw Requests
         * -----------------------------
         */
        $withdrawRequests = WithdrawRequest::with(['provider.account'])
            ->where('user_id', Helpers::get_provider_id())
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                foreach ($keys as $key) {
                    $query->where('amount', 'LIKE', '%' . $key . '%')
                        ->orWhere('request_status', 'LIKE', '%' . $key . '%')
                        ->orWhere('note', 'LIKE', '%' . $key . '%');
                }
            })
            ->latest()
            ->paginate(pagination_limit())->appends($queryParam);

        $total_collected_cash = Transaction::where('from_user_id', Helpers::get_provider_id())->where('from_user_type', PROVIDER)
            ->where('trx_type', TRANSACTION_TYPE[1]['key'])
            ->sum('debit');

        /**
         * -----------------------------
         * Provider & Booking Overview
         * -----------------------------
         */
        $isPublished = 0;
        try {
            $fullData = include('Modules/Gateways/Addon/info.php');
            $isPublished = $fullData['is_published'] == 1 ? 1 : 0;
        } catch (\Exception $exception) {}

        $paymentGateways = collect($this->getWithdrawMethods())
            ->filter(function ($query) use ($isPublished) {
                if (!$isPublished) {
                    return in_array($query['gateway'], array_column(PAYMENT_METHODS, 'key'));
                } else return $query;
            })->map(function ($query) {
                $query['label'] = ucwords(str_replace('_', ' ', $query['gateway']));
                return $query;
            })->values();

        $provider = Provider::with('account')->withCount(['bookings'])
            ->where('id', Helpers::get_provider_id())
            ->first();

        $bookingOverview = DB::table('service_bookings')
            ->where('provider_id', Helpers::get_provider_id())
            ->select('booking_status', DB::raw('count(*) as total'))
            ->groupBy('booking_status')
            ->get();

        $status = ['accepted', 'ongoing', 'completed', 'canceled'];
        $total = [];
        foreach ($status as $item) {
            $total[] = $bookingOverview->where('booking_status', $item)->first()->total ?? 0;
        }

        $account = getUserAccount(Helpers::get_provider_id(), PROVIDER);
        $totalEarning = $account['received_balance'] + $account['total_withdrawn'];

        /**
         * -----------------------------
         * Withdraw Request Amount (Random Generation)
         * -----------------------------
         */
        $withdrawRequestAmount = [
            'minimum' => (float)(business_config('minimum_withdraw_amount', 'business_information'))?->value
                ?? null,
            'maximum' => (float)(business_config('maximum_withdraw_amount', 'business_information'))?->value
                ?? null,
        ];

        $min = $withdrawRequestAmount['minimum'];
        $max = $withdrawRequestAmount['maximum'];

        $mid = round(($min + $max) / 2 / 10) * 10;
        $mid1 = round(($min + $mid) / 2 / 10) * 10;
        $mid2 = round(($mid + $max) / 2 / 10) * 10;
        $num4 = ceil($max / 10) * 10;

        if ($min == 0 && $max == 0) {
            $num5 = 0;
        } else {
            if ($min >= $max || $max - $min > 10000) {
                $min = 1;
                $max = 100;
            }

            $mid = round(($min + $max) / 2);
            $mid1 = round(($min + $mid) / 2);
            $mid2 = round(($mid + $max) / 2);
            $num4 = $max;

            $excluded = array_unique([$mid, $mid1, $mid2, $num4]);
            $step = 10;
            $validValues = range($min, $max, $step);
            $validValues = array_filter($validValues, fn($value) => !in_array($value, $excluded));
            $num5 = empty($validValues) ? $min : $validValues[array_rand($validValues)];
        }

        $withdrawRequestAmount['random'] = [$mid, $mid1, $num5, $mid2, $num4];

        /**
         * -----------------------------
         * Collectable Cash
         * -----------------------------
         */
        $receivable = $account->receivable_balance ?? 0;
        $payable   = $account->payable_balance ?? 0;

        if ($receivable > $payable) {
            $collectable_cash = $receivable - $payable;
        } elseif ($payable > $receivable) {
            $collectable_cash = $payable - $receivable;
        } else {
            $collectable_cash = 0;
        }

        /**
         * -----------------------------
         * Withdrawal Methods
         * -----------------------------
         */
        $withdrawalMethods = WithdrawalMethod::ofStatus(1)->get();

        // dd($paymentGateways);

        return view('service::provider.wallet.index', compact(
            'provider',
            'total',
            'totalEarning',
            'paymentGateways',
            'collectable_cash',
            'withdrawalMethods',
            'withdrawRequestAmount',
            'withdrawRequests',
            'total_collected_cash',
            'search'
        ));
    }

    public function method_list(Request $request)
    {
        $method = WithdrawalMethod::ofStatus(1)->where('id', $request->method_id)->first();

        return response()->json(['content'=>$method], 200);
    }

    private function getWithdrawMethods(){
        $withdrawal_methods = WithdrawalMethod::ofStatus(1)->get();

        $published_status =0;
        $payment_published_status = config('get_payment_publish_status');
        if (isset($payment_published_status[0]['is_published'])) {
            $published_status = $payment_published_status[0]['is_published'];
        }

        $methods = DB::table('addon_settings')->where('is_active',1)->where('settings_type', 'payment_config')

            ->when($published_status == 0, function($q){
                $q->whereIn('key_name', ['ssl_commerz','paypal','stripe','razor_pay','senang_pay','paytabs','paystack','paymob_accept','paytm','flutterwave','liqpay','bkash','mercadopago']);
            })
            ->get();
        $env = env('APP_ENV') == 'live' ? 'live' : 'test';
        $credentials = $env . '_values';

        $data = [];
        foreach ($methods as $method) {
            $credentialsData = json_decode($method->$credentials);
            $additional_data = json_decode($method->additional_data);
            if ($credentialsData->status == 1) {
                $data[] = [
                    'gateway' => $method->key_name,
                    'gateway_title' => $additional_data?->gateway_title,
                    'gateway_image' => $additional_data?->gateway_image
                ];
            }
        }

        // $result = [
        //     'data' => $data ,
        //     'withdrawal_methods' => $withdrawal_methods ,
        // ];

        return  $data;
    }


}
