<?php

namespace Modules\RideShare\Service\TripManagement;

use Modules\RideShare\Interface\TripManagement\Repository\TripRequestTimeRepositoryInterface;
use Modules\RideShare\Interface\TripManagement\Service\TripRequestTimeServiceInterface;
use Modules\RideShare\Service\BaseService;

class TripRequestTimeService extends BaseService implements TripRequestTimeServiceInterface

{
    protected $tripRequestTimeRepository;

    public function __construct(TripRequestTimeRepositoryInterface $tripRequestTimeRepository)
    {
        parent::__construct($tripRequestTimeRepository);
        $this->tripRequestTimeRepository = $tripRequestTimeRepository;
    }
}
