<?php

namespace Modules\RideShare\Interface\PromotionManagement\Service;

use Modules\RideShare\Interface\BaseServiceInterface;

interface CouponSetupServiceInterface extends BaseServiceInterface
{
    public function getUserCouponList(array $data, $limit = null, $offset = null);

    public function getAppliedCoupon($tripType, $vehicleCategoryId, array $data);

}
