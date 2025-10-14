<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderPaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_payments')->delete();
        
        \DB::table('order_payments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'order_id' => 100066,
                'transaction_ref' => NULL,
                'amount' => '205.00',
                'payment_status' => 'paid',
                'payment_method' => 'wallet',
                'created_at' => '2023-08-22 11:00:19',
                'updated_at' => '2023-08-22 11:00:19',
            ),
            1 => 
            array (
                'id' => 2,
                'order_id' => 100066,
                'transaction_ref' => NULL,
                'amount' => '3060.22',
                'payment_status' => 'unpaid',
                'payment_method' => 'digital_payment',
                'created_at' => '2023-08-22 11:00:19',
                'updated_at' => '2023-08-22 11:00:19',
            ),
            2 => 
            array (
                'id' => 3,
                'order_id' => 100068,
                'transaction_ref' => NULL,
                'amount' => '217.00',
                'payment_status' => 'paid',
                'payment_method' => 'wallet',
                'created_at' => '2023-08-22 11:27:42',
                'updated_at' => '2023-08-22 11:27:42',
            ),
            3 => 
            array (
                'id' => 4,
                'order_id' => 100068,
                'transaction_ref' => NULL,
                'amount' => '2838.15',
                'payment_status' => 'paid',
                'payment_method' => 'ssl_commerz',
                'created_at' => '2023-08-22 11:27:42',
                'updated_at' => '2023-08-22 11:28:42',
            ),
            4 => 
            array (
                'id' => 5,
                'order_id' => 100069,
                'transaction_ref' => NULL,
                'amount' => '220.00',
                'payment_status' => 'paid',
                'payment_method' => 'wallet',
                'created_at' => '2023-08-22 12:00:41',
                'updated_at' => '2023-08-22 12:00:41',
            ),
            5 => 
            array (
                'id' => 6,
                'order_id' => 100069,
                'transaction_ref' => NULL,
                'amount' => '557.00',
                'payment_status' => 'unpaid',
                'payment_method' => 'cash_on_delivery',
                'created_at' => '2023-08-22 12:00:41',
                'updated_at' => '2023-08-22 12:00:41',
            ),
        ));
        
        
    }
}