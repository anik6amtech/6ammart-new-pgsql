<?php

namespace Modules\Service\Http\Controllers\Api\Provider\ProviderModule;

use App\Models\User;
use App\Models\WithdrawalMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\WithdrawRequest;
use Modules\Service\Entities\TransactionModule\Transaction;
use Modules\Service\Traits\ProviderManagement\WithdrawTrait;

class WithdrawController extends Controller
{
    use WithdrawTrait;
    protected Provider $provider;
    protected WithdrawRequest $withdraw_request;
    protected Transaction $transaction;
    protected WithdrawalMethod $withdrawalMethod;

    public function __construct(Provider $provider, WithdrawRequest $withdraw_request, Transaction $transaction, WithdrawalMethod $withdrawalMethod)
    {
        $this->provider = $provider;
        $this->withdraw_request = $withdraw_request;
        $this->transaction = $transaction;
        $this->withdrawalMethod = $withdrawalMethod;
    }

    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'string' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $withdrawRequests = $this->withdraw_request
            ->with(['provider.account'])
            ->where('user_id', $request->user('provider')->id)
            ->latest()->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('')->through(function ($withdrawRequest) {
                $withdrawRequest->request_updater->account;
                return $withdrawRequest;
            });

        $totalCollectedCash = $this->transaction
            ->where('from_user_id', $request->user('provider')->id)
            ->where('trx_type', TRANSACTION_TYPE[1]['key'])
            ->sum('debit');

        return response()->json(response_formatter(DEFAULT_200, ['withdraw_requests' => $withdrawRequests, 'total_collected_cash' => $totalCollectedCash]), 200);
    }

    /**
     * withdraw amount
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'note' => 'max:255',
            'withdrawal_method_id' => 'required',
            'withdrawal_method_fields' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        //input fields validation check
        $withdrawalMethod = $this->withdrawalMethod->find($request['withdrawal_method_id']);
        $fields = array_column($withdrawalMethod->method_fields, 'input_name');

        $values = (array)json_decode(base64_decode($request['withdrawal_method_fields']))[0];


        foreach ($fields as $field) {
            if(!key_exists($field, $values)) {
                return response()->json(response_formatter(DEFAULT_400, $fields, null), 400);
            }
        }

        $providerUser = $this->provider->with(['account'])->find($request->user('provider')->id);
        $account = $providerUser->account;
        $receivable = $account->receivable_balance;
        $payable = $account->payable_balance;
        $providerInfo = $providerUser->provider;

        if ($receivable > $payable && $payable != 0) {

            $totalReceivable = $receivable - $payable ?? 0;

            if ($request['amount'] > $totalReceivable) {
                return response()->json(response_formatter(DEFAULT_400), 200);
            }


            if($providerInfo){
                $providerInfo->is_suspended = 0;
                $providerInfo->save();
            }


        } elseif ($receivable > $payable && $payable == 0) {

            $totalReceivable = $receivable - $payable ?? 0;

            if ($request['amount'] > $totalReceivable) {
                return response()->json(response_formatter(DEFAULT_400), 200);
            }

        }

        //min max check
        // $withdrawRequestAmount = [
        //     'minimum' => (float)(business_config('minimum_withdraw_amount', 'business_information'))->live_values ?? null,
        //     'maximum' => (float)(business_config('maximum_withdraw_amount', 'business_information'))->live_values ?? null,
        // ];

        // if($account->receivable_balance < $request['amount'] || $request['amount'] < $withdrawRequestAmount['minimum'] || $request['amount'] > $withdrawRequestAmount['maximum']) {
        //     return response()->json(response_formatter(DEFAULT_400), 200);
        // }


        DB::transaction(function () use ($account, $request, $payable, $values) {
            withdrawRequestTransaction($request->user('provider')->id, $request['amount']);

            //admin payment transaction
            if ($payable > 0){
                $provider = Provider::where('id', $request->user('provider')->id)->first();

                //adjust
                withdrawRequestAcceptForAdjustTransaction($request->user('provider')->id, $payable);
                collectCashTransaction($provider->id, $payable);
            }

            $this->withdraw_request->create([
                'user_id' => $request->user('provider')->id,
                'request_updated_by' => $request->user('provider')->id,
                'amount' => $request['amount'],
                'request_status' => 'pending',
                'is_paid' => 0,
                'note' => $request['note'],
                'withdrawal_method_id' => $request['withdrawal_method_id'],
                'withdrawal_method_fields' => $values,
            ]);
        });

        return response()->json(response_formatter(DEFAULT_200), 200);
    }


    public function getMethods(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $methods = $this->withdrawalMethod->ofStatus(1)
            ->paginate($request['limit'], ['*'], 'offset', $request['offset']);

        return response()->json(response_formatter(DEFAULT_200, $methods), 200);
    }


}
