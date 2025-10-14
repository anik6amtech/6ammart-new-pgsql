<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideCancellationReasonsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_cancellation_reasons')->delete();
        
        \DB::table('ride_cancellation_reasons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Couldn’t find or contact customer',
                'cancellation_type' => 'accepted_ride',
                'user_type' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:32:17',
                'updated_at' => '2025-09-04 03:32:17',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Customer asked to cancel',
                'cancellation_type' => 'ongoing_ride',
                'user_type' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:32:31',
                'updated_at' => '2025-09-04 03:32:31',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Couldn’t reach to the customer for heavy jam',
                'cancellation_type' => 'accepted_ride',
                'user_type' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:32:42',
                'updated_at' => '2025-09-04 03:32:42',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Customer didn’t arrived at pickup point',
                'cancellation_type' => 'accepted_ride',
                'user_type' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:32:56',
                'updated_at' => '2025-09-04 03:32:56',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Vehicle problem',
                'cancellation_type' => 'ongoing_ride',
                'user_type' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:33:06',
                'updated_at' => '2025-09-04 03:33:06',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Driver asked me to cancel',
                'cancellation_type' => 'ongoing_ride',
                'user_type' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:33:17',
                'updated_at' => '2025-09-04 03:33:17',
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'Driver want extra fare',
                'cancellation_type' => 'ongoing_ride',
                'user_type' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:35:59',
                'updated_at' => '2025-09-04 03:35:59',
            ),
            7 => 
            array (
                'id' => 8,
                'title' => 'Waiting time is high',
                'cancellation_type' => 'accepted_ride',
                'user_type' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:36:10',
                'updated_at' => '2025-09-04 03:36:10',
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'Driver is taking long time to reach pickup point',
                'cancellation_type' => 'accepted_ride',
                'user_type' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:36:26',
                'updated_at' => '2025-09-04 03:36:26',
            ),
            9 => 
            array (
                'id' => 10,
                'title' => 'Selected wrong location',
                'cancellation_type' => 'accepted_ride',
                'user_type' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:38:47',
                'updated_at' => '2025-09-04 03:38:47',
            ),
            10 => 
            array (
                'id' => 11,
                'title' => 'test',
                'cancellation_type' => 'accepted_ride',
                'user_type' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-11 12:28:29',
                'updated_at' => '2025-09-11 12:28:29',
            ),
        ));
        
        
    }
}