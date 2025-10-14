<?php

namespace Modules\Service\Http\Controllers\Api\Provider\Auth;

use App\Models\BusinessSetting;
use App\Traits\SmsGateway;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use Illuminate\Support\Carbon;
use App\CentralLogics\SMS_module;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\Serviceman;

class ProviderPasswordResetController extends Controller
{
    public function reset_password_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reset_type' => 'required|in:email,phone',
            'email' => 'required_if:reset_type,email|email|exists:service_providers,email',
            'phone' => 'required_if:reset_type,phone|exists:service_providers,phone',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        if ($request['reset_type'] == 'email') {
            $vendor = Provider::Where(['email' => $request['email']])->first();

            if (isset($vendor)) {
                $token = rand(1000,9999);
                DB::table('password_resets')->updateOrInsert([
                    'email' => $vendor['email'],
                    'token' => $token,
                    'created_at' => now(),
                ]);
                if (config('mail.status')) {
                    Mail::to($vendor['email'])->send(new \App\Mail\PasswordResetMail($token));
                }
                return response()->json(['message' => 'Email sent successfully.'], 200);
            }
            return response()->json(['errors' => [
                ['code' => 'not-found', 'message' => 'Email not found!']
            ]], 404);
        }else{
            $firebase_otp_verification = BusinessSetting::where('key', 'firebase_otp_verification')->first()->value??0;
            $vendor = Provider::Where(['phone' => $request['phone']])->first();

            if (isset($vendor)) {
                if($firebase_otp_verification || env('APP_MODE') =='dev')
                {
                    return response()->json(['message' => translate('messages.otp_sent_successfull')], 200);
                }

                $otp_interval_time= 60;
                $verification_data= DB::table('password_resets')->where('phone', $vendor['phone'])->first();
                if(isset($verification_data) &&  Carbon::parse($verification_data->created_at)->DiffInSeconds() < $otp_interval_time){
                    $time = $otp_interval_time - Carbon::parse($verification_data->created_at)->DiffInSeconds();
                    $errors = [];
                    array_push($errors, ['code' => 'otp', 'message' =>  translate('messages.please_try_again_after_').$time.' '.translate('messages.seconds')]);
                    return response()->json([
                        'errors' => $errors
                    ], 405);
                }

                $token = rand(100000, 999999);
                DB::table('password_resets')->updateOrInsert(['phone' => $vendor['phone']],
                    [
                        'token' => $token,
                        'created_at' => now(),
                    ]);


                $response = null;

                if (Helpers::getNotificationStatusData('user','verification','sms_status')) {
                    $published_status = addon_published_status('Gateways');
                    if($published_status == 1){
                        $response = SmsGateway::send($request['phone'],$token);
                    }else{
                        $response = SMS_module::send($request['phone'],$token);
                    }
                }

                if($response == 'success')
                {
                    return response()->json(['message' => translate('messages.Otp_Successfully_Sent_To_Your_Phone')], 200);
                }
                else {
                    return response()->json([
                        'errors' => [
                            ['code' => 'otp', 'message' => translate('messages.failed_to_send_sms')]
                        ]], 405);
                }
            }

        }
    }

    public function verify_token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reset_type' => 'required|in:email,phone',
            'email' => 'required_if:reset_type,email|email|exists:service_providers,email',
            'phone' => 'required_if:reset_type,phone|exists:service_providers,phone',
            'reset_token'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        if ($request->reset_type == 'email'){
            $data = DB::table('password_resets')->where(['token' => $request['reset_token'],'email'=>$request->email])->first();
        }else{
            $data = DB::table('password_resets')->where(['token' => $request['reset_token'],'phone'=>$request->phone])->first();
        }

        if (isset($data) || (env('APP_MODE')=='dev'&& $request['reset_token'] == '123456' )) {
            return response()->json(['message'=>translate("OTP found, you can proceed")], 200);

        } else{
            $max_otp_hit = 5;
            $max_otp_hit_time = 60; // seconds
            $temp_block_time = 600; // seconds
            $verification_data = $data;


            if(isset($verification_data)){
                $time = $temp_block_time - Carbon::parse($verification_data->temp_block_time)->DiffInSeconds();

                if(isset($verification_data->temp_block_time ) && Carbon::parse($verification_data->temp_block_time)->DiffInSeconds() <= $temp_block_time){
                    $time = $temp_block_time - Carbon::parse($verification_data->temp_block_time)->DiffInSeconds();

                    $errors = [];
                    array_push($errors, ['code' => 'otp_block_time', 'message' => translate('messages.please_try_again_after_').CarbonInterval::seconds($time)->cascade()->forHumans()
                    ]);
                    return response()->json([
                        'errors' => $errors
                    ], 405);
                }

                if($verification_data->is_temp_blocked == 1 && Carbon::parse($verification_data->created_at)->DiffInSeconds() >= $max_otp_hit_time){
                    DB::table('password_resets')->updateOrInsert([$request->reset_type => $request->email ?: $request->phone],
                        [
                            'otp_hit_count' => 0,
                            'is_temp_blocked' => 0,
                            'temp_block_time' => null,
                            'created_at' => now(),
                        ]);
                }

                if($verification_data->otp_hit_count >= $max_otp_hit &&  Carbon::parse($verification_data->created_at)->DiffInSeconds() < $max_otp_hit_time &&  $verification_data->is_temp_blocked == 0){

//                    DB::table('password_resets')->updateOrInsert(['email' => $request->email],
                    DB::table('password_resets')->updateOrInsert([$request->reset_type => $request->email ?: $request->phone],
                        [
                            'is_temp_blocked' => 1,
                            'temp_block_time' => now(),
                            'created_at' => now(),
                        ]);
                    $errors = [];
                    array_push($errors, ['code' => 'otp_temp_blocked', 'message' => translate('messages.Too_many_attemps') ]);
                    return response()->json([
                        'errors' => $errors
                    ], 405);
                }
            }
            DB::table('password_resets')->updateOrInsert([$request->reset_type => $request->email ?: $request->phone],

                [
                    'otp_hit_count' => DB::raw('otp_hit_count + 1'),
                    'created_at' => now(),
                    'temp_block_time' => null,
                ]);
        }
        return response()->json(['errors' => [
            ['code' => 'reset_token', 'message' => 'Invalid OTP.']
        ]], 400);
    }

    public function reset_password_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reset_type' => 'required|in:email,phone',
            'email' => 'required_if:reset_type,email|email|exists:service_providers,email',
            'phone' => 'required_if:reset_type,phone|exists:service_providers,phone',
            'reset_token'=> 'required',
            'password' => ['required', Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
            'confirm_password'=> 'required|same:password',
        ],

            [
                'password.required' => translate('The password is required'),
                'password.min_length' => translate('The password must be at least :min characters long'),
                'password.mixed' => translate('The password must contain both uppercase and lowercase letters'),
                'password.letters' => translate('The password must contain letters'),
                'password.numbers' => translate('The password must contain numbers'),
                'password.symbols' => translate('The password must contain symbols'),
                'password.uncompromised' => translate('The password is compromised. Please choose a different one'),
            ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        if(env('APP_MODE')=='dev') {
            if ($request['reset_token'] != '123456') {
                return response()->json(['errors' => [
                    ['code' => 'invalid', 'message' => trans('messages.invalid_otp')]
                ]], 400);
            }
            if ($request['password'] == $request['confirm_password']) {
                DB::table('service_providers')->where([$request->reset_type => $request->email ?: $request->phone])->update([
                    'password' => bcrypt($request['confirm_password'])
                ]);
                DB::table('password_resets')->where(['token' => $request['reset_token']])->delete();
                return response()->json(['message' => translate('Password changed successfully.')], 200);
            }
            return response()->json(['errors' => [
                ['code' => 'mismatch', 'message' => translate('messages.password_mismatch')]
            ]], 401);
        }

        $data = DB::table('password_resets')->where([$request->reset_type => $request->email ?: $request->phone,'token' => $request['reset_token']])->first();
        if (isset($data)) {
            if ($request['password'] == $request['confirm_password']) {
                DB::table('service_providers')->where([$request->reset_type => $request->email ?: $request->phone])->update([
                    'password' => bcrypt($request['confirm_password'])
                ]);
                DB::table('password_resets')->where(['token' => $request['reset_token']])->delete();
                return response()->json(['message' => translate('Password changed successfully.')], 200);
            }
            return response()->json(['errors' => [
                ['code' => 'mismatch', 'message' => translate('messages.password_mismatch')]
            ]], 401);
        }
        return response()->json(['errors' => [
            ['code' => 'invalid', 'message' => translate('messages.invalid_otp')]
        ]], 400);
    }


    public function firebase_auth_verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reset_type' => 'required|in:email,phone',
            'sessionInfo' => 'required',
            'phoneNumber' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }


        $webApiKey = BusinessSetting::where('key', 'firebase_web_api_key')->first()->value??'';

        $response = Http::post('https://identitytoolkit.googleapis.com/v1/accounts:signInWithPhoneNumber?key='. $webApiKey, [
            'sessionInfo' => $request->sessionInfo,
            'phoneNumber' => $request->phoneNumber,
            'code' => $request->code,
        ]);

        $responseData = $response->json();

        if (isset($responseData['error'])) {
            $errors = [];
            $errors[] = ['code' => "403", 'message' => $responseData['error']['message']];
            return response()->json(['errors' => $errors], 403);
        }

        $user = Provider::Where(['phone' => $request->phoneNumber])->first();

        if (isset($user)){
            DB::table('password_resets')->updateOrInsert([$request->reset_type => $user->$request->reset_type],
                [
                    'token' => $request->code,
                    'created_at' => now(),
                ]);
            return response()->json(['message'=>"Token found, you can proceed"], 200);
        }

        return response()->json([
            'message' => translate('messages.not_found')
        ], 404);
    }
}
