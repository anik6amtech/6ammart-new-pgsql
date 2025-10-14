<?php

namespace Modules\RideShare\Traits\TransactionManagement;

use App\CentralLogics\CustomerLogic;
use App\Models\Admin;
use App\Models\DeliveryManWallet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\RideShare\Entities\TransactionManagement\Transaction;
use App\Models\UserAccount;
use Modules\RideShare\Traits\UserManagement\LevelUpdateCheckerTrait;
use Modules\RideShare\Traits\UserManagement\UserAccountManagementTrait;

trait TransactionTrait
{

    use LevelUpdateCheckerTrait, UserAccountManagementTrait;

    public function digitalPaymentTransaction($trip): void
    {
        $adminUserId = Admin::where('role_id', 1)->first()->id;

        DB::beginTransaction();
        $adminReceived = $trip->fee->admin_commission;//30
        $tripBalanceAfterRemoveCommission = $trip->paid_fare - $trip->fee->admin_commission; //70
        $riderEarning = $tripBalanceAfterRemoveCommission;

        //Admin account update (payable and wallet balance +)
        $adminAccount = $this->getUserAccount($adminUserId, 'admin');
        $adminAccount->payable_balance += $tripBalanceAfterRemoveCommission;
        $adminAccount->received_balance += $adminReceived;
        $adminAccount->save();

        $this->updateAdminWallet($adminUserId, 'credit', $adminReceived, 'total_commission_earning');
        $this->updateAdminWallet($adminUserId, 'credit', ($adminReceived + $tripBalanceAfterRemoveCommission), 'digital_received');

        //Admin transaction 1 (payable)
        $adminTransaction1 = new Transaction();
        $adminTransaction1->attribute = 'driver_earning';
        $adminTransaction1->attribute_id = $trip->id;
        $adminTransaction1->credit = $tripBalanceAfterRemoveCommission;
        $adminTransaction1->balance = $adminAccount->payable_balance;
        $adminTransaction1->user_id = $adminUserId;
        $adminTransaction1->user_type = 'admin';
        $adminTransaction1->account = 'payable_balance';
        $adminTransaction1->save();

        //Admin transaction 2 ( + received balance)
        $adminTransaction2 = new Transaction();
        $adminTransaction2->attribute = 'admin_commission';
        $adminTransaction2->attribute_id = $trip->id;
        $adminTransaction2->credit = $adminReceived;
        $adminTransaction2->balance = $adminAccount->received_balance;
        $adminTransaction2->user_id = $adminUserId;
        $adminTransaction2->user_type = 'admin';
        $adminTransaction2->account = 'received_balance';
        $adminTransaction2->save();

        //Admin account update for coupon amount
        if ($trip->coupon_id !== null && $trip->coupon_amount > 0) {
            $this->adminAccountUpdateWithTransactionForCoupon($trip, $adminUserId);
        }

        //Admin account update for discount amount
        if ($trip->discount_amount !== null && $trip->discount_amount > 0) {
            $this->adminAccountUpdateWithTransactionForDiscount($trip, $adminUserId);
        }

        //Rider account update (+ receivable_balance)
        $riderAccount = $this->getUserAccount($trip->driver->id, DRIVER);
        $riderAccount->receivable_balance += $tripBalanceAfterRemoveCommission; //70
        $riderAccount->save();

        $this->updateDriverBalance($trip->driver, 'credit', $tripBalanceAfterRemoveCommission, 'total_earning');

        //Rider transaction 1
        $riderTransaction = new Transaction();
        $riderTransaction->attribute = 'driver_earning';
        $riderTransaction->attribute_id = $trip->id;
        $riderTransaction->credit = $tripBalanceAfterRemoveCommission;
        $riderTransaction->balance = $riderAccount->receivable_balance;
        $riderTransaction->user_id = $trip->driver->id;
        $riderTransaction->user_type = DRIVER;
        $riderTransaction->account = 'receivable_balance';
        $riderTransaction->save();

        //Rider account update for coupon
        if ($trip->coupon_id !== null && $trip->coupon_amount > 0) {
            $this->riderAccountUpdateWithTransactionForCoupon($trip);
        }

        //Rider account update for discount
        if ($trip->discount_amount !== null && $trip->discount_amount > 0) {
            $this->riderAccountUpdateWithTransactionForDiscount($trip);
        }

        $this->driverLevelUpdateChecker($trip->driver);
        DB::commit();

    }

