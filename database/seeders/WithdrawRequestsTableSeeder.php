<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WithdrawRequestsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('withdraw_requests')->delete();

        \DB::table('withdraw_requests')->insert(array (
            0 =>
            array (
                'id' => 1,
                'vendor_id' => 3,
                'admin_id' => NULL,
                'transaction_note' => NULL,
                'amount' => '3000.000',
                'approved' => 0,
                'created_at' => '2022-09-29 15:13:30',
                'updated_at' => '2022-09-29 15:13:30',
                'delivery_man_id' => NULL,
                'withdrawal_method_id' => NULL,
                'withdrawal_method_fields' => NULL,
                'type' => 'manual',
                'user_note' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'vendor_id' => 3,
                'admin_id' => NULL,
                'transaction_note' => NULL,
                'amount' => '400.000',
                'approved' => 0,
                'created_at' => '2022-09-29 15:13:36',
                'updated_at' => '2022-09-29 15:13:36',
                'delivery_man_id' => NULL,
                'withdrawal_method_id' => NULL,
                'withdrawal_method_fields' => NULL,
                'type' => 'manual',
                'user_note' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'vendor_id' => 3,
                'admin_id' => NULL,
                'transaction_note' => NULL,
                'amount' => '5000.000',
                'approved' => 1,
                'created_at' => '2022-09-29 15:13:42',
                'updated_at' => '2022-09-29 15:14:38',
                'delivery_man_id' => NULL,
                'withdrawal_method_id' => NULL,
                'withdrawal_method_fields' => NULL,
                'type' => 'manual',
                'user_note' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'vendor_id' => 3,
                'admin_id' => NULL,
                'transaction_note' => NULL,
                'amount' => '700.000',
                'approved' => 0,
                'created_at' => '2022-09-29 15:13:51',
                'updated_at' => '2022-09-29 15:13:51',
                'delivery_man_id' => NULL,
                'withdrawal_method_id' => NULL,
                'withdrawal_method_fields' => NULL,
                'type' => 'manual',
                'user_note' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'vendor_id' => 3,
                'admin_id' => NULL,
                'transaction_note' => NULL,
                'amount' => '3500.000',
                'approved' => 1,
                'created_at' => '2022-09-29 15:14:03',
                'updated_at' => '2022-09-29 15:14:26',
                'delivery_man_id' => NULL,
                'withdrawal_method_id' => NULL,
                'withdrawal_method_fields' => NULL,
                'type' => 'manual',
                'user_note' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'vendor_id' => 1,
                'admin_id' => NULL,
                'transaction_note' => 'Store_wallet_adjustment_partial',
                'amount' => '736.360',
                'approved' => 1,
                'created_at' => '2023-11-27 13:46:23',
                'updated_at' => '2023-11-27 13:46:23',
                'delivery_man_id' => NULL,
                'withdrawal_method_id' => NULL,
                'withdrawal_method_fields' => NULL,
                'type' => 'adjustment',
                'user_note' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'vendor_id' => NULL,
                'admin_id' => NULL,
                'transaction_note' => 'fghg',
                'amount' => '123.000',
                'approved' => 1,
                'created_at' => '2025-10-08 17:06:15',
                'updated_at' => '2025-10-08 17:07:07',
                'delivery_man_id' => 9,
                'withdrawal_method_id' => 1,
                'withdrawal_method_fields' => '{"account_name":"Chhf","account_number":"3535","email":"Yd@g.com"}',
                'type' => 'manual',
                'user_note' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'vendor_id' => NULL,
                'admin_id' => NULL,
                'transaction_note' => 'sdgfsdgfsa',
                'amount' => '11.000',
                'approved' => 1,
                'created_at' => '2025-10-09 15:17:37',
                'updated_at' => '2025-10-09 15:18:20',
                'delivery_man_id' => 9,
                'withdrawal_method_id' => 1,
                'withdrawal_method_fields' => '{"account_name":"Chhf","account_number":"3535","email":"Yd@g.com"}',
                'type' => 'manual',
                'user_note' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'vendor_id' => NULL,
                'admin_id' => NULL,
                'transaction_note' => NULL,
                'amount' => '3476.200',
                'approved' => 0,
                'created_at' => '2025-10-09 19:42:09',
                'updated_at' => '2025-10-09 19:42:09',
                'delivery_man_id' => 1,
                'withdrawal_method_id' => 1,
                'withdrawal_method_fields' => '{"account_name":"Ali 123","account_number":"083868658"}',
                'type' => 'manual',
                'user_note' => NULL,
            ),
        ));


    }
}
