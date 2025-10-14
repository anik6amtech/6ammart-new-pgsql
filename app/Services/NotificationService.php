<?php

namespace App\Services;

use App\Models\Module;
use App\Traits\FileManagerTrait;

class NotificationService
{
    use FileManagerTrait;

    public function getAddData(Object $request): array
    {
        if ($request->has('image')) {
            $imageName = $this->upload('notification/', 'png', $request->file('image'));
        } else {
            $imageName = null;
        }
        return [
            'title' => $request->notification_title,
            'description' => $request->description,
            'image' => $imageName,
            'tergat' => $request->tergat,
            'status' => 1,
            'zone_id' => $request->zone=='all'?null:$request->zone,
        ];
    }
    public function getUpdateData(Object $request, object $notification): array
    {
        if ($request->has('image')) {
            $imageName = $this->updateAndUpload('notification/', $notification->image, 'png', $request->file('image'));
        } else {
            $imageName = $notification['image'];
        }
        return [
            'title' => $request->notification_title,
            'description' => $request->description,
            'image' => $imageName,
            'tergat' => $request->tergat,
            'status' => 1,
            'zone_id' => $request->zone=='all'?null:$request->zone,
            'updated_at' => now(),
        ];
    }

    public function getTopic(Object $request): string
    {
        $topicAllZone =[
            'customer'=>'all_zone_customer',
            'deliveryman'=>'all_zone_delivery_man',
            'store'=>'all_zone_store',
            'provider'=>'all_zone_provider',
            'serviceman'=>'all_zone_serviceman',
        ];

        $topicZoneWise=[
            'customer'=>'zone_'.$request->zone.'_customer',
            'deliveryman'=>'zone_'.$request->zone.'_delivery_man_push',
            'store'=>'zone_'.$request->zone.'_store',
            'provider'=>'zone_'.$request->zone.'_provider',
            'serviceman'=>'zone_'.$request->zone.'_serviceman',
        ];

        return $request->zone == 'all'?$topicAllZone[$request->tergat]:$topicZoneWise[$request->tergat];
    }

    public function getUserTypes() {
        $fullUserTypes = [
            'customer' => 'Customer',
            'deliveryman' => 'Delivery Man',
            'store' => 'Store',
            'provider' => 'Provider',
            'serviceman' => 'Service Man'
        ];
        $moduleId = config('module.current_module_id');
        $module = Module::find($moduleId);
        if($module?->module_type == 'service') {
            $userTypes = ['customer', 'provider', 'serviceman'];
        } elseif($module?->module_type == 'ride-share') {
            $userTypes = ['customer', 'deliveryman'];
        } else {
            $userTypes = ['customer', 'deliveryman', 'store'];
        }

        $returnUserTypes = [];
        foreach ($userTypes as $type) {
            $returnUserTypes[$type] = $fullUserTypes[$type];
        }
        return $returnUserTypes;
    }


}