    public function cashTransaction($trip, $returnFee = false): void
    {
        $adminUserId = Admin::where('role_id', 1)->first()->id;
        DB::beginTransaction();
        $adminReceived = $trip->fee->admin_commission;//30
        if ($returnFee) {
            $tripBalanceAfterRemoveCommission = ($trip->paid_fare - $trip->return_fee) - $trip->fee->admin_commission; //70
        } else {
            $tripBalanceAfterRemoveCommission = $trip->paid_fare - $trip->fee->admin_commission; //70
        }


        //Rider account update
        $riderAccount = $this->getUserAccount($trip->driver->id, DRIVER);
        $riderAccount->payable_balance += $adminReceived; //30
        $riderAccount->received_balance += $tripBalanceAfterRemoveCommission; //70
        $riderAccount->save();

        $this->updateDriverBalance($trip->driver, 'credit', $tripBalanceAfterRemoveCommission, 'total_earning');
        $this->updateDriverBalance($trip->driver, 'credit', ($adminReceived + $tripBalanceAfterRemoveCommission), 'collected_cash');

        //Rider account update transaction 1
        $riderTransaction1 = new Transaction();
        $riderTransaction1->attribute = 'driver_earning';
        $riderTransaction1->attribute_id = $trip->id;
        $riderTransaction1->credit = $tripBalanceAfterRemoveCommission;
        $riderTransaction1->balance = $riderAccount->received_balance;
        $riderTransaction1->user_id = $trip->driver->id;
        $riderTransaction1->user_type = DRIVER;
        $riderTransaction1->account = 'received_balance';
        $riderTransaction1->save();

        //Rider account update transaction 2
        $riderTransaction2 = new Transaction();
        $riderTransaction2->attribute = 'admin_commission';
        $riderTransaction2->attribute_id = $trip->id;
        $riderTransaction2->credit = $adminReceived;
        $riderTransaction2->balance = $riderAccount->payable_balance;
        $riderTransaction2->user_id = $trip->driver->id;
        $riderTransaction2->user_type = DRIVER;
        $riderTransaction2->account = 'payable_balance';
        $riderTransaction2->trx_ref_id = $riderTransaction1->id;
        $riderTransaction2->save();

        //Rider account update for coupon
        if ($trip->coupon_id !== null && $trip->coupon_amount > 0) {
            $this->riderAccountUpdateWithTransactionForCoupon($trip);
        }

        //Rider account update for discount
        if ($trip->discount_amount !== null && $trip->discount_amount > 0) {
            $this->riderAccountUpdateWithTransactionForDiscount($trip);
        }

        //Admin account update
        $adminAccount = $this->getUserAccount($adminUserId, 'admin');
        $adminAccount->receivable_balance += $adminReceived; //30
        $adminAccount->save();

        $this->updateAdminWallet($adminUserId, 'credit', $adminReceived, 'total_commission_earning');

        //Admin transaction 1
        $adminTransaction = new Transaction();
        $adminTransaction->attribute = 'admin_commission';
        $adminTransaction->attribute_id = $trip->id;
        $adminTransaction->credit = $adminReceived;
        $adminTransaction->balance = $adminAccount->receivable_balance;
        $adminTransaction->user_id = $adminUserId;
        $adminTransaction->user_type = 'admin';
        $adminTransaction->account = 'receivable_balance';
        $adminTransaction->trx_ref_id = $riderTransaction2->id;
        $adminTransaction->save();

        //Admin account update for coupon amount
        if ($trip->coupon_id !== null && $trip->coupon_amount > 0) {
            $this->adminAccountUpdateWithTransactionForCoupon($trip, $adminUserId);
        }

        //Admin account update for discount amount
        if ($trip->discount_amount !== null && $trip->discount_amount > 0) {
            $this->adminAccountUpdateWithTransactionForDiscount($trip, $adminUserId);
        }

        $this->driverLevelUpdateChecker($trip->driver);

        DB::commit();
    }

/*     public function cashReturnFeeTransaction($trip): void
    {

        $amount = $trip->due_amount;
        DB::beginTransaction();
        //Rider account update
        $riderAccount = $this->getUserAccount($trip->driver->id, DRIVER);
        $riderAccount->received_balance += $amount;
        $riderAccount->save();

        $this->updateDriverBalance($trip->driver, 'credit', $amount, 'collected_cash');

        //Rider account update transaction 1
        $riderTransaction1 = new Transaction();
        $riderTransaction1->attribute = 'driver_earning';
        $riderTransaction1->attribute_id = $trip->id;
        $riderTransaction1->credit = $amount;
        $riderTransaction1->balance = $riderAccount->received_balance;
        $riderTransaction1->user_id = $trip->driver->id;
        $riderTransaction1->user_type = DRIVER;
        $riderTransaction1->account = 'received_balance';
        $riderTransaction1->save();

        $this->driverLevelUpdateChecker($trip->driver);

        DB::commit();
    } */

