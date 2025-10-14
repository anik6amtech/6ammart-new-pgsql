<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PartialPaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('partial_payments')->delete();
        
        \DB::table('partial_payments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'trip_id' => 100041,
                'transaction_ref' => NULL,
                'amount' => 145.26,
                'payment_status' => 'paid',
                'payment_method' => 'wallet',
                'created_at' => '2025-02-08 13:11:44',
                'updated_at' => '2025-02-08 13:11:44',
            ),
            1 => 
            array (
                'id' => 2,
                'trip_id' => 100041,
                'transaction_ref' => NULL,
                'amount' => 8719.79,
                'payment_status' => 'unpaid',
                'payment_method' => 'ssl_commerz',
                'created_at' => '2025-02-08 13:11:44',
                'updated_at' => '2025-02-08 13:11:44',
            ),
        ));
        
        
    }
}