<?php

namespace Modules\RideShare\Repository\UserManagement;

use Modules\RideShare\Entities\UserManagement\ReferralDriver;
use Modules\RideShare\Interface\UserManagement\Repository\ReferralDriverRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class ReferralDriverRepository extends BaseRepository implements ReferralDriverRepositoryInterface
{
    public function __construct(ReferralDriver $model)
    {
        parent::__construct($model);
    }
}
