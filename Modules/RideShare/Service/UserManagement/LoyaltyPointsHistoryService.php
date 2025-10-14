<?php

namespace Modules\RideShare\Service\UserManagement;

use Modules\RideShare\Interface\UserManagement\Repository\LoyaltyPointsHistoryRepositoryInterface;
use Modules\RideShare\Interface\UserManagement\Service\LoyaltyPointsHistoryServiceInterface;
use Modules\RideShare\Service\BaseService;

class LoyaltyPointsHistoryService extends BaseService implements LoyaltyPointsHistoryServiceInterface
{
    protected $loyaltyPointsHistoryRepository;

    public function __construct(LoyaltyPointsHistoryRepositoryInterface $loyaltyPointsHistoryRepository)
    {
        parent::__construct($loyaltyPointsHistoryRepository);
        $this->loyaltyPointsHistoryRepository = $loyaltyPointsHistoryRepository;
    }

    // Add your specific methods related to LoyaltyPointsHistoryService here
}
