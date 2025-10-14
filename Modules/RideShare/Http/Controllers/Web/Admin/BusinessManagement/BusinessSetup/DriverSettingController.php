<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\BusinessManagement\BusinessSetup;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Modules\BusinessManagement\Http\Requests\DriverSettingStoreOrUpdateRequest;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Interface\BusinessManagement\Service\BusinessSettingServiceInterface;

class DriverSettingController extends BaseController
{
    protected $businessSettingService;

    public function __construct(BusinessSettingServiceInterface $businessSettingService)
    {
        parent::__construct($businessSettingService);
        $this->businessSettingService = $businessSettingService;
    }

    public function index(?Request $request, string $type = null): View|Collection|LengthAwarePaginator|null|callable|RedirectResponse
    {

        $settings = $this->businessSettingService->getBy(criteria: ['type' => RIDE_SHARE_BUSINESS_SETTINGS]);
        return view('ride-share::admin.business-management.business-setup.rider', compact('settings'));
    }

    public function store(DriverSettingStoreOrUpdateRequest $request): RedirectResponse|Renderable
    {
        $this->businessSettingService->storeDriverSetting($request->validated());
        Toastr::success(BUSINESS_SETTING_UPDATE_200['message']);
        return back();
    }
    public function vehicleUpdate(Request $request): RedirectResponse|Renderable
    {
        $this->businessSettingService->storeVehicleUpdateDriverSetting($request->all());
        Toastr::success(BUSINESS_SETTING_UPDATE_200['message']);
        return back();
    }
}
