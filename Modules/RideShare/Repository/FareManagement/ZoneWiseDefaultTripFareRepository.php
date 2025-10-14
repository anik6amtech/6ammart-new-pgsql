<?php

namespace Modules\RideShare\Repository\FareManagement;

use Modules\RideShare\Entities\FareManagement\ZoneWiseDefaultRideFare;
use Modules\RideShare\Interface\FareManagement\Repository\ZoneWiseDefaultTripFareRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class ZoneWiseDefaultTripFareRepository extends BaseRepository implements ZoneWiseDefaultTripFareRepositoryInterface
{
    public function __construct(ZoneWiseDefaultRideFare $model)
    {
        parent::__construct($model);
    }
}
