<?php

namespace Modules\RideShare\Service\TripManagement;

use Modules\RideShare\Interface\TripManagement\Repository\RecentAddressRepositoryInterface;
use Modules\RideShare\Interface\TripManagement\Service\RecentAddressServiceInterface;
use Modules\RideShare\Service\BaseService;

class RecentAddressService extends BaseService implements RecentAddressServiceInterface
{
    protected $recentAddressRepository;

    public function __construct(RecentAddressRepositoryInterface $recentAddressRepository)
    {
        parent::__construct($recentAddressRepository);
        $this->recentAddressRepository = $recentAddressRepository;
    }

    // Add your specific methods related to RecentAddressService here
}
