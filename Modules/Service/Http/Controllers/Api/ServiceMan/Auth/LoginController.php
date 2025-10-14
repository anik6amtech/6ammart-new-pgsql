<?php

namespace Modules\Service\Http\Controllers\Api\ServiceMan\Auth;

use App\CentralLogics\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Service\Entities\ProviderManagement\Serviceman;

class LoginController extends Controller
{
    private Serviceman $serviceman;
    public function __construct(Serviceman $serviceman)
    {
        $this->serviceman = $serviceman;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $serviceman = $this->serviceman->where('phone', $request->phone)->first();

        if ($serviceman && Hash::check($request->password, $serviceman->password)) {
            $token = $this->genarate_token($request->phone);
            $serviceman->auth_token = $token;
            $serviceman->save();

            return response()->json([
                'token' => $token,
                'module_type' => $serviceman->module?->module_type,
                'module_id' => $serviceman->module_id
            ], 200);
        } else {
            return response()->json([
                'errors' => [
                    ['code' => 'auth-001', 'message' => translate('Credential_do_not_match,_please_try_again')]
                ]
            ], 401);
        }
    }

    private function genarate_token($phone)
    {
        $token = Str::random(120);
        $is_available = $this->serviceman
            ->where('auth_token', $token)
            ->where('phone', '!=', $phone)
            ->count();

        if ($is_available) {
            return $this->genarate_token($phone);
        }

        return $token;
    }


}