    public function walletTransaction($trip): void
    {

        $adminUserId = Admin::where('role_id', 1)->first()->id;

        DB::beginTransaction();
        $adminReceived = $trip->fee->admin_commission;//30
        $tripBalanceAfterRemoveCommission = $trip->paid_fare - $trip->fee->admin_commission; //70
        $riderEarning = $tripBalanceAfterRemoveCommission;

        //customer account debit
        $customerAccount = $this->getUserAccount($trip->customer->id, CUSTOMER);
        $customerAccount->wallet_balance -= $trip->paid_fare;
        $customerAccount->save();

        $this->updateCustomerWalletBalance($trip->customer, 'debit', $trip->paid_fare, $trip);

        //customer transaction (debit)
        $customerTransaction = new Transaction();
        $customerTransaction->attribute = 'wallet_payment';
        $customerTransaction->attribute_id = $trip->id;
        $customerTransaction->debit = $trip->paid_fare;
        $customerTransaction->balance = $customerAccount->wallet_balance;
        $customerTransaction->user_id = $trip->customer->id;
        $customerTransaction->user_type = CUSTOMER;
        $customerTransaction->account = 'wallet_balance';
        $customerTransaction->save();

        //Admin account update (payable and wallet balance +)
        $adminAccount = $this->getUserAccount($adminUserId, 'admin');
        $adminAccount->payable_balance += $tripBalanceAfterRemoveCommission;
        $adminAccount->received_balance += $adminReceived;
        $adminAccount->save();

        $this->updateAdminWallet($adminUserId, 'credit', $adminReceived, 'total_commission_earning');
        $this->updateAdminWallet($adminUserId, 'credit', ($adminReceived + $tripBalanceAfterRemoveCommission), 'digital_received');

        //Admin transaction 1 (payable)
        $adminTransaction1 = new Transaction();
        $adminTransaction1->attribute = 'driver_earning';
        $adminTransaction1->attribute_id = $trip->id;
        $adminTransaction1->credit = $tripBalanceAfterRemoveCommission;
        $adminTransaction1->balance = $adminAccount->payable_balance;
        $adminTransaction1->user_id = $adminUserId;
        $adminTransaction1->user_type = 'admin';
        $adminTransaction1->account = 'payable_balance';
        $adminTransaction1->trx_ref_id = $customerTransaction->id;
        $adminTransaction1->save();

        //Admin transaction 2 ( + received balance)
        $adminTransaction2 = new Transaction();
        $adminTransaction2->attribute = 'admin_commission';
        $adminTransaction2->attribute_id = $trip->id;
        $adminTransaction2->credit = $adminReceived;
        $adminTransaction2->balance = $adminAccount->received_balance;
        $adminTransaction2->user_id = $adminUserId;
        $adminTransaction2->user_type = 'admin';
        $adminTransaction2->account = 'received_balance';
        $adminTransaction2->trx_ref_id = $customerTransaction->id;
        $adminTransaction2->save();

        //Admin account update for coupon amount
        if ($trip->coupon_id !== null && $trip->coupon_amount > 0) {
            $this->adminAccountUpdateWithTransactionForCoupon($trip, $adminUserId);
        }

        //Admin account update for discount amount
        if ($trip->discount_amount !== null && $trip->discount_amount > 0) {
            $this->adminAccountUpdateWithTransactionForDiscount($trip, $adminUserId);
        }

        //Rider account update (+ receivable_balance)
        $riderAccount = $this->getUserAccount($trip->driver->id, DRIVER);
        $riderAccount->receivable_balance += $tripBalanceAfterRemoveCommission; //70
        $riderAccount->save();

        $this->updateDriverBalance($trip->driver, 'credit', $tripBalanceAfterRemoveCommission, 'total_earning');

        //Rider transaction 1
        $riderTransaction = new Transaction();
        $riderTransaction->attribute = 'driver_earning';
        $riderTransaction->attribute_id = $trip->id;
        $riderTransaction->credit = $tripBalanceAfterRemoveCommission;
        $riderTransaction->balance = $riderAccount->receivable_balance;
        $riderTransaction->user_id = $trip->driver->id;
        $riderTransaction->user_type = DRIVER;
        $riderTransaction->account = 'receivable_balance';
        $riderTransaction->save();

        //Rider account update for coupon
        if ($trip->coupon_id !== null && $trip->coupon_amount > 0) {
            $this->riderAccountUpdateWithTransactionForCoupon($trip);
        }

        //Rider account update for discount
        if ($trip->discount_amount !== null && $trip->discount_amount > 0) {
            $this->riderAccountUpdateWithTransactionForDiscount($trip);
        }

        $this->driverLevelUpdateChecker($trip->driver);
        DB::commit();


    }

    private function adminAccountUpdateWithTransactionForCoupon($trip, $adminUserId)
    {

        $adminAccountForCoupon = $this->getUserAccount($adminUserId, 'admin');
        $adminAccountForCoupon->payable_balance += $trip->coupon_amount; //30
        $adminAccountForCoupon->save();

        //Admin transaction for coupon amount
        $adminTransactionForCoupon = new Transaction();
        $adminTransactionForCoupon->attribute = 'driver_earning';
        $adminTransactionForCoupon->attribute_id = $trip->id;
        $adminTransactionForCoupon->credit = $trip->coupon_amount;
        $adminTransactionForCoupon->balance = $adminAccountForCoupon->payable_balance;
        $adminTransactionForCoupon->user_id = $adminUserId;
        $adminTransactionForCoupon->user_type = 'admin';
        $adminTransactionForCoupon->transaction_type = COUPON;
        $adminTransactionForCoupon->account = 'payable_balance';
        $adminTransactionForCoupon->save();
    }

    private function adminAccountUpdateWithTransactionForDiscount($trip, $adminUserId)
    {

        $adminAccountForDiscount = $this->getUserAccount($adminUserId, 'admin');
        $adminAccountForDiscount->payable_balance += $trip->discount_amount; //30
        $adminAccountForDiscount->save();

        //Admin transaction for coupon amount
        $adminTransactionForDiscount = new Transaction();
        $adminTransactionForDiscount->attribute = 'driver_earning';
        $adminTransactionForDiscount->attribute_id = $trip->id;
        $adminTransactionForDiscount->credit = $trip->discount_amount;
        $adminTransactionForDiscount->balance = $adminAccountForDiscount->payable_balance;
        $adminTransactionForDiscount->user_id = $adminUserId;
        $adminTransactionForDiscount->user_type = 'admin';
        $adminTransactionForDiscount->transaction_type = DISCOUNT;
        $adminTransactionForDiscount->account = 'payable_balance';
        $adminTransactionForDiscount->save();
    }

