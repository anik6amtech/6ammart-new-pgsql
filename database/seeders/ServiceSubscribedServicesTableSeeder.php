<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceSubscribedServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_subscribed_services')->delete();
        
        \DB::table('service_subscribed_services')->insert(array (
            0 => 
            array (
                'id' => 1,
                'provider_id' => 1,
                'category_id' => 1,
                'sub_category_id' => 4,
                'is_subscribed' => 0,
                'created_at' => '2025-09-04 06:42:14',
                'updated_at' => '2025-10-12 13:16:50',
            ),
            1 => 
            array (
                'id' => 2,
                'provider_id' => 1,
                'category_id' => 1,
                'sub_category_id' => 5,
                'is_subscribed' => 0,
                'created_at' => '2025-09-04 06:42:48',
                'updated_at' => '2025-10-12 13:16:50',
            ),
            2 => 
            array (
                'id' => 3,
                'provider_id' => 2,
                'category_id' => 1,
                'sub_category_id' => 4,
                'is_subscribed' => 1,
                'created_at' => '2025-09-04 09:20:39',
                'updated_at' => '2025-09-04 09:20:39',
            ),
            3 => 
            array (
                'id' => 4,
                'provider_id' => 2,
                'category_id' => 1,
                'sub_category_id' => 5,
                'is_subscribed' => 1,
                'created_at' => '2025-09-04 09:21:01',
                'updated_at' => '2025-09-04 09:21:01',
            ),
            4 => 
            array (
                'id' => 5,
                'provider_id' => 7,
                'category_id' => 3,
                'sub_category_id' => 10,
                'is_subscribed' => 0,
                'created_at' => '2025-09-09 10:52:50',
                'updated_at' => '2025-10-12 16:44:11',
            ),
            5 => 
            array (
                'id' => 6,
                'provider_id' => 7,
                'category_id' => 2,
                'sub_category_id' => 7,
                'is_subscribed' => 0,
                'created_at' => '2025-09-09 10:52:55',
                'updated_at' => '2025-10-12 16:13:48',
            ),
            6 => 
            array (
                'id' => 7,
                'provider_id' => 7,
                'category_id' => 2,
                'sub_category_id' => 8,
                'is_subscribed' => 0,
                'created_at' => '2025-09-09 10:52:57',
                'updated_at' => '2025-10-12 16:13:48',
            ),
            7 => 
            array (
                'id' => 8,
                'provider_id' => 7,
                'category_id' => 1,
                'sub_category_id' => 5,
                'is_subscribed' => 1,
                'created_at' => '2025-09-09 10:53:02',
                'updated_at' => '2025-09-09 10:53:02',
            ),
            8 => 
            array (
                'id' => 9,
                'provider_id' => 7,
                'category_id' => 1,
                'sub_category_id' => 4,
                'is_subscribed' => 1,
                'created_at' => '2025-09-09 10:53:04',
                'updated_at' => '2025-09-09 10:53:04',
            ),
            9 => 
            array (
                'id' => 10,
                'provider_id' => 7,
                'category_id' => 1,
                'sub_category_id' => 6,
                'is_subscribed' => 0,
                'created_at' => '2025-09-09 10:53:07',
                'updated_at' => '2025-09-30 09:59:33',
            ),
            10 => 
            array (
                'id' => 11,
                'provider_id' => 7,
                'category_id' => 3,
                'sub_category_id' => 9,
                'is_subscribed' => 1,
                'created_at' => '2025-09-09 10:53:11',
                'updated_at' => '2025-09-09 10:53:11',
            ),
            11 => 
            array (
                'id' => 12,
                'provider_id' => 3,
                'category_id' => 3,
                'sub_category_id' => 10,
                'is_subscribed' => 1,
                'created_at' => '2025-09-09 11:45:59',
                'updated_at' => '2025-09-09 11:45:59',
            ),
            12 => 
            array (
                'id' => 13,
                'provider_id' => 3,
                'category_id' => 3,
                'sub_category_id' => 9,
                'is_subscribed' => 1,
                'created_at' => '2025-09-09 11:46:02',
                'updated_at' => '2025-09-09 11:46:02',
            ),
            13 => 
            array (
                'id' => 14,
                'provider_id' => 3,
                'category_id' => 2,
                'sub_category_id' => 7,
                'is_subscribed' => 1,
                'created_at' => '2025-09-09 11:46:06',
                'updated_at' => '2025-09-09 11:46:06',
            ),
            14 => 
            array (
                'id' => 15,
                'provider_id' => 3,
                'category_id' => 2,
                'sub_category_id' => 8,
                'is_subscribed' => 1,
                'created_at' => '2025-09-09 11:46:08',
                'updated_at' => '2025-09-09 11:46:08',
            ),
            15 => 
            array (
                'id' => 16,
                'provider_id' => 3,
                'category_id' => 1,
                'sub_category_id' => 5,
                'is_subscribed' => 1,
                'created_at' => '2025-09-09 11:46:11',
                'updated_at' => '2025-09-09 11:46:11',
            ),
            16 => 
            array (
                'id' => 17,
                'provider_id' => 3,
                'category_id' => 1,
                'sub_category_id' => 4,
                'is_subscribed' => 1,
                'created_at' => '2025-09-09 11:46:12',
                'updated_at' => '2025-09-09 11:46:12',
            ),
            17 => 
            array (
                'id' => 18,
                'provider_id' => 3,
                'category_id' => 1,
                'sub_category_id' => 6,
                'is_subscribed' => 1,
                'created_at' => '2025-09-09 11:46:14',
                'updated_at' => '2025-09-09 11:46:14',
            ),
            18 => 
            array (
                'id' => 19,
                'provider_id' => 8,
                'category_id' => 1,
                'sub_category_id' => 4,
                'is_subscribed' => 0,
                'created_at' => '2025-09-21 10:35:33',
                'updated_at' => '2025-10-07 17:42:46',
            ),
            19 => 
            array (
                'id' => 20,
                'provider_id' => 1,
                'category_id' => 3,
                'sub_category_id' => 10,
                'is_subscribed' => 0,
                'created_at' => '2025-09-21 17:56:56',
                'updated_at' => '2025-10-12 13:16:50',
            ),
            20 => 
            array (
                'id' => 21,
                'provider_id' => 1,
                'category_id' => 3,
                'sub_category_id' => 9,
                'is_subscribed' => 1,
                'created_at' => '2025-09-21 17:56:59',
                'updated_at' => '2025-09-21 17:56:59',
            ),
            21 => 
            array (
                'id' => 22,
                'provider_id' => 1,
                'category_id' => 1,
                'sub_category_id' => 6,
                'is_subscribed' => 1,
                'created_at' => '2025-09-21 17:57:06',
                'updated_at' => '2025-09-21 17:57:06',
            ),
            22 => 
            array (
                'id' => 23,
                'provider_id' => 2,
                'category_id' => 1,
                'sub_category_id' => 6,
                'is_subscribed' => 1,
                'created_at' => '2025-09-22 11:24:05',
                'updated_at' => '2025-09-22 11:24:05',
            ),
            23 => 
            array (
                'id' => 24,
                'provider_id' => 2,
                'category_id' => 3,
                'sub_category_id' => 9,
                'is_subscribed' => 1,
                'created_at' => '2025-09-22 11:24:10',
                'updated_at' => '2025-09-22 11:24:10',
            ),
            24 => 
            array (
                'id' => 25,
                'provider_id' => 2,
                'category_id' => 3,
                'sub_category_id' => 10,
                'is_subscribed' => 1,
                'created_at' => '2025-09-22 11:24:12',
                'updated_at' => '2025-09-22 11:24:12',
            ),
            25 => 
            array (
                'id' => 26,
                'provider_id' => 8,
                'category_id' => 3,
                'sub_category_id' => 10,
                'is_subscribed' => 0,
                'created_at' => '2025-09-23 16:26:49',
                'updated_at' => '2025-09-24 16:48:37',
            ),
            26 => 
            array (
                'id' => 27,
                'provider_id' => 8,
                'category_id' => 3,
                'sub_category_id' => 9,
                'is_subscribed' => 0,
                'created_at' => '2025-09-23 16:26:52',
                'updated_at' => '2025-09-24 16:55:12',
            ),
            27 => 
            array (
                'id' => 28,
                'provider_id' => 8,
                'category_id' => 1,
                'sub_category_id' => 5,
                'is_subscribed' => 1,
                'created_at' => '2025-09-23 16:27:00',
                'updated_at' => '2025-09-29 16:27:17',
            ),
            28 => 
            array (
                'id' => 29,
                'provider_id' => 8,
                'category_id' => 1,
                'sub_category_id' => 6,
                'is_subscribed' => 1,
                'created_at' => '2025-09-24 16:44:51',
                'updated_at' => '2025-09-24 16:44:51',
            ),
            29 => 
            array (
                'id' => 30,
                'provider_id' => 8,
                'category_id' => 2,
                'sub_category_id' => 7,
                'is_subscribed' => 0,
                'created_at' => '2025-09-24 16:45:01',
                'updated_at' => '2025-09-24 16:54:00',
            ),
        ));
        
        
    }
}