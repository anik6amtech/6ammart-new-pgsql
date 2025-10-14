<?php

namespace Modules\RideShare\Interface\PromotionManagement\Repository;

use Modules\RideShare\Interface\BaseRepositoryInterface;

interface DiscountSetupRepositoryInterface extends BaseRepositoryInterface
{
    public function getUserDiscountList(array $data, $limit = null, $offset = null);
    public function getUserTripApplicableDiscountList($tripType, $vehicleCategoryId, array $data, $limit = null, $offset = null);

}