    private function riderAccountUpdateWithTransactionForCoupon($trip)
    {

        $riderAccountForCoupon = $this->getUserAccount($trip->driver->id, DRIVER);
        $riderAccountForCoupon->receivable_balance += $trip->coupon_amount;
        $riderAccountForCoupon->save();

        $this->updateDriverBalance($trip->driver, 'credit', $trip->coupon_amount, 'total_earning');

        //Rider transaction for coupon
        $riderTransactionForCoupon = new Transaction();
        $riderTransactionForCoupon->attribute = 'driver_earning';
        $riderTransactionForCoupon->attribute_id = $trip->id;
        $riderTransactionForCoupon->credit = $trip->coupon_amount;
        $riderTransactionForCoupon->balance = $riderAccountForCoupon->receivable_balance;
        $riderTransactionForCoupon->user_id = $trip->driver->id;
        $riderTransactionForCoupon->user_type = DRIVER;
        $riderTransactionForCoupon->transaction_type = COUPON;
        $riderTransactionForCoupon->account = 'receivable_balance';
        $riderTransactionForCoupon->save();
    }

    private function riderAccountUpdateWithTransactionForDiscount($trip)
    {
        $riderAccountForCoupon = $this->getUserAccount($trip->driver->id, DRIVER);
        $riderAccountForCoupon->receivable_balance += $trip->discount_amount;
        $riderAccountForCoupon->save();

        $this->updateDriverBalance($trip->driver, 'credit', $trip->discount_amount, 'total_earning');
        //Rider transaction for discount
        $riderTransactionForDiscount = new Transaction();
        $riderTransactionForDiscount->attribute = 'driver_earning';
        $riderTransactionForDiscount->attribute_id = $trip->id;
        $riderTransactionForDiscount->credit = $trip->discount_amount;
        $riderTransactionForDiscount->balance = $riderAccountForCoupon->receivable_balance;
        $riderTransactionForDiscount->user_id = $trip->driver->id;
        $riderTransactionForDiscount->user_type = DRIVER;
        $riderTransactionForDiscount->transaction_type = DISCOUNT;
        $riderTransactionForDiscount->account = 'receivable_balance';
        $riderTransactionForDiscount->save();
    }

    private function adminAccountUpdateWithTransactionForCouponReverse($trip, $adminUserId)
    {
        $adminAccountForCoupon = $this->getUserAccount($adminUserId, 'admin');
        $adminAccountForCoupon->payable_balance -= $trip->coupon_amount; //30
        $adminAccountForCoupon->save();

        //Admin transaction for coupon amount
        $adminTransactionForCoupon = new Transaction();
        $adminTransactionForCoupon->attribute = 'driver_earning_reverse';
        $adminTransactionForCoupon->attribute_id = $trip->id;
        $adminTransactionForCoupon->debit = $trip->coupon_amount;
        $adminTransactionForCoupon->balance = $adminAccountForCoupon->payable_balance;
        $adminTransactionForCoupon->user_id = $adminUserId;
        $adminTransactionForCoupon->user_type = 'admin';
        $adminTransactionForCoupon->transaction_type = COUPON;
        $adminTransactionForCoupon->account = 'payable_balance';
        $adminTransactionForCoupon->save();
    }

