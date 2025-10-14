<?php

namespace Modules\RideShare\Repository\VehicleManagement;

use App\Models\RiderVehicleModel;
use Modules\RideShare\Interface\VehicleManagement\Repository\VehicleModelRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class VehicleModelRepository extends BaseRepository implements VehicleModelRepositoryInterface
{
    public function __construct(RiderVehicleModel $model)
    {
        parent::__construct($model);
    }
}
