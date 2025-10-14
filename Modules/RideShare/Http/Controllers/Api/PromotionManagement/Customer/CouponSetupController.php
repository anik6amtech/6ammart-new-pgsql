<?php

namespace Modules\RideShare\Http\Controllers\Api\PromotionManagement\Customer;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\RideShare\Http\Resources\PromotionManagement\CouponResource;
use Modules\RideShare\Interface\PromotionManagement\Service\CouponSetupServiceInterface;

class CouponSetupController extends Controller
{
    protected $tripRequestService;
    protected $couponService;
    // public function __construct(CouponSetupServiceInterface $couponService, UserLevelServiceInterface $userLevelService,
    //                             TripRequestServiceInterface $tripRequestService)
    public function __construct(CouponSetupServiceInterface $couponService)
    {
        $this->couponService = $couponService;
        // $this->tripRequestService = $tripRequestService;
    }
    public function list(Request $request): JsonResponse
    {
        $user = auth('api')->user();
        $criteria = [
            'user_id' => $user->id,
            'is_active' => 1,
            'date' => date('Y-m-d')
        ];
        $coupons = $this->couponService->getUserCouponList(data: $criteria, limit: $request->limit, offset: $request->offset);

        $data = CouponResource::collection($coupons);

        return response()->json(responseFormatter(constant: DEFAULT_200, content: $data, limit: $request->limit, offset: $request->offset));
    }


    public function apply(Request $request): JsonResponse
    {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'coupon_id' => 'required|exists:ride_coupon_setups,id'
        ]);

        if ($validator->fails()) {
            return response()->json(responseFormatter(constant: DEFAULT_400, errors: errorProcessor($validator)), 403);
        }
        $coupon = $this->couponService->findOne($request->coupon_id);
        if (!$coupon) {
            return response()->json(responseFormatter(constant: COUPON_404), 403);
        }
        $user = auth('api')->user();

        // Check if the user already has an applied coupon
        if ($user->appliedCoupon && $user->appliedCoupon->coupon_setup_id == $coupon?->id) {
            // Remove the previously applied coupon
            $user->appliedCoupon->delete();
            return response()->json(responseFormatter(COUPON_REMOVED_200), 200);
        } else {
            if ($user->appliedCoupon) {
                $user->appliedCoupon->delete();
            }
            $appliedCoupon = $user->appliedCoupon()->create([
                'coupon_setup_id' => $coupon->id
            ]);
            return response()->json(responseFormatter(COUPON_APPLIED_200), 200);
        }


    }

}
