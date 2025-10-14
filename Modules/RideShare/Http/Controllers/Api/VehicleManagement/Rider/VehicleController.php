<?php

namespace Modules\RideShare\Http\Controllers\Api\VehicleManagement\Rider;

use Illuminate\Routing\Controller;
use Modules\RideShare\Http\Requests\VehicleManagement\VehicleApiStoreUpdateRequest;
use Modules\RideShare\Interface\VehicleManagement\Service\VehicleServiceInterface;

class VehicleController extends Controller
{
    protected $vehicleService;


    public function __construct(VehicleServiceInterface $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function store(VehicleApiStoreUpdateRequest $request)
    {
        if ($this->vehicleService->findOneBy(['rider_id' => $request->rider_id])) {
            return response()->json(responseFormatter(constant: VEHICLE_DRIVER_EXISTS_403), 403);
        }
        $data = array_merge($request->all(), ['vehicle_request_status' => PENDING]);
        $this->vehicleService->create(data: $data);
        return response()->json(responseFormatter(VEHICLE_CREATE_200), 200);
    }

    public function update(int|string $id, VehicleApiStoreUpdateRequest $request)
    {
        $vehicle = $this->vehicleService->updatedByDriver(id:$id, data: $request);
        if (!$vehicle) {
            return response()->json(responseFormatter(constant: VEHICLE_404, content:404), 404);
        }
        if ($vehicle?->vehicle_request_status == APPROVED && $vehicle?->draft) {
            return response()->json(responseFormatter(VEHICLE_REQUEST_200), 200);
        }
        return response()->json(responseFormatter(VEHICLE_UPDATE_200), 200);
    }
}
