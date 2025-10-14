<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserLastLocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_last_locations')->delete();
        
        \DB::table('user_last_locations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'type' => 'rider',
                'latitude' => '23.8374883',
                'longitude' => '90.3767933',
                'zone_id' => 1,
                'created_at' => '2025-09-08 04:49:12',
                'updated_at' => '2025-10-14 09:30:44',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 10,
                'type' => 'rider',
                'latitude' => '30.416735',
                'longitude' => '-9.5750831',
                'zone_id' => 1,
                'created_at' => '2025-09-09 12:48:40',
                'updated_at' => '2025-10-01 00:41:53',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 11,
                'type' => 'rider',
                'latitude' => '23.8372872',
                'longitude' => '90.3757627',
                'zone_id' => 1,
                'created_at' => '2025-09-11 12:24:11',
                'updated_at' => '2025-09-17 09:22:05',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 9,
                'type' => 'rider',
                'latitude' => '23.752404632749',
                'longitude' => '90.381225981926',
                'zone_id' => 1,
                'created_at' => '2025-09-14 10:21:07',
                'updated_at' => '2025-10-14 09:36:22',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 21,
                'type' => 'customer',
                'latitude' => '23.8372944',
                'longitude' => '90.3757812',
                'zone_id' => 1,
                'created_at' => '2025-09-24 12:59:14',
                'updated_at' => '2025-10-14 09:36:22',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 33,
                'type' => 'customer',
                'latitude' => '23.75305525897994',
                'longitude' => '90.38160643880465',
                'zone_id' => 1,
                'created_at' => '2025-09-25 11:37:26',
                'updated_at' => '2025-10-13 18:34:08',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 16,
                'type' => 'rider',
                'latitude' => '30.4029537',
                'longitude' => '-9.5867772',
                'zone_id' => 1,
                'created_at' => '2025-09-25 17:27:56',
                'updated_at' => '2025-09-26 08:43:01',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 8,
                'type' => 'customer',
                'latitude' => '23.8372996',
                'longitude' => '90.3757923',
                'zone_id' => 1,
                'created_at' => '2025-09-25 17:44:50',
                'updated_at' => '2025-10-11 18:14:47',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 32,
                'type' => 'customer',
                'latitude' => '23.837241',
                'longitude' => '90.375493',
                'zone_id' => 1,
                'created_at' => '2025-09-25 17:50:53',
                'updated_at' => '2025-10-13 16:39:18',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 20,
                'type' => 'rider',
                'latitude' => '23.8372801',
                'longitude' => '90.3757672',
                'zone_id' => 1,
                'created_at' => '2025-10-09 15:01:08',
                'updated_at' => '2025-10-13 18:30:13',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 21,
                'type' => 'rider',
                'latitude' => '23.8372829',
                'longitude' => '90.3757569',
                'zone_id' => 1,
                'created_at' => '2025-10-09 17:49:31',
                'updated_at' => '2025-10-09 17:51:52',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 22,
                'type' => 'rider',
                'latitude' => '23.8372267',
                'longitude' => '90.3757033',
                'zone_id' => 1,
                'created_at' => '2025-10-10 17:52:39',
                'updated_at' => '2025-10-10 17:52:39',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 17,
                'type' => 'rider',
                'latitude' => '23.795152712085',
                'longitude' => '90.353361616325',
                'zone_id' => 1,
                'created_at' => '2025-10-11 10:23:59',
                'updated_at' => '2025-10-11 16:55:06',
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 2,
                'type' => 'rider',
                'latitude' => '23.8372488',
                'longitude' => '90.3757219',
                'zone_id' => 1,
                'created_at' => '2025-10-11 12:14:01',
                'updated_at' => '2025-10-13 13:15:20',
            ),
            14 => 
            array (
                'id' => 15,
                'user_id' => 37,
                'type' => 'customer',
                'latitude' => '23.8372681',
                'longitude' => '90.3757336',
                'zone_id' => 1,
                'created_at' => '2025-10-11 16:04:37',
                'updated_at' => '2025-10-13 13:44:52',
            ),
            15 => 
            array (
                'id' => 16,
                'user_id' => 24,
                'type' => 'rider',
                'latitude' => '23.8306436',
                'longitude' => '90.3490342',
                'zone_id' => 1,
                'created_at' => '2025-10-11 16:09:55',
                'updated_at' => '2025-10-13 20:14:02',
            ),
            16 => 
            array (
                'id' => 17,
                'user_id' => 25,
                'type' => 'rider',
                'latitude' => '23.794990421343',
                'longitude' => '90.353148037183',
                'zone_id' => 1,
                'created_at' => '2025-10-12 11:13:32',
                'updated_at' => '2025-10-12 11:18:51',
            ),
            17 => 
            array (
                'id' => 18,
                'user_id' => 38,
                'type' => 'customer',
                'latitude' => '23.8372804',
                'longitude' => '90.3757585',
                'zone_id' => 1,
                'created_at' => '2025-10-13 10:33:02',
                'updated_at' => '2025-10-13 10:39:42',
            ),
        ));
        
        
    }
}