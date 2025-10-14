<?php

use App\CentralLogics\Helpers;
use App\Models\Admin;
use App\Models\AdminWallet;
use App\Models\User;
use App\Models\UserAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Service\Entities\BookingModule\BookingDetailsAmount;
use Modules\Service\Entities\BookingModule\BookingPartialPayment;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\TransactionModule\Transaction;

//============ Booking Place ============
if (!function_exists('placeBookingTransactionForDigitalPayment')) {
    function placeBookingTransactionForDigitalPayment($booking): void
    {
        if ($booking['payment_method'] != 'cash_after_service') {
            $admin_user_id = Admin::where('role_id',1)->first()->id;
            DB::transaction(function () use ($booking, $admin_user_id) {
                //Admin account update
                $account = getUserAccount($admin_user_id, 'admin');
                $account->pending_balance += $booking['total_booking_amount'];
                $account->save();

                //Admin transaction
                Transaction::create([
                    'ref_trx_id' => null,
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['booking_amount'],
                    'debit' => 0,
                    'credit' => $booking['total_booking_amount'],
                    'balance' => $account->pending_balance,
                    'from_user_id' => $booking->customer_id,
                    'from_user_type' => 'customer',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => null,
                    'to_user_account' => ACCOUNT_STATES[0]['value'],
                    'is_guest' => $booking->is_guest
                ]);
            });
        }
    }
}

if (!function_exists('placeBookingRepeatTransactionForDigitalPayment')) {
    function placeBookingRepeatTransactionForDigitalPayment($booking): void
    {
        if ($booking['payment_method'] != 'cash_after_service') {
            $admin_user_id = Admin::where('role_id',1)->first()->id;
            DB::transaction(function () use ($booking, $admin_user_id) {
                //Admin account update
                $account = getUserAccount($admin_user_id, 'admin');
                $account->pending_balance += $booking['total_booking_amount'];
                $account->save();

                //Admin transaction
                Transaction::create([
                    'ref_trx_id' => null,
                    'booking_id' => 0,
                    'booking_repeat_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['booking_amount'],
                    'debit' => 0,
                    'credit' => $booking['total_booking_amount'],
                    'balance' => $account->pending_balance,
                    'from_user_id' => $booking?->booking?->customer_id,
                    'from_user_type' => 'customer',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => null,
                    'to_user_account' => ACCOUNT_STATES[0]['value'],
                    'is_guest' => $booking->is_guest
                ]);
            });
        }
    }
}

if (!function_exists('placeBookingTransactionForPartialCas')) {
    /**
     * Admin (+pending_balance)
     * Customer (-wallet_balance)
     * @param $booking
     * @return void
     */
    function placeBookingTransactionForPartialCas($booking): void
    {
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $user_wallet_balance = User::find($booking->customer_id)?->wallet_balance;
        $paid_amount = $user_wallet_balance;

        DB::transaction(function () use ($booking, $admin_user_id, $paid_amount) {
            /** wallet partial */

            //Admin transaction
            $account = getUserAccount($admin_user_id, 'admin');
            $account->pending_balance += $paid_amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['booking_amount'],
                'debit' => 0,
                'credit' => $paid_amount,
                'balance' => $account->pending_balance,
                'from_user_id' => $booking->customer_id,
                'from_user_type' => 'customer',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[0]['value']
            ]);

            //customer transaction (wallet)
            $user = User::find($booking['customer_id']);
            if ($user->wallet_balance >= $paid_amount) $user->wallet_balance -= $paid_amount;
            $user->save();

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => WALLET_TRX_TYPE['wallet_payment'],
                'debit' => $paid_amount,
                'credit' => 0,
                'balance' => $user->wallet_balance,
                'from_user_id' => $booking->customer_id,
                'from_user_type' => 'customer',
                'to_user_id' => $booking->customer_id,
                'to_user_type' => 'customer',
                'from_user_account' => null,
                'to_user_account' => 'user_wallet'
            ]);
        });
    }
}

if (!function_exists('placeBookingTransactionForPartialDigital')) {
    /**
     * Admin (+pending_balance) [wallet payment]
     * Customer (-wallet_balance) [wallet payment]
     * Admin (+pending_balance) [digital payment]
     * @param $booking
     * @return void
     */
    function placeBookingTransactionForPartialDigital($booking): void
    {
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $user_wallet_balance = User::find($booking->customer_id)?->wallet_balance;

        $paid_amount =$user_wallet_balance;
        $due_amount =  $booking['total_booking_amount'] - $paid_amount;

        DB::transaction(function () use ($booking, $admin_user_id, $paid_amount, $due_amount) {
            /** wallet partial */
            //Admin transaction
            $account = getUserAccount($admin_user_id, 'admin');
            $account->pending_balance += $paid_amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['booking_amount'],
                'debit' => 0,
                'credit' => $paid_amount,
                'balance' => $account->pending_balance,
                'from_user_id' => $booking->customer_id,
                'from_user_type' => 'customer',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[0]['value']
            ]);

            //customer transaction (wallet)
            $user = User::find($booking['customer_id']);
            if ($user->wallet_balance >= $paid_amount) $user->wallet_balance -= $paid_amount;
            $user->save();

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => WALLET_TRX_TYPE['wallet_payment'],
                'debit' => $paid_amount,
                'credit' => 0,
                'balance' => $user->wallet_balance,
                'from_user_id' => $booking->customer_id,
                'from_user_type' => 'customer',
                'to_user_id' => $booking->customer_id,
                'to_user_type' => 'customer',
                'from_user_account' => null,
                'to_user_account' => 'user_wallet'
            ]);

            /** CAS partial */
            //Admin transaction
            $account = getUserAccount($admin_user_id, 'admin');
            $account->pending_balance += $due_amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['booking_amount'],
                'debit' => 0,
                'credit' => $due_amount,
                'balance' => $account->pending_balance,
                'from_user_id' => $booking->customer_id,
                'from_user_type' => 'customer',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[0]['value'],
                'is_guest' => $booking->is_guest
            ]);
        });
    }
}

if (!function_exists('placeBookingTransactionForWalletPayment')) {
    function placeBookingTransactionForWalletPayment($booking): void
    {
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        DB::transaction(function () use ($booking, $admin_user_id) {
            //Admin account update
            $account = getUserAccount($admin_user_id, 'admin');
            $account->pending_balance += $booking['total_booking_amount'];
            $account->save();

            //Admin transaction
            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['booking_amount'],
                'debit' => 0,
                'credit' => $booking['total_booking_amount'],
                'balance' => $account->pending_balance,
                'from_user_id' => $booking->customer_id,
                'from_user_type' => 'customer',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[0]['value']
            ]);



            //Customer wallet update
            $user = User::find($booking['customer_id']);
            if ($user->wallet_balance >= $booking['total_booking_amount']) {
                $user->wallet_balance -= $booking['total_booking_amount'];
            }
            $user->save();

            //customer transaction (wallet)
            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => WALLET_TRX_TYPE['wallet_payment'],
                'debit' => $booking['total_booking_amount'],
                'credit' => 0,
                'balance' => $user->wallet_balance,
                'from_user_id' => $booking->customer_id,
                'from_user_type' => 'customer',
                'to_user_id' => $booking->customer_id,
                'to_user_type' => 'customer',
                'from_user_account' => null,
                'to_user_account' => 'user_wallet'
            ]);
        });
    }
}


//============ Booking Edit ============
if (!function_exists('removeBookingServiceTransactionForDigitalPayment')) {
    /**
     * Admin -$amount [pending_balance]
     * Customer +$amount [wallet_balance]
     * @param $booking
     * @param $removed_total
     * @return void
     */
    function removeBookingServiceTransactionForDigitalPayment($booking, $removed_total): void
    {
        $amount = 0;

        //refund amount calculation
        if (($booking->booking_partial_payments->isEmpty() && $booking['payment_method'] != 'cash_after_service') || $booking->booking_partial_payments->isNotEmpty()) {

            if ($booking->booking_partial_payments->isEmpty()) { //not partial
                $amount = $removed_total;

            } elseif ($booking->booking_partial_payments->isNotEmpty()) { //partial
                //(wallet + digital/offline) or (wallet + CAS)
                $paid_amount = $booking->booking_partial_payments->sum('paid_amount');

                if (($removed_total-$paid_amount) < 0) { //paid more than booking amount
                    $amount = abs($removed_total-$paid_amount);
                }
            }
        }

        if ($amount > 0) {
            $admin_user_id = Admin::where('role_id',1)->first()->id;
            $primary_transaction = Transaction::where('booking_id', $booking['id'])->whereNull('ref_trx_id')->first()?->id;

            DB::transaction(function () use ($booking, $admin_user_id, $amount, $primary_transaction) {
                //Admin transaction
                $account = getUserAccount($admin_user_id, 'admin');
                if ($account->pending_balance >= $amount) {
                    $account->pending_balance -= $amount;
                }
                $account->save();

                $primary_transaction = Transaction::create([
                    'ref_trx_id' => $primary_transaction ?? null,
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['booking_amount'],
                    'debit' => $amount,
                    'credit' => 0,
                    'balance' => $account->pending_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => null,
                    'to_user_account' => ACCOUNT_STATES[0]['value']
                ]);

                //customer transaction
                $user = User::find($booking['customer_id']);
                $user->wallet_balance += $amount;
                $user->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction->id,
                    'booking_id' => $booking['id'],
                    'trx_type' => WALLET_TRX_TYPE['booking_refund'],
                    'debit' => 0,
                    'credit' => $amount,
                    'balance' => $user->wallet_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $booking['customer_id'],
                    'to_user_type' => 'customer',
                    'from_user_account' => 'wallet_balance',
                    'to_user_account' => null
                ]);
            });
        }
    }
}


