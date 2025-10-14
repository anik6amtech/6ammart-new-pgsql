<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FareBiddingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fare_biddings')->delete();
        
        \DB::table('fare_biddings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ride_request_id' => 1,
                'driver_id' => 1,
                'customer_id' => 8,
                'bid_fare' => '60.00',
                'is_ignored' => 1,
                'created_at' => '2025-09-08 05:58:43',
                'updated_at' => '2025-09-08 06:01:26',
            ),
            1 => 
            array (
                'id' => 2,
                'ride_request_id' => 3,
                'driver_id' => 1,
                'customer_id' => 8,
                'bid_fare' => '473.00',
                'is_ignored' => 1,
                'created_at' => '2025-09-08 06:30:03',
                'updated_at' => '2025-09-08 06:31:16',
            ),
            2 => 
            array (
                'id' => 3,
                'ride_request_id' => 9,
                'driver_id' => 1,
                'customer_id' => 10,
                'bid_fare' => '60.00',
                'is_ignored' => 1,
                'created_at' => '2025-09-08 08:59:21',
                'updated_at' => '2025-09-08 09:01:21',
            ),
            3 => 
            array (
                'id' => 5,
                'ride_request_id' => 14,
                'driver_id' => 10,
                'customer_id' => 21,
                'bid_fare' => '634.00',
                'is_ignored' => 0,
                'created_at' => '2025-09-09 13:11:11',
                'updated_at' => '2025-09-09 13:11:11',
            ),
            4 => 
            array (
                'id' => 6,
                'ride_request_id' => 28,
                'driver_id' => 10,
                'customer_id' => 8,
                'bid_fare' => '44.00',
                'is_ignored' => 0,
                'created_at' => '2025-09-12 05:26:24',
                'updated_at' => '2025-09-12 05:26:24',
            ),
            5 => 
            array (
                'id' => 7,
                'ride_request_id' => 192,
                'driver_id' => 9,
                'customer_id' => 33,
                'bid_fare' => '92.26',
                'is_ignored' => 0,
                'created_at' => '2025-09-29 17:02:49',
                'updated_at' => '2025-09-29 17:02:49',
            ),
            6 => 
            array (
                'id' => 8,
                'ride_request_id' => 213,
                'driver_id' => 1,
                'customer_id' => 21,
                'bid_fare' => '93.44',
                'is_ignored' => 1,
                'created_at' => '2025-09-30 12:55:36',
                'updated_at' => '2025-09-30 12:57:35',
            ),
            7 => 
            array (
                'id' => 9,
                'ride_request_id' => 216,
                'driver_id' => 1,
                'customer_id' => 21,
                'bid_fare' => '72.48',
                'is_ignored' => 0,
                'created_at' => '2025-09-30 14:59:25',
                'updated_at' => '2025-09-30 14:59:25',
            ),
            8 => 
            array (
                'id' => 10,
                'ride_request_id' => 219,
                'driver_id' => 1,
                'customer_id' => 21,
                'bid_fare' => '54.55',
                'is_ignored' => 1,
                'created_at' => '2025-10-04 11:31:37',
                'updated_at' => '2025-10-04 11:33:27',
            ),
            9 => 
            array (
                'id' => 11,
                'ride_request_id' => 242,
                'driver_id' => 9,
                'customer_id' => 33,
                'bid_fare' => '743.36',
                'is_ignored' => 0,
                'created_at' => '2025-10-07 14:58:30',
                'updated_at' => '2025-10-07 14:58:30',
            ),
            10 => 
            array (
                'id' => 12,
                'ride_request_id' => 243,
                'driver_id' => 9,
                'customer_id' => 33,
                'bid_fare' => '753.36',
                'is_ignored' => 0,
                'created_at' => '2025-10-07 14:59:17',
                'updated_at' => '2025-10-07 14:59:17',
            ),
            11 => 
            array (
                'id' => 13,
                'ride_request_id' => 268,
                'driver_id' => 1,
                'customer_id' => 21,
                'bid_fare' => '189.69',
                'is_ignored' => 1,
                'created_at' => '2025-10-08 16:57:01',
                'updated_at' => '2025-10-08 16:57:07',
            ),
            12 => 
            array (
                'id' => 14,
                'ride_request_id' => 273,
                'driver_id' => 9,
                'customer_id' => 33,
                'bid_fare' => '51.42',
                'is_ignored' => 0,
                'created_at' => '2025-10-09 14:40:13',
                'updated_at' => '2025-10-09 14:40:13',
            ),
            13 => 
            array (
                'id' => 16,
                'ride_request_id' => 352,
                'driver_id' => 1,
                'customer_id' => 21,
                'bid_fare' => '188.23',
                'is_ignored' => 1,
                'created_at' => '2025-10-11 15:38:21',
                'updated_at' => '2025-10-11 15:38:29',
            ),
            14 => 
            array (
                'id' => 17,
                'ride_request_id' => 356,
                'driver_id' => 24,
                'customer_id' => 37,
                'bid_fare' => '210.00',
                'is_ignored' => 0,
                'created_at' => '2025-10-11 16:26:22',
                'updated_at' => '2025-10-11 16:26:22',
            ),
            15 => 
            array (
                'id' => 18,
                'ride_request_id' => 365,
                'driver_id' => 9,
                'customer_id' => 33,
                'bid_fare' => '222.73',
                'is_ignored' => 0,
                'created_at' => '2025-10-11 17:29:45',
                'updated_at' => '2025-10-11 17:29:45',
            ),
            16 => 
            array (
                'id' => 19,
                'ride_request_id' => 370,
                'driver_id' => 9,
                'customer_id' => 33,
                'bid_fare' => '207.73',
                'is_ignored' => 0,
                'created_at' => '2025-10-11 17:39:36',
                'updated_at' => '2025-10-11 17:39:36',
            ),
            17 => 
            array (
                'id' => 20,
                'ride_request_id' => 387,
                'driver_id' => 9,
                'customer_id' => 33,
                'bid_fare' => '202.68',
                'is_ignored' => 1,
                'created_at' => '2025-10-12 11:27:30',
                'updated_at' => '2025-10-12 11:27:56',
            ),
            18 => 
            array (
                'id' => 23,
                'ride_request_id' => 435,
                'driver_id' => 24,
                'customer_id' => 37,
                'bid_fare' => '265.00',
                'is_ignored' => 0,
                'created_at' => '2025-10-12 15:59:35',
                'updated_at' => '2025-10-12 15:59:35',
            ),
            19 => 
            array (
                'id' => 24,
                'ride_request_id' => 438,
                'driver_id' => 24,
                'customer_id' => 37,
                'bid_fare' => '185.81',
                'is_ignored' => 0,
                'created_at' => '2025-10-12 16:13:48',
                'updated_at' => '2025-10-12 16:13:48',
            ),
        ));
        
        
    }
}