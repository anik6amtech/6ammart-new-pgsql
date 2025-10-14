<?php

namespace Modules\RideShare\Service\TripManagement;

use Modules\RideShare\Interface\TripManagement\Repository\TripRequestCoordinateRepositoryInterface;
use Modules\RideShare\Interface\TripManagement\Service\TripRequestCoordinateServiceInterface;
use Modules\RideShare\Service\BaseService;

class TripRequestCoordinateService extends BaseService implements TripRequestCoordinateServiceInterface
{
    protected $tripRequestCoordinateRepository;

    public function __construct(TripRequestCoordinateRepositoryInterface $tripRequestCoordinateRepository)
    {
        parent::__construct($tripRequestCoordinateRepository);
        $this->tripRequestCoordinateRepository = $tripRequestCoordinateRepository;
    }

    // Add your specific methods related to TripRequestCoordinateService here
}