    private function adminAccountUpdateWithTransactionForDiscountReverse($trip, $adminUserId)
    {
        $adminAccountForDiscount = $this->getUserAccount($adminUserId, 'admin');
        $adminAccountForDiscount->payable_balance -= $trip->discount_amount; //30
        $adminAccountForDiscount->save();

        //Admin transaction for coupon amount
        $adminTransactionForDiscount = new Transaction();
        $adminTransactionForDiscount->attribute = 'driver_earning_reverse';
        $adminTransactionForDiscount->attribute_id = $trip->id;
        $adminTransactionForDiscount->debit = $trip->discount_amount;
        $adminTransactionForDiscount->balance = $adminAccountForDiscount->payable_balance;
        $adminTransactionForDiscount->user_id = $adminUserId;
        $adminTransactionForDiscount->user_type = 'admin';
        $adminTransactionForDiscount->transaction_type = DISCOUNT;
        $adminTransactionForDiscount->account = 'payable_balance';
        $adminTransactionForDiscount->save();
    }

/*     private function riderAccountUpdateWithTransactionForCouponReverse($trip)
    {
        $riderAccountForCoupon = $this->getUserAccount($trip->driver->id, DRIVER);
        $riderAccountForCoupon->receivable_balance -= $trip->coupon_amount;
        $riderAccountForCoupon->save();

        $this->updateDriverBalance($trip->driver, 'debit', $trip->discount_amount, 'total_earning');

        //Rider transaction for coupon
        $riderTransactionForCoupon = new Transaction();
        $riderTransactionForCoupon->attribute = 'driver_earning_reverse';
        $riderTransactionForCoupon->attribute_id = $trip->id;
        $riderTransactionForCoupon->debit = $trip->coupon_amount;
        $riderTransactionForCoupon->balance = $riderAccountForCoupon->receivable_balance;
        $riderTransactionForCoupon->user_id = $trip->driver->id;
        $riderTransactionForCoupon->user_type = DRIVER;
        $riderTransactionForCoupon->transaction_type = COUPON;
        $riderTransactionForCoupon->account = 'receivable_balance';
        $riderTransactionForCoupon->save();
    } */

/*     private function riderAccountUpdateWithTransactionForDiscountReverse($trip)
    {
        $riderAccountForCoupon = $this->getUserAccount($trip->driver->id, DRIVER);
        $riderAccountForCoupon->receivable_balance -= $trip->discount_amount;
        $riderAccountForCoupon->save();

        $this->updateDriverBalance($trip->driver, 'debit', $trip->discount_amount, 'total_earning');

        //Rider transaction for discount
        $riderTransactionForDiscount = new Transaction();
        $riderTransactionForDiscount->attribute = 'driver_earning_reverse';
        $riderTransactionForDiscount->attribute_id = $trip->id;
        $riderTransactionForDiscount->debit = $trip->discount_amount;
        $riderTransactionForDiscount->balance = $riderAccountForCoupon->receivable_balance;
        $riderTransactionForDiscount->user_id = $trip->driver->id;
        $riderTransactionForDiscount->user_type = DRIVER;
        $riderTransactionForDiscount->transaction_type = DISCOUNT;
        $riderTransactionForDiscount->account = 'receivable_balance';
        $riderTransactionForDiscount->save();
    } */

/*     public function customerLoyaltyPointsTransaction($user, $amount): Model|Builder|null
    {
        DB::beginTransaction();
        //Customer account update
        $customer = $this->getUserAccount($user->id, CUSTOMER);
        $customer->wallet_balance += $amount;
        $customer->save();

        $this->updateCustomerWalletBalance($user, 'credit', $amount);

        //customer transaction (credit)
        $primary_transaction = new Transaction();
        $primary_transaction->attribute = 'point_conversion';
        $primary_transaction->credit = $amount;
        $primary_transaction->balance = $customer->wallet_balance;
        // $primary_transaction->wallet_balance = $customer->wallet_balance;
        $primary_transaction->user_id = $user->id;
        $primary_transaction->user_type = CUSTOMER;
        $primary_transaction->account = 'wallet_balance';
        $primary_transaction->save();

        DB::commit();

        return $customer;
    } */

    public function driverLoyaltyPointsTransaction($user, $amount): Model|Builder|null
    {
        DB::beginTransaction();
        //driver account update
        $driver = $this->getUserAccount($user->id, DRIVER);
        $driver->receivable_balance += $amount;
        $driver->save();

        $this->updateDriverBalance($user, 'credit', $amount, 'total_earning');

        //Driver transaction (credit)
        $primary_transaction = new Transaction();
        $primary_transaction->attribute = 'point_conversion';
        $primary_transaction->credit = $amount;
        $primary_transaction->balance = $driver->receivable_balance;
        // $primary_transaction->wallet_balance = $customer->wallet_balance;
        $primary_transaction->user_id = $user->id;
        $primary_transaction->user_type = DRIVER;
        $primary_transaction->account = 'receivable_balance';
        $primary_transaction->save();

        DB::commit();

        return $driver;
    }

/*     public function withdrawRequestWithAdjustTransaction($user, $amount, $attribute)
    {
        DB::beginTransaction();

        //Driver account update
        $driver = $this->getUserAccount($user->id, DRIVER);
        $payableBalance = $driver->payable_balance;

        $driver->receivable_balance -= ($payableBalance + $amount);
        $driver->payable_balance -= $payableBalance;
        $driver->pending_balance += $amount;
        $driver->save();

        $this->updateDriverBalance($user, 'debit', ($payableBalance + $amount), 'total_earning');
        $this->updateDriverBalance($user, 'debit', $payableBalance, 'collected_cash');
        $this->updateDriverBalance($user, 'credit', $amount, 'pending_withdraw');

        //Admin account update
        $adminUserId = $this->getAdminUserId();
        $account = $this->getUserAccount($adminUserId, 'admin');
        $account->received_balance += $payableBalance;
        $account->receivable_balance -= $payableBalance;
        $account->save();

        //Driver transaction (credit)
        $first_trx = new Transaction();
        $first_trx->attribute = 'pending_withdrawn';
        $first_trx->attribute_id = $attribute->id;
        $first_trx->credit = $amount;
        $first_trx->balance = $driver->pending_balance;
        $first_trx->user_id = $user->id;
        $first_trx->user_type = DRIVER;
        $first_trx->account = 'pending_withdraw_balance';
        $first_trx->save();


        #adjust driver payable balance

        //Driver transaction (debit)
        $driver_transaction = new Transaction();
        $driver_transaction->attribute = 'adjust_payable_balance';
        $driver_transaction->debit = $payableBalance;
        $driver_transaction->balance = $driver->payable_balance;
        $driver_transaction->user_id = $user->id;
        $driver_transaction->user_type = DRIVER;
        $driver_transaction->account = 'payable_balance';
        $driver_transaction->trx_ref_id = $first_trx->id;
        $driver_transaction->save();
        //Admin transaction (credit)
        $admin_transaction = new Transaction();
        $admin_transaction->attribute = 'adjust_received_balance';
        $admin_transaction->credit = $payableBalance;
        $admin_transaction->balance = $account->received_balance;
        $admin_transaction->user_id = $adminUserId;
        $admin_transaction->user_type = 'admin';
        $admin_transaction->account = 'received_balance';
        $admin_transaction->trx_ref_id = $driver_transaction->id;
        $admin_transaction->save();
        //Admin transaction 2 (debit)
        $admin_transaction_2 = new Transaction();
        $admin_transaction_2->attribute = 'adjust_receiveable_balance';
        $admin_transaction_2->debit = $payableBalance;
        $admin_transaction_2->balance = $account->receivable_balance;
        $admin_transaction_2->user_id = $adminUserId;
        $admin_transaction_2->user_type = 'admin';
        $admin_transaction_2->account = 'receivable_balance';
        $admin_transaction_2->trx_ref_id = $driver_transaction->id;
        $admin_transaction_2->save();

        DB::commit();

        return $driver;
    } */

