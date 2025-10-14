<?php

namespace Modules\RideShare\Repository\TripManagement;

use Modules\RideShare\Entities\TripManagement\RecentAddress;
use Modules\RideShare\Interface\TripManagement\Repository\RecentAddressRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class RecentAddressRepository extends BaseRepository implements RecentAddressRepositoryInterface
{
    public function __construct(RecentAddress $model)
    {
        parent::__construct($model);
    }
}
