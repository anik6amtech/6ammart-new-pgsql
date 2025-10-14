<?php

namespace Modules\RideShare\Service\UserManagement;

use Modules\RideShare\Interface\UserManagement\Repository\UserLastLocationRepositoryInterface;
use Modules\RideShare\Interface\UserManagement\Service\UserLastLocationServiceInterface;
use Modules\RideShare\Service\BaseService;

class UserLastLocationService extends BaseService implements UserLastLocationServiceInterface
{
    protected $userLastLocationRepository;

    public function __construct(UserLastLocationRepositoryInterface $userLastLocationRepository)
    {
        parent::__construct($userLastLocationRepository);
        $this->userLastLocationRepository = $userLastLocationRepository;
    }

    // Add your specific methods related to UserLastLocationService here

    public function getNearestDrivers($attributes): mixed
    {
        return $this->userLastLocationRepository->getNearestDrivers($attributes);
    }
}
