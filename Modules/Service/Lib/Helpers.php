<?php

use App\Models\BusinessSetting;
use App\Models\NotificationSetting;
use App\Models\StoreSubscription;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\BookingModule\BookingRepeat;
use Modules\Service\Entities\CartModule\Cart;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\ProviderNotificationSetup;
use Modules\Service\Entities\ProviderManagement\ProviderSetting;

if (!function_exists('translate')) {
    function translate($key)
    {
        try {
            $local = app()->getLocale();
            $lang_array = include(base_path('resources/lang/' . $local . '/lang.php'));
            $processed_key = ucfirst(str_replace('_', ' ', str_ireplace(['\'', '"', ';', '<', '>', '?'], ' ', $key)));
            if (!array_key_exists($key, $lang_array)) {
                $lang_array[$key] = $processed_key;
                $str = "<?php return " . var_export($lang_array, true) . ";";
                file_put_contents(base_path('resources/lang/' . $local . '/lang.php'), $str);
                $result = $processed_key;
            } else {
                $result = __('lang.' . $key);
            }
            return $result;
        } catch (\Exception $exception) {
            return $key;
        }
    }
}

if (!function_exists('bs_data')) {
    function bs_data($settings, $key, $required = 0)
    {
        try {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'live' || $required) {
                $config = $settings->where('key_name', $key)->first()->live_values;
            } else {
                $config = null;
            }

        } catch (Exception $exception) {
            return null;
        }

        return (isset($config)) ? $config : null;
    }
}

if (!function_exists('bs_data_text')) {
    function bs_data_text($settings, $key, $required = 0)
    {
        try {
            if (env('APP_ENV') == 'local' || env('APP_ENV') == 'live' || $required) {
                $config = $settings->where('key', $key)->first()->value;
            } else {
                $config = null;
            }

        } catch (Exception $exception) {
            return null;
        }

        return (isset($config)) ? $config : null;
    }
}

if (!function_exists('error_processor')) {
    function error_processor($validator)
    {
        $errors = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            $errors[] = ['error_code' => $index, 'message' => translate($error[0])];
        }
        return $errors;
    }
}

if (!function_exists('get_path')) {
    function get_path($type)
    {
        if ($type == 'public') {
            return url('/') . '/public';
        }

        return url('/');
    }
}

if (!function_exists('response_formatter')) {
    function response_formatter($constant, $content = null, $errors = []): array
    {
        $constant = [
            'response_code' => $constant['response_code'],
            'message' => translate($constant['message']),
        ];
        $constant['content'] = $content;
        $constant['errors'] = $errors;

        return $constant;
    }
}

if (!function_exists('getDisk')) {
    function getDisk()
    {
        $storageType = business_config('storage_connection_type', 'storage_settings');
        return isset($storageType) ? ($storageType->live_values == 's3' ? 's3' : 'public') : 'public';
    }
}

if (!function_exists('file_uploader')) {
    function file_uploader(string $dir, string $format, $image = null, $old_image = null)
    {
        if ($image == null) return $old_image ?? 'def.png';

        if (isset($old_image)) Storage::disk(getDisk())->delete($dir . $old_image);

        $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;

        try {
            if (!Storage::disk(getDisk())->exists($dir)) {
                Storage::disk(getDisk())->makeDirectory($dir);
            }
            Storage::disk(getDisk())->put($dir . $imageName, file_get_contents($image));
        }catch (Exception $exception){

        }
        return $imageName;
    }
}

if (!function_exists('file_remover')) {
    function file_remover(string $dir, $image): bool
    {
        if (!isset($image)) return true;

        if (is_array($image)) {
            foreach ($image as $img) {
                file_remover($dir, $img);
            }
        } else {
            if (Storage::disk('public')->exists($dir . $image)) Storage::disk('public')->delete($dir . $image);

            try {
                if (Storage::disk('s3')->exists($dir . $image)) Storage::disk('s3')->delete($dir . $image);
            } catch (Exception $e) {

            }
        }

        return true;
    }
}

if (!function_exists('divnum')) {
    function divnum($numerator, $denominator)
    {
        return $denominator == 0 ? 0 : ($numerator / $denominator);
    }
}

