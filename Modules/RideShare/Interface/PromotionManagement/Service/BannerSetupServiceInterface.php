<?php

namespace Modules\RideShare\Interface\PromotionManagement\Service;

use Modules\RideShare\Interface\BaseServiceInterface;

interface BannerSetupServiceInterface extends BaseServiceInterface
{
    public function list($data,$limit,$offset, $withoutGlobalScope = []);
}
