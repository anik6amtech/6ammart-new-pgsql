<?php

namespace Modules\RideShare\Repository\UserManagement;

use Modules\RideShare\Entities\UserManagement\RiderTimeLog;
use Modules\RideShare\Interface\UserManagement\Repository\DriverTimeLogRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class DriverTimeLogRepository extends BaseRepository implements DriverTimeLogRepositoryInterface
{
    public function __construct(RiderTimeLog $model)
    {
        parent::__construct($model);
    }
}