if (!function_exists('access_checker')) {
    function access_checker($module)
    {
        return true;
        if (auth()->user()->user_type == 'super-admin') {
            return true;
        } elseif (auth()->user()->roles->count() > 0) {
            $modules = auth()->user()->roles[0]->modules;
            if (in_array($module, $modules)) {
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('exc_handler')) {
    function exc_handler($data)
    {
        try {
            $response = $data;
        } catch (Exception $exception) {
            $response = translate('not_available');
        }
        return $response;
    }
}

if (!function_exists('get_add_money_bonus')) {
    function get_add_money_bonus($amount)
    {
        $bonuses = Bonus::where('is_active', 1)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->where('minimum_add_amount', '<=', $amount)
            ->get();

        $bonuses = $bonuses->where('minimum_add_amount', $bonuses->max('minimum_add_amount'));

        foreach ($bonuses as $key => $item) {
            $item->applied_bonus_amount = $item->bonus_amount_type == 'percent' ? ($amount * $item->bonus_amount) / 100 : $item->bonus_amount;

            if ($item->bonus_amount_type == 'percent' && $item->applied_bonus_amount > $item->maximum_bonus_amount) {
                $item->applied_bonus_amount = $item->maximum_bonus_amount;
            }
        }

        return $bonuses->max('applied_bonus_amount') ?? 0;
    }
}

if (!function_exists('get_distance')) {
    function get_distance(array $originCoordinates, array $destinationCoordinates, $unit = 'K'): float
    {
        $lat1 = (float)$originCoordinates[0];
        $lat2 = (float)$destinationCoordinates[0];
        $lon1 = (float)$originCoordinates[1];
        $lon2 = (float)$destinationCoordinates[1];

        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}

if (!function_exists('provider_warning_amount_calculate')) {
    function provider_warning_amount_calculate($payable, $receivable): bool|string
    {
        if ($payable > $receivable) {
            $cash_in_hand_overflow = business_config('provider_suspend_on_exceed_cash_limit')->value ?? 0;
            $limit_amount = business_config('provider_max_cash_in_hand_limit')->value ?? 0;
            // $cash_in_hand_overflow= BusinessSetting::where('key' ,'cash_in_hand_overflow_store')->first()?->value ?? 1;
            // $limit_amount = BusinessSetting::where('key' ,'cash_in_hand_overflow_store_amount')->first()?->value ?? 0;

            if (!$cash_in_hand_overflow) {
                return false;
            }

            $amount = $payable - $receivable;

            $percentage_80 = 0.8 * $limit_amount;
            $percentage_100 = $limit_amount;

            $warningType = '';

            if ($amount >= $percentage_80) {
                $warningType = '80_percent';
            }

            if ($amount >= $percentage_100) {
                $warningType = '100_percent';
            }
            return $warningType;
        }
        return false;
    }
}

if (!function_exists('remove_invalid_charcaters')) {
    function remove_invalid_charcaters($str): array|string
    {
        return str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', $str);
    }
}

if (!function_exists('text_variable_data_format')) {
    function text_variable_data_format($title, $booking_id, $type = null, $data = null, $bookingType = null): array|string
    {
        $replaceMap = [
            '{{providerName}}' => '',
            '{{scheduleTime}}' => '',
            '{{userName}}' => '',
            '{{zoneName}}' => '',
            '{{serviceManName}}' => '',
        ];

        if ($type == 'booking' || $type == 'offline-payment') {
            $booking = null;

            if ($bookingType == 'repeat') {
                $booking = BookingRepeat::find($booking_id) ?? Booking::find($booking_id);
            } else {
                $booking = Booking::find($booking_id);
            }

            if (!$booking) {
                return $title;
            }

            $replaceMap['{{providerName}}'] = $booking?->provider?->company_name ?? '';
            $replaceMap['{{bookingId}}'] = $booking->readable_id;
            $replaceMap['{{scheduleTime}}'] = $booking->service_schedule;

            if ($bookingType == 'repeat') {
                if ($booking->booking) {
                    $replaceMap['{{userName}}'] = $booking->booking->customer ? $booking->booking->customer->first_name . ' ' . $booking->booking->customer->last_name : '';
                    $replaceMap['{{zoneName}}'] = $booking->booking->zone?->name ?? '';
                } else {
                    $replaceMap['{{userName}}'] = $booking->customer?->first_name . ' ' . $booking->customer?->last_name;
                    $replaceMap['{{zoneName}}'] = $booking->zone?->name;
                }
            } else {
                $replaceMap['{{userName}}'] = $booking->customer?->first_name . ' ' . $booking->customer?->last_name;
                $replaceMap['{{zoneName}}'] = $booking->zone?->name;
            }

            $replaceMap['{{serviceManName}}'] = $booking?->serviceman?->user?->first_name . ' ' . $booking?->serviceman?->user?->last_name;

        } else {
            if (is_array($data) && !empty($data)) {
                $replaceMap['{{providerName}}'] = $data['provider_name'] ?? '';
                $replaceMap['{{scheduleTime}}'] = $data['schedule_time'] ?? '';
                $replaceMap['{{userName}}'] = $data['user_name'] ?? '';
                $replaceMap['{{zoneName}}'] = $data['zone_name'] ?? '';
                $replaceMap['{{serviceManName}}'] = $data['service_man_name'] ?? '';
            }
        }

        $formattedTitle = str_replace(array_keys($replaceMap), array_values($replaceMap), $title);

        return ($formattedTitle === $title) ? $title : $formattedTitle;
    }
}

if (!function_exists('config_settingss')) {
    function config_settingss($key, $settings_type)
    {
        try {
            $config = DB::table('addon_settings')->where('key_name', $key)
                ->where('settings_type', $settings_type)->first();
        } catch (Exception $exception) {
            return null;
        }

        return (isset($config)) ? $config : null;
    }
}

if (!function_exists('onErrorImage')) {
    function onErrorImage($data, $src, $error_src ,$path)
    {
        if(isset($data) && strlen($data) >1 && Storage::disk('public')->exists($path.$data)){
            return $src;
        }
        return $error_src;
    }
}

if (!function_exists('getSuperAdminId')) {
    function getSuperAdminId()
    {
        return User::where('user_type', ADMIN_USER_TYPES[0])->first()->id;
    }
}

if (!function_exists('getServiceFee')) {
    function getServiceFee()
    {
        $additionalCharge = 0;
        $additional_charge_status = BusinessSetting::where('key', 'additional_charge_status')->first()->value;
        $additional_charge = BusinessSetting::where('key', 'additional_charge')->first()->value;
        if ($additional_charge_status == 1) {
            $additionalCharge = $additional_charge ?? 0;
        }
        return $additionalCharge;
    }
}

if (!function_exists('formatSubscriptionPackage')) {
    function formatSubscriptionPackage($subscriptionPackage, $features)
    {
        $featureList = [];
        foreach ($features as $feature) {
            $featureExists = $subscriptionPackage->subscriptionPackageFeature->contains(function ($value) use ($feature) {
                return $value->feature == $feature['key'];
            });
            if ($featureExists) {
                $featureList[] = $feature['value'];
            }
        }

        $bookingLimit = 'Unlimited Bookings';
        $categoryLimit = 'Unlimited Service Sub Categories';

        foreach ($subscriptionPackage->subscriptionPackageLimit as $limit) {
            if ($limit->key === 'booking' && $limit->is_limited) {
                $bookingLimit = $limit->limit_count . ' Booking Limit';
            }
            if ($limit->key === 'category' && $limit->is_limited) {
                $categoryLimit = $limit->limit_count . ' Sub Category Limit';
            }
        }

        $featureList[] = $bookingLimit;
        $featureList[] = $categoryLimit;

        $subscriptionPackage['feature_list'] = $featureList;

        unset($subscriptionPackage->subscriptionPackageFeature);
        unset($subscriptionPackage->subscriptionPackageLimit);

        return $subscriptionPackage;
    }
}

if (!function_exists('subscriptionFeatureList')) {
    function subscriptionFeatureList($subscription, $features): array
    {
        $categoryCount = 0;
        $bookingCount = 0;

        $featureList = [];
        $limitFeature = [
            'booking' => 'Unlimited',
            'category' => 'Unlimited'
        ];
        $limitLeft = [
            'booking' => 0,
            'category' => 0
        ];

        foreach ($features as $feature) {
            $featureExists = $subscription->subscriptionPackageFeature->contains(function ($value) use ($feature) {
                return $value->feature == $feature['key'];
            });
            if ($featureExists) {
                $featureList[] = $feature['key'];
            }
        }

        $featureList[] = 'booking';
        $featureList[] = 'category';

        foreach ($subscription->subscriptionPackageLimit as $limit) {
            if ($limit->key === 'booking' && $limit->is_limited) {
                $limitFeature['booking'] = $limit->limit_count;
                $limitLeft['booking'] = $limit->limit_count - $bookingCount;
            }
            if ($limit->key === 'category' && $limit->is_limited) {
                $limitFeature['category'] = $limit->limit_count;
                $limitLeft['category'] = $limit->limit_count - $categoryCount;
            }
        }

        $subscription->feature_list = $featureList;
        $subscription->feature_limit = $limitFeature;

        unset($subscription->subscriptionPackageFeature);
        unset($subscription->subscriptionPackageLimit);

        return $subscription->toArray();
    }
}



if (!function_exists('packageSubscriber')) {
    function packageSubscriber($packageSubscriber, $features)
    {
        $providerId = $packageSubscriber->provider_id;
        $packageSubscriber['total_amount'] = $packageSubscriber?->logs->where('provider_id', $providerId)->sum('package_price');
        $packageSubscriber['number_of_uses'] = $packageSubscriber?->logs->where('provider_id', $providerId)->count();
        $packageSubscriber['description'] = $packageSubscriber?->package->description;

        $featureList = [];
        foreach ($features as $feature) {
            $featureExists = $packageSubscriber->feature->contains(function ($value) use ($feature) {
                return $value->feature == $feature['key'];
            });
            if ($featureExists) {
                $featureList[] = $feature['value'];
            }
        }
        $bookingLimit = 'Unlimited Bookings';
        $categoryLimit = 'Unlimited Service Categories';

        foreach ($packageSubscriber->limits as $limit) {
            if ($limit->key === 'booking' && $limit->is_limited) {
                $bookingLimit = $limit->limit_count . ' Booking Limit';
            }
            if ($limit->key === 'category' && $limit->is_limited) {
                $categoryLimit = $limit->limit_count . ' Category Limit';
            }
        }

        $featureList[] = $bookingLimit;
        $featureList[] = $categoryLimit;

        $packageSubscriber['feature_list'] = $featureList;

        unset($packageSubscriber->feature);
        unset($packageSubscriber->limits);
        unset($packageSubscriber->logs);
        unset($packageSubscriber->package);

        return $packageSubscriber;
    }
}

if (!function_exists('apiPackageSubscriber')) {
    function apiPackageSubscriber($packageSubscriber, $features)
    {
        $categoryCount = 0;
        $bookingCount = 0;

        $startDate = $packageSubscriber?->package_start_date;
        $endDate = $packageSubscriber?->package_end_date;
        $providerId = $packageSubscriber?->provider_id;
        $providerUserId = $packageSubscriber?->provider->user_id;

        $packageSubscriber['total_amount'] = $packageSubscriber?->logs->sum('package_price');
        $packageSubscriber['number_of_uses'] = $packageSubscriber?->logs->count();
        $packageSubscriber['description'] = $packageSubscriber?->package->description;
        $packageSubscriber['is_paid'] = $packageSubscriber?->payment?->where('id', $packageSubscriber->payment_id)->value('is_paid');

        if ($startDate && $endDate) {
            $bookingCount = SubscriptionSubscriberBooking::where('provider_id', $providerId)
                ->where('package_subscriber_log_id', $packageSubscriber?->package_subscriber_log_id)
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    $startDate = Carbon::parse($startDate)->startOfDay();
                    $endDate = Carbon::parse($endDate)->endOfDay();
                    return $query->whereBetween('updated_at', [$startDate, $endDate]);
                })
                ->count();

            $categoryCount = SubscribedService::where('provider_id', $providerId)->where('is_subscribed', 1)
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    $startDate = Carbon::parse($startDate)->startOfDay();
                    $endDate = Carbon::parse($endDate)->endOfDay();
                    return $query->whereBetween('updated_at', [$startDate, $endDate]);
                })
                ->count();
        }

        $featureList = [];
        $limitFeature = [
            'booking' => 'Unlimited',
            'category' => 'Unlimited'
        ];
        $limitLeft = [
            'booking' => 0,
            'category' => 0
        ];

        foreach ($features as $feature) {
            $featureExists = $packageSubscriber->feature->contains(function ($value) use ($feature) {
                return $value->feature == $feature['key'];
            });
            if ($featureExists) {
                $featureList[] = $feature['key'];
            }
        }

        $featureList[] = 'booking';
        $featureList[] = 'category';

        foreach ($packageSubscriber->limits->where('provider_id', $providerId) as $limit) {
            if ($limit->key === 'booking' && $limit->is_limited) {
                $limitFeature['booking'] = $limit->limit_count;
                $limitLeft['booking'] = $limit->limit_count - $bookingCount;
            }
            if ($limit->key === 'category' && $limit->is_limited) {
                $limitFeature['category'] = $limit->limit_count;
                $limitLeft['category'] = $limit->limit_count - $categoryCount;
            }
        }

        $packageSubscriber['feature_list'] = $featureList;
        $packageSubscriber['feature_limit'] = $limitFeature;
        $packageSubscriber['feature_limit_left'] = $limitLeft;

        unset($packageSubscriber->feature);
        unset($packageSubscriber->limits);
        unset($packageSubscriber->logs);
        unset($packageSubscriber->package);
        unset($packageSubscriber->payment);

        return $packageSubscriber;
    }
}

