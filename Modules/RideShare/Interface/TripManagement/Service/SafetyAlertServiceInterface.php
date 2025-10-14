<?php

namespace Modules\RideShare\Interface\TripManagement\Service;

use Modules\RideShare\Interface\BaseServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface SafetyAlertServiceInterface extends BaseServiceInterface
{
    public function create(array|Request $data): ?Model;

    public function updatedBy(array $criteria = [], array $whereInCriteria = [], array $data = [], bool $withTrashed = false);

    public function export(array $criteria = [], array $relations = [], array $whereHasRelations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = []): \Illuminate\Support\Collection;

    public function safetyAlertLatestUserRoute(): string;
}
