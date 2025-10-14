<?php

namespace Modules\RideShare\Repository\VehicleManagement;

use App\Models\RiderVehicleCategory;
use Modules\RideShare\Interface\VehicleManagement\Repository\VehicleCategoryRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class VehicleCategoryRepository extends BaseRepository implements VehicleCategoryRepositoryInterface
{
    public function __construct(RiderVehicleCategory $model)
    {
        parent::__construct($model);
    }
}
