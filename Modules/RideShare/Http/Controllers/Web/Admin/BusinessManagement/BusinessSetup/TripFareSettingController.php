<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\BusinessManagement\BusinessSetup;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Http\Requests\BusinessManagement\CancellationReasonStoreOrUpdateRequest;
use Modules\RideShare\Http\Requests\BusinessManagement\TripFareSettingStoreOrUpdateRequest;
use Modules\RideShare\Interface\BusinessManagement\Service\BusinessSettingServiceInterface;
use Modules\RideShare\Interface\BusinessManagement\Service\CancellationReasonServiceInterface;

class TripFareSettingController extends BaseController
{
    protected $businessSettingService;
    protected $cancellationReasonService;

    public function __construct(BusinessSettingServiceInterface $businessSettingService, CancellationReasonServiceInterface $cancellationReasonService)
    {
        parent::__construct($businessSettingService);
        $this->businessSettingService = $businessSettingService;
        $this->cancellationReasonService = $cancellationReasonService;
    }

    public function index(?Request $request, string $type = null): View|Collection|LengthAwarePaginator|null|callable|RedirectResponse
    {
        $settings = $this->businessSettingService->getBy(criteria: ['type' => RIDE_SHARE_BUSINESS_SETTINGS]);
        return view('ride-share::admin.business-management.business-setup.fare_and_penalty', compact('settings'));
    }

    public function tripIndex(Request $request)
    {
        $searchCriteria = [];
        if (array_key_exists('search', $request->all())) {
            $searchCriteria = [
                'fields' => ['title'],
                'value' => $request->search,
            ];
        }
        $settings = $this->businessSettingService->getBy(criteria: ['type' => RIDE_SHARE_BUSINESS_SETTINGS]);
        $cancellationReasons = $this->cancellationReasonService->getBy(searchCriteria: $searchCriteria, orderBy: ['created_at'=>'desc'], limit: paginationLimit(),offset: $request?->page??1);
        return view('ride-share::admin.business-management.business-setup.rides', compact('settings','cancellationReasons'));
    }

    public function store(TripFareSettingStoreOrUpdateRequest $request)
    {
        $this->businessSettingService->storeTripFareSetting($request->validated());
        Toastr::success(BUSINESS_SETTING_UPDATE_200['message']);
        return back();
    }

    #cancellation reason
    public function storeCancellationReason(CancellationReasonStoreOrUpdateRequest $request)
    {
        $this->cancellationReasonService->create(data: $request);
        Toastr::success(translate('Cancellation message stored successfully'));
        return redirect()->back();
    }
    public function editCancellationReason($id)
    {
        $cancellationReason = $this->cancellationReasonService->findOne(id: $id);
        if (!$cancellationReason){
            Toastr::error(translate('Cancellation reason not found'));
            return redirect()->back();
        }
        return view('ride-share::admin.business-management.business-setup.edit-cancellation-reason', compact('cancellationReason'));
    }
    public function updateCancellationReason($id, CancellationReasonStoreOrUpdateRequest $request)
    {
        $this->cancellationReasonService->update(id: $id,data: $request);
        Toastr::success(translate('Cancellation message updated successfully'));
        return redirect()->back();
    }

    public function destroyCancellationReason(string $id)
    {
        $this->cancellationReasonService->delete(id: $id);
        Toastr::success(translate('Cancellation message deleted successfully.'));
        return redirect()->back();
    }

    public function statusCancellationReason(Request $request): RedirectResponse
    {
        $request->validate([
            'status' => 'boolean'
        ]);
        $data = [
            'status' => $request->status
        ];
        $model = $this->cancellationReasonService->statusChange(id: $request->id, data: $data);
        Toastr::success(translate('messages.status_updated'));
        return back();
    }
}
