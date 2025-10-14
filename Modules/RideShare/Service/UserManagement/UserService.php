<?php

namespace Modules\RideShare\Service\UserManagement;

use Modules\RideShare\Interface\UserManagement\Repository\UserRepositoryInterface;
use Modules\RideShare\Interface\UserManagement\Service\UserServiceInterface;
use Modules\RideShare\Service\BaseService;

class UserService extends BaseService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        parent::__construct($userRepository);
        $this->userRepository = $userRepository;
    }

    // Add your specific methods related to UserService here
}