//============ After Complete Booking ============
if (!function_exists('completeBookingTransactionForDigitalPayment')) {
    function completeBookingTransactionForDigitalPayment($booking): void
    {
        $service_cost = $booking['total_booking_amount'] - $booking['total_tax_amount'] + $booking['total_discount_amount'] + $booking['total_campaign_discount_amount'] + $booking['total_coupon_discount_amount'] - $booking['extra_fee'];

        //cost bearing (promotional)
        $booking_details_amounts = BookingDetailsAmount::where('booking_id', $booking->id)->get();
        $promotional_cost_by_admin = 0;
        $promotional_cost_by_provider = 0;
        foreach($booking_details_amounts as $booking_details_amount) {
            $promotional_cost_by_admin += $booking_details_amount['discount_by_admin'] + $booking_details_amount['coupon_discount_by_admin'] + $booking_details_amount['campaign_discount_by_admin'];
            $promotional_cost_by_provider += $booking_details_amount['discount_by_provider'] + $booking_details_amount['coupon_discount_by_provider'] + $booking_details_amount['campaign_discount_by_provider'];
        }


        $provider_receivable_total_booking_amount = $service_cost - $promotional_cost_by_provider;

        $bookingType = $booking->booking_type == 'subscription';
        if ($bookingType){
            $admin_commission = 0;
        }else{
            //admin commission
            $provider = Provider::find($booking['provider_id']);
            $commission_percentage = $provider->commission_status == 1 ? $provider->commission_percentage : business_config('default_commission')->value;
            $admin_commission = ($provider_receivable_total_booking_amount*$commission_percentage)/100;

            $admin_commission -= $promotional_cost_by_admin;
        }

        //total booking amount (without commission)
        $booking_amount_without_commission = $booking['total_booking_amount'] - $admin_commission - $booking['extra_fee'];

        //user ids (from/to)
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $provider_user_id = get_user_id($booking['provider_id'], PROVIDER_USER_TYPES[0]);

        DB::transaction(function () use ($booking, $admin_user_id, $provider_user_id, $admin_commission, $booking_amount_without_commission, $promotional_cost_by_admin, $promotional_cost_by_provider) {

            $account = getUserAccount($admin_user_id, 'admin');
            $account->pending_balance -= $booking['total_booking_amount'];
            $account->save();

            //Admin transaction (-pending)
            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['pending_amount'],
                'debit' => $booking['total_booking_amount'],
                'credit' => 0,
                'balance' => $account->pending_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => ACCOUNT_STATES[0]['value'],
                'to_user_account' => null
            ]);

            //Provider transactions (+receivable)
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->receivable_balance += $booking_amount_without_commission;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['receivable_amount'],
                'debit' => 0,
                'credit' => $booking_amount_without_commission,
                'balance' => $account->receivable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[3]['value']
            ]);

            if($admin_commission > 0) {
                //Admin transactions for commission (+received)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->received_balance += $admin_commission;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_commission'],
                    'debit' => 0,
                    'credit' => $admin_commission,
                    'balance' => $account->received_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[1]['value'],
                    'to_user_account' => null
                ]);
            }

            //admin extra fee transaction
            if($booking['extra_fee'] > 0) {
                //Admin transactions for extra fee (+received_balance)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->received_balance += $booking['extra_fee'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_extra_fee'],
                    'debit' => 0,
                    'credit' => $booking['extra_fee'],
                    'balance' => $account->received_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[1]['value'],
                    'to_user_account' => null
                ]);
            }

            //Admin transactions (+payable)
            $account = getUserAccount($admin_user_id, 'admin');
            $account->payable_balance += $booking_amount_without_commission;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['payable_amount'],
                'debit' => 0,
                'credit' => $booking_amount_without_commission,
                'balance' => $account->payable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[2]['value'],
                'to_user_account' => null
            ]);

            //expense
            $account = getUserAccount($admin_user_id, 'admin');
            $account->total_expense += $promotional_cost_by_admin;
            $account->save();

            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->total_expense += $promotional_cost_by_provider;
            $account->save();
        });
    }
}
if (!function_exists('completeBookingRepeatTransactionForDigitalPayment')) {
    function completeBookingRepeatTransactionForDigitalPayment($booking): void
    {
        $service_cost = $booking['total_booking_amount'] - $booking['total_tax_amount'] + $booking['total_discount_amount'] + $booking['total_campaign_discount_amount'] + $booking['total_coupon_discount_amount'] - $booking['extra_fee'];

        //cost bearing (promotional)
        $booking_details_amounts = BookingDetailsAmount::where('booking_repeat_id', $booking->id)->get();
        $promotional_cost_by_admin = 0;
        $promotional_cost_by_provider = 0;
        foreach($booking_details_amounts as $booking_details_amount) {
            $promotional_cost_by_admin += $booking_details_amount['discount_by_admin'] + $booking_details_amount['coupon_discount_by_admin'] + $booking_details_amount['campaign_discount_by_admin'];
            $promotional_cost_by_provider += $booking_details_amount['discount_by_provider'] + $booking_details_amount['coupon_discount_by_provider'] + $booking_details_amount['campaign_discount_by_provider'];
        }


        $provider_receivable_total_booking_amount = $service_cost - $promotional_cost_by_provider;

        $bookingType = $booking->booking->booking_type == 'subscription';
        if ($bookingType){
            $admin_commission = 0;
        }else{
            //admin commission
            $provider = Provider::find($booking['provider_id']);
            $commission_percentage = $provider->commission_status == 1 ? $provider->commission_percentage : business_config('default_commission')->value;
            $admin_commission = ($provider_receivable_total_booking_amount*$commission_percentage)/100;

            $admin_commission -= $promotional_cost_by_admin;
        }

        //total booking amount (without commission)
        $booking_amount_without_commission = $booking['total_booking_amount'] - $admin_commission - $booking['extra_fee'];

        //user ids (from/to)
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $provider_user_id = get_user_id($booking['provider_id'], PROVIDER_USER_TYPES[0]);

        DB::transaction(function () use ($booking, $admin_user_id, $provider_user_id, $admin_commission, $booking_amount_without_commission, $promotional_cost_by_admin, $promotional_cost_by_provider) {

            $account = getUserAccount($admin_user_id, 'admin');
            $account->pending_balance -= $booking['total_booking_amount'];
            $account->save();

            //Admin transaction (-pending)
            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => 0,
                'booking_repeat_id' => $booking['id'],
                'trx_type' => TRX_TYPE['pending_amount'],
                'debit' => $booking['total_booking_amount'],
                'credit' => 0,
                'balance' => $account->pending_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => ACCOUNT_STATES[0]['value'],
                'to_user_account' => null
            ]);

            //Provider transactions (+receivable)
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->receivable_balance += $booking_amount_without_commission;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => 0,
                'booking_repeat_id' => $booking['id'],
                'trx_type' => TRX_TYPE['receivable_amount'],
                'debit' => 0,
                'credit' => $booking_amount_without_commission,
                'balance' => $account->receivable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[3]['value']
            ]);

            if($admin_commission > 0) {
                //Admin transactions for commission (+received)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->received_balance += $admin_commission;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => 0,
                    'booking_repeat_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_commission'],
                    'debit' => 0,
                    'credit' => $admin_commission,
                    'balance' => $account->received_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[1]['value'],
                    'to_user_account' => null
                ]);
            }

            //admin extra fee transaction
            if($booking['extra_fee'] > 0) {
                //Admin transactions for extra fee (+received_balance)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->received_balance += $booking['extra_fee'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => 0,
                    'booking_repeat_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_extra_fee'],
                    'debit' => 0,
                    'credit' => $booking['extra_fee'],
                    'balance' => $account->received_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[1]['value'],
                    'to_user_account' => null
                ]);
            }

            //Admin transactions (+payable)
            $account = getUserAccount($admin_user_id, 'admin');
            $account->payable_balance += $booking_amount_without_commission;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => 0,
                'booking_repeat_id' => $booking['id'],
                'trx_type' => TRX_TYPE['payable_amount'],
                'debit' => 0,
                'credit' => $booking_amount_without_commission,
                'balance' => $account->payable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[2]['value'],
                'to_user_account' => null
            ]);

            //expense
            $account = getUserAccount($admin_user_id, 'admin');
            $account->total_expense += $promotional_cost_by_admin;
            $account->save();

            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->total_expense += $promotional_cost_by_provider;
            $account->save();
        });
    }
}

