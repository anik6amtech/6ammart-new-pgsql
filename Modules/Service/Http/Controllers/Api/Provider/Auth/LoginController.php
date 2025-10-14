<?php

namespace Modules\Service\Http\Controllers\Api\Provider\Auth;

use App\CentralLogics\Helpers;
use App\Models\Module;
use App\Models\NotificationSetting;
use App\Models\SubscriptionPackage;
use App\Models\Translation;
use App\Models\Vendor;
use App\Models\Zone;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\ProviderNotificationSetup;
use Modules\Service\Entities\ProviderManagement\ProviderSetting;

class LoginController extends Controller
{
    private Provider $provider;
    private Zone $zone;
    private SubscriptionPackage $subscriptionPackage;

    public function __construct
    (Provider $provider, Zone $zone, SubscriptionPackage $subscriptionPackage)
    {
        $this->provider = $provider;
        $this->zone = $zone;
        $this->subscriptionPackage = $subscriptionPackage;
    }

    private function currentModuleId(): int
    {
        return request()->header('moduleid');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $provider_type = $request->provider_type;

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if($provider_type == 'owner'){
            if (auth('provider')->attempt($data)) {
                $token = $this->genarate_token($request['email']);
                $provider = Provider::where(['email' => $request['email']])->first();

                $providerSubscriptionCheck=  $this->storeSubscriptionCheck($provider,$token);

                if(data_get($providerSubscriptionCheck,'type') != null){
                    return response()->json(data_get($providerSubscriptionCheck,'data'), data_get($providerSubscriptionCheck,'code'));
                }

                $provider->auth_token = $token;
                $provider->save();
                return response()->json([
                    'token' => $token,
                    'zone_wise_topic'=> $provider->zone->store_wise_topic,
                    'module_type' => $provider->module?->module_type,
                    'module_id' => $provider->module_id]
                    , 200);
            }  else {
                $errors = [];
                $errors[] = ['code' => 'auth-001', 'message' => translate('Credential_do_not_match,_please_try_again')];
                return response()->json([
                    'errors' => $errors
                ], 401);
            }

        }
//        elseif($provider_type == 'employee'){
//
//            if (auth('vendor_employee')->attempt($data)) {
//                $token = $this->genarate_token($request['email']);
//                $provider = VendorEmployee::where(['email' => $request['email']])->first();
//                $providerSubscriptionCheck=  $this->storeSubscriptionCheck($provider?->store,$provider,$token);
//                if(data_get($providerSubscriptionCheck,'type') != null){
//                    return response()->json(data_get($providerSubscriptionCheck,'data'), data_get($providerSubscriptionCheck,'code'));
//                }
//
//                if($provider?->store?->module_type == 'rental'){
//                    if(!addon_published_status('Rental')){
//                        $errors = [];
//                        array_push($errors, ['code' => 'auth-001', 'message' => translate('rental_module_is_not_available')]);
//                        return response()->json([
//                            'errors' => $errors
//                        ], 401);
//                    }
//                }
//
//                $provider->auth_token = $token;
//                $provider->save();
//                $role = $provider->role ? json_decode($provider->role->modules):[];
//                return response()->json(['token' => $token, 'zone_wise_topic'=> $provider->store->zone->store_wise_topic, 'role'=>$role,
//                    'module_type' => $provider?->store?->module_type], 200);
//            } else {
//                $errors = [];
//                array_push($errors, ['code' => 'auth-001', 'message' => translate('Credential_do_not_match,_please_try_again')]);
//                return response()->json([
//                    'errors' => $errors
//                ], 401);
//            }
//        }
        else {
            $errors = [];
            $errors[] = ['code' => 'auth-001', 'message' => translate('Credential_do_not_match,_please_try_again')];
            return response()->json([
                'errors' => $errors
            ], 401);
        }

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            // 'name' => 'required',
            // 'address' => 'required',
            'company_phone' => 'required',
            'company_email' => 'required',
            'logo' => 'required|image|mimes:jpeg,jpg,png,gif',
            'cover_photo' => 'required|image|mimes:jpeg,jpg,png,gif',
            'zone_id' => 'required',
            // 'module_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
//            'minimum_service_time' => 'required|integer|min:0',
//            'maximum_service_time' => 'required|integer|min:0',
//            'service_time_type' => 'required|in:min,hours,days',
            'f_name' => 'required|string|max:191',
            'l_name' => 'required|string|max:191',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',

            'identity_type' => 'required|in:passport,driving_license,nid,trade_license,company_id',
            'identity_number' => 'required',
            'identity_images' => 'nullable|array',
            'identity_images.*' => 'image|mimes:jpeg,jpg,png,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        if (Provider::where('email', $request['email'])->first()) {
            return response()->json(response_formatter(DEFAULT_400, null, [["error_code" => "account_email", "message" => translate('Email already taken')]]), 400);
        }

