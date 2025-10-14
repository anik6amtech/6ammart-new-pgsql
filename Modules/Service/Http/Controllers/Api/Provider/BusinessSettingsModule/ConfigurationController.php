<?php

namespace Modules\Service\Http\Controllers\Api\Provider\BusinessSettingsModule;

use App\Models\NotificationSetting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Service\Entities\ProviderManagement\ProviderNotificationSetup;

class ConfigurationController extends Controller
{
    private NotificationSetting $notificationSetup;
    private ProviderNotificationSetup $providerNotificationSetup;

    private $statusValue = [];

    public function __construct(NotificationSetting $notificationSetup, ProviderNotificationSetup $providerNotificationSetup)
    {
        $this->notificationSetup = $notificationSetup;
        $this->providerNotificationSetup = $providerNotificationSetup;
        $this->statusValue = [
            "disable" => null,
            "inactive" => 0,
            "active" => 1,
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function notificationSettingsGet(Request $request): \Illuminate\Http\JsonResponse
    {
        $provider = auth('provider')->user();
        $notificationType = $request->get('notification_type', 'provider');
        $notificationSetup = $this->notificationSetup->where('type', $notificationType)
            ->get();

        $notificationSetup->each(function ($setup) use ($provider) {
            $setup->value = [
                "email" => $this->statusValue[$setup->mail_status],
                "notification" => $this->statusValue[$setup->push_notification_status],
                "sms" => $this->statusValue[$setup->sms_status],
            ];
            $setup->title = translate($setup->title);
            $setup->sub_title = translate($setup->sub_title);

            $providerNotification = ProviderNotificationSetup::where('type', $setup->type)
                ->where('key', $setup->key)
                ->where('provider_id', $provider->id)
                ->first();

            if ($providerNotification != null) {
                $providerNotification->value = [
                    "email" => $this->statusValue[$providerNotification->mail_status],
                    "notification" => $this->statusValue[$providerNotification->push_notification_status],
                    "sms" => $this->statusValue[$providerNotification->sms_status],
                ];
                $setup->provider_notifications = $providerNotification;
            } else {
                $setup->provider_notifications = null;
            }
        });

        return response()->json(response_formatter(DEFAULT_200, $notificationSetup), 200);
    }

    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $provider = auth('provider')->user();
        $notificationsData = $request->input('notifications', []);

        foreach ($notificationsData as $notificationId => $settings) {
            $adminNotification = $this->notificationSetup->find($notificationId);

            $providerNotification = $this->providerNotificationSetup->where([
                'type' => $adminNotification->type,
                'key' => $adminNotification->key,
                'provider_id' => $provider->id
            ])->first();

            if($providerNotification == null) { 
                $providerNotification = new ProviderNotificationSetup();
                $providerNotification->title = $adminNotification->title;
                $providerNotification->sub_title = $adminNotification->sub_title;
                $providerNotification->type = $adminNotification->type;
                $providerNotification->key = $adminNotification->key;
                $providerNotification->provider_id = $provider->id;
                $providerNotification->mail_status = $adminNotification->mail_status;
                $providerNotification->sms_status = $adminNotification->sms_status;
                $providerNotification->push_notification_status = $adminNotification->push_notification_status;
            }
            foreach ($settings as $type => $status) {
                if($type == 'sms') {
                    $providerNotification->sms_status = $this->getUpdateStatus($providerNotification->sms_status, $status);
                } elseif ($type == 'email') {
                    $providerNotification->mail_status = $this->getUpdateStatus($providerNotification->mail_status, $status);
                } elseif ($type == 'notification') {
                    $providerNotification->push_notification_status = $this->getUpdateStatus($providerNotification->push_notification_status, $status);
                }
            }

            $providerNotification->save();
        }

        return response()->json(response_formatter(DEFAULT_200), 200);
    }

    public function getUpdateStatus($existingStatus, $newStatus) {
        
        $updateStatus = 'inactive';
        if($existingStatus === 'disable') {
            $updateStatus = 'disable';
        }elseif($newStatus == "1") {
            $updateStatus = 'active';
        }
        return $updateStatus;
    }
}
