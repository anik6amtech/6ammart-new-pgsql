<?php

namespace Modules\Service\Http\Controllers\Web\Provider\ProviderManagement;

use App\CentralLogics\Helpers;
use App\Models\BusinessSetting;
use App\Models\NotificationSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Service\Entities\ProviderManagement\ProviderNotificationSetup;

class NotificationController extends Controller
{
    private function providerId(): int
    {
        return Helpers::get_provider_id();
    }

    public function notificationSettingsGet(Request $request): View|Factory|Application
    {
        $type = $request->has('type') ? $request->type : 'provider';
        $data = ProviderNotificationSetup::where('provider_id', $this->providerId())->where('type', $type)->get();
        $business_name = BusinessSetting::where('key','business_name')->first()?->value;
        return view('service::provider.provider-management.notification-setup', compact('business_name' ,'data' ,'type'));
    }

    public function notificationSettingsSet($user_type, $key, $type){
        $data = ProviderNotificationSetup::where('provider_id',$this->providerId())->where('key',$key)->where('type',$user_type)->first();

        if(!$data){
            Toastr::error(translate('messages.Notification_settings_not_found'));
            return back();
        }
        if($type == 'mail' ) {
            $data->mail_status =  $data->mail_status == 'active' ? 'inactive' : 'active';
        }
        elseif($type == 'push_notification' ) {
            $data->push_notification_status =  $data->push_notification_status == 'active' ? 'inactive' : 'active';
        }
        elseif($type == 'sms' ) {
            $data->sms_status =  $data->sms_status == 'active' ? 'inactive' : 'active';
        }
        $data?->save();

        Toastr::success(translate('messages.Notification_settings_updated'));
        return back();
    }
}
