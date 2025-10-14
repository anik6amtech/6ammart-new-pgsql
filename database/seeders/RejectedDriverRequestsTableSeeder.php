<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RejectedDriverRequestsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rejected_driver_requests')->delete();
        
        \DB::table('rejected_driver_requests')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ride_request_id' => 13,
                'user_id' => 10,
                'created_at' => '2025-09-09 13:07:11',
                'updated_at' => '2025-09-09 13:07:11',
            ),
            1 => 
            array (
                'id' => 2,
                'ride_request_id' => 62,
                'user_id' => 9,
                'created_at' => '2025-09-16 11:21:06',
                'updated_at' => '2025-09-16 11:21:06',
            ),
            2 => 
            array (
                'id' => 3,
                'ride_request_id' => 293,
                'user_id' => 9,
                'created_at' => '2025-10-10 10:30:52',
                'updated_at' => '2025-10-10 10:30:52',
            ),
            3 => 
            array (
                'id' => 4,
                'ride_request_id' => 369,
                'user_id' => 9,
                'created_at' => '2025-10-11 17:37:50',
                'updated_at' => '2025-10-11 17:37:50',
            ),
            4 => 
            array (
                'id' => 5,
                'ride_request_id' => 388,
                'user_id' => 24,
                'created_at' => '2025-10-12 11:48:08',
                'updated_at' => '2025-10-12 11:48:08',
            ),
            5 => 
            array (
                'id' => 6,
                'ride_request_id' => 389,
                'user_id' => 24,
                'created_at' => '2025-10-12 11:57:24',
                'updated_at' => '2025-10-12 11:57:24',
            ),
            6 => 
            array (
                'id' => 7,
                'ride_request_id' => 404,
                'user_id' => 9,
                'created_at' => '2025-10-12 13:11:51',
                'updated_at' => '2025-10-12 13:11:51',
            ),
            7 => 
            array (
                'id' => 8,
                'ride_request_id' => 427,
                'user_id' => 2,
                'created_at' => '2025-10-12 15:23:42',
                'updated_at' => '2025-10-12 15:23:42',
            ),
        ));
        
        
    }
}