if (!function_exists('completeBookingTransactionForCashAfterService')) {
    function completeBookingTransactionForCashAfterService($booking): void
    {
        $service_cost = $booking['total_booking_amount'] - $booking['total_tax_amount'] + $booking['total_discount_amount'] + $booking['total_campaign_discount_amount'] + $booking['total_coupon_discount_amount'] - $booking['extra_fee'];

        //cost bearing (promotional)
        $booking_details_amounts = BookingDetailsAmount::where('booking_id', $booking->id)->get();
        $promotional_cost_by_admin = 0;
        $promotional_cost_by_provider = 0;
        foreach($booking_details_amounts as $booking_details_amount) {
            $promotional_cost_by_admin += $booking_details_amount['discount_by_admin'] + $booking_details_amount['coupon_discount_by_admin'] + $booking_details_amount['campaign_discount_by_admin'];
            $promotional_cost_by_provider += $booking_details_amount['discount_by_provider'] + $booking_details_amount['coupon_discount_by_provider'] + $booking_details_amount['campaign_discount_by_provider'];
        }

        //total booking amount (for provider)
        $provider_receivable_total_booking_amount = $service_cost - $promotional_cost_by_provider;

        $bookingType = $booking->booking_type == 'subscription';
        if ($bookingType){
            $admin_commission = 0;
        }else{
            //admin commission
            $provider = Provider::find($booking['provider_id']);
            $commission_percentage = $provider->commission_status == 1 ? $provider->commission_percentage : business_config('default_commission')->value;
            $admin_commission = ($provider_receivable_total_booking_amount*$commission_percentage)/100;
            $admin_commission -= $promotional_cost_by_admin;
        }
        //admin promotional cost will be deducted from admin commission

        //total booking amount (without commission)
        $booking_amount_without_commission = $booking['total_booking_amount'] - $admin_commission - $booking['extra_fee'];

        //user ids (from/to)
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $provider_user_id = get_user_id($booking['provider_id'], PROVIDER_USER_TYPES[0]);

        DB::transaction(function () use ($booking, $admin_user_id, $provider_user_id, $admin_commission, $booking_amount_without_commission, $promotional_cost_by_admin, $promotional_cost_by_provider) {

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->received_balance += $booking_amount_without_commission;
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['received_amount'],
                'debit' => 0,
                'credit' => $booking_amount_without_commission,
                'balance' => $account->received_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[1]['value']
            ]);

            if($admin_commission > 0) {
                //Provider transactions (for commission)
                $account = getUserAccount($provider_user_id, PROVIDER);
                $account->payable_balance += $admin_commission;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['payable_commission'],
                    'debit' => 0,
                    'credit' => $admin_commission,
                    'balance' => $account->payable_balance,
                    'from_user_id' => $provider_user_id,
                    'from_user_type' => PROVIDER,
                    'to_user_id' => $provider_user_id,
                    'to_user_type' => PROVIDER,
                    'from_user_account' => ACCOUNT_STATES[2]['value'],
                    'to_user_account' => null
                ]);
            }

            if($booking['extra_fee'] > 0){
                //Provider transactions (for commission)
                $account = getUserAccount($provider_user_id, PROVIDER);
                $account->payable_balance += $booking['extra_fee'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['payable_extra_fee'],
                    'debit' => 0,
                    'credit' => $booking['extra_fee'],
                    'balance' => $account->payable_balance,
                    'from_user_id' => $provider_user_id,
                    'from_user_type' => PROVIDER,
                    'to_user_id' => $provider_user_id,
                    'to_user_type' => PROVIDER,
                    'from_user_account' => ACCOUNT_STATES[2]['value'],
                    'to_user_account' => null
                ]);

            }

            if($admin_commission > 0) {
                //Admin transactions (for commission)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->receivable_balance += $admin_commission;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['receivable_commission'],
                    'debit' => 0,
                    'credit' => $admin_commission,
                    'balance' => $account->receivable_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $provider_user_id,
                    'to_user_type' => PROVIDER,
                    'from_user_account' => ACCOUNT_STATES[3]['value'],
                    'to_user_account' => null
                ]);
            }

            if($booking['extra_fee']){
                //Admin transactions (for commission)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->receivable_balance += $booking['extra_fee'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_extra_fee'],
                    'debit' => 0,
                    'credit' => $booking['extra_fee'],
                    'balance' => $account->receivable_balance,
                    'from_user_id' => $provider_user_id,
                    'from_user_type' => PROVIDER,
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[3]['value'],
                    'to_user_account' => null
                ]);
            }

            //expense (admin)
            $account = getUserAccount($admin_user_id, 'admin');
            $account->total_expense += $promotional_cost_by_admin;
            $account->save();

            //expense (provider)
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->total_expense += $promotional_cost_by_provider;
            $account->save();
        });
    }
}
if (!function_exists('completeBookingRepeatTransactionForCashAfterService')) {
    function completeBookingRepeatTransactionForCashAfterService($booking): void
    {
        $service_cost = $booking['total_booking_amount'] - $booking['total_tax_amount'] + $booking['total_discount_amount'] + $booking['total_campaign_discount_amount'] + $booking['total_coupon_discount_amount'] - $booking['extra_fee'];

        //cost bearing (promotional)
        $booking_details_amounts = BookingDetailsAmount::where('booking_repeat_id', $booking->id)->get();
        $promotional_cost_by_admin = 0;
        $promotional_cost_by_provider = 0;
        foreach($booking_details_amounts as $booking_details_amount) {
            $promotional_cost_by_admin += $booking_details_amount['discount_by_admin'] + $booking_details_amount['coupon_discount_by_admin'] + $booking_details_amount['campaign_discount_by_admin'];
            $promotional_cost_by_provider += $booking_details_amount['discount_by_provider'] + $booking_details_amount['coupon_discount_by_provider'] + $booking_details_amount['campaign_discount_by_provider'];
        }

        //total booking amount (for provider)
        $provider_receivable_total_booking_amount = $service_cost - $promotional_cost_by_provider;

        $bookingType = $booking->booking_type == 'subscription';
        if ($bookingType){
            $admin_commission = 0;
        }else{
            //admin commission
            $provider = Provider::find($booking['provider_id']);
            $commission_percentage = $provider->commission_status == 1 ? $provider->commission_percentage : business_config('default_commission')->value;
            $admin_commission = ($provider_receivable_total_booking_amount*$commission_percentage)/100;
            $admin_commission -= $promotional_cost_by_admin;
        }
        //admin promotional cost will be deducted from admin commission

        //total booking amount (without commission)
        $booking_amount_without_commission = $booking['total_booking_amount'] - $admin_commission - $booking['extra_fee'];

        //user ids (from/to)
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $provider_user_id = get_user_id($booking['provider_id'], PROVIDER_USER_TYPES[0]);

        DB::transaction(function () use ($booking, $admin_user_id, $provider_user_id, $admin_commission, $booking_amount_without_commission, $promotional_cost_by_admin, $promotional_cost_by_provider) {

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->received_balance += $booking_amount_without_commission;
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => 0,
                'booking_repeat_id' => $booking['id'],
                'trx_type' => TRX_TYPE['received_amount'],
                'debit' => 0,
                'credit' => $booking_amount_without_commission,
                'balance' => $account->received_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[1]['value']
            ]);

            if($admin_commission > 0) {
                //Provider transactions (for commission)
                $account = getUserAccount($provider_user_id, PROVIDER);
                $account->payable_balance += $admin_commission;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => 0,
                    'booking_repeat_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['payable_commission'],
                    'debit' => 0,
                    'credit' => $admin_commission,
                    'balance' => $account->payable_balance,
                    'from_user_id' => $provider_user_id,
                    'from_user_type' => PROVIDER,
                    'to_user_id' => $provider_user_id,
                    'to_user_type' => PROVIDER,
                    'from_user_account' => ACCOUNT_STATES[2]['value'],
                    'to_user_account' => null
                ]);
            }

            if($booking['extra_fee'] > 0){
                //Provider transactions (for commission)
                $account = getUserAccount($provider_user_id, PROVIDER);
                $account->payable_balance += $booking['extra_fee'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => 0,
                    'booking_repeat_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['payable_extra_fee'],
                    'debit' => 0,
                    'credit' => $booking['extra_fee'],
                    'balance' => $account->payable_balance,
                    'from_user_id' => $provider_user_id,
                    'from_user_type' => PROVIDER,
                    'to_user_id' => $provider_user_id,
                    'to_user_type' => PROVIDER,
                    'from_user_account' => ACCOUNT_STATES[2]['value'],
                    'to_user_account' => null
                ]);

            }

            if($admin_commission > 0) {
                //Admin transactions (for commission)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->receivable_balance += $admin_commission;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => 0,
                    'booking_repeat_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['receivable_commission'],
                    'debit' => 0,
                    'credit' => $admin_commission,
                    'balance' => $account->receivable_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $provider_user_id,
                    'to_user_type' => PROVIDER,
                    'from_user_account' => ACCOUNT_STATES[3]['value'],
                    'to_user_account' => null
                ]);
            }

            if($booking['extra_fee']){
                //Admin transactions (for commission)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->receivable_balance += $booking['extra_fee'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => 0,
                    'booking_repeat_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_extra_fee'],
                    'debit' => 0,
                    'credit' => $booking['extra_fee'],
                    'balance' => $account->receivable_balance,
                    'from_user_id' => $provider_user_id,
                    'from_user_type' => PROVIDER,
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[3]['value'],
                    'to_user_account' => null
                ]);
            }

            //expense (admin)
            $account = getUserAccount($admin_user_id, 'admin');
            $account->total_expense += $promotional_cost_by_admin;
            $account->save();

            //expense (provider)
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->total_expense += $promotional_cost_by_provider;
            $account->save();
        });
    }
}

