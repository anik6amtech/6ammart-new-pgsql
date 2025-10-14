<?php

namespace Modules\RideShare\Interface\UserManagement\Service;

use Modules\RideShare\Interface\BaseServiceInterface;

interface DriverDetailServiceInterface extends BaseServiceInterface
{
    public function updateAvailability(array $data = []);
}
