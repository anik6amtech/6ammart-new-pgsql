<?php

namespace Modules\RideShare\Repository\BusinessManagement;

use Modules\RideShare\Entities\BusinessManagement\SafetyAlertReason;
use Modules\RideShare\Interface\BusinessManagement\Repository\SafetyAlertReasonRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class SafetyAlertReasonRepository extends BaseRepository implements SafetyAlertReasonRepositoryInterface
{
    public function __construct(SafetyAlertReason $model)
    {
        parent::__construct($model);
    }
}
