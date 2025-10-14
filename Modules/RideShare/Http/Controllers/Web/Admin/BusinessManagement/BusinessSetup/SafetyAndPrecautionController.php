<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\BusinessManagement\BusinessSetup;


use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Http\Requests\BusinessManagement\EmergencyNumberForCallStoreOrUpdateRequest;
use Modules\RideShare\Http\Requests\BusinessManagement\SafetyAlertStoreOrUpdateRequest;
use Modules\RideShare\Http\Requests\BusinessManagement\SafetyFeatureStoreOrUpdateRequest;
use Modules\RideShare\Http\Requests\BusinessManagement\SafetyPrecautionStoreOrUpdateRequest;
use Modules\RideShare\Interface\BusinessManagement\Service\BusinessSettingServiceInterface;
use Modules\RideShare\Interface\BusinessManagement\Service\SafetyAlertReasonServiceInterface;
use Modules\RideShare\Interface\BusinessManagement\Service\SafetyPrecautionServiceInterface;

class SafetyAndPrecautionController extends BaseController
{
    protected $businessSettingService;
    protected $safetyPrecautionService;
    protected $safetyAlertReasonService;


    public function __construct(
        BusinessSettingServiceInterface   $businessSettingService,
        SafetyPrecautionServiceInterface  $safetyPrecautionService,
        SafetyAlertReasonServiceInterface $safetyAlertReasonService,
    )
    {
        parent::__construct($businessSettingService);
        $this->businessSettingService = $businessSettingService;
        $this->safetyPrecautionService = $safetyPrecautionService;
        $this->safetyAlertReasonService = $safetyAlertReasonService;
    }

    public function index(?Request $request, string $type = null): View|Collection|LengthAwarePaginator|null|callable|RedirectResponse
    {
        if (in_array($type, [SAFETY_ALERT, PRECAUTION])) {
            $settings = $this->businessSettingService->getBy(criteria: ['type' => RIDE_SHARE_BUSINESS_SETTINGS]);
            $safetyPrecautions = $this->safetyPrecautionService->getBy(orderBy: ['created_at' => 'desc'], limit: paginationLimit(), offset: $request?->page ?? 1);
            $safetyAlertReasons = $this->safetyAlertReasonService->getBy(orderBy: ['created_at' => 'desc'], limit: paginationLimit(), offset: $request?->page ?? 1);
            $emergencyNumbers = json_decode($settings->firstWhere('key', 'emergency_other_number')?->value, true) ?? [];

            if ($type === SAFETY_ALERT) {
                return view('ride-share::admin.business-management.business-setup.safety-precaution', compact('settings', 'safetyAlertReasons', 'emergencyNumbers'));
            }
            if ($type === PRECAUTION) {
                return view('ride-share::admin.business-management.business-setup.precautions', compact('settings', 'safetyPrecautions', 'safetyAlertReasons', 'emergencyNumbers'));
            }
            return view('ride-share::admin.business-management.business-setup.safety-precaution', compact('settings', 'safetyPrecautions', 'safetyAlertReasons', 'emergencyNumbers'));
        }
        abort(404);
    }

    public function store(SafetyFeatureStoreOrUpdateRequest $request): RedirectResponse
    {
        $this->businessSettingService->storeSafetyFeature($request->validated());
        Toastr::success(BUSINESS_SETTING_UPDATE_200['message']);
        return back();
    }

    public function storeSafetyAlertReason(SafetyAlertStoreOrUpdateRequest $request): RedirectResponse
    {
        $this->safetyAlertReasonService->create(data: $request);
        Toastr::success(translate('Safety Alert stored successfully'));
        return redirect()->back();
    }

    public function editSafetyAlertReason($id): View
    {
        $safetyAlertReason = $this->safetyAlertReasonService->findOne(id: $id);
        if (!$safetyAlertReason) {
            Toastr::error(translate('Safety Alert not found'));
            return redirect()->back();
        }
        return view('ride-share::admin.business-management.business-setup.edit-safety-alert-reason', compact('safetyAlertReason'));
    }

    public function updateSafetyAlertReason($id, SafetyAlertStoreOrUpdateRequest $request): RedirectResponse
    {
        $this->safetyAlertReasonService->update(id: $id, data: $request);
        Toastr::success(translate('Safety Alert updated successfully'));
        return redirect()->back();
    }

    public function destroySafetyAlertReason(string $id): RedirectResponse
    {
        $this->safetyAlertReasonService->delete(id: $id);
        Toastr::success(translate('Safety alert deleted successfully.'));
        return redirect()->back();
    }

    public function statusSafetyAlertReason(Request $request): RedirectResponse
    {
        $request->validate([
            'status' => 'boolean'
        ]);
        $data = [
            'status' => $request->status
        ];
        $model = $this->safetyAlertReasonService->statusChange(id: $request->id, data: $data);
        Toastr::success(translate('messages.status_updated'));
        return back();
    }

    public function storeSafetyPrecaution(SafetyPrecautionStoreOrUpdateRequest $request): RedirectResponse
    {
        $this->safetyPrecautionService->create(data: $request);
        Toastr::success(translate('Safety Precaution stored successfully'));
        return redirect()->back();
    }

    public function editSafetyPrecaution($id): View
    {
        $safetyPrecaution = $this->safetyPrecautionService->findOne(id: $id);
        if (!$safetyPrecaution) {
            Toastr::error(translate('Safety Precaution not found'));
            return redirect()->back();
        }
        return view('ride-share::admin.business-management.business-setup.edit-safety-precaution', compact('safetyPrecaution'));
    }

    public function updateSafetyPrecaution($id, SafetyPrecautionStoreOrUpdateRequest $request): RedirectResponse
    {
        $this->safetyPrecautionService->update(id: $id, data: $request);
        Toastr::success(translate('Safety Precaution updated successfully'));
        return redirect()->back();
    }

    public function destroySafetyPrecaution(string $id): RedirectResponse
    {
        $this->safetyPrecautionService->delete(id: $id);
        Toastr::success(translate('Safety precaution deleted successfully.'));
        return redirect()->back();
    }


    public function statusSafetyPrecaution(Request $request): RedirectResponse
    {
        $request->validate([
            'status' => 'boolean'
        ]);
        $model = $this->safetyPrecautionService->statusChange(id: $request->id, data: $request->all());
        Toastr::success(translate('messages.status_updated'));
        return back();
    }

    public function storeEmergencyNumberForCall(EmergencyNumberForCallStoreOrUpdateRequest $request): JsonResponse
    {
        try {
            $this->businessSettingService->storeEmergencyNumberForCall(data: $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => BUSINESS_SETTING_UPDATE_200['message'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }


}
