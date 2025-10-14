<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceBookingPartialPaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_booking_partial_payments')->delete();
        
        \DB::table('service_booking_partial_payments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => NULL,
                'booking_id' => 1136,
                'paid_with' => 'wallet',
                'paid_amount' => '110.000',
                'due_amount' => '2650.000',
                'created_at' => '2025-10-05 12:06:39',
                'updated_at' => '2025-10-05 12:06:39',
            ),
        ));
        
        
    }
}