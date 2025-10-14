<?php

namespace Modules\RideShare\Repository\VehicleManagement;

use App\Models\RiderVehicle;
use Modules\RideShare\Interface\VehicleManagement\Repository\VehicleRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class VehicleRepository extends BaseRepository implements VehicleRepositoryInterface
{
    public function __construct(RiderVehicle $model)
    {
        parent::__construct($model);
    }
}