if (!function_exists('completeBookingTransactionForPartialCas')) {
    /**
     * //digital
     * Admin (-pending) [customer paid]
     * Admin (+received) [commission]
     * Admin (+payable) [provider earning]
     * Provider (+receivable_balance) [provider earning]
     * // CAS
     * Provider (+received_balance) [provider earning]
     * Provider (+payable_balance) [commission]
     * Provider (+receivable_balance) [commission]
     *
     * @param $booking
     * @return void
     */
    function completeBookingTransactionForPartialCas($booking): void
    {
        $booking_partial_payment = BookingPartialPayment::where('booking_id', $booking->id)->where('paid_with', 'wallet')->first();

        $paid_amount = $booking_partial_payment->paid_amount;
        $due_amount = $booking['total_booking_amount'] - $paid_amount;

        $service_cost = $booking['total_booking_amount'] - $booking['total_tax_amount'] + $booking['total_discount_amount'] + $booking['total_campaign_discount_amount'] + $booking['total_coupon_discount_amount'] - $booking['extra_fee'];

        if($booking['additional_charge'] > 0) {
            $service_cost = $service_cost - $booking['additional_charge'] + $booking['additional_tax_amount'] + $booking['additional_discount_amount'] + $booking['additional_campaign_discount_amount'] -  $booking['total_coupon_discount_amount'];
        }

        //cost bearing (promotional)
        $booking_details_amounts = BookingDetailsAmount::where('booking_id', $booking->id)->get();
        $promotional_cost_by_admin = 0;
        $promotional_cost_by_provider = 0;
        foreach($booking_details_amounts as $booking_details_amount) {
            $promotional_cost_by_admin += $booking_details_amount['discount_by_admin'] + $booking_details_amount['coupon_discount_by_admin'] + $booking_details_amount['campaign_discount_by_admin'];
            $promotional_cost_by_provider += $booking_details_amount['discount_by_provider'] + $booking_details_amount['coupon_discount_by_provider'] + $booking_details_amount['campaign_discount_by_provider'];
        }

        //total booking amount (for provider)
        $provider_receivable_total_booking_amount = $service_cost - $promotional_cost_by_provider;

        //admin commission

        $bookingType = $booking->booking_type == 'subscription';
        if ($bookingType){
            $admin_commission = 0;
        }else{
            //admin commission
            $provider = Provider::find($booking['provider_id']);
            $commission_percentage = $provider->commission_status == 1 ? $provider->commission_percentage : business_config('default_commission')->value;
            $admin_commission = ($provider_receivable_total_booking_amount*$commission_percentage)/100;

            $admin_commission -= $promotional_cost_by_admin;
        }

        //total booking amount (without commission)
        $booking_amount_without_commission = $booking['total_booking_amount'] - $admin_commission - $booking['additional_charge'] - $booking['extra_fee'];

        //user ids (from/to)
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $provider_user_id = get_user_id($booking['provider_id'], PROVIDER_USER_TYPES[0]);

        DB::transaction(function () use ($booking, $admin_user_id, $provider_user_id, $admin_commission, $booking_amount_without_commission, $promotional_cost_by_admin, $promotional_cost_by_provider, $paid_amount, $due_amount) {

            /** digital */
            $account = getUserAccount($admin_user_id, 'admin');
            $account->pending_balance -= $paid_amount;
            $account->save();

            //Admin (-pending) [customer paid]
            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['pending_amount'],
                'debit' => $paid_amount,
                'credit' => 0,
                'balance' => $account->pending_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => ACCOUNT_STATES[0]['value'],
                'to_user_account' => null
            ]);

            if($admin_commission > 0) {
                //Admin (+received) [commission]
                $account = getUserAccount($admin_user_id, 'admin');
                $account->received_balance += ($admin_commission * $paid_amount) / $booking['total_booking_amount'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_commission'],
                    'debit' => 0,
                    'credit' => ($admin_commission * $paid_amount) / $booking['total_booking_amount'],
                    'balance' => $account->received_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[1]['value'],
                    'to_user_account' => null
                ]);
            }

            if($booking['extra_fee'] > 0) {
                //Admin transactions for extra fee (+received_balance)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->received_balance += $booking['extra_fee'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_extra_fee'],
                    'debit' => 0,
                    'credit' => $booking['extra_fee'],
                    'balance' => $account->received_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[1]['value'],
                    'to_user_account' => null
                ]);
            }

            //Admin (+payable) [provider earning]
            $account = getUserAccount($admin_user_id, 'admin');
            $account->payable_balance += ($booking_amount_without_commission*$paid_amount)/$booking['total_booking_amount'];
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['payable_amount'],
                'debit' => 0,
                'credit' => ($booking_amount_without_commission*$paid_amount)/$booking['total_booking_amount'],
                'balance' => $account->payable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[2]['value'],
                'to_user_account' => null
            ]);

            //Provider (+receivable_balance) [provider earning]
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->receivable_balance += ($booking_amount_without_commission*$paid_amount)/$booking['total_booking_amount'];
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['receivable_amount'],
                'debit' => 0,
                'credit' => ($booking_amount_without_commission*$paid_amount)/$booking['total_booking_amount'],
                'balance' => $account->receivable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[3]['value']
            ]);

            /** CAS */
            //Provider (+received_balance) [provider earning]
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->received_balance += ($booking_amount_without_commission*$due_amount)/$booking['total_booking_amount'];
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['received_amount'],
                'debit' => 0,
                'credit' => ($booking_amount_without_commission*$due_amount)/$booking['total_booking_amount'],
                'balance' => $account->received_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[1]['value']
            ]);

            if ($admin_commission > 0) {
                //Provider (+payable_balance) [commission]
                $account = getUserAccount($provider_user_id, PROVIDER);
                $account->payable_balance += ($admin_commission * $due_amount) / $booking['total_booking_amount'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['payable_commission'],
                    'debit' => 0,
                    'credit' => ($admin_commission * $due_amount) / $booking['total_booking_amount'],
                    'balance' => $account->payable_balance,
                    'from_user_id' => $provider_user_id,
                    'from_user_type' => PROVIDER,
                    'to_user_id' => $provider_user_id,
                    'to_user_type' => PROVIDER,
                    'from_user_account' => ACCOUNT_STATES[2]['value'],
                    'to_user_account' => null
                ]);
            }

            if ($admin_commission > 0) {
                //Provider (+receivable_balance) [commission]
                $account = getUserAccount($admin_user_id, 'admin');
                $account->receivable_balance += ($admin_commission * $due_amount) / $booking['total_booking_amount'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['receivable_commission'],
                    'debit' => 0,
                    'credit' => ($admin_commission * $due_amount) / $booking['total_booking_amount'],
                    'balance' => $account->receivable_balance,
                    'from_user_id' => $provider_user_id,
                    'from_user_type' => PROVIDER,
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[3]['value'],
                    'to_user_account' => null
                ]);
            }

            //expense
            getUserAccount($admin_user_id, 'admin')->increment('total_expense', $promotional_cost_by_admin);
            getUserAccount($provider_user_id, PROVIDER)->increment('total_expense', $promotional_cost_by_provider);
        });
    }
} //partially paid

if (!function_exists('completeBookingTransactionForPartialDigital')) {
    /**
     * @param $booking
     * @return void
     */
    function completeBookingTransactionForPartialDigital($booking): void
    {
        $service_cost = $booking['total_booking_amount'] - $booking['total_tax_amount'] + $booking['total_discount_amount'] + $booking['total_campaign_discount_amount'] + $booking['total_coupon_discount_amount'] - $booking['extra_fee'];
        if($booking['additional_charge'] > 0) {
            $service_cost = $service_cost - $booking['additional_charge'] + $booking['additional_tax_amount'] + $booking['additional_discount_amount'] + $booking['additional_campaign_discount_amount'] -  $booking['total_coupon_discount_amount'];
        }

        //cost bearing (promotional)
        $booking_details_amounts = BookingDetailsAmount::where('booking_id', $booking->id)->get();
        $promotional_cost_by_admin = 0;
        $promotional_cost_by_provider = 0;
        foreach($booking_details_amounts as $booking_details_amount) {
            $promotional_cost_by_admin += $booking_details_amount['discount_by_admin'] + $booking_details_amount['coupon_discount_by_admin'] + $booking_details_amount['campaign_discount_by_admin'];
            $promotional_cost_by_provider += $booking_details_amount['discount_by_provider'] + $booking_details_amount['coupon_discount_by_provider'] + $booking_details_amount['campaign_discount_by_provider'];
        }

        //total booking amount (for provider)
        $provider_receivable_total_booking_amount = $service_cost - $promotional_cost_by_provider;

        //admin commission
        $bookingType = $booking->booking_type == 'subscription';
        if ($bookingType){
            $admin_commission = 0;
        }else{
            //admin commission
            $provider = Provider::find($booking['provider_id']);
            $commission_percentage = $provider->commission_status == 1 ? $provider->commission_percentage : business_config('default_commission')->value;
            $admin_commission = ($provider_receivable_total_booking_amount*$commission_percentage)/100;

            $admin_commission -= $promotional_cost_by_admin;
        }

        //total booking amount (without commission)
        $booking_amount_without_commission = $booking['total_booking_amount'] - $admin_commission - $booking['additional_charge'];

        //user ids (from/to)
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $provider_user_id = get_user_id($booking['provider_id'], PROVIDER_USER_TYPES[0]);

        DB::transaction(function () use ($booking, $admin_user_id, $provider_user_id, $admin_commission, $booking_amount_without_commission, $promotional_cost_by_admin, $promotional_cost_by_provider) {

            $account = getUserAccount($admin_user_id, 'admin');
            $account->pending_balance -= ($booking['total_booking_amount'] - $booking['additional_charge']);
            $account->save();

            //Admin transaction (-pending)
            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['pending_amount'],
                'debit' => ($booking['total_booking_amount'] - $booking['additional_charge']),
                'credit' => 0,
                'balance' => $account->pending_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => ACCOUNT_STATES[0]['value'],
                'to_user_account' => null
            ]);

            //Provider transactions (+receivable)
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->receivable_balance += $booking_amount_without_commission;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['receivable_amount'],
                'debit' => 0,
                'credit' => $booking_amount_without_commission,
                'balance' => $account->receivable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[3]['value']
            ]);

            if($admin_commission > 0) {
                //Admin transactions for commission (+received)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->received_balance += $admin_commission;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_commission'],
                    'debit' => 0,
                    'credit' => $admin_commission,
                    'balance' => $account->received_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[1]['value'],
                    'to_user_account' => null
                ]);
            }

            //Admin transactions (+payable)
            $account = getUserAccount($admin_user_id, 'admin');
            $account->payable_balance += $booking_amount_without_commission;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['payable_amount'],
                'debit' => 0,
                'credit' => $booking_amount_without_commission,
                'balance' => $account->payable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[2]['value'],
                'to_user_account' => null
            ]);

            //expense
            $account = getUserAccount($admin_user_id, 'admin');
            $account->total_expense += $promotional_cost_by_admin;
            $account->save();

            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->total_expense += $promotional_cost_by_provider;
            $account->save();
        });
    }
} //partially paid

