<?php

namespace Modules\RideShare\Repository\TripManagement;

use Modules\RideShare\Entities\TripManagement\RideRequestFee;
use Modules\RideShare\Interface\TripManagement\Repository\TripRequestFeeRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class TripRequestFeeRepository extends BaseRepository implements TripRequestFeeRepositoryInterface
{
    public function __construct(RideRequestFee $model)
    {
        parent::__construct($model);
    }
}
