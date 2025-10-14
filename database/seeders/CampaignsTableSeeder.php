<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('campaigns')->delete();
        
        \DB::table('campaigns')->insert(array (
            0 => 
            array (
                'id' => 4,
                'title' => 'Buy One Get One',
                'image' => '2023-10-19-6530a1777a6d8.png',
                'description' => '\'Buy One Get One FREE\' on all Signature Items',
                'status' => 1,
                'admin_id' => NULL,
                'created_at' => '2022-09-29 12:03:13',
                'updated_at' => '2023-10-19 10:38:56',
                'start_date' => '2022-09-29',
                'end_date' => '2024-01-16',
                'start_time' => '09:02:00',
                'end_time' => '22:03:00',
                'module_id' => 1,
            ),
            1 => 
            array (
                'id' => 6,
                'title' => 'Get Your Grocery Items',
                'image' => '2023-10-19-6530a56f60ee3.png',
                'description' => 'Get Your Grocery Items',
                'status' => 1,
                'admin_id' => NULL,
                'created_at' => '2023-10-19 09:41:35',
                'updated_at' => '2023-10-19 09:41:35',
                'start_date' => '2023-10-19',
                'end_date' => '2023-12-30',
                'start_time' => '07:40:00',
                'end_time' => '22:41:00',
                'module_id' => 1,
            ),
            2 => 
            array (
                'id' => 7,
                'title' => 'Add 100 get 10% Extras',
                'image' => '2023-10-19-6530bfbca89d0.png',
                'description' => 'Add 100 get 10% Extras',
                'status' => 0,
                'admin_id' => NULL,
                'created_at' => '2023-10-19 11:33:48',
                'updated_at' => '2024-10-31 18:03:38',
                'start_date' => '2023-10-19',
                'end_date' => '2024-12-19',
                'start_time' => '07:33:00',
                'end_time' => '21:33:00',
                'module_id' => 4,
            ),
            3 => 
            array (
                'id' => 8,
                'title' => 'Add 10',
                'image' => '2024-10-28-671f5e33bdda4.png',
                'description' => 'Add 100 get 10% Extras',
                'status' => 1,
                'admin_id' => NULL,
                'created_at' => '2023-10-19 12:55:15',
                'updated_at' => '2024-10-28 15:49:39',
                'start_date' => '2024-10-28',
                'end_date' => '2025-10-28',
                'start_time' => '07:54:00',
                'end_time' => '22:54:00',
                'module_id' => 3,
            ),
            4 => 
            array (
                'id' => 9,
                'title' => 'Add 100 shop',
                'image' => '2024-10-28-671f5e69e7e2d.png',
                'description' => 'Add 100 shop',
                'status' => 1,
                'admin_id' => NULL,
                'created_at' => '2023-10-19 12:55:56',
                'updated_at' => '2024-10-28 15:50:33',
                'start_date' => '2023-10-19',
                'end_date' => '2024-11-19',
                'start_time' => '08:55:00',
                'end_time' => '22:55:00',
                'module_id' => 3,
            ),
            5 => 
            array (
                'id' => 10,
                'title' => 'Campaign For Pharmacy module',
                'image' => '2023-10-22-6534e9e576ecc.png',
                'description' => 'Campaign For Pharmacy module',
                'status' => 1,
                'admin_id' => NULL,
                'created_at' => '2023-10-22 15:22:45',
                'updated_at' => '2023-10-22 15:22:45',
                'start_date' => '2023-10-22',
                'end_date' => '2023-12-31',
                'start_time' => '08:20:00',
                'end_time' => '23:20:00',
                'module_id' => 2,
            ),
            6 => 
            array (
                'id' => 11,
                'title' => 'New Campaign',
                'image' => '2023-10-22-6534ea1f59a57.png',
                'description' => 'New Campaign',
                'status' => 1,
                'admin_id' => NULL,
                'created_at' => '2023-10-22 15:23:43',
                'updated_at' => '2023-10-22 15:23:43',
                'start_date' => '2023-10-22',
                'end_date' => '2023-12-31',
                'start_time' => '06:23:00',
                'end_time' => '23:23:00',
                'module_id' => 2,
            ),
            7 => 
            array (
                'id' => 13,
                'title' => 'iPhone 16',
                'image' => '2024-10-31-67233f3ca1956.png',
                'description' => 'The Future in Your Hands',
                'status' => 1,
                'admin_id' => NULL,
                'created_at' => '2024-10-31 14:16:54',
                'updated_at' => '2024-10-31 14:26:53',
                'start_date' => '2024-10-31',
                'end_date' => '2025-10-27',
                'start_time' => '06:16:00',
                'end_time' => '23:51:00',
                'module_id' => 3,
            ),
        ));
        
        
    }
}