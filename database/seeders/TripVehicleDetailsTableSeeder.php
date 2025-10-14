<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TripVehicleDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('trip_vehicle_details')->delete();
        
        \DB::table('trip_vehicle_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'trip_id' => 100008,
                'vehicle_id' => 3,
                'trip_details_id' => 13,
                'vehicle_identity_id' => 5,
                'vehicle_driver_id' => 7,
                'estimated_trip_end_time' => '2025-02-07 17:24:00',
                'is_completed' => 1,
                'created_at' => '2025-02-06 16:40:21',
                'updated_at' => '2025-02-06 16:40:42',
            ),
            1 => 
            array (
                'id' => 2,
                'trip_id' => 100001,
                'vehicle_id' => 19,
                'trip_details_id' => 2,
                'vehicle_identity_id' => 49,
                'vehicle_driver_id' => 6,
                'estimated_trip_end_time' => '2025-02-07 12:14:00',
                'is_completed' => 0,
                'created_at' => '2025-02-06 16:42:36',
                'updated_at' => '2025-02-06 16:43:01',
            ),
            2 => 
            array (
                'id' => 3,
                'trip_id' => 100001,
                'vehicle_id' => 3,
                'trip_details_id' => 3,
                'vehicle_identity_id' => 8,
                'vehicle_driver_id' => 9,
                'estimated_trip_end_time' => '2025-02-07 12:14:00',
                'is_completed' => 0,
                'created_at' => '2025-02-06 16:42:41',
                'updated_at' => '2025-02-06 16:43:01',
            ),
            3 => 
            array (
                'id' => 4,
                'trip_id' => 100000,
                'vehicle_id' => 3,
                'trip_details_id' => 1,
                'vehicle_identity_id' => 10,
                'vehicle_driver_id' => 8,
                'estimated_trip_end_time' => '2025-02-07 12:10:00',
                'is_completed' => 0,
                'created_at' => '2025-02-06 16:44:51',
                'updated_at' => '2025-02-06 16:45:00',
            ),
            4 => 
            array (
                'id' => 5,
                'trip_id' => 100016,
                'vehicle_id' => 3,
                'trip_details_id' => 21,
                'vehicle_identity_id' => 11,
                'vehicle_driver_id' => NULL,
                'estimated_trip_end_time' => '2025-02-06 16:32:12',
                'is_completed' => 0,
                'created_at' => '2025-02-06 16:45:57',
                'updated_at' => '2025-02-06 16:45:57',
            ),
            5 => 
            array (
                'id' => 6,
                'trip_id' => 100019,
                'vehicle_id' => 19,
                'trip_details_id' => 24,
                'vehicle_identity_id' => 49,
                'vehicle_driver_id' => 10,
                'estimated_trip_end_time' => '2025-02-06 17:37:13',
                'is_completed' => 0,
                'created_at' => '2025-02-06 16:46:40',
                'updated_at' => '2025-02-06 16:46:46',
            ),
            6 => 
            array (
                'id' => 7,
                'trip_id' => 100014,
                'vehicle_id' => 15,
                'trip_details_id' => 19,
                'vehicle_identity_id' => 44,
                'vehicle_driver_id' => 10,
                'estimated_trip_end_time' => '2025-02-07 01:29:45',
                'is_completed' => 0,
                'created_at' => '2025-02-06 16:47:28',
                'updated_at' => '2025-02-06 16:47:35',
            ),
            7 => 
            array (
                'id' => 8,
                'trip_id' => 100013,
                'vehicle_id' => 17,
                'trip_details_id' => 18,
                'vehicle_identity_id' => 47,
                'vehicle_driver_id' => 8,
                'estimated_trip_end_time' => '2025-02-06 21:28:30',
                'is_completed' => 0,
                'created_at' => '2025-02-06 16:48:01',
                'updated_at' => '2025-02-06 16:48:07',
            ),
            8 => 
            array (
                'id' => 9,
                'trip_id' => 100023,
                'vehicle_id' => 19,
                'trip_details_id' => 28,
                'vehicle_identity_id' => 49,
                'vehicle_driver_id' => 10,
                'estimated_trip_end_time' => '2025-02-14 16:49:00',
                'is_completed' => 1,
                'created_at' => '2025-02-06 16:53:17',
                'updated_at' => '2025-02-06 16:53:35',
            ),
            9 => 
            array (
                'id' => 10,
                'trip_id' => 100015,
                'vehicle_id' => 16,
                'trip_details_id' => 20,
                'vehicle_identity_id' => 45,
                'vehicle_driver_id' => 21,
                'estimated_trip_end_time' => '2025-02-06 17:31:33',
                'is_completed' => 1,
                'created_at' => '2025-02-06 16:53:56',
                'updated_at' => '2025-02-06 16:54:14',
            ),
            10 => 
            array (
                'id' => 11,
                'trip_id' => 100024,
                'vehicle_id' => 16,
                'trip_details_id' => 29,
                'vehicle_identity_id' => 45,
                'vehicle_driver_id' => 20,
                'estimated_trip_end_time' => '2025-02-06 18:52:00',
                'is_completed' => 1,
                'created_at' => '2025-02-06 16:56:28',
                'updated_at' => '2025-02-06 16:56:41',
            ),
            11 => 
            array (
                'id' => 12,
                'trip_id' => 100022,
                'vehicle_id' => 4,
                'trip_details_id' => 27,
                'vehicle_identity_id' => 13,
                'vehicle_driver_id' => 8,
                'estimated_trip_end_time' => '2025-02-08 17:49:00',
                'is_completed' => 0,
                'created_at' => '2025-02-06 16:57:21',
                'updated_at' => '2025-02-06 16:57:26',
            ),
            12 => 
            array (
                'id' => 13,
                'trip_id' => 100012,
                'vehicle_id' => 19,
                'trip_details_id' => 17,
                'vehicle_identity_id' => 49,
                'vehicle_driver_id' => 8,
                'estimated_trip_end_time' => '2025-02-06 17:27:38',
                'is_completed' => 1,
                'created_at' => '2025-02-06 16:59:00',
                'updated_at' => '2025-02-06 16:59:17',
            ),
            13 => 
            array (
                'id' => 14,
                'trip_id' => 100025,
                'vehicle_id' => 18,
                'trip_details_id' => 30,
                'vehicle_identity_id' => 48,
                'vehicle_driver_id' => 9,
                'estimated_trip_end_time' => '2025-02-07 14:01:00',
                'is_completed' => 1,
                'created_at' => '2025-02-06 17:02:43',
                'updated_at' => '2025-02-06 17:03:20',
            ),
            14 => 
            array (
                'id' => 15,
                'trip_id' => 100029,
                'vehicle_id' => 9,
                'trip_details_id' => 34,
                'vehicle_identity_id' => 25,
                'vehicle_driver_id' => 10,
                'estimated_trip_end_time' => '2025-02-07 13:10:00',
                'is_completed' => 0,
                'created_at' => '2025-02-06 17:11:31',
                'updated_at' => '2025-02-06 17:11:58',
            ),
            15 => 
            array (
                'id' => 16,
                'trip_id' => 100029,
                'vehicle_id' => 18,
                'trip_details_id' => 35,
                'vehicle_identity_id' => 48,
                'vehicle_driver_id' => 7,
                'estimated_trip_end_time' => '2025-02-07 13:10:00',
                'is_completed' => 0,
                'created_at' => '2025-02-06 17:11:35',
                'updated_at' => '2025-02-06 17:11:58',
            ),
            16 => 
            array (
                'id' => 17,
                'trip_id' => 100030,
                'vehicle_id' => 16,
                'trip_details_id' => 36,
                'vehicle_identity_id' => 45,
                'vehicle_driver_id' => 20,
                'estimated_trip_end_time' => '2025-02-06 18:18:05',
                'is_completed' => 1,
                'created_at' => '2025-02-06 17:18:30',
                'updated_at' => '2025-02-06 17:18:46',
            ),
            17 => 
            array (
                'id' => 18,
                'trip_id' => 100031,
                'vehicle_id' => 6,
                'trip_details_id' => 37,
                'vehicle_identity_id' => 18,
                'vehicle_driver_id' => 25,
                'estimated_trip_end_time' => '2025-02-07 14:22:00',
                'is_completed' => 1,
                'created_at' => '2025-02-06 17:22:31',
                'updated_at' => '2025-02-06 17:22:47',
            ),
            18 => 
            array (
                'id' => 19,
                'trip_id' => 100032,
                'vehicle_id' => 17,
                'trip_details_id' => 38,
                'vehicle_identity_id' => 47,
                'vehicle_driver_id' => 8,
                'estimated_trip_end_time' => '2025-02-06 21:26:00',
                'is_completed' => 1,
                'created_at' => '2025-02-06 17:38:41',
                'updated_at' => '2025-02-06 17:38:51',
            ),
            19 => 
            array (
                'id' => 20,
                'trip_id' => 100034,
                'vehicle_id' => 16,
                'trip_details_id' => 40,
                'vehicle_identity_id' => 45,
                'vehicle_driver_id' => 20,
                'estimated_trip_end_time' => '2025-02-07 12:53:00',
                'is_completed' => 1,
                'created_at' => '2025-02-06 17:54:23',
                'updated_at' => '2025-02-06 17:54:33',
            ),
            20 => 
            array (
                'id' => 21,
                'trip_id' => 100037,
                'vehicle_id' => 1,
                'trip_details_id' => 43,
                'vehicle_identity_id' => 1,
                'vehicle_driver_id' => NULL,
                'estimated_trip_end_time' => '2025-02-08 13:48:13',
                'is_completed' => 1,
                'created_at' => '2025-02-08 12:49:06',
                'updated_at' => '2025-02-08 12:49:10',
            ),
            21 => 
            array (
                'id' => 22,
                'trip_id' => 100041,
                'vehicle_id' => 1,
                'trip_details_id' => 47,
                'vehicle_identity_id' => 2,
                'vehicle_driver_id' => 3,
                'estimated_trip_end_time' => '2025-02-08 14:09:18',
                'is_completed' => 1,
                'created_at' => '2025-02-08 13:11:09',
                'updated_at' => '2025-02-08 13:11:22',
            ),
        ));
        
        
    }
}