if (!function_exists('saveSingleImageDataToStorage')) {
    function saveSingleImageDataToStorage($model, $modelColumn, $storageType)
    {
        \App\Models\Storage::updateOrCreate(
            [
                'model' => get_class($model),
                'model_id' => $model->id,
                'model_column' => $modelColumn
            ],
            [
                'storage_type' => $storageType,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        return true;
    }
}

if (!function_exists('saveBusinessImageDataToStorage')) {
    function saveBusinessImageDataToStorage($model, $modelColumn, $storageType)
    {
        \Modules\BusinessSettingsModule\Entities\Storage::updateOrCreate(
            [
                'model' => get_class($model),
                'model_column' => $modelColumn
            ],
            [
                'model_id' => $model->id,
                'storage_type' => $storageType,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        return true;
    }
}

if (!function_exists('getSingleImageFullPath')) {
    function getSingleImageFullPath($imagePath, $s3Storage = null, $defaultPath = null)
    {
        try {
            if ($s3Storage && $s3Storage->storage_type == 's3' && \Illuminate\Support\Facades\Storage::disk('s3')->exists($imagePath)) {
                return Storage::disk('s3')->url($imagePath);
//                $awsUrl = rtrim(config('filesystems.disks.s3.url'), '/');
//                $awsBucket = config('filesystems.disks.s3.bucket');
//                return $awsUrl . '/' . $awsBucket . '/' . $imagePath;
            }
        }catch(\Exception $exception){
            //
        }
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)) {
            return asset('storage/app/public/' . $imagePath);
        }

        else {
            if (request()->is('api/*')) {
                return null;
            }
            return $defaultPath;
        }
    }
}

if (!function_exists('getIdentityImageFullPath')) {
    function getIdentityImageFullPath($identityImages, $path, $defaultPath = null)
    {
//        if (empty($identityImages)) {
//            return $defaultPath ? [$defaultPath] : [];
//        }
        $identityImageFullPath = [];

        foreach ($identityImages as $identityImage) {
            $identityImage = is_array($identityImage) ? $identityImage : ['image' => $identityImage, 'storage' => 'public'];
            $imagePath = $path . $identityImage['image'];
            $fullPath = $defaultPath;

            try {
                if ($identityImage['storage'] == 's3' && \Illuminate\Support\Facades\Storage::disk('s3')->exists($imagePath)) {
//                    $awsUrl = rtrim(config('filesystems.disks.s3.url'), '/');
//                    $awsBucket = config('filesystems.disks.s3.bucket');
//                    $fullPath = $awsUrl . '/' . $awsBucket . '/' . $imagePath;
                    $fullPath = Storage::disk('s3')->url($imagePath);
                }
            }catch(\Exception $exception){
                //
            }

            if ($identityImage['storage'] == 'public' && \Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)) {
                $fullPath = asset('storage/app/public/' . $imagePath);
            }

            $identityImageFullPath[] = $fullPath;
        }

        return $identityImageFullPath;
    }
}

if (!function_exists('getBusinessSettingsImageFullPath')) {
    function getBusinessSettingsImageFullPath($key, $settingType, $path, $defaultPath = null)
    {
        $store_logo= BusinessSetting::where(['key' => 'logo'])->first();
        return \App\CentralLogics\Helpers::get_full_url('business',$store_logo?->value,$store_logo?->storage[0]?->value ?? 'public');
        /* $image = \Modules\BusinessSettingsModule\Entities\BusinessSettings::with('storage')->where(['key_name' => $key, 'settings_type' => $settingType])->first();
        if (!$image) {
            if (request()->is('api/*')) {
                return null;
            }
            return asset($defaultPath);
        }

        $imagePath = $path . $image->live_values;
        $s3Storage = $image->storage;

        try {
            if ($s3Storage && $s3Storage->storage_type == 's3' && \Illuminate\Support\Facades\Storage::disk('s3')->exists($imagePath)) {
                return Storage::disk('s3')->url($imagePath);
//                $awsUrl = rtrim(config('filesystems.disks.s3.url'), '/');
//                $awsBucket = config('filesystems.disks.s3.bucket');
//                return $awsUrl . '/' . $awsBucket . '/' . $imagePath;
            }
        }catch(\Exception $exception){
            //
        }

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)) {
            return asset('storage/app/public/' . $imagePath);
        } else {
            if (request()->is('api/*')) {
                return null;
            }
            return asset($defaultPath);
        } */
    }
}
if (!function_exists('getDataSettingsImageFullPath')) {
    function getDataSettingsImageFullPath($key, $settingType, $path, $defaultPath = null)
    {
        $image = \Modules\BusinessSettingsModule\Entities\DataSetting::with('storage')->where(['key' => $key, 'type' => $settingType])->first();
        if (!$image) {
            if (request()->is('api/*')) {
                return null;
            }
            return asset($defaultPath);
        }

        $imagePath = $path . $image->value;
        $s3Storage = $image->storage;

        try {
            if ($s3Storage && $s3Storage->storage_type == 's3' && \Illuminate\Support\Facades\Storage::disk('s3')->exists($imagePath)) {
                return Storage::disk('s3')->url($imagePath);
//                $awsUrl = rtrim(config('filesystems.disks.s3.url'), '/');
//                $awsBucket = config('filesystems.disks.s3.bucket');
//                return $awsUrl . '/' . $awsBucket . '/' . $imagePath;
            }
        }catch(\Exception $exception){
            //
        }

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)) {
            return asset('storage/app/public/' . $imagePath);
        } else {
            if (request()->is('api/*')) {
                return null;
            }
            return asset($defaultPath);
        }
    }
}