    public function withdrawRequestWithoutAdjustTransaction($user, $amount, $attribute)
    {
        DB::beginTransaction();
        //Driver account update
        $driver = $this->getUserAccount($user->id, DRIVER);
        $driver->receivable_balance -= $amount;
        $driver->pending_balance += $amount;
        $driver->save();

        // $this->updateDriverBalance($user, 'debit', $amount, 'total_earning');
        // $this->updateDriverBalance($user, 'credit', $amount, 'pending_withdraw');
        //Driver transaction (credit)
        $second_trx = new Transaction();
        $second_trx->attribute = 'pending_withdrawn';
        $second_trx->attribute_id = $attribute->id;
        $second_trx->credit = $amount;
        $second_trx->balance = $driver->pending_balance;
        $second_trx->user_id = $user->id;
        $second_trx->user_type = DRIVER;
        $second_trx->account = 'pending_withdraw_balance';
        $second_trx->save();
        DB::commit();

        return $driver;
    }

/*     public function withdrawRequestReverseTransaction($user, $amount, $attribute)
    {
        //Driver account update
        $driver = $this->getUserAccount($user->id, DRIVER);
        if ($attribute->status == DENIED) {
            $driver->receivable_balance -= $amount;
            $driver->pending_balance += $amount;
            $driver->save();

            $this->updateDriverBalance($user, 'debit', $amount, 'total_earning');
            $this->updateDriverBalance($user, 'credit', $amount, 'pending_withdraw');
        //Driver transaction (debit)
            $second_trx = new Transaction();
            $second_trx->attribute = 'pending_withdraw_reverse';
            $second_trx->attribute_id = $attribute->id;
            $second_trx->debit = $amount;
            $second_trx->balance = $driver->pending_balance;
            $second_trx->user_id = $user->id;
            $second_trx->user_type = DRIVER;
            $second_trx->account = 'withdraw_balance_reverse';
            $second_trx->save();
        } elseif ($attribute->status == SETTLED) {
            $driver->total_withdrawn -= $amount;
            $driver->pending_balance += $amount;
            $driver->save();
            $this->updateDriverBalance($user, 'debit', $amount, 'total_withdrawn');
            $this->updateDriverBalance($user, 'credit', $amount, 'pending_withdraw');
            //Driver transaction (debit)
            $second_trx = new Transaction();
            $second_trx->attribute = 'pending_withdraw_reverse';
            $second_trx->attribute_id = $attribute->id;
            $second_trx->debit = $amount;
            $second_trx->balance = $driver->pending_balance;
            $second_trx->user_id = $user->id;
            $second_trx->user_type = DRIVER;
            $second_trx->account = 'withdraw_balance_reverse';
            $second_trx->save();


            //Admin account update
            $admin = Admin::query()->where('role_id', 1)->first();
            $admin_user = UserAccount::query()->firstWhere('user_id', $admin->id);
            $admin_user->payable_balance += $amount;
            $admin_user->save();

            //admin transaction (credit)
            $third_trx = new Transaction();
            $third_trx->attribute = 'withdraw_request_reverse';
            $third_trx->attribute_id = $attribute->id;
            $third_trx->credit = $amount;
            $third_trx->balance = $admin_user->payable_balance;
            $third_trx->user_id = $admin->id;
            $third_trx->user_type = 'admin';
            $third_trx->account = 'withdraw_balance_reverse';
            $third_trx->trx_ref_id = $second_trx->id;
            $third_trx->save();
        }

        return $driver;
    } */