        if (Provider::where('phone', $request['phone'])->first()) {
            return response()->json(response_formatter(DEFAULT_400, null, [["error_code" => "account_phone", "message" => translate('Phone already taken')]]), 400);
        }

        if ($request->zone_id && !$this->isValidZone($request)) {
            return response()->json(response_formatter(DEFAULT_400, null, [["error_code" => "zone", "message" => translate('coordinates_out_of_zone')]]), 400);
        }

        if($request->business_plan == 'subscription') {
            $package = $this->subscriptionPackage->where('id',$request->package_id)
                ->ofStatus(1)
                ->where('module_type', 'service')
                ->first();
            if (!$package) {
                return response()->json(response_formatter(DEFAULT_400, null, [["error_code" => "package", "message" => translate('Please Select valid plan')]]), 400);

            }
        }

        $identityImages = [];
        if ($request->has('identity_images')) {
            foreach ($request->identity_images as $image) {
                $imageName = file_uploader('provider/identity/', 'png', $image);
                $identityImages[] = ['image'=>$imageName, 'storage'=> getDisk()];
            }
        }

        DB::beginTransaction();

        $data = json_decode($request->translations, true) ?? [];

        if (count($data) < 1) {
            $validator->getMessageBag()->add('translations', translate('messages.Name and description in english is required'));
        }

        $module = Module::where('module_type', 'service')->first();

        $provider = $this->provider;
        $provider->module_id = $module->id;
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
        $provider->company_name = $data[0]['value'];
        $provider->company_address = $data[1]['value'];
        $provider->company_phone = $request->company_phone;
        $provider->company_email = $request->company_email;
        $provider->logo = file_uploader('provider/logo/', 'png', $request->file('logo'));
        $provider->cover_image = file_uploader('provider/cover-image/', 'png', $request->file('cover_photo'));

        $provider->minimum_service_time = 0;
        $provider->maximum_service_time = 0;
        $provider->service_time_type = '';
        $provider->business_model = 'none';
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

        foreach ($data as $key => $i) {
            $data[$key]['translationable_type'] = 'Modules/Service/Entities/ProviderManagement/Provider';
            $data[$key]['translationable_id'] = $provider->id;
        }

        Translation::insert($data);

        ProviderSetting::create([
            'provider_id'   => $provider->id,
            'key'      => 'service_at_customer_location',
            'value'   => 1,
            'type' => 'provider_config',
            'is_active'     => 1,
        ]);

        try {
            // Mail::to($provider->email)->send(new NewJoiningRequestMail($provider));
        } catch (\Exception $exception) {
            info($exception);
        }
        DB::commit();

