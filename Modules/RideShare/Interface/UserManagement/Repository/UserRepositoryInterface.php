<?php

namespace Modules\RideShare\Interface\UserManagement\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\RideShare\Interface\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function loyalCustomer($loyalLevelId): Collection;

    public function getDriverWithoutVehicle(array $criteria = [], array $searchCriteria = [], array $whereInCriteria = [], array $whereBetweenCriteria = [], array $whereHasRelations = [], array $withAvgRelations = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false, array $withCountQuery = [], array $appends = []): Collection|LengthAwarePaginator;

    public function getChattingDriverList(array $criteria, array $searchCriteria, array $whereInCriteria, array $relations = [], array $orderBy = [], array $whereHasRelations = []): Collection;
}