    public function withdrawRequestCancelTransaction($user, $amount, $attribute)
    {
        DB::beginTransaction();
        //Driver account update
        $driver = $this->getUserAccount($user->id, DRIVER);
        $driver->receivable_balance += $amount;
        $driver->pending_balance -= $amount;
        $driver->save();

        // $this->updateDriverBalance($user, 'credit', $amount, 'total_earning');
        $this->updateDriverBalance($user, 'debit', $amount, 'pending_withdraw');
        //Driver transaction (debit)
        $second_trx = new Transaction();
        $second_trx->attribute = 'pending_withdraw_revoked';
        $second_trx->attribute_id = $attribute->id;
        $second_trx->debit = $amount;
        $second_trx->balance = $driver->pending_balance;
        $second_trx->user_id = $user->id;
        $second_trx->user_type = DRIVER;
        $second_trx->account = 'withdraw_balance_rejected';
        $second_trx->save();

        DB::commit();
        return $driver;
    }

    public function withdrawRequestAcceptTransaction($user, $amount, $attribute)
    {
        DB::beginTransaction();
        //driver account update
        $driver = $this->getUserAccount($user->id, DRIVER);
        $driver->pending_balance -= $amount;
        $driver->total_withdrawn += $amount;
        $driver->save();

        $this->updateDriverBalance($user, 'credit', $amount, 'total_withdrawn');
        $this->updateDriverBalance($user, 'debit', $amount, 'pending_withdraw');
        //driver transaction (credit)
        $second_trx = new Transaction();
        $second_trx->attribute = 'withdraw_request_accepted';
        $second_trx->attribute_id = $attribute->id;
        $second_trx->credit = $amount;
        $second_trx->balance = $driver->total_withdrawn;
        $second_trx->user_id = $user->id;
        $second_trx->user_type = DRIVER;
        $second_trx->account = 'received_withdraw_balance';
        $second_trx->save();


        //Admin account update
        $admin = Admin::query()->where('role_id', 1)->first();
        $admin_user = UserAccount::query()->firstWhere('user_id', $admin->id);
        $admin_user->payable_balance -= $amount;
        $admin_user->save();

        //admin transaction (debit)
        $third_trx = new Transaction();
        $third_trx->attribute = 'withdraw_request_approved';
        $third_trx->attribute_id = $attribute->id;
        $third_trx->debit = $amount;
        $third_trx->balance = $admin_user->payable_balance;
        $third_trx->user_id = $admin->id;
        $third_trx->user_type = 'admin';
        $third_trx->account = 'withdraw_balance_paid';
        $third_trx->trx_ref_id = $second_trx->id;
        $third_trx->save();

        DB::commit();

        return $driver;
    }

/*     public function driverLevelRewardTransaction($user, $amount): void
    {
        DB::beginTransaction();
        //Driver account update
        $driver = $this->getUserAccount($user->id, DRIVER);
        $driver->receivable_balance += $amount;
        $driver->save();

        $this->updateDriverBalance($user, 'credit', $amount, 'total_earning');
        //Driver transaction (credit)
        $primary_transaction = new Transaction();
        $primary_transaction->attribute = 'level_reward';
        $primary_transaction->credit = $amount;
        $primary_transaction->balance = $driver->receivable_balance;
        $primary_transaction->user_id = $user->id;
        $primary_transaction->user_type = DRIVER;
        $primary_transaction->account = 'receivable_balance';
        $primary_transaction->save();

        DB::commit();
    } */

    #referral earning transaction
    public function customerReferralEarningTransaction($user, $amount): void
    {
        DB::beginTransaction();
        //Customer account update
        $customer = $this->getUserAccount($user->id, CUSTOMER);
        $customer->wallet_balance += $amount;
        $customer->referral_earn += $amount;
        $customer->save();

        $this->updateCustomerWalletBalance($user, 'credit', $amount);
        //customer transaction (credit)
        $primary_transaction = new Transaction();
        $primary_transaction->attribute = 'referral_earning';
        $primary_transaction->credit = $amount;
        $primary_transaction->balance = $customer->wallet_balance;
        $primary_transaction->user_id = $user->id;
        $primary_transaction->user_type = CUSTOMER;
        $primary_transaction->account = 'wallet_balance';
        $primary_transaction->save();

        DB::commit();
    }

    public function driverReferralEarningTransaction($user, $amount): void
    {
        DB::beginTransaction();
        $driver = $this->getUserAccount($user->id, DRIVER);
        $driver->receivable_balance += $amount;
        $driver->referral_earn += $amount;
        $driver->save();

        $this->updateDriverBalance($user, 'credit', $amount, 'total_earning');
        //driver transaction (credit)
        $primary_transaction = new Transaction();
        $primary_transaction->attribute = 'referral_earning';
        $primary_transaction->credit = $amount;
        $primary_transaction->balance = $driver->receivable_balance;
        $primary_transaction->user_id = $user->id;
        $primary_transaction->user_type = DRIVER;
        $primary_transaction->account = 'receivable_balance';
        $primary_transaction->save();
        DB::commit();
    }