if (!function_exists('completeBookingTransactionForDigitalPaymentAndExtraService')) {
    function completeBookingTransactionForDigitalPaymentAndExtraService($booking): void
    {
        $service_cost = $booking['total_booking_amount'] - $booking['total_tax_amount'] + $booking['total_discount_amount'] + $booking['total_campaign_discount_amount'] + $booking['total_coupon_discount_amount'];

        //cost bearing (promotional)
        $booking_details_amounts = BookingDetailsAmount::where('booking_id', $booking->id)->get();
        $promotional_cost_by_admin = 0;
        $promotional_cost_by_provider = 0;
        foreach($booking_details_amounts as $booking_details_amount) {
            $promotional_cost_by_admin += $booking_details_amount['discount_by_admin'] + $booking_details_amount['coupon_discount_by_admin'] + $booking_details_amount['campaign_discount_by_admin'];
            $promotional_cost_by_provider += $booking_details_amount['discount_by_provider'] + $booking_details_amount['coupon_discount_by_provider'] + $booking_details_amount['campaign_discount_by_provider'];
        }

        //total booking amount (for provider)
        $provider_receivable_total_booking_amount = $service_cost - $promotional_cost_by_provider;

        $bookingType = $booking->booking_type == 'subscription';
        if ($bookingType){
            $admin_commission = 0;
        }else{
            //admin commission
            $provider = Provider::find($booking['provider_id']);
            $commission_percentage = $provider->commission_status == 1 ? $provider->commission_percentage : business_config('default_commission')->value;
            $admin_commission = ($provider_receivable_total_booking_amount*$commission_percentage)/100;

            $admin_commission -= $promotional_cost_by_admin;
        }

        //total booking amount (without commission)
        $booking_amount_without_commission = $booking['total_booking_amount'] - $admin_commission - $booking['extra_fee'];

        //user ids (from/to)
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $provider_user_id = get_user_id($booking['provider_id'], PROVIDER_USER_TYPES[0]);

        //----------------------------

        DB::transaction(function () use ($booking, $admin_user_id, $provider_user_id, $admin_commission, $booking_amount_without_commission, $promotional_cost_by_admin, $promotional_cost_by_provider) {

            //=============== DIGITAL ===============
            $digitally_paid_booking_amount = $booking['total_booking_amount'] - $booking['additional_charge'];
            $commission_for_digital =  round(($admin_commission * $digitally_paid_booking_amount)/$booking['total_booking_amount'], 2);
            $provider_earning_for_digital = ($booking_amount_without_commission * $digitally_paid_booking_amount)/$booking['total_booking_amount'];


            //Admin transaction (-pending)
            $account = getUserAccount($admin_user_id, 'admin');
            $account->pending_balance -= $digitally_paid_booking_amount;
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['pending_amount'],
                'debit' => $digitally_paid_booking_amount,
                'credit' => 0,
                'balance' => $account->pending_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => ACCOUNT_STATES[0]['value'],
                'to_user_account' => null
            ]);

            //Provider transactions (+receivable)
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->receivable_balance += $provider_earning_for_digital;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['receivable_amount'],
                'debit' => 0,
                'credit' => $provider_earning_for_digital,
                'balance' => $account->receivable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[3]['value']
            ]);

            if($admin_commission > 0) {
                //Admin transactions for commission (+received)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->received_balance += $commission_for_digital;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_commission'],
                    'debit' => 0,
                    'credit' => $commission_for_digital,
                    'balance' => $account->received_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[1]['value'],
                    'to_user_account' => null
                ]);
            }

            //admin extra fee transaction
            if($booking['extra_fee'] > 0) {
                //Admin transactions for extra fee (+received)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->received_balance += $booking['extra_fee'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_extra_fee'],
                    'debit' => 0,
                    'credit' => $booking['extra_fee'],
                    'balance' => $account->received_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[1]['value'],
                    'to_user_account' => null
                ]);
            }

            //Admin transactions (+payable)
            $account = getUserAccount($admin_user_id, 'admin');
            $account->payable_balance += $provider_earning_for_digital;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['payable_amount'],
                'debit' => 0,
                'credit' => $provider_earning_for_digital,
                'balance' => $account->payable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[2]['value'],
                'to_user_account' => null
            ]);

            //=============== CAS ===============
            $due_amount = 0;
            if ($booking?->booking_details_amounts->count() == 1) {
                $due_amount = $booking?->booking_details_amounts->where('paid_with', 'wallet')->first()?->due_amount ?? 0;
            }
            $due_booking_amount = $booking['additional_charge'] + $booking['removed_booking_amount'] + $due_amount;
            $commission_for_cas =  round(($admin_commission * $due_booking_amount)/$booking['total_booking_amount'], 2);
            $provider_earning_for_cas = ($booking_amount_without_commission * $due_booking_amount)/$booking['total_booking_amount'];

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->received_balance += $provider_earning_for_cas;
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['received_amount'],
                'debit' => 0,
                'credit' => $provider_earning_for_cas,
                'balance' => $account->received_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[1]['value']
            ]);

            if($admin_commission > 0) {
                //Provider transactions (for commission)
                $account = getUserAccount($provider_user_id, PROVIDER);
                $account->payable_balance += $commission_for_cas;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['payable_commission'],
                    'debit' => 0,
                    'credit' => $commission_for_cas,
                    'balance' => $account->payable_balance,
                    'from_user_id' => $provider_user_id,
                    'from_user_type' => PROVIDER,
                    'to_user_id' => $provider_user_id,
                    'to_user_type' => PROVIDER,
                    'from_user_account' => ACCOUNT_STATES[2]['value'],
                    'to_user_account' => null
                ]);
            }

            if($admin_commission > 0) {
                //Admin transactions (for commission)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->receivable_balance += $commission_for_cas;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['receivable_commission'],
                    'debit' => 0,
                    'credit' => $commission_for_cas,
                    'balance' => $account->receivable_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $provider_user_id,
                    'to_user_type' => PROVIDER,
                    'from_user_account' => ACCOUNT_STATES[3]['value'],
                    'to_user_account' => null
                ]);
            }

            //expense
            $account = getUserAccount($admin_user_id, 'admin');
            $account->total_expense += $promotional_cost_by_admin;
            $account->save();

            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->total_expense += $promotional_cost_by_provider;
            $account->save();
        });
    }
} //edited booking
if (!function_exists('completeBookingRepeatTransactionForDigitalPaymentAndExtraService')) {
    function completeBookingRepeatTransactionForDigitalPaymentAndExtraService($booking): void
    {
        $service_cost = $booking['total_booking_amount'] - $booking['total_tax_amount'] + $booking['total_discount_amount'] + $booking['total_campaign_discount_amount'] + $booking['total_coupon_discount_amount'];

        //cost bearing (promotional)
        $booking_details_amounts = BookingDetailsAmount::where('booking_repeat_id', $booking->id)->get();
        $promotional_cost_by_admin = 0;
        $promotional_cost_by_provider = 0;
        foreach($booking_details_amounts as $booking_details_amount) {
            $promotional_cost_by_admin += $booking_details_amount['discount_by_admin'] + $booking_details_amount['coupon_discount_by_admin'] + $booking_details_amount['campaign_discount_by_admin'];
            $promotional_cost_by_provider += $booking_details_amount['discount_by_provider'] + $booking_details_amount['coupon_discount_by_provider'] + $booking_details_amount['campaign_discount_by_provider'];
        }

        //total booking amount (for provider)
        $provider_receivable_total_booking_amount = $service_cost - $promotional_cost_by_provider;

        $bookingType = $booking->booking->booking_type == 'subscription';
        if ($bookingType){
            $admin_commission = 0;
        }else{
            //admin commission
            $provider = Provider::find($booking['provider_id']);
            $commission_percentage = $provider->commission_status == 1 ? $provider->commission_percentage : business_config('default_commission')->value;
            $admin_commission = ($provider_receivable_total_booking_amount*$commission_percentage)/100;

            $admin_commission -= $promotional_cost_by_admin;
        }

        //total booking amount (without commission)
        $booking_amount_without_commission = $booking['total_booking_amount'] - $admin_commission - $booking['extra_fee'];

        //user ids (from/to)
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $provider_user_id = get_user_id($booking['provider_id'], PROVIDER_USER_TYPES[0]);

        //----------------------------

        DB::transaction(function () use ($booking, $admin_user_id, $provider_user_id, $admin_commission, $booking_amount_without_commission, $promotional_cost_by_admin, $promotional_cost_by_provider) {

            //=============== DIGITAL ===============
            $digitally_paid_booking_amount = $booking['total_booking_amount'] - $booking['additional_charge'];
            $commission_for_digital =  round(($admin_commission * $digitally_paid_booking_amount)/$booking['total_booking_amount'], 2);
            $provider_earning_for_digital = ($booking_amount_without_commission * $digitally_paid_booking_amount)/$booking['total_booking_amount'];


            //Admin transaction (-pending)
            $account = getUserAccount($admin_user_id, 'admin');
            $account->pending_balance -= $digitally_paid_booking_amount;
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => 0,
                'booking_repeat_id' => $booking['id'],
                'trx_type' => TRX_TYPE['pending_amount'],
                'debit' => $digitally_paid_booking_amount,
                'credit' => 0,
                'balance' => $account->pending_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => ACCOUNT_STATES[0]['value'],
                'to_user_account' => null
            ]);

            //Provider transactions (+receivable)
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->receivable_balance += $provider_earning_for_digital;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => 0,
                'booking_repeat_id' => $booking['id'],
                'trx_type' => TRX_TYPE['receivable_amount'],
                'debit' => 0,
                'credit' => $provider_earning_for_digital,
                'balance' => $account->receivable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[3]['value']
            ]);

            if($admin_commission > 0) {
                //Admin transactions for commission (+received)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->received_balance += $commission_for_digital;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => 0,
                    'booking_repeat_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_commission'],
                    'debit' => 0,
                    'credit' => $commission_for_digital,
                    'balance' => $account->received_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[1]['value'],
                    'to_user_account' => null
                ]);
            }

            //admin extra fee transaction
            if($booking['extra_fee'] > 0) {
                //Admin transactions for extra fee (+received)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->received_balance += $booking['extra_fee'];
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => 0,
                    'booking_repeat_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['received_extra_fee'],
                    'debit' => 0,
                    'credit' => $booking['extra_fee'],
                    'balance' => $account->received_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $admin_user_id,
                    'to_user_type' => 'admin',
                    'from_user_account' => ACCOUNT_STATES[1]['value'],
                    'to_user_account' => null
                ]);
            }

            //Admin transactions (+payable)
            $account = getUserAccount($admin_user_id, 'admin');
            $account->payable_balance += $provider_earning_for_digital;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => 0,
                'booking_repeat_id' => $booking['id'],
                'trx_type' => TRX_TYPE['payable_amount'],
                'debit' => 0,
                'credit' => $provider_earning_for_digital,
                'balance' => $account->payable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[2]['value'],
                'to_user_account' => null
            ]);

            //=============== CAS ===============
            $due_amount = 0;
            if ($booking?->booking_details_amounts->count() == 1) {
                $due_amount = $booking?->booking_details_amounts->where('paid_with', 'wallet')->first()?->due_amount ?? 0;
            }
            $due_booking_amount = $booking['additional_charge'] + $booking['removed_booking_amount'] + $due_amount;
            $commission_for_cas =  round(($admin_commission * $due_booking_amount)/$booking['total_booking_amount'], 2);
            $provider_earning_for_cas = ($booking_amount_without_commission * $due_booking_amount)/$booking['total_booking_amount'];

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->received_balance += $provider_earning_for_cas;
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => 0,
                'booking_repeat_id' => $booking['id'],
                'trx_type' => TRX_TYPE['received_amount'],
                'debit' => 0,
                'credit' => $provider_earning_for_cas,
                'balance' => $account->received_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[1]['value']
            ]);

            if($admin_commission > 0) {
                //Provider transactions (for commission)
                $account = getUserAccount($provider_user_id, PROVIDER);
                $account->payable_balance += $commission_for_cas;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => 0,
                    'booking_repeat_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['payable_commission'],
                    'debit' => 0,
                    'credit' => $commission_for_cas,
                    'balance' => $account->payable_balance,
                    'from_user_id' => $provider_user_id,
                    'from_user_type' => PROVIDER,
                    'to_user_id' => $provider_user_id,
                    'to_user_type' => PROVIDER,
                    'from_user_account' => ACCOUNT_STATES[2]['value'],
                    'to_user_account' => null
                ]);
            }

            if($admin_commission > 0) {
                //Admin transactions (for commission)
                $account = getUserAccount($admin_user_id, 'admin');
                $account->receivable_balance += $commission_for_cas;
                $account->save();

                Transaction::create([
                    'ref_trx_id' => $primary_transaction['id'],
                    'booking_id' => 0,
                    'booking_repeat_id' => $booking['id'],
                    'trx_type' => TRX_TYPE['receivable_commission'],
                    'debit' => 0,
                    'credit' => $commission_for_cas,
                    'balance' => $account->receivable_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $provider_user_id,
                    'to_user_type' => PROVIDER,
                    'from_user_account' => ACCOUNT_STATES[3]['value'],
                    'to_user_account' => null
                ]);
            }

            //expense
            $account = getUserAccount($admin_user_id, 'admin');
            $account->total_expense += $promotional_cost_by_admin;
            $account->save();

            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->total_expense += $promotional_cost_by_provider;
            $account->save();
        });
    }
} //edited booking repeat


