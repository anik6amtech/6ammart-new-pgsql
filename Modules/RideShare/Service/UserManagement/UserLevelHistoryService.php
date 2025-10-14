<?php

namespace Modules\RideShare\Service\UserManagement;

use Modules\RideShare\Interface\UserManagement\Repository\UserLevelHistoryRepositoryInterface;
use Modules\RideShare\Interface\UserManagement\Service\UserLevelHistoryServiceInterface;
use Modules\RideShare\Service\BaseService;

class UserLevelHistoryService extends BaseService implements UserLevelHistoryServiceInterface
{
    protected $userLevelHistoryRepository;

    public function __construct(UserLevelHistoryRepositoryInterface $userLevelHistoryRepository)
    {
        parent::__construct($userLevelHistoryRepository);
        $this->userLevelHistoryRepository = $userLevelHistoryRepository;
    }

    // Add your specific methods related to UserLevelHistoryService here
}
