<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\PromotionManagement;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Http\Requests\PromotionManagement\CouponSetupStoreUpdateRequest;
use Modules\RideShare\Interface\PromotionManagement\Service\CouponSetupServiceInterface;
use Modules\RideShare\Interface\PromotionManagement\Service\CouponSetupVehicleCategoryServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\CustomerServiceInterface;
use Modules\RideShare\Interface\VehicleManagement\Service\VehicleCategoryServiceInterface;
use Modules\RideShare\Interface\ZoneManagement\Service\ZoneServiceInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CouponSetupController extends BaseController
{
    protected $couponSetupService;
    protected $tripRequestService;
    protected $zoneService;
    protected $customerService;
    protected $vehicleCategoryService;

    // public function __construct(CouponSetupServiceInterface $couponSetupService, TripRequestServiceInterface $tripRequestService,
    //                             ZoneServiceInterface        $zoneService, CustomerLevelServiceInterface $customerLevelService,
    //                             CustomerServiceInterface    $customerService, VehicleCategoryServiceInterface $vehicleCategoryService,
    //                             ActivityLogServiceInterface $activityLogService)
    public function __construct(CouponSetupServiceInterface $couponSetupService,
                                ZoneServiceInterface        $zoneService,
                                CustomerServiceInterface    $customerService,
                                VehicleCategoryServiceInterface $vehicleCategoryService)
    {
        parent::__construct($couponSetupService);
        $this->couponSetupService = $couponSetupService;
        // $this->tripRequestService = $tripRequestService;
        $this->zoneService = $zoneService;
        $this->customerService = $customerService;
        $this->vehicleCategoryService = $vehicleCategoryService;
    }

    public function index(?Request $request, string $type = null): View|Collection|LengthAwarePaginator|null|callable|RedirectResponse
    {
        if (Schema::hasColumns('coupon_setups', ['user_id', 'user_level_id', 'rules'])) {
            $couponSetups = $this->couponSetupService->getBy(withTrashed: true,);
            DB::beginTransaction();
            if (count((array)$couponSetups) > 0) {
                foreach ($couponSetups as $couponSetup) {
                    $this->couponSetupService->updatedBy(criteria: ['id' => $couponSetup->id], data: ['zone_coupon_type' => ALL]);
                    if ($couponSetup->user_id == ALL) {
                        $this->couponSetupService->updatedBy(criteria: ['id' => $couponSetup->id], data: ['customer_coupon_type' => ALL]);
                    } else {
                        $this->couponSetupService->updatedBy(criteria: ['id' => $couponSetup->id], data: ['customer_coupon_type' => CUSTOM]);
                        $couponSetup?->customers()->attach($couponSetup->user_id);
                    }
                    // if ($couponSetup->user_level_id == ALL || $couponSetup->user_level_id == null) {
                    //     $this->couponSetupService->updatedBy(criteria: ['id' => $couponSetup->id], data: ['customer_level_coupon_type' => ALL]);
                    // } else {
                    //     $this->couponSetupService->updatedBy(criteria: ['id' => $couponSetup->id], data: ['customer_level_coupon_type' => CUSTOM]);
                    //     $couponSetup?->customerLevels()->attach($couponSetup->user_level_id);
                    // }
                    if ($couponSetup->rules == "default") {
                        $this->couponSetupService->updatedBy(criteria: ['id' => $couponSetup->id], data: ['category_coupon_type' => [ALL]]);
                    } else {
                        $this->couponSetupService->updatedBy(criteria: ['id' => $couponSetup->id], data: ['category_coupon_type' => CUSTOM]);
                    }
                }

            }
            DB::commit();
            Schema::table('coupon_setups', function (Blueprint $table) {
                $table->dropColumn(['user_id', 'user_level_id', 'rules']); // Replace 'column_name' with the actual column name
            });
        }

        $dateRange = $request->query('date_range',ALL_TIME);
        $data = $request?->date_range;
        $this->couponSetupService->updatedBy(criteria: [['end_date', '<', Carbon::today()]], data: ['is_active' => false]);
        $cardValues = $this->couponSetupService->getCardValues($data);
        // $analytics = $this->tripRequestService->getAnalytics($data);
        $coupons = $this->couponSetupService->index(criteria: $request?->all(), orderBy: ['created_at' => 'desc'], limit: paginationLimit(), offset: $request['page'] ?? 1);

        $query = DB::table('ride_coupon_setups')->whereNull('deleted_at');

        if ($dateRange === TODAY) {
            $query->whereDate('created_at', Carbon::today());
        }
        elseif ($dateRange === THIS_WEEK) {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        }
        elseif ($dateRange === THIS_MONTH) {
            $query->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year);
        }
        elseif ($dateRange === THIS_YEAR) {
            $query->whereYear('created_at', Carbon::now()->year);
        }

        $couponAmount = (clone $query)
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%b') as month"),
                DB::raw("SUM(total_amount) as total_amount")
            )
            ->groupBy('month')
            ->orderByRaw("MIN(created_at)")
            ->pluck('total_amount', 'month')
            ->toArray();

        $noOfCouponUse = (clone $query)
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%b') as month"),
                DB::raw("SUM(total_used) as usage_count")
            )
            ->groupBy('month')
            ->orderByRaw("MIN(created_at)")
            ->pluck('usage_count', 'month')
            ->toArray();

        return view('ride-share::admin.promotion-management.coupon-setup.list', [
            'coupons' => $coupons,
            'cardValues' => $cardValues,
            'dateRangeValue' => $dateRange,
            'couponAmount' => $couponAmount,
            'noOfCouponUse' => $noOfCouponUse,
        ]);
    }

    public function create(): Renderable
    {
        $zones = $this->zoneService->getAll();
        $vehicleCategories = $this->vehicleCategoryService->getAll();
        $language = getWebConfig('language');
        $customer = request()->customer ?? null;
        return view('ride-share::admin.promotion-management.coupon-setup.create', compact('zones', 'language','vehicleCategories', 'customer'));
    }

    public function store(CouponSetupStoreUpdateRequest $request): RedirectResponse
    {
        $this->couponSetupService->create(data: $request);
        Toastr::success(COUPON_STORE_200['message']);
        return redirect()->route('admin.ride-share.promotion.coupon-setup.index');
    }

    public function edit(string $id): Renderable
    {
        $zones = $this->zoneService->getAll();
        $vehicleCategories = $this->vehicleCategoryService->getAll();
        // $relations = ['vehicleCategories', 'zones', 'customers', 'customerLevels'];
        $relations = ['vehicleCategories','zones', 'customers'];
        $coupon = $this->couponSetupService->findOne(id: $id, relations: $relations, withoutGlobalScope: ['translate']);
        $customers = $this->customerService->getBy(criteria: ['status' => 1]);
        $language = getWebConfig('language');
        return view('ride-share::admin.promotion-management.coupon-setup.edit', compact('coupon','zones', 'customers', 'language','vehicleCategories'));
    }

    public function update(CouponSetupStoreUpdateRequest $request, $id)
    {
        $this->couponSetupService->update(id: $id, data: $request);
        Toastr::success(COUPON_UPDATE_200['message']);
        return redirect()->route('admin.ride-share.promotion.coupon-setup.index');
    }

    public function destroy($id)
    {
        $this->couponSetupService->delete(id: $id);
        Toastr::success(COUPON_DESTROY_200['message']);
        return back();
    }

    public function status(Request $request): RedirectResponse
    {
        $request->validate([
            'status' => 'boolean'
        ]);
        $model = $this->couponSetupService->statusChange(id: $request->id, data: $request->all());
        Toastr::success(COUPON_UPDATE_200['message']);
        return back();
        // return response()->json($model);
    }

    public function export(Request $request): View|Factory|Response|StreamedResponse|string|Application
    {
        $coupon = $this->couponSetupService->index(criteria: $request->all(), orderBy: ['created_at' => 'desc']);

        $date = Carbon::now()->startOfDay();


        $data = $coupon->map(function ($item) use ($date) {

            if ($date->gt($item['end_date'])) {
                $couponStatus = ucwords(EXPIRED);
            } elseif (!$item['is_active']) {
                $couponStatus = ucwords(CURRENTLY_OFF);
            } elseif ($date->lt($item['start_date'])) {
                $couponStatus = ucwords(UPCOMING);
            } elseif ($date->lte($item['end_date'])) {
                $couponStatus = ucwords(RUNNING);
            } else {
                $couponStatus = ucwords(UPCOMING);
            }

            return [
                'id' => $item['id'],
                'Name' => $item['name'],
                'Description' => $item['description'],
                'Zone' => $item['zone_coupon_type'] ?? '-',
                'Level' => $item['customer_level_coupon_type'] ?? '-',
                'Customer' => $item['customer_coupon_type'] ?? '-',
                'Category' => implode(',',$item['category_coupon_type']) ?? '-',
                'Min Trip Amount' => getCurrencyFormat($item['min_trip_amount'] ?? 0),
                "Max Coupon Amount" => getCurrencyFormat($item['max_coupon_amount'] ?? 0),
                "Coupon" => getCurrencyFormat($item['coupon'] ?? 0),
                "Amount Type" => ucwords($item['amount_type']),
                "Coupon Type" => ucwords($item['coupon_type']),
                "Coupon Code" => $item['coupon_code'],
                "Limit" => $item['limit'],
                "Start Date" => $item['start_date'],
                "End Date" => $item['end_date'],
                "Total Used" => $item['total_used'],
                "Total Amount" => getCurrencyFormat($item['total_amount'] ?? 0),
                "Duration In Days" => $item['start_date'] && $item['end_date'] ? Carbon::parse($item['end_date'])->diffInDays($item['start_date'])+1 . ' days' : '-',
                "Avg Amount" => set_currency_symbol(round($item['total_used'] > 0 ? ($item['total_amount'] / $item['total_used']) : 0, 2)),
                "Coupon Status" => $couponStatus,
                "Active Status" => $item['is_active'] == 1 ? "Active" : "Inactive",
            ];
        });
        return exportData($data, $request['file'], 'ride-share::admin.promotion-management.coupon-setup.print');
    }

    public function trashed(Request $request): View
    {
        $coupons = $this->couponSetupService->trashedData(criteria: $request->all(), limit: paginationLimit(), offset: $request['page'] ?? 1);
        return view('ride-share::admin.promotion-management.coupon-setup.trashed', compact('coupons'));
    }

    public function restore($id): RedirectResponse
    {
        $this->couponSetupService->restoreData($id);
        Toastr::success(DEFAULT_RESTORE_200['message']);
        return redirect()->route('admin.promotion.coupon-setup.index');
    }

    public function permanentDelete($id)
    {
        $this->couponSetupService->permanentDelete(id: $id);
        Toastr::success(COUPON_DESTROY_200['message']);
        return back();
    }
}
