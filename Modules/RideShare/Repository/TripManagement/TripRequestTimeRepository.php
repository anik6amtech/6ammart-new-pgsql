<?php

namespace Modules\RideShare\Repository\TripManagement;

use Modules\RideShare\Entities\TripManagement\RideRequestTime;
use Modules\RideShare\Interface\TripManagement\Repository\TripRequestTimeRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class TripRequestTimeRepository extends BaseRepository implements TripRequestTimeRepositoryInterface
{
    public function __construct(RideRequestTime $model)
    {
        parent::__construct($model);
    }
}
