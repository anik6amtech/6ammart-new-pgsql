<?php

namespace Modules\RideShare\Repository\VehicleManagement;

use App\Models\RiderVehicleBrand;
use Modules\RideShare\Interface\VehicleManagement\Repository\VehicleBrandRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class VehicleBrandRepository extends BaseRepository implements VehicleBrandRepositoryInterface
{
    public function __construct(RiderVehicleBrand $model)
    {
        parent::__construct($model);
    }
}