//*** (admin) collect cash from provider ***
if (!function_exists('collectCashTransaction')) {
    function collectCashTransaction($provider_id, $collect_amount) {
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $provider_user_id = get_user_id($provider_id, PROVIDER_USER_TYPES[0]);

        DB::transaction(function () use ($collect_amount, $admin_user_id, $provider_user_id) {

            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->payable_balance -= $collect_amount;
            $account->save();

            //Provider transactions
            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['paid_commission'],
                'debit' => $collect_amount,
                'credit' => 0,
                'balance' => $account->payable_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[2]['value'],
                'to_user_account' => null
            ]);

            //Admin transactions
            $account = getUserAccount($admin_user_id, 'admin');
            $account->received_balance += $collect_amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => null,
                'trx_type' => TRX_TYPE['received_commission'],
                'debit' => 0,
                'credit' => $collect_amount,
                'balance' => $account->received_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[1]['value']
            ]);

            //admin transactions
            $account = getUserAccount($admin_user_id, 'admin');
            $account->receivable_balance -= $collect_amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => null,
                'trx_type' => TRX_TYPE['receivable_commission'],
                'debit' => $collect_amount,
                'credit' => 0,
                'balance' => $account->receivable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => ACCOUNT_STATES[3]['value'],
                'to_user_account' => null
            ]);
        });
    }
}


//*** (provider) withdraw from admin ***
if (!function_exists('withdrawRequestTransaction')) {
    function withdrawRequestTransaction($provider_user_id, $withdrawal_amount) {

        DB::transaction(function () use ($withdrawal_amount, $provider_user_id) {

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->receivable_balance -= $withdrawal_amount;
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['withdrawable_amount'],
                'debit' => $withdrawal_amount,
                'credit' => 0,
                'balance' => $account->receivable_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => ACCOUNT_STATES[3]['value'],
                'to_user_account' => null
            ]);

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->pending_balance += $withdrawal_amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => null,
                'trx_type' => TRX_TYPE['pending_amount'],
                'debit' => 0,
                'credit' => $withdrawal_amount,
                'balance' => $account->pending_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[0]['value']
            ]);
        });
    }
}

if (!function_exists('withdrawRequestAcceptTransaction')) {
    function withdrawRequestAcceptTransaction($provider_user_id, $withdrawal_amount) {
        $admin_user_id = Admin::where('role_id',1)->first()->id;

        DB::transaction(function () use ($admin_user_id, $withdrawal_amount, $provider_user_id) {

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->pending_balance -= $withdrawal_amount;
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['pending_amount'],
                'debit' => $withdrawal_amount,
                'credit' => 0,
                'balance' => $account->pending_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => ACCOUNT_STATES[0]['value'],
                'to_user_account' => null
            ]);

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->total_withdrawn += $withdrawal_amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => null,
                'trx_type' => TRX_TYPE['received_amount'],
                'debit' => 0,
                'credit' => $withdrawal_amount,
                'balance' => $account->total_withdrawn,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[4]['value'],
                'to_user_account' => null
            ]);

            //Admin transactions
            $account = getUserAccount($admin_user_id, 'admin');
            $account->payable_balance -= $withdrawal_amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => null,
                'trx_type' => TRX_TYPE['paid_amount'],
                'debit' => $withdrawal_amount,
                'credit' => 0,
                'balance' => $account->payable_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[2]['value']
            ]);
        });
    }
}

