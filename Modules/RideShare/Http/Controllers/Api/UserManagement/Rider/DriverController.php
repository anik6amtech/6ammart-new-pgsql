<?php

namespace Modules\RideShare\Http\Controllers\Api\UserManagement\Rider;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\RideShare\Http\Resources\TripManagement\TripRequestResource;
use Modules\RideShare\Http\Resources\UserManagement\DriverTimeLogResource;
use Modules\RideShare\Interface\TripManagement\Service\TripRequestServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\DriverTimeLogServiceInterface;

class DriverController extends Controller
{
    // protected $driverService;
    // protected $driverDetailService;
    protected $driverTimeLogService;
    protected $tripRequestService;

    public function __construct(
        // DriverServiceInterface          $driverService, 
        // DriverDetailServiceInterface    $driverDetailService,
        DriverTimeLogServiceInterface   $driverTimeLogService,
        TripRequestServiceInterface     $tripRequestService
    )
    {
        // $this->driverService = $driverService;
        // $this->driverDetailService = $driverDetailService;
        $this->driverTimeLogService = $driverTimeLogService;
        $this->tripRequestService = $tripRequestService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function myActivity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to' => 'required_with:from|date',
            'from' => 'required_with:to|date',
            'limit' => 'required|numeric',
            'offset' => 'required|numeric'
        ]);

        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 400);
        }

        $user = auth('delivery_men')->user();
        $attributes = [
            'rider_id' => $user->id,
        ];

        $whereBetweenCriteria = [];
        if ($request['to']) {
            $from = Carbon::parse($request['from'])->startOfDay();
            $to = Carbon::parse($request['to'])->endOfDay();
            $whereBetweenCriteria = [
                'created_at' => [$from, $to],
            ];
        }

        $data = $this->driverTimeLogService->getBy(criteria: $attributes, whereBetweenCriteria: $whereBetweenCriteria, limit: $request['limit'], offset: $request['offset']);
        $activity = DriverTimeLogResource::collection($data);
        return response()->json(responseFormatter(DEFAULT_200, $activity, $request['limit'], $request['offset']), 200);

    }

    public function incomeStatement(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
        ]);
        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }

        $criteria = [
            ['driver_id', '!=', null],
            'driver_id' => auth('delivery_men')->user()->id,
            'payment_status' => PAID,
        ];
        $incomeStatements = $this->tripRequestService->getBy(criteria: $criteria, limit: $request->limit, offset: $request->offset, orderBy: ['updated_at' => 'desc']);
        $incomeStatements = TripRequestResource::collection($incomeStatements);

        return response()->json(responseFormatter(constant: DEFAULT_200, content: $incomeStatements, limit: $request->limit, offset: $request->offset));
    }

    public function referralDetails(Request $request): JsonResponse
    {
        
        $useCodeEarning = get_cache('driver_use_code_earning');
        $data = [
            'referral_code' => auth('delivery_men')->user()->ref_code,
            'share_code_earning' => (double)get_cache('driver_share_code_earning'),
            'use_code_earning' => (double)get_cache('driver_use_code_earning'),
        ];
        return response()->json(responseFormatter(DEFAULT_200, $data), 200);
    }
}
