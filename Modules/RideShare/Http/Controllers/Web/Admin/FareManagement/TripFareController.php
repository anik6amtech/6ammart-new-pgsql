<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\FareManagement;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Http\Requests\FareManagement\TripFareStoreOrUpdateRequest;
use Modules\RideShare\Interface\FareManagement\Service\TripFareServiceInterface;
use Modules\RideShare\Interface\VehicleManagement\Service\VehicleCategoryServiceInterface;
use Modules\RideShare\Interface\ZoneManagement\Service\ZoneServiceInterface;

class TripFareController extends BaseController
{
    protected $vehicleCategoryService;
    protected $tripFareService;
    protected $zoneService;

    public function __construct(VehicleCategoryServiceInterface     $vehicleCategoryService, TripFareServiceInterface $tripFareService,
                                 ZoneServiceInterface $zoneService)
    {
        parent::__construct($vehicleCategoryService);
        $this->vehicleCategoryService = $vehicleCategoryService;
        $this->tripFareService = $tripFareService;
        $this->zoneService = $zoneService;
    }

    public function index(?Request $request, string $type = null): View|Collection|LengthAwarePaginator|null|callable|RedirectResponse
    {
        $vehicleCategoryCriteria = [
            'is_active' => 1,
        ];
        $vehicleCategories = $this->vehicleCategoryService->getBy(criteria: $vehicleCategoryCriteria);
        $zoneCriteria = array_merge($request?->all(),[
            'is_active' => 1
        ]);
        $withCountCriteria = [
            'drivers'=>[]
        ];
        $zones = $this->zoneService->index(criteria: $zoneCriteria, withCountQuery: $withCountCriteria);
        $fares = $this->tripFareService->getAll();

        return view('ride-share::admin.fare-management.trip.index', compact('vehicleCategories', 'zones', 'fares'));
    }

    public function create($zone_id): Renderable|RedirectResponse
    {
        $zone = $this->zoneService->findOne(id: $zone_id, relations: ['defaultFare','defaultFare.tripFares']);
        if ( is_null($zone) ) {
            Toastr::error(ZONE_404['message']);
            return redirect()->back();
        }
        $vehicleCategoryCriteria = [
            'is_active' => 1,
        ];
        $vehicleCategories = $this->vehicleCategoryService->getBy(criteria: $vehicleCategoryCriteria);
        if ( $vehicleCategories->count() < 1) {

            Toastr::warning(VEHICLE_CATEGORY_404['message']);
            return back();
        }
        $defaultTripFare = $zone?->defaultFare;
        $tripFares = $zone?->defaultFare?->tripFares;
        return view('ride-share::admin.fare-management.trip.create', compact('vehicleCategories', 'zone', 'tripFares','defaultTripFare'));
    }

    public function store(TripFareStoreOrUpdateRequest $request): Renderable|RedirectResponse
    {
        $hasDynamicField = collect($request->all())->keys()->contains(fn($fieldName) => Str::startsWith($fieldName, 'vehicle_category_'));
        if (!$hasDynamicField) {

            Toastr::error('Please select vehicle category');
            return back();
        }
        $vehicleCategories = $this->vehicleCategoryService->getAll();
        $request->merge(['vehicleCategories' => $vehicleCategories]);

        $this->tripFareService->create($request->all());

        Toastr::success(TRIP_FARE_STORE_200['message']);
        return back();
    }
}
