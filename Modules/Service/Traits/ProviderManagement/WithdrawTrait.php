<?php

namespace Modules\Service\Traits\ProviderManagement;


trait WithdrawTrait
{
    public function adjustment($provider_user): void
    {
        $payable = $provider_user->account->payable_balance;
        $receivable = $provider_user->account->receivable_balance;

        if($payable > $receivable){
            $provider_user->account->decrement('payable_balance', $receivable);
            $provider_user->account->decrement('receivable_balance', $receivable);

            //withdraw tran

        }elseif($payable < $receivable){
            $provider_user->account->decrement('payable_balance', $payable);
            $provider_user->account->decrement('receivable_balance', $payable);
        }
    }

}
