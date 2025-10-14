<?php

namespace Modules\RideShare\Service\FareManagement;

use Modules\RideShare\Interface\FareManagement\Service\ZoneWiseDefaultTripFareServiceInterface;
use Modules\RideShare\Repository\FareManagement\ZoneWiseDefaultTripFareRepository;
use Modules\RideShare\Service\BaseService;

class ZoneWiseDefaultTripFareService extends BaseService implements ZoneWiseDefaultTripFareServiceInterface
{
    protected $zoneWiseDefaultTripFareRepository;
    public function __construct(ZoneWiseDefaultTripFareRepository $zoneWiseDefaultTripFareRepository){
        parent::__construct($zoneWiseDefaultTripFareRepository);
        $this->zoneWiseDefaultTripFareRepository = $zoneWiseDefaultTripFareRepository;
    }
}
