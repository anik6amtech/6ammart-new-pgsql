<?php

namespace Modules\RideShare\Interface\UserManagement\Repository;

use Modules\RideShare\Interface\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserLevelRepositoryInterface extends BaseRepositoryInterface
{
    public function getStatistics(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $whereBetweenCriteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = []): Collection|LengthAwarePaginator;
}
