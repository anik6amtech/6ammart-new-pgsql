<?php

namespace Modules\RideShare\Interface\UserManagement\Repository;

use Modules\RideShare\Interface\BaseRepositoryInterface;

interface UserLastLocationRepositoryInterface extends BaseRepositoryInterface
{
    public function getNearestDrivers($attributes): mixed;
}
