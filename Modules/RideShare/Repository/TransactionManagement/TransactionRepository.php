<?php

namespace Modules\RideShare\Repository\TransactionManagement;

use Modules\RideShare\Entities\TransactionManagement\Transaction;
use Modules\RideShare\Interface\TransactionManagement\Repository\TransactionRepositoryInterface;
use Modules\RideShare\Repository\BaseRepository;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }
}