if (!function_exists('withdrawRequestAcceptForAdjustTransaction')) {
    function withdrawRequestAcceptForAdjustTransaction($provider_user_id, $withdrawal_amount) {
        $admin_user_id = Admin::where('role_id',1)->first()->id;

        DB::transaction(function () use ($admin_user_id, $withdrawal_amount, $provider_user_id) {

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->receivable_balance -= $withdrawal_amount;
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['withdrawable_amount'],
                'debit' => $withdrawal_amount,
                'credit' => 0,
                'balance' => $account->receivable_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => ACCOUNT_STATES[3]['value'],
                'to_user_account' => null
            ]);

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->total_withdrawn += $withdrawal_amount;
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['received_amount'],
                'debit' => 0,
                'credit' => $withdrawal_amount,
                'balance' => $account->total_withdrawn,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[4]['value'],
                'to_user_account' => null
            ]);

            //Admin transactions
            $account = getUserAccount($admin_user_id, 'admin');
            $account->payable_balance -= $withdrawal_amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => null,
                'trx_type' => TRX_TYPE['paid_amount'],
                'debit' => $withdrawal_amount,
                'credit' => 0,
                'balance' => $account->payable_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[2]['value']
            ]);
        });
    }
}

if (!function_exists('withdrawRequestDenyTransaction')) {
    function withdrawRequestDenyTransaction($provider_user_id, $withdrawal_amount) {

        DB::transaction(function () use ($withdrawal_amount, $provider_user_id) {

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->receivable_balance += $withdrawal_amount;
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['withdrawable_amount'],
                'debit' => 0,
                'credit' => $withdrawal_amount,
                'balance' => $account->receivable_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => ACCOUNT_STATES[3]['value'],
                'to_user_account' => null
            ]);

            //Provider transactions
            $account = getUserAccount($provider_user_id, PROVIDER);
            $account->pending_balance -= $withdrawal_amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction['id'],
                'booking_id' => null,
                'trx_type' => TRX_TYPE['pending_amount'],
                'debit' => $withdrawal_amount,
                'credit' => 0,
                'balance' => $account->pending_balance,
                'from_user_id' => $provider_user_id,
                'from_user_type' => PROVIDER,
                'to_user_id' => $provider_user_id,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[0]['value']
            ]);
        });
    }
}


//*** FUND ***
if (!function_exists('addFundTransaction')) {
    function addFundTransaction($user_id, $amount, $reference) {

        DB::transaction(function () use ($user_id, $amount, $reference) {

            //Provider transactions
            $user = User::where('id', $user_id)->first();
            $user->wallet_balance += $amount;
            $user->save();

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['fund_by_admin'],
                'debit' => 0,
                'credit' => $amount,
                'balance' => $user->wallet_balance,
                'from_user_id' => $user_id,
                'from_user_type' => 'customer',
                'to_user_id' => $user_id,
                'to_user_type' => 'customer',
                'from_user_account' => null,
                'to_user_account' => 'user_wallet',
                'reference_note' => $reference,
            ]);

        });
    }
}

//*** Referral Earn ***
if (!function_exists('referralEarningTransactionDuringRegistration')) {
    function referralEarningTransactionDuringRegistration($user, $amount) {

        DB::transaction(function () use ($user, $amount) {

            //Customer account
            $account = getUserAccount($user->id, CUSTOMER);
            $account->pending_balance += $amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['referral_earning'],
                'debit' => 0,
                'credit' => $amount,
                'balance' => $account->pending_balance,
                'from_user_id' => $user->id,
                'from_user_type' => 'customer',
                'to_user_id' => $user->id,
                'to_user_type' => 'customer',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[0]['value'],
                'reference_note' => $user->ref_code,
            ]);

        });
    }
}

if (!function_exists('referralEarningTransactionAfterBookingComplete')) {
    function referralEarningTransactionAfterBookingComplete($user, $amount) {

        DB::transaction(function () use ($user, $amount) {

            //Customer account (removed from PENDING)
            $account = getUserAccount($user->id, CUSTOMER);
            $account->pending_balance -= $amount;
            $account->save();

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['referral_earning'],
                'debit' => $amount,
                'credit' => 0,
                'balance' => $account->pending_balance,
                'from_user_id' => $user->id,
                'from_user_type' => 'customer',
                'to_user_id' => $user->id,
                'to_user_type' => 'customer',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[0]['value'],
                'reference_note' => $user->ref_code,
            ]);

            //Customer account (add in RECEIVABLE)
            $user = User::where('id', $user->id)->first();
            $user->wallet_balance += $amount;
            $user->save();

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['referral_earning'],
                'debit' => 0,
                'credit' => $amount,
                'balance' => $user->wallet_balance,
                'from_user_id' => $user->id,
                'from_user_type' => 'customer',
                'to_user_id' => $user->id,
                'to_user_type' => 'customer',
                'from_user_account' => null,
                'to_user_account' => 'user_wallet',
                'reference_note' => $user->ref_code,
            ]);

        });
    }
}

if (!function_exists('referralEarningTransactionAfterBookingCompleteFirst')) {
    function referralEarningTransactionAfterBookingCompleteFirst($user, $amount, $bookingId) {

        DB::transaction(function () use ($user, $amount, $bookingId) {

            $admin_user_id = Admin::where('role_id',1)->first()->id;

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $bookingId,
                'trx_type' => TRX_TYPE['referral_discount'],
                'debit' => $amount,
                'credit' => 0,
                'balance' => 0,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => null,
                'reference_note' => $user->ref_code,
            ]);

        });
    }
}

if (!function_exists('referralEarningTransactionAfterBookingRepeatCompleteFirst')) {
    function referralEarningTransactionAfterBookingRepeatCompleteFirst($user, $amount, $bookingId) {

        DB::transaction(function () use ($user, $amount, $bookingId) {

            $admin_user_id = Admin::where('role_id',1)->first()->id;

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => 0,
                'booking_repeat_id' => $bookingId,
                'trx_type' => TRX_TYPE['referral_discount'],
                'debit' => $amount,
                'credit' => 0,
                'balance' => 0,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => null,
                'reference_note' => $user->ref_code,
            ]);

        });
    }
}


//*** Loyalty point ***
/* if (!function_exists('loyaltyPointWalletTransferTransaction')) {
    function loyaltyPointWalletTransferTransaction($user_id, $point, $amount) {

        DB::transaction(function () use ($user_id, $point, $amount) {

            //Customer (loyalty_point update)
            $user = User::find($user_id);
            $user->loyalty_point -= $point;
            $user->wallet_balance += $amount;
            $user->save();

            //transaction
            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['loyalty_point_earning'],
                'debit' => 0,
                'credit' => $amount,
                'balance' => $amount,
                'from_user_id' => $user_id,
                'from_user_type' => 'customer',
                'to_user_id' => $user_id,
                'to_user_type' => 'customer',
                'from_user_account' => null,
                'to_user_account' => 'user_wallet',
                'reference_note' => null,
            ]);

            //transaction
            LoyaltyPointTransaction::create([
                'user_id' => $user_id,
                'debit' => $point,
                'credit' => 0,
                'balance' => $user->loyalty_point,
                'reference' => null,
                'transaction_type' => null,
            ]);
        });
    }
} */

/* if (!function_exists('loyaltyPointTransaction')) {
    function loyaltyPointTransaction($user_id, $point) {

        DB::transaction(function () use ($user_id, $point) {

            //point update
            $user = User::find($user_id);
            $user->loyalty_point += $point;
            $user->save();

            //transaction
            LoyaltyPointTransaction::create([
                'user_id' => $user_id,
                'debit' => 0,
                'credit' => $point,
                'balance' => $user->loyalty_point,
                'reference' => null,
                'transaction_type' => null,
            ]);
        });
    }
}
 */
//*** Add Fund ***
if (!function_exists('addFundTransactions')) {
    function addFundTransactions($customer_user_id, $amount): void
    {
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $bonus = get_add_money_bonus($amount);

        DB::transaction(function () use ($customer_user_id, $amount, $admin_user_id, $bonus) {

            //customer wallet update
            $user = User::find($customer_user_id);
            $user->wallet_balance += $amount;
            $user->save();

            Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['add_fund'],
                'debit' => 0,
                'credit' => $amount,
                'balance' => $user->wallet_balance,
                'from_user_id' => null,
                'from_user_type' => null,
                'to_user_id' => $user->id,
                'to_user_type' => 'customer',
                'from_user_account' => null,
                'to_user_account' => 'user_wallet',
                'reference_note' => null,
            ]);

            if($bonus > 0) {
                $user = User::find($customer_user_id);
                $user->wallet_balance += $bonus;
                $user->save();

                //send notification
                $user = User::find($customer_user_id);
                $title =  Helpers::format_currency($bonus) . ' ' . get_push_notification_message('add_fund_wallet_bonus', 'customer_notification', $user?->current_language_key);
                $permission = isNotificationActive(null, 'wallet', 'notification', 'user');
                $data_info = [
                    'user_name' => $user?->f_name . ' '. $user->l_name
                ];
                if ($user->cm_firebase_token && $title && $permission) {
                    device_notification($user->cm_firebase_token, $title, null, null, null, NOTIFICATION_TYPE['wallet'], null, $customer_user_id, $data_info);
                }

                Transaction::create([
                    'ref_trx_id' => null,
                    'booking_id' => null,
                    'trx_type' => TRX_TYPE['add_fund_bonus'],
                    'debit' => 0,
                    'credit' => $bonus,
                    'balance' => $user->wallet_balance,
                    'from_user_id' => $admin_user_id,
                    'from_user_type' => 'admin',
                    'to_user_id' => $user->id,
                    'to_user_type' => 'customer',
                    'from_user_account' => null,
                    'to_user_account' => 'user_wallet',
                    'reference_note' => null,
                ]);

                //expense
                $account = getUserAccount($admin_user_id, 'admin');
                $account->total_expense += $bonus;
                $account->save();
            }
        });
    }
}


