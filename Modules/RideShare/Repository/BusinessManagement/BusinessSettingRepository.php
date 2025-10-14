<?php

namespace Modules\RideShare\Repository\BusinessManagement;

use App\Models\DataSetting;
use Modules\RideShare\Interface\BusinessManagement\Repository\BusinessSettingRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class BusinessSettingRepository extends BaseRepository implements BusinessSettingRepositoryInterface
{
    public function __construct(DataSetting $model)
    {
        parent::__construct($model);
    }
}
