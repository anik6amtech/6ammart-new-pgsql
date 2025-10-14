<?php

namespace Modules\RideShare\Http\Controllers\Api\PromotionManagement\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\RideShare\Http\Resources\PromotionManagement\DiscountResource;
use Modules\RideShare\Interface\PromotionManagement\Service\DiscountSetupServiceInterface;

class DiscountSetupController extends Controller
{
    protected $discountSetupService;
    public function __construct(DiscountSetupServiceInterface $discountSetupService)
    {
        $this->discountSetupService = $discountSetupService;
    }
    public function list(Request $request): JsonResponse
    {
        $user = auth('api')->user();
        $criteria = [
            'user_id' => $user->id,
            // 'level_id' => $user->level->id,
            'is_active' => 1,
            'date' => date('Y-m-d')
        ];
        $discounts = $this->discountSetupService->getUserDiscountList(data: $criteria, limit: $request->limit, offset: $request->offset);

        $data = DiscountResource::collection($discounts);

        return response()->json(responseFormatter(constant: DEFAULT_200, content: $data, limit: $request->limit, offset: $request->offset));
    }

}
