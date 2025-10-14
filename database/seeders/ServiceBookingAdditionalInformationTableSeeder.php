<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceBookingAdditionalInformationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_booking_additional_information')->delete();
        
        \DB::table('service_booking_additional_information')->insert(array (
            0 => 
            array (
                'id' => 1,
                'booking_id' => 1104,
                'key' => 'booking_deny_note',
                'value' => 'what',
                'created_at' => '2025-09-23 11:01:03',
                'updated_at' => '2025-09-23 11:01:03',
            ),
        ));
        
        
    }
}