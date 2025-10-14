<?php

namespace Modules\RideShare\Traits\UserManagement;

use App\CentralLogics\CustomerLogic;
use App\Models\AdminWallet;
use App\Models\DeliveryManWallet;
use App\Models\User;
use App\Models\UserAccount;

trait UserAccountManagementTrait
{
    public function getUserAccount($user_id, $user_type){

        $userAccount = UserAccount::where('user_id', $user_id)->where('user_type', $user_type)->first();

        if(!$userAccount){
            $userAccount = new UserAccount();
            $userAccount->user_id = $user_id;
            $userAccount->user_type = $user_type;
            $userAccount->save();
        }

        // if($user_type == CUSTOMER){
        //     $user = User::find($user_id);
        //     $userAccount->wallet_balance = $user->wallet_balance;
        // }else if($user_type == DRIVER){
        //     $user = DeliveryManWallet::where('delivery_man_id',$user_id)->first();
        //     if(!$user){
        //         $userAccount->wallet_balance = $user->total_earning - ($user->total_withdrawn +$user->pending_withdraw);
        //         $userAccount->receivable_balance = $user->total_earning - $user->total_withdrawn;
        //         $userAccount->total_withdrawn = $user->total_withdrawn;
        //         $userAccount->pending_balance = $user->pending_withdraw;
        //         $userAccount->payable_balance = 0;
        //         $userAccount->received_balance = 0;
        //     }
        // }

        // $userAccount->payable_balance = $userAccount->payable_balance ?? 0.0;
        // $userAccount->receivable_balance = $userAccount->receivable_balance ?? 0.0;
        // $userAccount->received_balance = $userAccount->received_balance ?? 0.0;
        // $userAccount->pending_balance = $userAccount->pending_balance ?? 0.0;
        // $userAccount->wallet_balance = $userAccount->wallet_balance ?? 0.0;
        // $userAccount->total_withdrawn = $userAccount->total_withdrawn ?? 0.0;
        // $userAccount->referral_earn = $userAccount->referral_earn ?? 0.0;
        // $userAccount->save();

        return $userAccount;
    }

    public function updateCustomerWalletBalance($user, $transaction_type, $amount, $trip = null){
        if($transaction_type == 'debit'){
            CustomerLogic::create_wallet_transaction($user->id, $amount, 'ride_booking',$trip?->id, false);
        }else{
            CustomerLogic::create_wallet_transaction($user->id, $amount, 'referrer',$trip?->id, false);
        }
        return $user;
    }

    public function updateDriverBalance($user, $transaction_type, $amount, $balance_type)
    {
        $driverWallet = DeliveryManWallet::firstOrNew(['delivery_man_id' => $user->id]);
        $allowed = [
            'total_earning',
            'collected_cash',
            'pending_withdraw',
            'total_withdrawn',
        ];
        if (!in_array($balance_type, $allowed)) {
            throw new \InvalidArgumentException("Invalid balance type: $balance_type");
        }
        if ($transaction_type == 'debit') {
            $driverWallet->$balance_type -= $amount;
        } else {
            $driverWallet->$balance_type += $amount;
        }
        return $driverWallet->save();
    }

    public function updateAdminWallet($user_id, $transaction_type, $amount, $balance_type)
    {
        $adminWallet = AdminWallet::firstOrNew(['admin_id' => $user_id]);
        $allowed = [
            'total_commission_earning',
            'digital_received',
            'manual_received',
        ];
        if (!in_array($balance_type, $allowed)) {
            throw new \InvalidArgumentException("Invalid balance type: $balance_type");
        }
        if ($transaction_type == 'debit') {
            $adminWallet->$balance_type -= $amount;
        } else {
            $adminWallet->$balance_type += $amount;
        }
        return $adminWallet->save();
    }
}
