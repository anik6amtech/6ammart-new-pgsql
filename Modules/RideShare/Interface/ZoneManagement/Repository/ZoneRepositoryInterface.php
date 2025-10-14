<?php

namespace Modules\RideShare\Interface\ZoneManagement\Repository;

use Modules\RideShare\Interface\BaseRepositoryInterface;

interface ZoneRepositoryInterface extends BaseRepositoryInterface
{
    public function getByPoints($point);
}