if (!function_exists('getPaymentGatewayImageFullPath')) {
    function getPaymentGatewayImageFullPath($key, $settingsType, $defaultPath = null)
    {
        $addonSettings = \Modules\PaymentModule\Entities\Setting::where('key_name', $key)->where('settings_type', $settingsType)->first();
        if (!$addonSettings) {
            if (request()->is('api/*')) {
                return null;
            }
            return asset($defaultPath);
        }
        $additionalData = $addonSettings['additional_data'] != null ? json_decode($addonSettings['additional_data']) : null;

        if ($additionalData){
            if (!$additionalData->gateway_image){
                return asset($defaultPath);
            }
        }

        $path = 'payment_modules/gateway_image/';
        $imagePath = $path . ($additionalData ? $additionalData->gateway_image : '');

        $additionalData = [
            'gateway_title' => $additionalData->gateway_title?? null,
            'gateway_image' => $additionalData->gateway_image?? null,
            'storage' => $additionalData->storage ?? 'public'
        ];

        try {
            if ($additionalData['storage'] == 's3' && \Illuminate\Support\Facades\Storage::disk('s3')->exists($imagePath)) {
                return Storage::disk('s3')->url($imagePath);
//                $awsUrl = rtrim(config('filesystems.disks.s3.url'), '/');
//                $awsBucket = config('filesystems.disks.s3.bucket');
//                return $awsUrl . '/' . $awsBucket . '/' . $imagePath;
            }
        }catch(\Exception $exception){
            //
        }

        if ($additionalData['storage'] == 'public' && \Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)) {
            return asset('storage/app/public/' . $imagePath);
        }

        if (request()->is('api/*')) {
            return null;
        }

        return asset($defaultPath);
    }
}


