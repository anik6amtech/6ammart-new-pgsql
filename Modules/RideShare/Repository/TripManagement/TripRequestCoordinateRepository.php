<?php

namespace Modules\RideShare\Repository\TripManagement;

use Modules\RideShare\Entities\TripManagement\RideRequestCoordinate;
use Modules\RideShare\Interface\TripManagement\Repository\TripRequestCoordinateRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class TripRequestCoordinateRepository extends BaseRepository implements TripRequestCoordinateRepositoryInterface
{
    public function __construct(RideRequestCoordinate $model)
    {
        parent::__construct($model);
    }
}
