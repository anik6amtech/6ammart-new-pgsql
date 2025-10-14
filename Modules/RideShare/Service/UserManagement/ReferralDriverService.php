<?php

namespace Modules\RideShare\Service\UserManagement;

use Modules\RideShare\Interface\UserManagement\Repository\ReferralDriverRepositoryInterface;
use Modules\RideShare\Interface\UserManagement\Service\ReferralDriverServiceInterface;
use Modules\RideShare\Service\BaseService;

class ReferralDriverService extends BaseService implements ReferralDriverServiceInterface
{
    protected $referralDriverRepository;

    public function __construct(ReferralDriverRepositoryInterface $referralDriverRepository)
    {
        parent::__construct($referralDriverRepository);
        $this->referralDriverRepository = $referralDriverRepository;
    }
}
