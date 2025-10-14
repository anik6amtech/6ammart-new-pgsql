<?php

namespace Modules\RideShare\Repository\BusinessManagement;

use Modules\RideShare\Entities\BusinessManagement\SafetyPrecaution;
use Modules\RideShare\Interface\BusinessManagement\Repository\SafetyPrecautionRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class SafetyPrecautionRepository extends BaseRepository implements SafetyPrecautionRepositoryInterface
{
    public function __construct(SafetyPrecaution $model)
    {
        parent::__construct($model);
    }
}
