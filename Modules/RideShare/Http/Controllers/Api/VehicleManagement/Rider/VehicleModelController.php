<?php

namespace Modules\RideShare\Http\Controllers\Api\VehicleManagement\Rider;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\RideShare\Http\Resources\VehicleManagement\VehicleModelResource;
use Modules\RideShare\Interface\VehicleManagement\Service\VehicleModelServiceInterface;

class VehicleModelController extends Controller
{

    protected $vehicleModelService;

    public function __construct(VehicleModelServiceInterface $vehicleModelService)
    {
        $this->vehicleModelService = $vehicleModelService;
    }

    public function modelList(Request $request): JsonResponse
    {
        if (empty($request->header('zoneId'))) {
            return response()->json(responseFormatter(ZONE_404), 200);
        }
        $relations = ['vehicles'];
        $criteria['is_active'] =  1;
        $models = $this->vehicleModelService->index(criteria: $criteria, relations: $relations, limit: $request['limit'], offset: $request['offset'], allModule: true);
        $modelList = VehicleModelResource::collection($models);
        return response()->json(responseFormatter(constant: DEFAULT_200, content: $modelList, limit: $request['limit'], offset: $request['offset']), 200);
    }
}