if (!function_exists('nextBookingEligibility')) {
    function nextBookingEligibility($providerId): bool
    {
        $provider = Provider::find($providerId);
        if($provider->business_model == 'commission') {
            return true;
        }

        $now = \Carbon\Carbon::now();
        $storeSubscription = StoreSubscription::where('store_id', $providerId)
            ->where('store_type', 'service_provider')
            ->where('status', 1)
            ->where('expiry_date', '>=', $now)
            ->first();
        if (!$storeSubscription) {
            return false;
        }

//        $bookingCount = Booking::where('provider_id', $providerId)->where('booking_type','subscription')
//            ->whereBetween(DB::raw('DATE(updated_at)'), [date('Y-m-d', strtotime($storeSubscription->created_at)), date('Y-m-d', strtotime($storeSubscription->expiry_date))])
//            ->count();

//        if($storeSubscription->max_order > $bookingCount) {
//            return true;
//        }

        if($storeSubscription->max_order > 0) {
            return true;
        }

        return false;
    }
}

if (!function_exists('nextBookingCount')) {
    function nextBookingCount($providerId): int
    {
        $provider = Provider::find($providerId);
        if ($provider->business_model == 'commission') {
            return PHP_INT_MAX;
        }

        $now = \Carbon\Carbon::now();
        $storeSubscription = StoreSubscription::where('store_id', $providerId)
            ->where('store_type', 'service_provider')
            ->where('status', 1)
            ->where('expiry_date', '>=', $now)
            ->first();

        if (!$storeSubscription) {
            return 0;
        }

        $bookingCount = Booking::where('provider_id', $providerId)
            ->where('booking_type', 'subscription')
            ->whereBetween(DB::raw('DATE(updated_at)'), [
                date('Y-m-d', strtotime($storeSubscription->created_at)),
                date('Y-m-d', strtotime($storeSubscription->expiry_date))
            ])
            ->count();

        return max(0, $bookingCount);
    }
}

if (!function_exists('scheduleBookingEligibility')) {
    function scheduleBookingEligibility($providerId): bool
    {
        $provider = Provider::find($providerId);
        $providerSettings = getProviderSettings($providerId, 'schedule_booking', 'provider_config');
        if($providerSettings == 0){
            return false;
        }

        if($provider->business_model == 'commission') {
            return true;
        }
        $now = \Carbon\Carbon::now();
        $storeSubscription = StoreSubscription::where('store_id', $providerId)
            ->where('store_type', 'service_provider')
            ->where('status', 1)
            ->where('expiry_date', '>=', $now)
            ->first();
        if (!$storeSubscription) {
            return false;
        }

        if($storeSubscription->scheduled_service == 1) {
            return true;
        }
        return false;
    }
}

