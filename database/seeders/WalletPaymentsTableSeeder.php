<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WalletPaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('wallet_payments')->delete();
        
        \DB::table('wallet_payments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 5,
                'transaction_ref' => NULL,
                'amount' => '5.00',
                'payment_status' => 'success',
                'payment_method' => 'ssl_commerz',
                'created_at' => '2023-08-22 10:54:21',
                'updated_at' => '2023-08-22 10:55:13',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 5,
                'transaction_ref' => NULL,
                'amount' => '8.00',
                'payment_status' => 'success',
                'payment_method' => 'ssl_commerz',
                'created_at' => '2023-08-22 11:00:33',
                'updated_at' => '2023-08-22 11:01:05',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 5,
                'transaction_ref' => NULL,
                'amount' => '8.00',
                'payment_status' => 'pending',
                'payment_method' => 'bkash',
                'created_at' => '2023-08-22 11:15:11',
                'updated_at' => '2023-08-22 11:15:11',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 5,
                'transaction_ref' => NULL,
                'amount' => '8.00',
                'payment_status' => 'pending',
                'payment_method' => 'bkash',
                'created_at' => '2023-08-22 11:16:51',
                'updated_at' => '2023-08-22 11:16:51',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 5,
                'transaction_ref' => NULL,
                'amount' => '190.00',
                'payment_status' => 'success',
                'payment_method' => 'ssl_commerz',
                'created_at' => '2023-08-22 11:21:45',
                'updated_at' => '2023-08-22 11:22:32',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 5,
                'transaction_ref' => NULL,
                'amount' => '200.00',
                'payment_status' => 'success',
                'payment_method' => 'ssl_commerz',
                'created_at' => '2023-08-22 11:49:07',
                'updated_at' => '2023-08-22 11:50:11',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 5,
                'transaction_ref' => NULL,
                'amount' => '50.00',
                'payment_status' => 'pending',
                'payment_method' => 'bkash',
                'created_at' => '2023-08-22 12:16:15',
                'updated_at' => '2023-08-22 12:16:15',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 5,
                'transaction_ref' => NULL,
                'amount' => '20.00',
                'payment_status' => 'success',
                'payment_method' => 'ssl_commerz',
                'created_at' => '2023-08-22 12:16:42',
                'updated_at' => '2023-08-22 12:17:32',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 5,
                'transaction_ref' => NULL,
                'amount' => '80.00',
                'payment_status' => 'success',
                'payment_method' => 'ssl_commerz',
                'created_at' => '2023-08-22 12:18:00',
                'updated_at' => '2023-08-22 12:18:41',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 8,
                'transaction_ref' => NULL,
                'amount' => '5000.00',
                'payment_status' => 'success',
                'payment_method' => 'stripe',
                'created_at' => '2024-01-02 16:51:47',
                'updated_at' => '2024-01-02 16:52:29',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 26,
                'transaction_ref' => NULL,
                'amount' => '200.00',
                'payment_status' => 'pending',
                'payment_method' => 'stripe',
                'created_at' => '2025-02-08 15:20:32',
                'updated_at' => '2025-02-08 15:20:32',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 33,
                'transaction_ref' => NULL,
                'amount' => '5000.00',
                'payment_status' => 'success',
                'payment_method' => 'ssl_commerz',
                'created_at' => '2025-09-15 17:29:37',
                'updated_at' => '2025-09-15 17:29:54',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 32,
                'transaction_ref' => NULL,
                'amount' => '100.00',
                'payment_status' => 'success',
                'payment_method' => 'ssl_commerz',
                'created_at' => '2025-10-05 11:41:39',
                'updated_at' => '2025-10-05 11:41:50',
            ),
        ));
        
        
    }
}