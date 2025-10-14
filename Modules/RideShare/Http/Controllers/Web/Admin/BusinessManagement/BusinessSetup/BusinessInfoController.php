<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\BusinessManagement\BusinessSetup;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Http\Requests\BusinessManagement\BusinessSettingStoreOrUpdateRequest;
use Modules\RideShare\Interface\BusinessManagement\Service\BusinessSettingServiceInterface;
use Modules\RideShare\Interface\ZoneManagement\Service\ZoneServiceInterface;

class BusinessInfoController extends BaseController
{

    
    protected $businessSettingService;
    protected $zoneService;

    public function __construct(BusinessSettingServiceInterface $businessSettingService, ZoneServiceInterface $zoneService)
    {
        parent::__construct($businessSettingService);
        $this->businessSettingService = $businessSettingService;
        $this->zoneService = $zoneService;
    }

    public function updateBusinessSetting(Request $request): JsonResponse
    {
        $businessInfo = $this->businessSettingService->findOneBy(criteria: ['key' => $request['name'], 'type' => RIDE_SHARE_BUSINESS_SETTINGS]);
        if ($businessInfo) {
            $data = $this->businessSettingService
                ->update(id: $businessInfo->id, data: ['key' => $request['name'], 'type' => RIDE_SHARE_BUSINESS_SETTINGS, 'value' => $request['value']]);
        } else {
            $data = $this->businessSettingService
                ->create(data: ['key' => $request['name'], 'type' => RIDE_SHARE_BUSINESS_SETTINGS, 'value' => $request['value']]);
        }
        if ($request['type'] == ALL_ZONE_EXTRA_FARE && $request['value'] == 0) {
            $allZones = $this->zoneService->getAll(withTrashed: true);
            if ($allZones) {
                $whereInCriteria = [
                    'id' => $allZones->pluck('id')->toArray(),
                ];
                $this->zoneService->updatedBy(whereInCriteria: $whereInCriteria, data: ['extra_fare_status' => false]);
            }
        }
        return response()->json($data);
    }

    public function settings()
    {
        $settings = $this->businessSettingService
            ->getBy(criteria: ['type' => RIDE_SHARE_BUSINESS_SETTINGS]);
        return view('ride-share::admin.business-management.business-setup.settings', compact('settings'));
    }

    public function updateSettings(BusinessSettingStoreOrUpdateRequest $request): RedirectResponse
    {
        $this->businessSettingService->updateSetting($request->validated());
        Toastr::success(BUSINESS_SETTING_UPDATE_200['message']);
        return back();
    }
}
