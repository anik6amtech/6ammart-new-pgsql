<?php

namespace Modules\RideShare\Interface\ReviewModule\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\RideShare\Interface\BaseRepositoryInterface;

interface ReviewRepositoryInterface extends BaseRepositoryInterface
{
    public function getWithAvg(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [], array $withAvgRelation = [],array $whereBetweenCriteria = []): Collection|LengthAwarePaginator;
}
