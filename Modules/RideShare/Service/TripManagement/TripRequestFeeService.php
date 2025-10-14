<?php

namespace Modules\RideShare\Service\TripManagement;

use Modules\RideShare\Interface\TripManagement\Repository\TripRequestFeeRepositoryInterface;
use Modules\RideShare\Interface\TripManagement\Service\TripRequestFeeServiceInterface;
use Modules\RideShare\Service\BaseService;

class TripRequestFeeService extends BaseService implements TripRequestFeeServiceInterface
{
    protected $tripRequestFeeRepository;

    public function __construct(TripRequestFeeRepositoryInterface $tripRequestFeeRepository)
    {
        parent::__construct($tripRequestFeeRepository);
        $this->tripRequestFeeRepository = $tripRequestFeeRepository;
    }

    // Add your specific methods related to TripRequestFeeService here
}
