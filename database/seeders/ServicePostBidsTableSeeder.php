<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicePostBidsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_post_bids')->delete();
        
        \DB::table('service_post_bids')->insert(array (
            0 => 
            array (
                'id' => 1,
                'offered_price' => '120.00',
                'provider_note' => 'Request Accepted',
                'status' => 'accepted',
                'post_id' => 3,
                'provider_id' => 7,
                'created_at' => '2025-09-09 14:45:36',
                'updated_at' => '2025-09-09 14:46:02',
            ),
            1 => 
            array (
                'id' => 2,
                'offered_price' => '1000.00',
                'provider_note' => NULL,
                'status' => 'accepted',
                'post_id' => 7,
                'provider_id' => 1,
                'created_at' => '2025-09-17 09:51:27',
                'updated_at' => '2025-09-17 12:39:03',
            ),
            2 => 
            array (
                'id' => 3,
                'offered_price' => '5000.00',
                'provider_note' => 'test',
                'status' => 'pending',
                'post_id' => 8,
                'provider_id' => 8,
                'created_at' => '2025-09-22 17:17:56',
                'updated_at' => '2025-09-22 17:17:56',
            ),
            3 => 
            array (
                'id' => 4,
                'offered_price' => '4554.00',
                'provider_note' => '54364645gdhfghgfhjhgfjghj',
                'status' => 'accepted',
                'post_id' => 10,
                'provider_id' => 7,
                'created_at' => '2025-09-23 16:25:02',
                'updated_at' => '2025-09-23 17:15:47',
            ),
            4 => 
            array (
                'id' => 5,
                'offered_price' => '5000.00',
                'provider_note' => 'test',
                'status' => 'pending',
                'post_id' => 9,
                'provider_id' => 8,
                'created_at' => '2025-09-23 16:25:55',
                'updated_at' => '2025-09-23 16:25:55',
            ),
            5 => 
            array (
                'id' => 6,
                'offered_price' => '500.00',
                'provider_note' => 'tt',
                'status' => 'pending',
                'post_id' => 10,
                'provider_id' => 8,
                'created_at' => '2025-09-23 16:27:30',
                'updated_at' => '2025-09-23 16:27:30',
            ),
            6 => 
            array (
                'id' => 7,
                'offered_price' => '2433.00',
                'provider_note' => NULL,
                'status' => 'pending',
                'post_id' => 11,
                'provider_id' => 7,
                'created_at' => '2025-09-23 18:04:46',
                'updated_at' => '2025-09-23 18:04:46',
            ),
            7 => 
            array (
                'id' => 8,
                'offered_price' => '1000.00',
                'provider_note' => NULL,
                'status' => 'accepted',
                'post_id' => 15,
                'provider_id' => 1,
                'created_at' => '2025-09-28 16:15:15',
                'updated_at' => '2025-09-28 16:54:59',
            ),
            8 => 
            array (
                'id' => 9,
                'offered_price' => '1000.00',
                'provider_note' => 'test',
                'status' => 'accepted',
                'post_id' => 17,
                'provider_id' => 1,
                'created_at' => '2025-09-29 17:20:36',
                'updated_at' => '2025-09-29 17:21:06',
            ),
            9 => 
            array (
                'id' => 10,
                'offered_price' => '666.00',
                'provider_note' => 'rtert',
                'status' => 'accepted',
                'post_id' => 20,
                'provider_id' => 8,
                'created_at' => '2025-10-05 15:51:52',
                'updated_at' => '2025-10-05 15:52:28',
            ),
            10 => 
            array (
                'id' => 11,
                'offered_price' => '434.00',
                'provider_note' => '4334',
                'status' => 'accepted',
                'post_id' => 21,
                'provider_id' => 8,
                'created_at' => '2025-10-05 16:45:06',
                'updated_at' => '2025-10-05 17:14:26',
            ),
            11 => 
            array (
                'id' => 12,
                'offered_price' => '5000.00',
                'provider_note' => NULL,
                'status' => 'accepted',
                'post_id' => 22,
                'provider_id' => 8,
                'created_at' => '2025-10-07 14:06:47',
                'updated_at' => '2025-10-07 14:07:01',
            ),
            12 => 
            array (
                'id' => 13,
                'offered_price' => '500.00',
                'provider_note' => NULL,
                'status' => 'accepted',
                'post_id' => 24,
                'provider_id' => 8,
                'created_at' => '2025-10-12 12:41:43',
                'updated_at' => '2025-10-12 12:41:57',
            ),
        ));
        
        
    }
}