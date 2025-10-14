<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceBookingIgnoresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_booking_ignores')->delete();
        
        \DB::table('service_booking_ignores')->insert(array (
            0 => 
            array (
                'id' => 1,
                'booking_id' => 1002,
                'provider_id' => 1,
                'created_at' => '2025-09-04 09:07:05',
                'updated_at' => '2025-09-04 09:07:05',
            ),
            1 => 
            array (
                'id' => 2,
                'booking_id' => 1012,
                'provider_id' => 2,
                'created_at' => '2025-09-07 07:03:58',
                'updated_at' => '2025-09-07 07:03:58',
            ),
            2 => 
            array (
                'id' => 3,
                'booking_id' => 1060,
                'provider_id' => 7,
                'created_at' => '2025-09-09 12:20:39',
                'updated_at' => '2025-09-09 12:20:39',
            ),
            3 => 
            array (
                'id' => 4,
                'booking_id' => 1165,
                'provider_id' => 1,
                'created_at' => '2025-10-09 17:26:48',
                'updated_at' => '2025-10-09 17:26:48',
            ),
            4 => 
            array (
                'id' => 5,
                'booking_id' => 1179,
                'provider_id' => 7,
                'created_at' => '2025-10-12 16:37:53',
                'updated_at' => '2025-10-12 16:37:53',
            ),
            5 => 
            array (
                'id' => 6,
                'booking_id' => 1178,
                'provider_id' => 7,
                'created_at' => '2025-10-12 16:41:20',
                'updated_at' => '2025-10-12 16:41:20',
            ),
            6 => 
            array (
                'id' => 7,
                'booking_id' => 1181,
                'provider_id' => 7,
                'created_at' => '2025-10-12 16:47:11',
                'updated_at' => '2025-10-12 16:47:11',
            ),
        ));
        
        
    }
}