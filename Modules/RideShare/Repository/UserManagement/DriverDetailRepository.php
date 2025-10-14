<?php

namespace Modules\RideShare\Repository\UserManagement;

use Modules\RideShare\Entities\UserManagement\RiderDetail;
use Modules\RideShare\Interface\UserManagement\Repository\DriverDetailRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class DriverDetailRepository extends BaseRepository implements DriverDetailRepositoryInterface
{
    public function __construct(RiderDetail $model)
    {
        parent::__construct($model);
    }
}
