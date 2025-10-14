<?php

namespace Modules\RideShare\Repository\FareManagement;

use Modules\RideShare\Entities\FareManagement\RideFare;
use Modules\RideShare\Interface\FareManagement\Repository\TripFareRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class TripFareRepository extends BaseRepository implements TripFareRepositoryInterface
{

    public function __construct(RideFare $model)
    {
        parent::__construct($model);
    }
}