//*** Refund ***
if (!function_exists('refundTransactionForCanceledBooking')) {
    /**
     * @param $booking
     * @return void
     */
    function refundTransactionForCanceledBooking($booking): void
    {
        $refund_amount = 0;
        if ($booking->booking_partial_payments->isEmpty()) {
            //not partial
            if ($booking->payment_method == 'offline_payment' && $booking->is_paid) {
                $refund_amount = $booking['total_booking_amount'];
            } elseif ($booking->payment_method != 'offline_payment' && $booking->payment_method != 'cash_after_service') {
                $refund_amount = $booking['total_booking_amount'];
            }
        } else {
            //partial
            if ($booking->payment_method == 'offline_payment' && $booking->is_paid) {
                $refund_amount = $booking->booking_partial_payments->sum('paid_amount');

            } elseif ($booking->payment_method == 'offline_payment' && !$booking->is_paid) {
                $refund_amount = $booking->booking_partial_payments->where('paid_with', '!=', 'offline_payment')->sum('paid_amount');

            } elseif ($booking->payment_method != 'offline_payment') {
                $refund_amount = $booking->booking_partial_payments->where('paid_with', '!=', 'cash_after_service')->sum('paid_amount');
            }
        }

        if ($refund_amount == 0) return;

        $admin_user_id = Admin::where('role_id',1)->first()->id;
        DB::transaction(function () use ($booking, $admin_user_id, $refund_amount) {
            //Admin transaction
            $account = getUserAccount($admin_user_id, 'admin');
            if ($account->pending_balance >= $refund_amount) {
                $account->pending_balance -= $refund_amount;
            }
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['booking_refund'],
                'debit' => $refund_amount,
                'credit' => 0,
                'balance' => $account->pending_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[0]['value'],
                'to_user_account' => null
            ]);

            //customer transaction (wallet)
            $user = User::find($booking['customer_id']);
            $user->wallet_balance += $refund_amount;
            $user->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction->id,
                'booking_id' => $booking['id'],
                'trx_type' => TRX_TYPE['booking_refund'],
                'debit' => 0,
                'credit' => $refund_amount,
                'balance' => $user->wallet_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $booking->customer_id,
                'to_user_type' => 'customer',
                'from_user_account' => null,
                'to_user_account' => 'user_wallet'
            ]);
            $title =  get_push_notification_message('refund', 'customer_notification', $booking?->customer?->current_language_key);
            if($title && $booking?->customer?->cm_firebase_token){
                device_notification($booking?->customer?->cm_firebase_token, Helpers::format_currency($refund_amount) . ' ' . $title, null, null, $booking->id, 'booking');
            }
        });
    }
}

if (!function_exists('purchaseSubscriptionTransaction')) {
    function purchaseSubscriptionTransaction($amount, $provider_id, $vat)
    {
        $totalAmount = $amount;
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $providerUserId = $provider_id;

        $transactionId = null;

        DB::transaction(function () use ($providerUserId, $totalAmount, $vat, $admin_user_id, &$transactionId) {
            // Admin account update
            $account = getUserAccount($admin_user_id, 'admin');
            $account->received_balance += $totalAmount;
            $account->save();

            $transaction = Transaction::create([
                'ref_trx_id' => null,
                'trx_type' => TRX_TYPE['subscription_purchase'],
                'debit' => 0,
                'credit' => $totalAmount,
                'balance' => $account->received_balance,
                'from_user_id' => $providerUserId,
                'from_user_type' => PROVIDER,
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[1]['value']
            ]);

            $transactionId = $transaction->id;
        });

        return $transactionId;
    }
}
if (!function_exists('purchaseSubscriptionWalletTransaction')) {
    function purchaseSubscriptionWalletTransaction($amount, $provider_id)
    {
        $totalAmount = $amount;
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $providerUserId = $provider_id;

        $transactionId = null;

        DB::transaction(function () use ($providerUserId, $totalAmount, $admin_user_id, &$transactionId) {
            // Admin account update
            $account = getUserAccount($admin_user_id, 'admin');
            $account->received_balance += $totalAmount;
            $account->save();

            $transaction = Transaction::create([
                'ref_trx_id' => null,
                'trx_type' => TRX_TYPE['subscription_purchase'],
                'debit' => 0,
                'credit' => $totalAmount,
                'balance' => $account->received_balance,
                'from_user_id' => $providerUserId,
                'from_user_type' => PROVIDER,
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[1]['value']
            ]);

            $transactionId = $transaction->id;

            
            //Provider transactions
            $providerAccount = getUserAccount($providerUserId, PROVIDER);
            $providerAccount->total_withdrawn += $totalAmount;
            $providerAccount->save();

            Transaction::create([
                'ref_trx_id' => $transactionId,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['received_amount'],
                'debit' => 0,
                'credit' => $totalAmount,
                'balance' => $providerAccount->total_withdrawn,
                'from_user_id' => $providerUserId,
                'from_user_type' => PROVIDER,
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[4]['value'],
                'to_user_account' => null
            ]);
        });

        return $transactionId;
    }
}

if (!function_exists('renewSubscriptionTransaction')) {
    function renewSubscriptionTransaction($amount, $provider_id, $vat)
    {
        $totalAmount = $amount;
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $providerUserId = $provider_id;

        // Initialize a variable to store the transaction ID
        $transactionId = null;

        DB::transaction(function () use ($providerUserId, $totalAmount, $vat, $admin_user_id, &$transactionId) {
            // Admin account update
            $account = getUserAccount($admin_user_id, 'admin');
            $account->received_balance += $totalAmount;
            $account->save();

            // Admin transaction
            $transaction = Transaction::create([
                'ref_trx_id' => null,
                'trx_type' => TRX_TYPE['subscription_renew'],
                'debit' => 0,
                'credit' => $totalAmount,
                'balance' => $account->received_balance,
                'from_user_id' => $providerUserId,
                'from_user_type' => PROVIDER,
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[1]['value']
            ]);

            // Capture the transaction ID
            $transactionId = $transaction->id;
        });

        // Return the transaction ID
        return $transactionId;
    }
}

if (!function_exists('shiftSubscriptionTransaction')) {
    function shiftSubscriptionTransaction($amount, $provider_id, $vat)
    {
        $totalAmount = $amount;
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $providerUserId = $provider_id;

        // Initialize a variable to store the transaction ID
        $transactionId = null;

        DB::transaction(function () use ($providerUserId, $totalAmount, $vat, $admin_user_id, &$transactionId) {
            // Admin account update
            $account = getUserAccount($admin_user_id, 'admin');
            $account->received_balance += $totalAmount;
            $account->save();

            // Admin transaction
            $transaction = Transaction::create([
                'ref_trx_id' => null,
                'trx_type' => TRX_TYPE['subscription_shift'],
                'debit' => 0,
                'credit' => $totalAmount,
                'balance' => $account->received_balance,
                'from_user_id' => $providerUserId,
                'from_user_type' => PROVIDER,
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => null,
                'to_user_account' => ACCOUNT_STATES[1]['value']
            ]);

            // Capture the transaction ID
            $transactionId = $transaction->id;
        });

        // Return the transaction ID
        return $transactionId;
    }
}


if (!function_exists('shiftRefundSubscriptionTransaction')) {
    function shiftRefundSubscriptionTransaction($provider_id, $refundAmount): void
    {
        $admin_user_id = Admin::where('role_id',1)->first()->id;
        $providerUserId = $provider_id;

        DB::transaction(function () use ($providerUserId, $provider_id, $admin_user_id, $refundAmount) {
            //Admin transaction
            $account = getUserAccount($admin_user_id, 'admin');
            if ($account->pending_balance >= $refundAmount) {
                $account->received_balance -= $refundAmount;
            }
            $account->save();

            $primary_transaction = Transaction::create([
                'ref_trx_id' => null,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['subscription_refund'],
                'debit' => $refundAmount,
                'credit' => 0,
                'balance' => $account->received_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $admin_user_id,
                'to_user_type' => 'admin',
                'from_user_account' => ACCOUNT_STATES[1]['value'],
                'to_user_account' => null
            ]);

            //provider transaction (receivable)
            $user = getUserAccount($providerUserId, PROVIDER);
            $user->receivable_balance += $refundAmount;
            $user->save();

            Transaction::create([
                'ref_trx_id' => $primary_transaction->id,
                'booking_id' => null,
                'trx_type' => TRX_TYPE['subscription_refund'],
                'debit' => 0,
                'credit' => $refundAmount,
                'balance' => $user->receivable_balance,
                'from_user_id' => $admin_user_id,
                'from_user_type' => 'admin',
                'to_user_id' => $providerUserId,
                'to_user_type' => PROVIDER,
                'from_user_account' => null,
                'to_user_account' => 'account receivable'
            ]);
        });
    }
}

if (!function_exists('getUserAccount')) {
  function getUserAccount($user_id, $user_type){

        $userAccount = UserAccount::where('user_id', $user_id)->where('user_type', $user_type)->first();

        if(!$userAccount){
            $userAccount = new UserAccount();
            $userAccount->user_id = $user_id;
            $userAccount->user_type = $user_type;
            $userAccount->save();
        }
        return $userAccount;
    }
}

if (!function_exists('updateAdminWallet')) {
    function updateAdminWallet($user_id, $transaction_type, $amount, $balance_type)
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