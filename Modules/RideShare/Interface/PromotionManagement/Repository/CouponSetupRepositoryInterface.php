<?php

namespace Modules\RideShare\Interface\PromotionManagement\Repository;

use Modules\RideShare\Interface\BaseRepositoryInterface;

interface CouponSetupRepositoryInterface extends BaseRepositoryInterface
{
    public function fetchCouponDataCount($dateRange, string $status = null): int;

    public function getUserCouponList(array $data, $limit= null, $offset = null);

    public function getAppliedCoupon($tripType, $vehicleCategoryId, array $data);
}