if (!function_exists('instantBookingEligibility')) {
    function instantBookingEligibility($providerId): bool
    {
        $providerSettings = getProviderSettings($providerId, 'instant_booking', 'provider_config');
        return $providerSettings == 1;
    }
}

if (!function_exists('repeatBookingEligibility')) {
    function repeatBookingEligibility($providerId): bool
    {
        $providerSettings = getProviderSettings($providerId, 'repeat_booking', 'provider_config');
        return $providerSettings == 1;
    }
}

if (!function_exists('chatEligibility')) {
    function chatEligibility($providerId): bool
    {
        $provider = Provider::find($providerId);
        if($provider->business_model == 'commission') {
            return true;
        }

        $now = \Carbon\Carbon::now();
        $storeSubscription = StoreSubscription::where('store_id', $providerId)
            ->where('store_type', 'service_provider')
            ->where('status', 1)
            ->where('expiry_date', '>=', $now)
            ->first();
        if (!$storeSubscription) {
            return false;
        }
        if($storeSubscription->chat == 1) {
            return true;
        }
        return false;
    }
}

if (!function_exists('advertisementsEligibility')) {
    function advertisementsEligibility($providerId): bool
    {
        $now = \Carbon\Carbon::now();

        $provider = Provider::find($providerId);
        if($provider->business_model == 'commission') {
            return true;
        }
        $now = \Carbon\Carbon::now();
        $storeSubscription = StoreSubscription::where('store_id', $providerId)
            ->where('store_type', 'service_provider')
            ->where('status', 1)
            ->where('expiry_date', '>=', $now)
            ->first();
        if (!$storeSubscription) {
            return false;
        }

        if($storeSubscription->advertisement == 1) {
            return true;
        }
        return false;
    }
}

