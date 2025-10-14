<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceBookingOfflinePaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_booking_offline_payments')->delete();
        
        \DB::table('service_booking_offline_payments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'booking_id' => 1015,
                'method_name' => 'Bank',
                'customer_information' => '[]',
                'offline_payment_id' => 1,
                'payment_status' => 'pending',
                'denied_note' => NULL,
                'customer_note' => NULL,
                'created_at' => '2025-09-07 07:47:11',
                'updated_at' => '2025-09-07 07:47:11',
            ),
            1 => 
            array (
                'id' => 2,
                'booking_id' => 1036,
                'method_name' => 'Bank',
                'customer_information' => '[]',
                'offline_payment_id' => 1,
                'payment_status' => 'pending',
                'denied_note' => NULL,
                'customer_note' => NULL,
                'created_at' => '2025-09-07 11:00:43',
                'updated_at' => '2025-09-07 11:00:43',
            ),
        ));
        
        
    }
}