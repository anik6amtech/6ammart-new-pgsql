<?php

namespace Modules\RideShare\Repository\TripManagement;

use Modules\RideShare\Entities\TripManagement\RideSafetyAlert;
use Modules\RideShare\Interface\TripManagement\Repository\SafetyAlertRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class SafetyAlertRepository extends BaseRepository implements SafetyAlertRepositoryInterface
{
    public function __construct(RideSafetyAlert $model)
    {
        parent::__construct($model);
    }
}
