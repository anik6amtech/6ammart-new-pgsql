<?php

namespace Modules\Service\Http\Controllers\Web\Provider;


use App\Models\DisbursementWithdrawalMethod;
use App\CentralLogics\Helpers;
use App\Models\WithdrawalMethod;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WalletMethodController extends Controller
{
    public function index(Request $request)
    {
        $key = explode(' ', $request['search']);
        $withdrawal_methods = WithdrawalMethod::ofStatus(1)->get();
        $provider_withdrawal_methods = DisbursementWithdrawalMethod::where('store_id', Helpers::get_provider_id())
            ->when( isset($key) , function($query) use($key){
                $query->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('method_name', 'like', "%{$value}%");
                    }
                });
            })
            ->latest()->paginate(config('default_pagination'));

        return view('service::provider.wallet-method.index', compact('withdrawal_methods','provider_withdrawal_methods'));
    }

    public function store(Request $request)
    {
        $method = WithdrawalMethod::find($request['withdraw_method']);
        $fields = array_column($method->method_fields, 'input_name');
        $values = $request->all();

        $method_data = [];
        foreach ($fields as $field) {
            if(key_exists($field, $values)) {
                $method_data[$field] = $values[$field];
            }
        }

        $data = [
            'store_id' => Helpers::get_provider_id(),
            'withdrawal_method_id' => $method['id'],
            'method_name' => $method['method_name'],
            'method_fields' => json_encode($method_data),
            'is_default' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('disbursement_withdrawal_methods')->insert($data);
        Toastr::success(translate('Disbursement_method_stored.'));
        return redirect()->back();
    }

    public function default(Request $request)
    {
        $method = DisbursementWithdrawalMethod::find($request->id);
        $method->is_default = $request->default;
        $method->save();
        DisbursementWithdrawalMethod::whereNot('id', $request->id)->where('store_id',Helpers::get_provider_id())->update(['is_default' => 0]);
        Toastr::success(translate('messages.default_method_updated'));
        return back();
    }

    public function delete(Request $request)
    {
        $method = DisbursementWithdrawalMethod::find($request->id);
        $method->delete();
        Toastr::success(translate('messages.method_deleted_successfully'));
        return back();
    }

    public function methodList(Request $request)
    {
        $method = WithdrawalMethod::ofStatus(1)->where('id', $request->method_id)->first();

        return response()->json(['content'=>$method], 200);
    }


}
