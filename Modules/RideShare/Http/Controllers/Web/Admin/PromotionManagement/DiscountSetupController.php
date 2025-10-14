<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\PromotionManagement;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Http\Requests\PromotionManagement\DiscountStoreOrUpdateRequest;
use Modules\RideShare\Interface\PromotionManagement\Service\DiscountSetupServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\CustomerServiceInterface;
use Modules\RideShare\Interface\VehicleManagement\Service\VehicleCategoryServiceInterface;
use Modules\RideShare\Interface\ZoneManagement\Service\ZoneServiceInterface;
use Modules\RideShare\Traits\TripManagement\DiscountCalculationTrait;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DiscountSetupController extends BaseController
{
    use DiscountCalculationTrait;

    protected $discountSetupService;
    protected $zoneService;
    // protected $customerLevelService;
    protected $customerService;
    protected $vehicleCategoryService;
    protected $activityLogService;

    // public function __construct(DiscountSetupServiceInterface   $discountSetupService, ZoneServiceInterface $zoneService,
    //                             CustomerLevelServiceInterface   $customerLevelService, CustomerServiceInterface $customerService,
    //                             VehicleCategoryServiceInterface $vehicleCategoryService, ActivityLogServiceInterface $activityLogService)
    public function __construct(DiscountSetupServiceInterface   $discountSetupService, ZoneServiceInterface $zoneService,
                                 CustomerServiceInterface $customerService,VehicleCategoryServiceInterface $vehicleCategoryService)
    {
        parent::__construct($discountSetupService);
        $this->discountSetupService = $discountSetupService;
        $this->zoneService = $zoneService;
        // $this->customerLevelService = $customerLevelService;
        $this->customerService = $customerService;
        $this->vehicleCategoryService = $vehicleCategoryService;
        // $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(?Request $request, string $type = null): View|Collection|LengthAwarePaginator|null|callable|RedirectResponse
    {
        $dateRangeValue = $request?->query('date_range');
        $this->discountSetupService->updatedBy(criteria: [['end_date', '<', Carbon::today()]], data: ['is_active' => false]);
        $discounts = $this->discountSetupService->index(criteria: $request?->all(), orderBy: ['created_at' => 'desc'], limit: paginationLimit(), offset: $request?->page ?? 1);

        return view('ride-share::admin.promotion-management.discount-setup.list', compact('dateRangeValue', 'discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Renderable
    {
        $zones = $this->zoneService->getAll();
        // $levels = $this->customerLevelService->getBy(criteria: ['user_type' => CUSTOMER]);
        $vehicleCategories = $this->vehicleCategoryService->getAll();
        $language = getWebConfig('language');
        return view('ride-share::admin.promotion-management.discount-setup.create', compact('zones', 'vehicleCategories', 'language'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountStoreOrUpdateRequest $request): RedirectResponse
    {
        $this->discountSetupService->create(data: $request);
        Toastr::success(DISCOUNT_STORE_200['message']);
        return redirect()->route('admin.ride-share.promotion.discount-setup.index');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('promotionmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $zones = $this->zoneService->getAll();
        // $levels = $this->customerLevelService->getBy(criteria: ['user_type' => CUSTOMER]);
        $vehicleCategories = $this->vehicleCategoryService->getAll();
        // $relations = ['vehicleCategories', 'zones', 'customers', 'customerLevels'];
        $relations = ['vehicleCategories','zones', 'customers'];
        $discount = $this->discountSetupService->findOne(id: $id, relations: $relations);
        if (is_null($discount)) {
            Toastr::error(translate(DISCOUNT_RESOURCE_404['message']));
            return redirect()->back();
        }
        $customers = $this->customerService->getBy(criteria: ['status' => 1]);
        $language = getWebConfig('language');
        return view('ride-share::admin.promotion-management.discount-setup.edit', compact('discount', 'zones', 'customers', 'language', 'vehicleCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountStoreOrUpdateRequest $request, $id): RedirectResponse
    {
        $this->discountSetupService->update(id: $id, data: $request);
        Toastr::success(DISCOUNT_UPDATE_200['message']);
        return redirect()->route('admin.ride-share.promotion.discount-setup.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->discountSetupService->delete(id: $id);
        Toastr::success(DISCOUNT_DESTROY_200['message']);
        return back();
    }

    public function status(Request $request): RedirectResponse
    {
        $request->validate([
            'status' => 'boolean'
        ]);
        $model = $this->discountSetupService->statusChange(id: $request->id, data: $request->all());
        Toastr::success(DISCOUNT_UPDATE_200['message']);
        return redirect()->route('admin.ride-share.promotion.discount-setup.index');
        // return response()->json($model);
    }

    public function export(Request $request): View|Factory|Response|StreamedResponse|string|Application
    {
        $discount = $this->discountSetupService->index(criteria: $request->all(), orderBy: ['created_at' => 'desc']);
        $date = Carbon::now()->startOfDay();


        $data = $discount->map(function ($item) use ($date) {

            if ($date->gt($item['end_date'])) {
                $discountStatus = ucwords(EXPIRED);
            } elseif (!$item['is_active']) {
                $discountStatus = ucwords(CURRENTLY_OFF);
            } elseif ($date->lt($item['start_date'])) {
                $discountStatus = ucwords(UPCOMING);
            } elseif ($date->lte($item['end_date'])) {
                $discountStatus = ucwords(RUNNING);
            } else {
                $discountStatus = ucwords(UPCOMING);
            }

            $startDate = Carbon::parse($item['start_date']);
            $endDate = Carbon::parse($item['end_date']);
            $duration = $startDate->diffInDays($endDate) + 1;

            return [
                'Discount Title' => $item['title'],
                'Zone' => $item['zone_discount_type'] ?? '-',
                'Customer Level' => $item['customer_level_discount_type'] ?? '-',
                'Customer' => $item['customer_discount_type'] ?? '-',
                'Category' => implode(',', $item['module_discount_type']) ?? '-',
                "Discount Amount" => $item['discount_amount_type'] == 'percentage' ? ($item['discount_amount'] ?? 0) . '%' : getCurrencyFormat($item['discount_amount'] ?? 0),
                'Duration' =>
                    'Start: ' . $startDate->format('Y-m-d') .
                    ', End: ' . $endDate->format('Y-m-d') .
                    ', Duration: ' . $duration . ' Days',
                'Total Time Used' => $item['total_used'] ?? 0,
                'Total Discount Amount' => getCurrencyFormat($item['total_amount'] ?? 0),
                "Discount Status" => $discountStatus,
                "Active Status" => $item['is_active'] == 1 ? "Active" : "Inactive",
            ];
        });
        return exportData($data, $request['file'], '');
    }

    public function trashed(Request $request): View
    {
        $discounts = $this->discountSetupService->trashedData(criteria: $request->all(), limit: paginationLimit(), offset: $request['page'] ?? 1);
        return view('ride-share::admin.promotion-management.discount-setup.trashed', compact('discounts'));
    }

    public function restore($id): RedirectResponse
    {
        $this->discountSetupService->restoreData($id);
        Toastr::success(DEFAULT_RESTORE_200['message']);
        return redirect()->route('admin.promotion.discount-setup.index');
    }

    public function permanentDelete($id)
    {
        $this->discountSetupService->permanentDelete(id: $id);
        Toastr::success(DISCOUNT_DESTROY_200['message']);
        return back();
    }

    // public function test()
    // {
    //     $user = $this->customerService->findOne(id: '1a9df870-f209-4d7f-aee9-71e7393f58ee');
    //     $trip = TripRequest::find(id: 'd471e033-12a9-479c-b14e-c1850ab74dac');
    //     return $this->getDiscount($user, $trip);
    // }
}
