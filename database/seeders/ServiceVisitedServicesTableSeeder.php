<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceVisitedServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_visited_services')->delete();
        
        \DB::table('service_visited_services')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => NULL,
                'user_id' => 29,
                'service_id' => 3,
                'count' => 1,
                'created_at' => '2025-09-04 10:35:55',
                'updated_at' => '2025-09-04 10:35:55',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => NULL,
                'user_id' => 29,
                'service_id' => 1,
                'count' => 2,
                'created_at' => '2025-09-04 10:39:03',
                'updated_at' => '2025-09-04 10:58:28',
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => NULL,
                'user_id' => 8,
                'service_id' => 1,
                'count' => 24,
                'created_at' => '2025-09-07 04:50:34',
                'updated_at' => '2025-10-13 16:30:12',
            ),
            3 => 
            array (
                'id' => 4,
                'module_id' => NULL,
                'user_id' => 8,
                'service_id' => 2,
                'count' => 5,
                'created_at' => '2025-09-07 10:17:10',
                'updated_at' => '2025-09-09 14:53:04',
            ),
            4 => 
            array (
                'id' => 5,
                'module_id' => NULL,
                'user_id' => 8,
                'service_id' => 3,
                'count' => 3,
                'created_at' => '2025-09-07 10:26:29',
                'updated_at' => '2025-10-13 21:58:19',
            ),
            5 => 
            array (
                'id' => 6,
                'module_id' => NULL,
                'user_id' => 10,
                'service_id' => 1,
                'count' => 1,
                'created_at' => '2025-09-08 11:55:22',
                'updated_at' => '2025-09-08 11:55:22',
            ),
            6 => 
            array (
                'id' => 7,
                'module_id' => NULL,
                'user_id' => 21,
                'service_id' => 3,
                'count' => 1,
                'created_at' => '2025-09-09 11:28:10',
                'updated_at' => '2025-09-09 11:28:10',
            ),
            7 => 
            array (
                'id' => 8,
                'module_id' => NULL,
                'user_id' => 21,
                'service_id' => 6,
                'count' => 1,
                'created_at' => '2025-09-09 11:36:41',
                'updated_at' => '2025-09-09 11:36:41',
            ),
            8 => 
            array (
                'id' => 9,
                'module_id' => NULL,
                'user_id' => 21,
                'service_id' => 4,
                'count' => 2,
                'created_at' => '2025-09-09 11:40:41',
                'updated_at' => '2025-09-09 11:40:56',
            ),
            9 => 
            array (
                'id' => 10,
                'module_id' => NULL,
                'user_id' => 21,
                'service_id' => 1,
                'count' => 3,
                'created_at' => '2025-09-09 11:57:33',
                'updated_at' => '2025-09-11 11:28:44',
            ),
            10 => 
            array (
                'id' => 11,
                'module_id' => NULL,
                'user_id' => 21,
                'service_id' => 5,
                'count' => 1,
                'created_at' => '2025-09-09 12:19:03',
                'updated_at' => '2025-09-09 12:19:03',
            ),
            11 => 
            array (
                'id' => 12,
                'module_id' => NULL,
                'user_id' => 8,
                'service_id' => 7,
                'count' => 4,
                'created_at' => '2025-09-09 12:34:00',
                'updated_at' => '2025-10-13 16:21:46',
            ),
            12 => 
            array (
                'id' => 13,
                'module_id' => NULL,
                'user_id' => 30,
                'service_id' => 1,
                'count' => 3,
                'created_at' => '2025-09-09 14:23:04',
                'updated_at' => '2025-09-09 14:27:11',
            ),
            13 => 
            array (
                'id' => 14,
                'module_id' => NULL,
                'user_id' => 8,
                'service_id' => 5,
                'count' => 3,
                'created_at' => '2025-09-09 14:49:02',
                'updated_at' => '2025-10-11 17:48:56',
            ),
            14 => 
            array (
                'id' => 15,
                'module_id' => NULL,
                'user_id' => 21,
                'service_id' => 7,
                'count' => 1,
                'created_at' => '2025-09-11 13:15:48',
                'updated_at' => '2025-09-11 13:15:48',
            ),
            15 => 
            array (
                'id' => 16,
                'module_id' => NULL,
                'user_id' => 14,
                'service_id' => 2,
                'count' => 19,
                'created_at' => '2025-09-16 12:18:36',
                'updated_at' => '2025-10-12 12:48:02',
            ),
            16 => 
            array (
                'id' => 17,
                'module_id' => NULL,
                'user_id' => 14,
                'service_id' => 3,
                'count' => 22,
                'created_at' => '2025-09-16 15:02:07',
                'updated_at' => '2025-10-12 13:05:14',
            ),
            17 => 
            array (
                'id' => 18,
                'module_id' => NULL,
                'user_id' => 14,
                'service_id' => 5,
                'count' => 7,
                'created_at' => '2025-09-16 16:01:56',
                'updated_at' => '2025-10-12 16:06:51',
            ),
            18 => 
            array (
                'id' => 19,
                'module_id' => NULL,
                'user_id' => 14,
                'service_id' => 1,
                'count' => 68,
                'created_at' => '2025-09-17 11:29:32',
                'updated_at' => '2025-10-12 13:46:34',
            ),
            19 => 
            array (
                'id' => 20,
                'module_id' => NULL,
                'user_id' => 14,
                'service_id' => 4,
                'count' => 8,
                'created_at' => '2025-09-17 11:29:52',
                'updated_at' => '2025-10-12 13:05:35',
            ),
            20 => 
            array (
                'id' => 21,
                'module_id' => NULL,
                'user_id' => 33,
                'service_id' => 5,
                'count' => 4,
                'created_at' => '2025-09-17 12:25:43',
                'updated_at' => '2025-10-06 10:36:27',
            ),
            21 => 
            array (
                'id' => 22,
                'module_id' => NULL,
                'user_id' => 33,
                'service_id' => 3,
                'count' => 10,
                'created_at' => '2025-09-17 13:16:34',
                'updated_at' => '2025-10-11 12:45:46',
            ),
            22 => 
            array (
                'id' => 23,
                'module_id' => NULL,
                'user_id' => 14,
                'service_id' => 8,
                'count' => 6,
                'created_at' => '2025-09-18 10:48:01',
                'updated_at' => '2025-10-07 13:30:10',
            ),
            23 => 
            array (
                'id' => 24,
                'module_id' => NULL,
                'user_id' => 33,
                'service_id' => 6,
                'count' => 12,
                'created_at' => '2025-09-20 11:56:06',
                'updated_at' => '2025-10-13 15:13:53',
            ),
            24 => 
            array (
                'id' => 25,
                'module_id' => NULL,
                'user_id' => 33,
                'service_id' => 4,
                'count' => 7,
                'created_at' => '2025-09-20 12:09:29',
                'updated_at' => '2025-10-11 15:15:00',
            ),
            25 => 
            array (
                'id' => 26,
                'module_id' => NULL,
                'user_id' => 33,
                'service_id' => 7,
                'count' => 11,
                'created_at' => '2025-09-20 14:57:13',
                'updated_at' => '2025-10-13 17:50:58',
            ),
            26 => 
            array (
                'id' => 27,
                'module_id' => NULL,
                'user_id' => 33,
                'service_id' => 1,
                'count' => 84,
                'created_at' => '2025-09-20 14:57:58',
                'updated_at' => '2025-10-13 17:50:39',
            ),
            27 => 
            array (
                'id' => 28,
                'module_id' => NULL,
                'user_id' => 33,
                'service_id' => 2,
                'count' => 8,
                'created_at' => '2025-09-22 11:43:34',
                'updated_at' => '2025-10-11 13:08:57',
            ),
            28 => 
            array (
                'id' => 29,
                'module_id' => NULL,
                'user_id' => 33,
                'service_id' => 9,
                'count' => 17,
                'created_at' => '2025-09-22 17:25:33',
                'updated_at' => '2025-10-13 14:44:56',
            ),
            29 => 
            array (
                'id' => 30,
                'module_id' => NULL,
                'user_id' => 14,
                'service_id' => 9,
                'count' => 9,
                'created_at' => '2025-09-23 10:49:48',
                'updated_at' => '2025-10-12 13:05:24',
            ),
            30 => 
            array (
                'id' => 31,
                'module_id' => NULL,
                'user_id' => 14,
                'service_id' => 7,
                'count' => 1,
                'created_at' => '2025-09-23 14:36:42',
                'updated_at' => '2025-09-23 14:36:42',
            ),
            31 => 
            array (
                'id' => 32,
                'module_id' => NULL,
                'user_id' => 14,
                'service_id' => 6,
                'count' => 5,
                'created_at' => '2025-09-23 15:48:14',
                'updated_at' => '2025-10-07 13:30:04',
            ),
            32 => 
            array (
                'id' => 33,
                'module_id' => NULL,
                'user_id' => 32,
                'service_id' => 6,
                'count' => 6,
                'created_at' => '2025-09-24 17:21:03',
                'updated_at' => '2025-10-06 15:15:10',
            ),
            33 => 
            array (
                'id' => 34,
                'module_id' => NULL,
                'user_id' => 32,
                'service_id' => 1,
                'count' => 51,
                'created_at' => '2025-09-24 17:21:16',
                'updated_at' => '2025-10-13 17:46:25',
            ),
            34 => 
            array (
                'id' => 35,
                'module_id' => NULL,
                'user_id' => 33,
                'service_id' => 8,
                'count' => 4,
                'created_at' => '2025-09-24 17:47:22',
                'updated_at' => '2025-10-05 14:39:24',
            ),
            35 => 
            array (
                'id' => 36,
                'module_id' => NULL,
                'user_id' => 8,
                'service_id' => 4,
                'count' => 7,
                'created_at' => '2025-09-28 13:03:22',
                'updated_at' => '2025-10-09 15:03:14',
            ),
            36 => 
            array (
                'id' => 37,
                'module_id' => NULL,
                'user_id' => 33,
                'service_id' => 10,
                'count' => 1,
                'created_at' => '2025-09-28 16:18:44',
                'updated_at' => '2025-09-28 16:18:44',
            ),
            37 => 
            array (
                'id' => 38,
                'module_id' => NULL,
                'user_id' => 32,
                'service_id' => 8,
                'count' => 11,
                'created_at' => '2025-09-29 10:55:42',
                'updated_at' => '2025-09-29 13:09:38',
            ),
            38 => 
            array (
                'id' => 39,
                'module_id' => NULL,
                'user_id' => 32,
                'service_id' => 10,
                'count' => 9,
                'created_at' => '2025-09-29 11:18:46',
                'updated_at' => '2025-09-29 15:07:33',
            ),
            39 => 
            array (
                'id' => 40,
                'module_id' => NULL,
                'user_id' => 32,
                'service_id' => 7,
                'count' => 8,
                'created_at' => '2025-09-29 11:18:54',
                'updated_at' => '2025-10-05 12:14:12',
            ),
            40 => 
            array (
                'id' => 41,
                'module_id' => NULL,
                'user_id' => 32,
                'service_id' => 9,
                'count' => 9,
                'created_at' => '2025-09-29 12:40:13',
                'updated_at' => '2025-09-29 13:06:51',
            ),
            41 => 
            array (
                'id' => 42,
                'module_id' => NULL,
                'user_id' => 32,
                'service_id' => 2,
                'count' => 6,
                'created_at' => '2025-09-30 10:09:10',
                'updated_at' => '2025-10-11 10:52:37',
            ),
            42 => 
            array (
                'id' => 43,
                'module_id' => NULL,
                'user_id' => 32,
                'service_id' => 4,
                'count' => 2,
                'created_at' => '2025-09-30 10:12:54',
                'updated_at' => '2025-10-07 12:56:54',
            ),
            43 => 
            array (
                'id' => 44,
                'module_id' => NULL,
                'user_id' => 8,
                'service_id' => 6,
                'count' => 6,
                'created_at' => '2025-10-06 09:56:12',
                'updated_at' => '2025-10-13 16:25:08',
            ),
            44 => 
            array (
                'id' => 45,
                'module_id' => NULL,
                'user_id' => 32,
                'service_id' => 5,
                'count' => 8,
                'created_at' => '2025-10-11 15:09:28',
                'updated_at' => '2025-10-11 15:24:27',
            ),
            45 => 
            array (
                'id' => 46,
                'module_id' => NULL,
                'user_id' => 37,
                'service_id' => 7,
                'count' => 1,
                'created_at' => '2025-10-11 16:36:56',
                'updated_at' => '2025-10-11 16:36:56',
            ),
        ));
        
        
    }
}