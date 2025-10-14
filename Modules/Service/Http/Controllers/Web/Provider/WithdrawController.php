<?php

namespace Modules\Service\Http\Controllers\Web\Provider;

use App\CentralLogics\Helpers;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\WithdrawalMethod;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\WithdrawRequest;
use Modules\Service\Entities\TransactionModule\Transaction;
use Rap2hpoutre\FastExcel\FastExcel;

class WithdrawController extends Controller
{
    protected User $user;
    protected Provider $provider;
    protected WithdrawRequest $withdraw_request;
    protected Transaction $transaction;
    protected UserAccount $account;
    protected WithdrawalMethod $withdrawal_method;

    public function __construct(User $user, Provider $provider, WithdrawRequest $withdraw_request, Transaction $transaction, UserAccount $account, WithdrawalMethod $withdrawal_method)
    {
        $this->user = $user;
        $this->provider = $provider;
        $this->withdraw_request = $withdraw_request;
        $this->transaction = $transaction;
        $this->account = $account;
        $this->withdrawal_method = $withdrawal_method;
    }

    /**
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        Validator::make($request->all(), [
            'search' => 'string',
        ]);

        $search = $request->has('search') ? $request['search'] : '';
        $queryParam = ['search' => $search];

        $withdrawRequests = $this->withdraw_request
            ->with(['user.account'])
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

        $total_collected_cash = $this->transaction
            ->where('from_user_id', Helpers::get_provider_id())
            ->where('trx_type', TRANSACTION_TYPE[1]['key'])
            ->sum('debit');

        $withdrawRequestAmount = [
            'minimum' => (float)(business_config('minimum_withdraw_amount', 'business_information'))->live_values ?? null,
            'maximum' => (float)(business_config('maximum_withdraw_amount', 'business_information'))->live_values ?? null,
        ];

        //random value generate
        $min = $withdrawRequestAmount['minimum'];
        $max = $withdrawRequestAmount['maximum'];

        // Generate random numbers
        $mid = round(($min + $max) / 2 / 10) * 10;
        $mid1 = round(($min + $mid) / 2 / 10) * 10;
        $mid2 = round(($mid + $max) / 2 / 10) * 10;
        $num4 = ceil($max / 10) * 10;

        if ($min == 0 && $max == 0) {
            $num5 = 0;
        } else {
            if ($min >= $max) {
                $min = 1;
                $max = 10;
            }
            $mid = round(($min + $max) / 2);
            $mid1 = round(($min + $mid) / 2);
            $mid2 = round(($mid + $max) / 2);
            $num4 = $max;
            $excluded = array_unique([$mid, $mid1, $mid2, $num4]);
            $validValues = range($min, $max);
            $validValues = array_diff($validValues, $excluded);
            if (empty($validValues)) {
                $num5 = $min;
            } else {
                $num5 = $validValues[array_rand($validValues)];
            }
        }

        $withdraw_request_amount['random'] = array($mid, $mid1, $num5, $mid2, $num4);

        $collectable_cash = $this->account->where('user_id', Helpers::get_provider_id())->first()->account_receivable ?? 0;

        $withdrawal_methods = $this->withdrawal_method->ofStatus(1)->get();

        return view('providermanagement::provider.account.withdraw', compact('withdrawRequests', 'total_collected_cash', 'search', 'collectable_cash', 'withdrawal_methods', 'withdraw_request_amount'));
    }

    /**
     * withdraw amount
     * @param Request $request
     * @return RedirectResponse
     */
    public function withdraw(Request $request): RedirectResponse
    {
        $method = $this->withdrawal_method->find($request['withdraw_method']);
        $fields = array_column($method->method_fields, 'input_name');

        $values = $request->all();
        $data = [];

        foreach ($fields as $field) {
            if(key_exists($field, $values)) {
                $data[$field] = $values[$field];
            }
        }

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'note' => 'max:255'
        ]);

        $provider_user = $this->provider->with(['account'])->find(Helpers::get_provider_id());
        $account = $provider_user->account;

        $receivable = $account->receivable_balance;
        $payable = $account->payable_balance;

        $providerinfo = $provider_user;

        if ($receivable > $payable && $payable != 0) {

            $totalReceivable = $receivable - $payable ?? 0;

            if ($request['amount'] > $totalReceivable) {
                Toastr::error(translate(DEFAULT_400['message']));
                return back();
            }

            //Adjust
            //$account->account_receivable -= $payable;

            if($providerinfo){
                $providerinfo->is_suspended = 0;
                $providerinfo->save();
            }


        } elseif ($receivable > $payable && $payable == 0) {

            $totalReceivable = $receivable - $payable ?? 0;

            if ($request['amount'] > $totalReceivable) {
                Toastr::error(translate(DEFAULT_400['message']));
                return back();
            }

        }

        //min max check
        // $withdrawRequestAmount = [
        //     'minimum' => (float)(business_config('minimum_withdraw_amount', 'business_information'))->live_values ?? null,
        //     'maximum' => (float)(business_config('maximum_withdraw_amount', 'business_information'))->live_values ?? null,
        // ];

        // if($account->account_receivable < $request['amount'] || $request['amount'] < $withdrawRequestAmount['minimum'] || $request['amount'] > $withdrawRequestAmount['maximum']) {
        //     Toastr::error(translate(DEFAULT_400['message']));
        //     return back();
        // }


        DB::transaction(function () use ($account, $request, $payable, $data,) {
            withdrawRequestTransaction(Helpers::get_provider_id(), $request['amount']);

            //admin payment transaction
            if ($payable > 0){
                $provider = Provider::where('id', Helpers::get_provider_id())->first();

                //adjust
                withdrawRequestAcceptForAdjustTransaction(Helpers::get_provider_id(), $payable);
                collectCashTransaction($provider->id, $payable);
            }

            $this->withdraw_request->create([
                'user_id' => Helpers::get_provider_id(),
                'request_updated_by' => Helpers::get_provider_id(),
                'updated_by_type' => PROVIDER,
                'amount' => $request['amount'],
                'request_status' => 'pending',
                'is_paid' => 0,
                'note' => $request['note'],
                'withdrawal_method_id' => $request['withdraw_method'],
                'withdrawal_method_fields' => $data,
            ]);
        });

        Toastr::success(translate(DEFAULT_200['message']));
        return back();
    }

    public function download(Request $request)
    {
        $keys = explode(' ', $request['search']);
        $items = $this->withdraw_request
            ->where('user_id', Helpers::get_provider_id())
            ->where(function ($query) use ($keys) {
                foreach ($keys as $key) {
                    $query->orWhere('amount', 'LIKE', '%' . $key . '%')
                        ->orWhere('request_status', 'LIKE', '%' . $key . '%')
                        ->orWhere('note', 'LIKE', '%' . $key . '%');
                }
            })->get();
        return (new FastExcel($items))->download(time() . '-file.xlsx');
    }
}
