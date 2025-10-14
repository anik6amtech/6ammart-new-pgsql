<?php

namespace Modules\RideShare\Interface\TransactionManagement\Service;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\RideShare\Interface\BaseServiceInterface;

interface TransactionServiceInterface extends BaseServiceInterface
{
    public function customerWalletTransaction(array $data, array $relations = [], array $orderBy = [], int $limit = null, int $offset = null): Collection|LengthAwarePaginator|\Illuminate\Support\Collection;
    public function export(array $criteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = []): Collection|LengthAwarePaginator|\Illuminate\Support\Collection;

}
