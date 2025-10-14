<?php

namespace Modules\RideShare\Interface\PromotionManagement\Service;

use Modules\RideShare\Interface\BaseServiceInterface;

interface DiscountSetupServiceInterface extends BaseServiceInterface
{
    public function getUserDiscountList(array $data, $limit = null, $offset = null);
    public function getUserTripApplicableDiscountList($tripType, $vehicleCategoryId, array $data, $limit = null, $offset = null);

}
