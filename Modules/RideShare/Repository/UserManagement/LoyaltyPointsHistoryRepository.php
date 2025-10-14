<?php

namespace Modules\RideShare\Repository\UserManagement;

use App\Models\LoyaltyPointsHistory;
use Modules\RideShare\Interface\UserManagement\Repository\LoyaltyPointsHistoryRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class LoyaltyPointsHistoryRepository extends BaseRepository implements LoyaltyPointsHistoryRepositoryInterface
{
    public function __construct(LoyaltyPointsHistory $model)
    {
        parent::__construct($model);
    }
}
