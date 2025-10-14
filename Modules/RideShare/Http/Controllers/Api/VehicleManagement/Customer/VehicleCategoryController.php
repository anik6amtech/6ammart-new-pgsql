<?php

namespace Modules\RideShare\Http\Controllers\Api\VehicleManagement\Customer;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\RideShare\Http\Resources\VehicleManagement\VehicleCategoryResource;
use Modules\RideShare\Interface\VehicleManagement\Service\VehicleCategoryServiceInterface;

class VehicleCategoryController extends Controller
{
    protected $vehicleCategoryService;
    public function __construct(VehicleCategoryServiceInterface $category)
    {
        $this->vehicleCategoryService = $category;
    }


    public function categoryFareList(Request $request): JsonResponse
    {
        if (empty($request->header('zoneId'))) {
            return response()->json(responseFormatter(ZONE_404), 200);
        }

        $relations = [
            'tripFares' => [
                ['zone_id', '=', $request->header('zoneId')]
            ]
        ];
        $whereHasRelations = [
            'tripFares' => ['zone_id' => $request->header('zoneId')]
        ];
        $categories = $this->vehicleCategoryService->getBy(criteria: ['is_active'=>1], whereHasRelations: $whereHasRelations, relations: $relations, limit: $request['limit'], offset: $request['offset']);

        $data = VehicleCategoryResource::collection($categories);


        return response()->json(responseFormatter(constant: DEFAULT_200, content: $data, limit: $request['limit'], offset: $request['offset']), 200);
    }
}
