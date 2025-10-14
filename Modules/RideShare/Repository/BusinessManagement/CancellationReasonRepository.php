<?php

namespace Modules\RideShare\Repository\BusinessManagement;

use Modules\RideShare\Entities\BusinessManagement\CancellationReason;
use Modules\RideShare\Interface\BusinessManagement\Repository\CancellationReasonRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class CancellationReasonRepository extends BaseRepository implements CancellationReasonRepositoryInterface
{
    public function __construct(CancellationReason $model)
    {
        parent::__construct($model);
    }
}