        if (Helpers::subscription_check()) {
            if ($request->business_plan == 'subscription' && $request->package_id != null) {
                $provider->package_id = $request->package_id;
                $provider->save();

                return response()->json([
                    'provider_id' => $provider->id,
                    'package_id' => $provider->package_id,
                    'type' => 'subscription',
                    'message' => translate('messages.application_placed_successfully')
                ], 200);
            } elseif ($request->business_plan == 'commission') {
                $provider->business_model = 'commission';
                $provider->save();
                return response()->json([
                    'provider_id' => $provider->id,
                    'type' => 'commission',
                    'message' => translate('messages.application_placed_successfully')
                ], 200);
            } else {
                return response()->json([
                    'provider_id' => $provider->id,
                    'type' => 'business_model_fail',
                    'message' => translate('messages.application_placed_successfully')
                ], 200);
            }
        } else {
            $provider->business_model = 'commission';
            $provider->save();
            return response()->json([
                'provider_id' => $provider->id,
                'type' => 'commission',
                'message' => translate('messages.application_placed_successfully')
            ], 200);
        }

        return response()->json(response_formatter(DEFAULT_200, $provider, null), 200);

    }

    private function genarate_token($email)
    {
        $token = Str::random(120);
        $is_available = Provider::where('auth_token', $token)->where('email', '!=', $email)->count();
        if($is_available)
        {
            $this->genarate_token($email);
        }
        return $token;
    }
    private function isValidZone(Request $request): bool
    {
        $zone = $this->zone->query()
            ->whereContains('coordinates', new Point($request->latitude, $request->longitude, POINT_SRID))
            ->where('id', $request->zone_id)
            ->first();
        return (bool)$zone;
    }
    private function storeSubscriptionCheck($provider,$token){
        if ($provider?->business_model == 'none') {
            $provider->auth_token = $token;
            $provider?->save();
            return [
                'type' => 'subscribed',
                'code' => 200,
                'data' => [
                    'subscribed' => [
                        'store_id' => $provider?->id,
                        'token' => $token,
                        'package_id' => $provider?->package_id,
                        'zone_wise_topic' => $provider?->zone?->store_wise_topic,
                        'type' => 'new_join',
                        'module_type' => $provider?->module?->module_type
                    ]
                ]
            ];
        }
        if ($provider->is_active == 0 || $provider->is_approved == 0) {
            return [
                'type' => 'errors',
                'code' => 403,
                'data' => [
                    'errors' => [
                        ['code' => 'auth-002', 'message' => translate('messages.Your_registration_is_not_approved_yet._You_can_login_once_admin_approved_the_request')]
                    ]
                ]
            ];
        } elseif ($provider->is_active == 0 && $provider->is_approved == 1 && in_array($provider?->business_model ,['subscription' ,'commission']) ) {
            return [
                'type' => 'errors',
                'code' => 403,
                'data' => [
                    'errors' => [
                        ['code' => 'auth-002', 'message' => translate('messages.Your_account_is_suspended')]
                    ]
                ]
            ];
        }

        if ($provider?->business_model == 'subscription') {
            $provider_sub = $provider?->store_sub;
            if (isset($provider_sub)) {
                if ($provider_sub?->mobile_app == 0) {
                    return [
                        'type' => 'errors',
                        'code' => 401,
                        'data' => [
                            'errors' => [
                                ['code' => 'no_mobile_app', 'message' => translate('messages.Your Subscription Plan is not Active for Mobile App')]
                            ]
                        ]
                    ];
                }
            }
        }

        if ($provider?->business_model == 'unsubscribed' && isset($provider?->store_sub_update_application)) {
            return null;
        }

        if ($provider?->business_model == 'unsubscribed' && !isset($provider?->store_sub_update_application)) {
            $provider->auth_token = $token;
            $provider?->save();
            return [
                'type' => 'subscribed',
                'code' => 200,
                'data' => [
                    'subscribed' => [
                        'store_id' => $provider?->id,
                        'token' => $token,
                        'zone_wise_topic' => $provider?->zone?->store_wise_topic,
                        'type' => 'new_join',
                        'module_type' => $provider?->module?->module_type
                    ]
                ]
            ];
        }
        return null ;
    }

}
