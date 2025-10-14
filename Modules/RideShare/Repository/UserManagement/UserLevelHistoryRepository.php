<?php

namespace Modules\RideShare\Repository\UserManagement;

use App\Models\UserLevelHistory;
use Modules\RideShare\Interface\UserManagement\Repository\UserLevelHistoryRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class UserLevelHistoryRepository extends BaseRepository implements UserLevelHistoryRepositoryInterface
{
    public function __construct(UserLevelHistory $model)
    {
        parent::__construct($model);
    }
}
