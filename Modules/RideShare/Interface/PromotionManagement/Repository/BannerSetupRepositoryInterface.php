<?php

namespace Modules\RideShare\Interface\PromotionManagement\Repository;

use Modules\RideShare\Interface\BaseRepositoryInterface;

interface BannerSetupRepositoryInterface extends BaseRepositoryInterface
{
    public function list($data,$limit,$offset,$withoutGlobalScope = []);
}