    #end referral earning transaction
    public function collectCashWithoutAdjustTransaction($user, $amount)
    {
        DB::beginTransaction();

        //Driver account update
        $driverAccount = $this->getUserAccount($user->id, DRIVER);
        $driverAccount->payable_balance -= $amount;
        $driverAccount->save();
        // $this->updateDriverBalance($user, 'debit', $amount, 'collected_cash');
        //Driver transaction (debit)
        $driverAccount_transaction = new Transaction();
        $driverAccount_transaction->attribute = 'admin_cash_collect';
        $driverAccount_transaction->debit = $amount;
        $driverAccount_transaction->balance = $driverAccount->payable_balance;
        $driverAccount_transaction->user_id = $user->id;
        $driverAccount_transaction->user_type = DRIVER;
        $driverAccount_transaction->account = 'payable_balance';
        $driverAccount_transaction->save();

        //Admin account update
        $adminUserId = Admin::query()->where('role_id', 1)->first()->id;
        $account = UserAccount::query()->firstWhere('user_id', $adminUserId);
        $account->received_balance += $amount;
        $account->save();


        //Admin transaction (credit)
        $admin_transaction = new Transaction();
        $admin_transaction->attribute = 'admin_cash_collect';
        $admin_transaction->credit = $amount;
        $admin_transaction->balance = $driverAccount->received_balance;
        $admin_transaction->user_id = $adminUserId;
        $admin_transaction->user_type = 'admin';
        $admin_transaction->account = 'received_balance';
        $admin_transaction->trx_ref_id = $driverAccount_transaction->id;
        $admin_transaction->save();
        $push = getNotification('admin_collected_cash');
        sendDeviceNotification(fcm_token: $user->fcm_token,
            title: translate($push['title']),
            description: translate($push['description']),
            status: $push['status'],
            action: $push['action'],
            user_id: $user->id,
        );
        DB::commit();
    }

    public function adjustWalletTransaction($user, $amount)
    {
        DB::beginTransaction();
        //Driver account update
        $driverAccount = $this->getUserAccount($user->id, DRIVER);
        $driverAccount->payable_balance -= $amount;
        $driverAccount->received_balance += $amount;
        $driverAccount->receivable_balance -= $amount;
        $driverAccount->save();

        //Admin account update
        $adminUserId = Admin::query()->where('role_id', 1)->first()->id;
        $account = $this->getUserAccount($adminUserId, 'admin');
        $account->payable_balance -= $amount;
        $account->received_balance += $amount;
        $account->receivable_balance -= $amount;
        $account->save();

        //Driver transaction (debit) for payable balance
        $driverAccount_transaction = new Transaction();
        $driverAccount_transaction->attribute = 'admin_cash_collect';
        $driverAccount_transaction->debit = $amount;
        $driverAccount_transaction->balance = $driverAccount->payable_balance;
        $driverAccount_transaction->user_id = $user->id;
        $driverAccount_transaction->user_type = DRIVER;
        $driverAccount_transaction->account = 'payable_balance';
        $driverAccount_transaction->save();

        //Admin transaction (credit)
        $admin_transaction = new Transaction();
        $admin_transaction->attribute = 'admin_cash_collect';
        $admin_transaction->credit = $amount;
        $admin_transaction->balance = $account->received_balance;
        $admin_transaction->user_id = $adminUserId;
        $admin_transaction->user_type = 'admin';
        $admin_transaction->account = 'received_balance';
        $admin_transaction->trx_ref_id = $driverAccount_transaction->id;
        $admin_transaction->save();

        //Admin transaction 2 (debit)
        $admin_transaction_2 = new Transaction();
        $admin_transaction_2->attribute = 'admin_cash_collect';
        $admin_transaction_2->debit = $amount;
        $admin_transaction_2->balance = $account->receivable_balance;
        $admin_transaction_2->user_id = $adminUserId;
        $admin_transaction_2->user_type = 'admin';
        $admin_transaction_2->account = 'receivable_balance';
        $admin_transaction_2->trx_ref_id = $driverAccount_transaction->id;
        $admin_transaction_2->save();

        #Adjustment transaction

        //admin transaction (debit)
        $third_trx = new Transaction();
        $third_trx->attribute = 'adjust_payable_balance';
        $third_trx->debit = $amount;
        $third_trx->balance = $account->payable_balance;
        $third_trx->user_id = $adminUserId;
        $third_trx->user_type = 'admin';
        $third_trx->account = 'payable_balance';
        $third_trx->trx_ref_id = $driverAccount_transaction->id;
        $third_trx->save();

        //Driver transaction (debit)
        $driverAccount_transaction2 = new Transaction();
        $driverAccount_transaction2->attribute = 'adjust_receivable_balance';
        $driverAccount_transaction2->debit = $amount;
        $driverAccount_transaction2->balance = $driverAccount->receivable_balance;
        $driverAccount_transaction2->user_id = $user->id;
        $driverAccount_transaction2->user_type = DRIVER;
        $driverAccount_transaction2->account = 'receivable_balance';
        $driverAccount_transaction2->trx_ref_id = $third_trx->id;
        $driverAccount_transaction2->save();

        $driverAccount_transaction3 = new Transaction();
        $driverAccount_transaction3->attribute = 'adjust_received_balance';
        $driverAccount_transaction3->credit = $amount;
        $driverAccount_transaction3->balance = $driverAccount->received_balance;
        $driverAccount_transaction3->user_id = $user->id;
        $driverAccount_transaction3->user_type = DRIVER;
        $driverAccount_transaction3->account = 'received_balance';
        $driverAccount_transaction3->trx_ref_id = $third_trx->id;
        $driverAccount_transaction3->save();

        DB::commit();
    }
}
