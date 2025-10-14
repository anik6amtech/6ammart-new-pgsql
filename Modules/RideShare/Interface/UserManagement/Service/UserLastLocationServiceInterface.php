<?php

namespace Modules\RideShare\Interface\UserManagement\Service;

use Modules\RideShare\Interface\BaseServiceInterface;

interface UserLastLocationServiceInterface extends BaseServiceInterface
{
    public function getNearestDrivers($attributes): mixed;
}
