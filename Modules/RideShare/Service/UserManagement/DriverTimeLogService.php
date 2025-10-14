<?php

namespace Modules\RideShare\Service\UserManagement;

use Modules\RideShare\Interface\UserManagement\Repository\DriverTimeLogRepositoryInterface;
use Modules\RideShare\Interface\UserManagement\Service\DriverTimeLogServiceInterface;
use Modules\RideShare\Service\BaseService;

class DriverTimeLogService extends BaseService implements DriverTimeLogServiceInterface
{
    protected $driverTimeLogRepository;

    public function __construct(DriverTimeLogRepositoryInterface $driverTimeLogRepository)
    {
        parent::__construct($driverTimeLogRepository);
        $this->driverTimeLogRepository = $driverTimeLogRepository;
    }

    // Add your specific methods related to DriverTimeLogService here
}