if (!function_exists('mobileAppCheck')) {
    function mobileAppCheck($user, $module): bool
    {
        if ($user) {
            $provider = Provider::where('user_id', $user->id)->first();
            if ($provider) {

                $providerId = $provider->id;
                $packageSubscriber = PackageSubscriber::where('provider_id', $providerId)->with('feature')->first();
                if ($packageSubscriber) {
                    $featureKeys = $packageSubscriber->feature->pluck('feature')->toArray();
                    if (in_array($module, $featureKeys) ) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        }
        return true;
    }
}

if (!function_exists('sendDeviceNotificationPermission')) {
    function sendDeviceNotificationPermission($providerId): bool
    {
        return true;
        $providerSubscription = PackageSubscriber::where('provider_id', $providerId)->first();
        $endDate = optional($providerSubscription)->package_end_date;
        $canceled = optional($providerSubscription)->is_canceled;
        $packageEndDate = $endDate ? Carbon::parse($endDate)->endOfDay() : null;
        $currentDate = Carbon::now()->subDay();
        $isPackageEnded = $packageEndDate ? $currentDate->diffInDays($packageEndDate, false) : null;
        $scheduleBookingEligibility = nextBookingEligibility($providerId);

        if ($providerSubscription) {
            if ($isPackageEnded > 0 && !$canceled && $scheduleBookingEligibility) {
                return true;
            }else{
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('isNotificationActive')) {
   function isNotificationActive(?string $providerId, string $key, string $type, string $userType): ?bool
   {
        $notificationSetup = NotificationSetting::where('key', $key)->where('type', $userType)->where('module_type','service')->get();

        if ($type == 'email') {
            $type = 'mail_status';
        } elseif ($type == 'notification') {
            $type = 'push_notification_status';
        } elseif ($type == 'sms') {
            $type = 'sms_status';
        }

        foreach ($notificationSetup as $setup) {
            $adminSettings = $setup;
            $providerSettings = null;

            if ($providerId) {
                $providerSettings = ProviderNotificationSetup::where('key', $key)->where('type', $userType)->where('provider_id', $providerId)->first();
            }

            $settingValue = $providerSettings->$type ?? $adminSettings->$type;

            if (is_null($settingValue)) {
                return false;
            }

            return (bool) $settingValue;
        }

        return false;
    }
}

if (!function_exists('checkCurrency')) {
   function checkCurrency($data, $type = null)
   {
       $digitalPayment = business_config('digital_payment', 'service_setup')->live_values;
       $publishedStatus = 0;

       try {
           $full_data = include('Modules/Gateways/Addon/info.php');
           $publishedStatus = $full_data['is_published'] == 1 ? 1 : 0;
       } catch (\Exception $exception) {
       }

       if($digitalPayment){
           if($type === null) {
               if ($publishedStatus == 1) {
                   $methods = DB::table('addon_settings')->where('is_active', 1)->where('settings_type', 'payment_config')->get();
                   $env = env('APP_ENV') == 'live' ? 'live' : 'test';
                   $credentials = $env . '_values';

               } else {
                   $methods = DB::table('addon_settings')->where('is_active', 1)->whereIn('settings_type', ['payment_config'])->whereIn('key_name', ['ssl_commerz', 'paypal', 'stripe', 'razor_pay', 'senang_pay', 'paytabs', 'paystack', 'paymob_accept', 'paytm', 'flutterwave', 'liqpay', 'bkash', 'mercadopago'])->get();
                   $env = env('APP_ENV') == 'live' ? 'live' : 'test';
                   $credentials = $env . '_values';

               }

               $getData = [];
               foreach ($methods as $method) {
                   $credentialsData = json_decode($method->$credentials);
                   $additional_data = json_decode($method->additional_data);
                   if ($credentialsData?->status == 1) {
                       $getData[] = [
                           'gateway' => $method->key_name,
                           'gateway_title' => $additional_data?->gateway_title,
                           'gateway_image' => $additional_data?->gateway_image
                       ];
                   }
               }

               if (is_array($getData)) {
                   foreach ($getData as $payment_gateway) {
                       $supportedCurrencies = getPaymentGatewaySupportedCurrencies($payment_gateway['gateway']);
                       if (!empty($supportedCurrencies) && !array_key_exists($data, $supportedCurrencies)) {
                           return $payment_gateway['gateway'];
                       }
                   }
               }
           }
           elseif($type == 'payment_gateway'){
               $currency = business_config('currency_code', 'business_information')->live_values;
               if(!empty(getPaymentGatewaySupportedCurrencies($data)) && !array_key_exists($currency, getPaymentGatewaySupportedCurrencies($data))){
                   return  $data;
               }
           }
       }

       return true;
    }
}

if (!function_exists('getPaymentGatewaySupportedCurrencies')) {
   function getPaymentGatewaySupportedCurrencies($key = null): array
   {
       $paymentGateway = [
           "amazon_pay" => [
               "USD" => "United States Dollar",
               "GBP" => "Pound Sterling",
               "EUR" => "Euro",
               "JPY" => "Japanese Yen",
               "AUD" => "Australian Dollar",
               "NZD" => "New Zealand Dollar",
               "CAD" => "Canadian Dollar"
           ],
           "bkash" => [
               "BDT" => "Bangladeshi Taka"
           ],
           "cashfree" => [
               "INR" => "Indian Rupee"
           ],
           "ccavenue" => [
               "INR" => "Indian Rupee"
           ],
           "ccavenue" => [
               "INR" => "Indian Rupee"
           ],
           "esewa" => [
               "NPR" => "Nepalese Rupee"
           ],
           "fatoorah" => [
               "KWD" => "Kuwaiti Dinar",
               "SAR" => "Saudi Riyal"
           ],
           "flutterwave" => [
               "NGN" => "Nigerian Naira",
               "GHS" => "Ghanaian Cedi",
               "KES" => "Kenyan Shilling",
               "ZAR" => "South African Rand",
               "USD" => "United States Dollar",
               "EUR" => "Euro",
               "GBP" => "Pound Sterling"
           ],
           "foloosi" => [
               "AED" => "United Arab Emirates Dirham"
           ],
           "hubtel" => [
               "GHS" => "Ghanaian Cedi"
           ],
           "hyper_pay" => [
               "AED" => "United Arab Emirates Dirham",
               "SAR" => "Saudi Riyal",
               "EGP" => "Egyptian Pound",
               "BHD" => "Bahraini Dinar",
               "KWD" => "Kuwaiti Dinar",
               "OMR" => "Omani Rial",
               "QAR" => "Qatari Riyal",
               "USD" => "United States Dollar"
           ],
           "instamojo" => [
               "INR" => "Indian Rupee"
           ],
           "iyzi_pay" => [
               "TRY" => "Turkish Lira"
           ],
           "liqpay" => [
               "UAH" => "Ukrainian Hryvnia",
               "USD" => "United States Dollar",
               "EUR" => "Euro"
           ],
           "maxicash" => [
               "PHP" => "Philippine Peso"
           ],
           "mercadopago" => [
               "ARS" => "Argentine Peso",
               "BRL" => "Brazilian Real",
               "CLP" => "Chilean Peso",
               "COP" => "Colombian Peso",
               "MXN" => "Mexican Peso",
               "PEN" => "Peruvian Sol",
               "UYU" => "Uruguayan Peso",
               "USD" => "United States Dollar"
           ],
           "momo" => [
               "VND" => "Vietnamese Dong"
           ],
           "moncash" => [
               "HTG" => "Haitian Gourde"
           ],
           "payfast" => [
               "ZAR" => "South African Rand"
           ],
           "paymob_accept" => [
               "EGP" => "Egyptian Pound"
           ],
           "paypal" => [
               "AUD" => "Australian Dollar",
               "BRL" => "Brazilian Real",
               "CAD" => "Canadian Dollar",
               "CZK" => "Czech Koruna",
               "DKK" => "Danish Krone",
               "EUR" => "Euro",
               "HKD" => "Hong Kong Dollar",
               "HUF" => "Hungarian Forint",
               "INR" => "Indian Rupee",
               "ILS" => "Israeli New Shekel",
               "JPY" => "Japanese Yen",
               "MYR" => "Malaysian Ringgit",
               "MXN" => "Mexican Peso",
               "TWD" => "New Taiwan Dollar",
               "NZD" => "New Zealand Dollar",
               "NOK" => "Norwegian Krone",
               "PHP" => "Philippine Peso",
               "PLN" => "Polish Zloty",
               "GBP" => "Pound Sterling",
               "RUB" => "Russian Ruble",
               "SGD" => "Singapore Dollar",
               "SEK" => "Swedish Krona",
               "CHF" => "Swiss Franc",
               "THB" => "Thai Baht",
               "TRY" => "Turkish Lira",
               "USD" => "United States Dollar"
           ],
           "paystack" => [
               "NGN" => "Nigerian Naira",
               "KES" => "Kenyan Shilling"
           ],
           "paytabs" => [
               "AED" => "United Arab Emirates Dirham",
               "SAR" => "Saudi Riyal",
               "BHD" => "Bahraini Dinar",
               "KWD" => "Kuwaiti Dinar",
               "OMR" => "Omani Rial",
               "QAR" => "Qatari Riyal",
               "EGP" => "Egyptian Pound",
               "USD" => "United States Dollar"
           ],
           "paytm" => [
               "INR" => "Indian Rupee"
           ],
           "phonepe" => [
               "INR" => "Indian Rupee"
           ],
           "pvit" => [
               "NGN" => "Nigerian Naira"
           ],
           "razor_pay" => [
               "INR" => "Indian Rupee"
           ],
           "senang_pay" => [
               "MYR" => "Malaysian Ringgit"
           ],
           "sixcash" => [
               "BDT" => "Bangladeshi Taka"
           ],
           "ssl_commerz" => [
               "BDT" => "Bangladeshi Taka"
           ],
           "stripe" => [
               "USD" => "United States Dollar",
               "AUD" => "Australian Dollar",
               "CAD" => "Canadian Dollar",
               "EUR" => "Euro",
               "GBP" => "Pound Sterling",
               "JPY" => "Japanese Yen",
               "NZD" => "New Zealand Dollar",
               "CHF" => "Swiss Franc",
               "DKK" => "Danish Krone",
               "NOK" => "Norwegian Krone",
               "SEK" => "Swedish Krona",
               "SGD" => "Singapore Dollar",
               "HKD" => "Hong Kong Dollar"
           ],
           "swish" => [
               "SEK" => "Swedish Krona"
           ],
           "tap" => [
               "AED" => "United Arab Emirates Dirham",
               "SAR" => "Saudi Riyal",
               "BHD" => "Bahraini Dinar",
               "KWD" => "Kuwaiti Dinar",
               "OMR" => "Omani Rial",
               "QAR" => "Qatari Riyal"
           ],
           "thawani" => [
               "OMR" => "Omani Rial"
           ],
           "viva_wallet" => [
               "EUR" => "Euro"
           ],
           "worldpay" => [
               "GBP" => "Pound Sterling",
               "USD" => "United States Dollar",
               "EUR" => "Euro",
               "JPY" => "Japanese Yen"
           ],
           "xendit" => [
               "IDR" => "Indonesian Rupiah",
               "PHP" => "Philippine Peso",
               "VND" => "Vietnamese Dong",
               "THB" => "Thai Baht",
               "MYR" => "Malaysian Ringgit",
               "SGD" => "Singapore Dollar"
           ],
       ];

       if ($key) {
           return array_key_exists($key,$paymentGateway) ?  $paymentGateway[$key] : [];
       }
       return $paymentGateway;
    }
}

if (!function_exists('getProviderSettings')) {
    function getProviderSettings($providerId, $key, $type)
    {
        $setting = ProviderSetting::where([
            'key'         => $key,
            'provider_id' => $providerId,
            'type'        => $type,
        ])->first();

        if ($setting) {
            return $setting->value;
        } else {
            $business_config = business_config($key);
            if($business_config){
                return $business_config->value;
            }
        }

        return 0;
    }
}

if (!function_exists('getProviderServiceLocation')) {
    function getProviderServiceLocation($providerId)
    {
        $serviceLocations = [];
        if(provider_config('service_at_customer_location', 'provider_config', $providerId)->value ?? false == '1') {
            $serviceLocations[] = 'customer';
        }
        if(provider_config('service_at_provider_location', 'provider_config', $providerId)->value ?? false == '1') {
            $serviceLocations[] = 'provider';
        }

        return $serviceLocations;
    }
}


//Promotion management lib small part

if (!function_exists('basic_discount_calculation')) {
    function basic_discount_calculation($service, $total_purchase_amount): float
    {
        $keeper = null;
        if ($service->service_discount->count() > 0) {
            $keeper = $service->service_discount[0]->discount;
        } elseif ($service->category->category_discount->count() > 0) {
            $keeper = $service->category->category_discount[0]->discount;
        }

        return booking_discount_calculator($keeper, $total_purchase_amount);
    }
}

if (!function_exists('campaign_discount_calculation')) {
    function campaign_discount_calculation($service, $total_purchase_amount): float
    {
        $keeper = null;
        if ($service->campaign_discount->count() > 0) {
            $keeper = $service->campaign_discount[0]->discount;
        } elseif($service->category->campaign_discount->count() > 0) {
            $keeper = $service->category->campaign_discount[0]->discount;
        }

        return booking_discount_calculator($keeper, $total_purchase_amount);
    }
}

if (!function_exists('booking_discount_calculator')) {
    /**
     * @param mixed $keeper
     * @param $total_purchase_amount
     * @return mixed
     */
    function booking_discount_calculator(mixed $keeper, $total_purchase_amount): float
    {
        $amount = 0;

        if ($keeper != null && $total_purchase_amount >= $keeper->min_purchase) {
            if ($keeper->discount_amount_type == 'percent') {
                $amount = ($total_purchase_amount / 100) * $keeper->discount_amount;

                if ($amount > $keeper->max_discount_amount) {
                    $amount = $keeper->max_discount_amount;
                }

            } else {
                $amount = $keeper->discount_amount;
            }
        }

        if($amount > $total_purchase_amount) {
            $amount = $total_purchase_amount;
        }

        return $amount;
    }

}

if (!function_exists('cart_items')) {
    function cart_items($user_id, $module_id)
    {
        return Cart::where(['customer_id' => $user_id, 'module_id' => $module_id])
            ->get();
    }
}

if (!function_exists('cart_total')) {
    function cart_total($user_id, $module_id): float
    {
        return (cart_items($user_id, $module_id))->sum('total_cost');
    }
}

if (!function_exists('cart_clean')) {
    function cart_clean($user_id, $module_id=null)
    {
        if ($module_id) {
            Cart::where(['customer_id' => $user_id, 'module_id' => $module_id])->delete();
            return [
                'flag' => 'success'
            ];
        }
        Cart::where(['customer_id' => $user_id])->delete();
        return [
            'flag' => 'success'
        ];
    }
}






