<?php

namespace Modules\Service\Http\Controllers\Web\Admin\BusinessSetup;

use App\CentralLogics\Helpers;
use App\Models\BusinessSetting;
use App\Models\DataSetting;
use App\Models\NotificationSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Service\Entities\ProviderManagement\Provider;

class BusinessSettingsController extends Controller
{
    public function getBusinessSetting(Request $request)
    {
        $settings = [];
        $keys = $this->getKeys($request->tab);

        $settings = DataSetting::whereIn('key', array_keys($keys))
            ->where('type', 'service_business_settings')
            ->get()
            ->mapWithKeys(function ($item) use ($keys) {
                if (isset($keys[$item->key])) {
                    if( $keys[$item->key] == 'json') {
                        $value = json_decode($item->value, true);
                    } else {
                        $value = $item->value;
                    }
                } else {
                    $value = $item->value;
                }
                return [$item->key => $value];
            })
            ->toArray();

        return view('service::admin.business-setup.business-settings')->with(compact(
            'settings'
        ));
    }

    public function updateBusinessSetting(Request $request)
    {
        if($request->type == 'bookings') {
            if($request->input('instant_booking') == 0 && $request->input('schedule_booking') == 0) {
                Toastr::error(translate('messages.You_must_enable_instant_or_schedule_booking'));
                return back();
            }
        }
        if($request->type == 'providers') {
            $this->updateProviderSuspension($request->provider_max_cash_in_hand_limit);
        }
        $keys = $this->getKeys($request->type);
        foreach ($keys as $key => $type) {
            if ($type == 'boolean') {
                $value = ($request->input($key) == 1) ? 1 : 0;
            } elseif ($type == 'numeric') {
                $value = is_numeric($request->input($key)) ? $request->input($key) : 0;
            } elseif ($type == 'string') {
                $value = $request->input($key) ?: '';
            } elseif($type == 'json') {
                $inputArr = $request->input($key);
                if(array_key_exists('bearer', $inputArr)) {
                    if($inputArr['bearer'] == 'admin') {
                        $inputArr['admin_percentage'] = 100;
                        $inputArr['provider_percentage'] = 0;
                    } elseif($inputArr['bearer'] == 'provider') {
                        $inputArr['admin_percentage'] = 0;
                        $inputArr['provider_percentage'] = 100;
                    }
                }
                $value = json_encode($inputArr);
            } else {
                $value = $request->input($key);
            }
            DataSetting::updateOrCreate(
                ['key' => $key, 'type' => 'service_business_settings'],
                ['value' => $value]
            );
        }

        Toastr::success(translate('messages.business_settings_updated_successfully'));
        return redirect()->back();
    }

    public function updateProviderSuspension($newLimit) {
        $oldMaximumLimitAmount = business_config('provider_max_cash_in_hand_limit')->value ?? 0;
        $currentMaxLimitAmount = $newLimit;
        $providers = Provider::ofApproval(1)->ofStatus(1)->get();
        // if($oldMaximumLimitAmount && $oldMaximumLimitAmount != $currentMaxLimitAmount){
            foreach ($providers as $provider){
                if ($provider){
                    $account = getUserAccount($provider->id, PROVIDER);
                    $payable = $account->payable_balance;
                    $receivable = $account->receivable_balance;
                    if ($payable > $receivable) {
                        $cash_in_hand = $payable - $receivable;
                        if ($cash_in_hand >= $currentMaxLimitAmount){
                            $provider->is_suspended = 1;
                            $provider->save();
                        }else{
                            $provider->is_suspended = 0;
                            $provider->save();
                        }
                    }elseif($payable <= $receivable){
                        $provider->is_suspended = 0;
                        $provider->save();
                    }
                }
            }
        // }
    }

    public function getKeys($tab, $type = 'full') {
        if ($tab == 'providers') {
            $keys = $this->getProviderSetupKeys();
        } elseif ($tab == 'serviceman') {
            $keys = $this->getServicemanSetupKeys();
        } elseif ($tab == 'promotion') {
            $keys = $this->getPromotionSetupKeys();
        } else {
            $keys = $this->getBookingsSetupKeys();
        }
        if ($type == 'key') {
            $keys = array_keys($keys);
        }
        return $keys;
    }

    public function getBookingsSetupKeys() {
        return [
            'bidding_system' => 'boolean',
            'otp_for_complete_service' => 'boolean',
            'see_other_providers_offers' => 'boolean',
            'post_validation_days' => 'numeric',
            'maximum_booking_amount' => 'numeric',
            'default_commission' => 'numeric',
            'minimum_booking_amount' => 'numeric',
            'service_complete_photo_evidence' => 'boolean',
            'direct_provider_booking' => 'boolean',
            'instant_booking' => 'boolean',
            'repeat_booking' => 'boolean',
            'schedule_booking' => 'boolean',
            'time_restriction_on_schedule_booking' => 'boolean',
            'time_restriction_on_schedule_booking_value' => 'numeric',
            'time_restriction_on_schedule_booking_value_type' => 'string',
            'booking_notification' => 'boolean',
            'booking_notification_type' => 'string',
        ];
    }

    public function getProviderSetupKeys() {
        return [
            'provider_can_cancel_booking' => 'boolean',
            'provider_can_edit_booking' => 'boolean',
            'provider_suspend_on_exceed_cash_limit' => 'boolean',
            'provider_self_registration' => 'boolean',
            'provider_self_delete' => 'boolean',
            'provider_commission_base' => 'boolean',
            'provider_subscription_base' => 'boolean',
            'provider_can_reply_review' => 'boolean',
            'service_at_provider_place' => 'boolean',
            'provider_maximum_booking_amount' => 'numeric',
            'provider_minimum_payable_amount' => 'numeric',
            'provider_max_cash_in_hand_limit' => 'numeric',
        ];
    }

    public function getServicemanSetupKeys() {
        return [
            'serviceman_can_cancel_booking' => 'boolean',
            'serviceman_edit_booking' => 'boolean'
        ];
    }

    public function getPromotionSetupKeys() {
        return [
            'service_coupon_cost_bearer' => 'json',
            'service_discount_cost_bearer' => 'json',
            'service_campaign_cost_bearer' => 'json'
        ];
    }

    public function notificationSetup(Request $request)
    {
        abort_if(!addon_published_status('Service'),404 );

        $data = NotificationSetting::where('module_type', 'service')
            ->when($request?->type == 'provider', function ($query) {
                $query->where('type', 'provider');
            })
            ->when($request?->type == 'customer', function ($query) {
                $query->where('type', 'user');
            })
            ->when($request?->type == 'serviceman', function ($query) {
                $query->where('type', 'serviceman');
            })->get();


        $business_name = BusinessSetting::where('key', 'business_name')->first()?->value;

        return view('service::admin.business-setup.notification-setup', compact('business_name', 'data'));

    }

    public function updateNotification($key, $user_type, $type)
    {
        $data = NotificationSetting::where('type', $user_type)->where('key', $key)->where('module_type', 'service')->first();
        if (!$data) {
            Toastr::error(translate('messages.Notification_settings_not_found'));
            return back();
        }
        if ($type == 'Mail') {
            $data->mail_status = $data->mail_status == 'active' ? 'inactive' : 'active';
        } elseif ($type == 'push_notification') {
            $data->push_notification_status = $data->push_notification_status == 'active' ? 'inactive' : 'active';
        } elseif ($type == 'SMS') {
            $data->sms_status = $data->sms_status == 'active' ? 'inactive' : 'active';
        }
        $data?->save();

        Toastr::success(translate('messages.Notification_settings_updated'));
        return back();
    }
}
