<?php

namespace Modules\RideShare\Http\Controllers\Api\UserManagement\Rider;

use App\CentralLogics\Helpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\RideShare\Http\Resources\UserManagement\LoyaltyPointsHistoryResource;
use Modules\RideShare\Interface\UserManagement\Service\DriverServiceInterface;
use Modules\RideShare\Interface\UserManagement\Service\LoyaltyPointsHistoryServiceInterface;
use Modules\RideShare\Traits\TransactionManagement\TransactionTrait;

class LoyaltyPointController extends Controller
{
    use TransactionTrait;
    protected $driverService;
    protected $loyaltyPointsHistoryService;

    public function __construct(DriverServiceInterface $driverService, LoyaltyPointsHistoryServiceInterface $loyaltyPointsHistoryService)
    {
        $this->driverService = $driverService;
        $this->loyaltyPointsHistoryService = $loyaltyPointsHistoryService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
        ]);
        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }
        $attributes = [
            'user_id' => auth('delivery_men')->id()
        ];
        $history = $this->loyaltyPointsHistoryService->getBy(criteria: $attributes, orderBy: ['created_at'=>'desc'], limit: $request->limit,
            offset: $request->offset);
        $history = LoyaltyPointsHistoryResource::collection($history);

        return response()->json(responseFormatter(constant: DEFAULT_200, content: $history, limit: $request->limit, offset: $request->offset));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function convert(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'points' => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }
        $conversion_rate_points = Helpers::get_business_data('dm_loyalty_point_exchange_rate');
        $conversion_rate_status = Helpers::get_business_data('dm_loyalty_point_status');
        $user = auth('delivery_men')->user();
        if (($conversion_rate_status ?? false) && $user->loyalty_points >= $request->points && $request->points >= ($conversion_rate_points ?? 1)) {

            DB::beginTransaction();
            $driver = auth('delivery_men')->user();
            $driver->loyalty_points -= $request->points;
            $driver->save();

            $balance = $request->points / ($conversion_rate_points ?? 1);
            $account = $this->driverLoyaltyPointsTransaction($driver, $balance);
            $attributes = [
                'user_id' => $user->id,
                'model_id' => $account->id,
                'model' => 'user_account',
                'points' => $request->points,
                'type' => 'debit'
            ];
            $this->loyaltyPointsHistoryService->create(data: $attributes);

            DB::commit();

            return response()->json(responseFormatter(constant: DEFAULT_UPDATE_200));
        }

        return response()->json(responseFormatter(constant: INSUFFICIENT_POINTS_403), 403);
    }
}
