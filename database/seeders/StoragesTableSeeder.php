<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoragesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('storages')->delete();
        
        \DB::table('storages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '18',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            1 => 
            array (
                'id' => 2,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '96',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            2 => 
            array (
                'id' => 3,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '223',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-06-06 12:42:24',
                'updated_at' => '2024-06-06 12:42:24',
            ),
            3 => 
            array (
                'id' => 4,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '224',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-06-06 12:42:24',
                'updated_at' => '2024-06-06 12:42:24',
            ),
            4 => 
            array (
                'id' => 5,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '225',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-06-06 12:42:36',
                'updated_at' => '2024-06-06 12:42:36',
            ),
            5 => 
            array (
                'id' => 6,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '226',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-06-06 12:43:09',
                'updated_at' => '2024-06-06 12:43:09',
            ),
            6 => 
            array (
                'id' => 7,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '227',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-06-06 12:43:09',
                'updated_at' => '2024-06-06 12:43:09',
            ),
            7 => 
            array (
                'id' => 8,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '228',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-06-06 12:43:15',
                'updated_at' => '2024-06-06 12:43:15',
            ),
            8 => 
            array (
                'id' => 9,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '36',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-06-06 12:46:17',
                'updated_at' => '2024-06-06 12:46:17',
            ),
            9 => 
            array (
                'id' => 10,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '36',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-06-06 12:46:17',
                'updated_at' => '2024-06-06 12:46:17',
            ),
            10 => 
            array (
                'id' => 11,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '36',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-06-06 12:47:54',
                'updated_at' => '2024-06-06 12:47:54',
            ),
            11 => 
            array (
                'id' => 12,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '37',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-06-06 12:49:50',
                'updated_at' => '2024-06-06 12:49:50',
            ),
            12 => 
            array (
                'id' => 13,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '37',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-06-06 12:49:50',
                'updated_at' => '2024-06-06 12:49:50',
            ),
            13 => 
            array (
                'id' => 14,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '37',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-06-06 12:49:50',
                'updated_at' => '2024-06-06 12:49:50',
            ),
            14 => 
            array (
                'id' => 15,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '38',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-06-06 12:51:16',
                'updated_at' => '2024-06-06 12:51:16',
            ),
            15 => 
            array (
                'id' => 16,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '38',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-06-06 12:51:16',
                'updated_at' => '2024-06-06 12:51:16',
            ),
            16 => 
            array (
                'id' => 17,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '38',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-06-06 12:51:16',
                'updated_at' => '2024-06-06 12:51:16',
            ),
            17 => 
            array (
                'id' => 18,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '39',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-06-06 12:52:33',
                'updated_at' => '2024-06-06 12:52:33',
            ),
            18 => 
            array (
                'id' => 19,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '39',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-06-06 12:52:33',
                'updated_at' => '2024-06-06 12:52:33',
            ),
            19 => 
            array (
                'id' => 20,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '39',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-06-06 12:52:33',
                'updated_at' => '2024-06-06 12:52:33',
            ),
            20 => 
            array (
                'id' => 21,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '40',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-06-06 12:54:35',
                'updated_at' => '2024-06-06 12:54:35',
            ),
            21 => 
            array (
                'id' => 22,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '40',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-06-06 12:54:35',
                'updated_at' => '2024-06-06 12:54:35',
            ),
            22 => 
            array (
                'id' => 23,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '40',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-06-06 12:54:35',
                'updated_at' => '2024-06-06 12:54:35',
            ),
            23 => 
            array (
                'id' => 24,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '220',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-14 09:16:10',
                'updated_at' => '2025-10-14 09:16:10',
            ),
            24 => 
            array (
                'id' => 25,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '41',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:16:30',
                'updated_at' => '2024-08-08 05:16:30',
            ),
            25 => 
            array (
                'id' => 26,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '41',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-08-08 05:16:30',
                'updated_at' => '2024-08-08 05:16:30',
            ),
            26 => 
            array (
                'id' => 27,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '41',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-08-08 05:16:30',
                'updated_at' => '2024-08-08 05:16:30',
            ),
            27 => 
            array (
                'id' => 28,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '42',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:19:14',
                'updated_at' => '2024-08-08 05:19:14',
            ),
            28 => 
            array (
                'id' => 29,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '42',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-08-08 05:19:14',
                'updated_at' => '2024-08-08 05:19:14',
            ),
            29 => 
            array (
                'id' => 30,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '42',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-08-08 05:19:14',
                'updated_at' => '2024-08-08 05:19:14',
            ),
            30 => 
            array (
                'id' => 31,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '43',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:24:06',
                'updated_at' => '2024-08-08 05:24:06',
            ),
            31 => 
            array (
                'id' => 32,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '43',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-08-08 05:24:06',
                'updated_at' => '2024-08-08 05:24:06',
            ),
            32 => 
            array (
                'id' => 33,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '43',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-08-08 05:24:06',
                'updated_at' => '2024-08-08 05:24:06',
            ),
            33 => 
            array (
                'id' => 34,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '44',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:26:36',
                'updated_at' => '2024-08-08 05:26:36',
            ),
            34 => 
            array (
                'id' => 35,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '44',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-08-08 05:26:36',
                'updated_at' => '2024-08-08 05:26:36',
            ),
            35 => 
            array (
                'id' => 36,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '44',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-08-08 05:26:36',
                'updated_at' => '2024-08-08 05:26:36',
            ),
            36 => 
            array (
                'id' => 37,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '45',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:28:35',
                'updated_at' => '2024-08-08 05:28:35',
            ),
            37 => 
            array (
                'id' => 38,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '45',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-08-08 05:28:35',
                'updated_at' => '2024-08-08 05:28:35',
            ),
            38 => 
            array (
                'id' => 39,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '45',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-08-08 05:28:35',
                'updated_at' => '2024-08-08 05:28:35',
            ),
            39 => 
            array (
                'id' => 40,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '46',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:30:33',
                'updated_at' => '2024-08-08 05:30:33',
            ),
            40 => 
            array (
                'id' => 41,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '46',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-08-08 05:30:33',
                'updated_at' => '2024-08-08 05:30:33',
            ),
            41 => 
            array (
                'id' => 42,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '46',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-08-08 05:30:33',
                'updated_at' => '2024-08-08 05:30:33',
            ),
            42 => 
            array (
                'id' => 43,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '47',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:32:31',
                'updated_at' => '2024-08-08 05:32:31',
            ),
            43 => 
            array (
                'id' => 44,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '47',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-08-08 05:32:31',
                'updated_at' => '2024-08-08 05:32:31',
            ),
            44 => 
            array (
                'id' => 45,
                'data_type' => 'App\\Models\\EmailTemplate',
                'data_id' => '47',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2024-08-08 05:32:31',
                'updated_at' => '2024-08-08 05:32:31',
            ),
            45 => 
            array (
                'id' => 46,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000000',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-08-08 05:36:45',
                'updated_at' => '2024-08-08 05:36:45',
            ),
            46 => 
            array (
                'id' => 47,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000000',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-11-03 10:10:09',
                'updated_at' => '2024-11-03 10:10:09',
            ),
            47 => 
            array (
                'id' => 48,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000000',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-11-17 14:11:59',
                'updated_at' => '2024-11-17 14:11:59',
            ),
            48 => 
            array (
                'id' => 49,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000001',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-08-08 05:39:01',
                'updated_at' => '2024-08-08 05:39:01',
            ),
            49 => 
            array (
                'id' => 50,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000001',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-11-03 10:20:43',
                'updated_at' => '2024-11-03 10:20:43',
            ),
            50 => 
            array (
                'id' => 51,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000001',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-11-03 17:32:47',
                'updated_at' => '2024-11-03 17:32:47',
            ),
            51 => 
            array (
                'id' => 52,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000002',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-11-03 09:29:52',
                'updated_at' => '2024-11-03 09:29:52',
            ),
            52 => 
            array (
                'id' => 53,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000002',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:40:28',
                'updated_at' => '2024-08-08 05:40:28',
            ),
            53 => 
            array (
                'id' => 54,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000002',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:40:28',
                'updated_at' => '2024-08-08 05:40:28',
            ),
            54 => 
            array (
                'id' => 55,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000003',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-11-03 09:50:00',
                'updated_at' => '2024-11-03 09:50:00',
            ),
            55 => 
            array (
                'id' => 56,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000003',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:43:08',
                'updated_at' => '2024-08-08 05:43:08',
            ),
            56 => 
            array (
                'id' => 57,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000003',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:43:08',
                'updated_at' => '2024-08-08 05:43:08',
            ),
            57 => 
            array (
                'id' => 58,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000004',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-08-08 05:48:39',
                'updated_at' => '2024-08-08 05:48:39',
            ),
            58 => 
            array (
                'id' => 59,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000004',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:48:39',
                'updated_at' => '2024-08-08 05:48:39',
            ),
            59 => 
            array (
                'id' => 60,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000004',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:48:39',
                'updated_at' => '2024-08-08 05:48:39',
            ),
            60 => 
            array (
                'id' => 61,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000005',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-10-24 11:44:29',
                'updated_at' => '2024-10-24 11:44:29',
            ),
            61 => 
            array (
                'id' => 62,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000005',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:50:21',
                'updated_at' => '2024-08-08 05:50:21',
            ),
            62 => 
            array (
                'id' => 63,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000005',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-08-08 05:50:21',
                'updated_at' => '2024-08-08 05:50:21',
            ),
            63 => 
            array (
                'id' => 64,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000006',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-08-08 05:53:11',
                'updated_at' => '2024-08-08 05:53:11',
            ),
            64 => 
            array (
                'id' => 65,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000006',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-10-24 11:12:09',
                'updated_at' => '2024-10-24 11:12:09',
            ),
            65 => 
            array (
                'id' => 66,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000006',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-11-17 14:22:54',
                'updated_at' => '2024-11-17 14:22:54',
            ),
            66 => 
            array (
                'id' => 67,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000007',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-08-08 05:54:55',
                'updated_at' => '2024-08-08 05:54:55',
            ),
            67 => 
            array (
                'id' => 68,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000007',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-10-24 11:12:25',
                'updated_at' => '2024-10-24 11:12:25',
            ),
            68 => 
            array (
                'id' => 69,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000007',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-11-17 14:20:51',
                'updated_at' => '2024-11-17 14:20:51',
            ),
            69 => 
            array (
                'id' => 70,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000008',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-08-08 05:58:12',
                'updated_at' => '2024-08-08 05:58:12',
            ),
            70 => 
            array (
                'id' => 71,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000008',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-11-04 17:56:49',
                'updated_at' => '2024-11-04 17:56:49',
            ),
            71 => 
            array (
                'id' => 72,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000008',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-11-05 14:00:33',
                'updated_at' => '2024-11-05 14:00:33',
            ),
            72 => 
            array (
                'id' => 73,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000009',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-08-08 06:01:05',
                'updated_at' => '2024-08-08 06:01:05',
            ),
            73 => 
            array (
                'id' => 74,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000009',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-11-04 17:57:07',
                'updated_at' => '2024-11-04 17:57:07',
            ),
            74 => 
            array (
                'id' => 75,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000009',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-11-05 14:00:56',
                'updated_at' => '2024-11-05 14:00:56',
            ),
            75 => 
            array (
                'id' => 76,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000010',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-11-04 18:04:12',
                'updated_at' => '2024-11-04 18:04:12',
            ),
            76 => 
            array (
                'id' => 77,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000010',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-08-08 06:03:03',
                'updated_at' => '2024-08-08 06:03:03',
            ),
            77 => 
            array (
                'id' => 78,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000010',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-08-08 06:03:03',
                'updated_at' => '2024-08-08 06:03:03',
            ),
            78 => 
            array (
                'id' => 79,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000011',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-10-28 16:48:45',
                'updated_at' => '2024-10-28 16:48:45',
            ),
            79 => 
            array (
                'id' => 80,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000011',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-08-08 06:09:37',
                'updated_at' => '2024-08-08 06:09:37',
            ),
            80 => 
            array (
                'id' => 81,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000011',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-08-08 06:09:37',
                'updated_at' => '2024-08-08 06:09:37',
            ),
            81 => 
            array (
                'id' => 82,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000012',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-08-08 06:14:28',
                'updated_at' => '2024-08-08 06:14:28',
            ),
            82 => 
            array (
                'id' => 83,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000012',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-10-28 16:57:10',
                'updated_at' => '2024-10-28 16:57:10',
            ),
            83 => 
            array (
                'id' => 84,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000012',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-11-17 11:19:46',
                'updated_at' => '2024-11-17 11:19:46',
            ),
            84 => 
            array (
                'id' => 85,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000013',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-08-08 06:17:12',
                'updated_at' => '2024-08-08 06:17:12',
            ),
            85 => 
            array (
                'id' => 86,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000013',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-10-28 16:57:28',
                'updated_at' => '2024-10-28 16:57:28',
            ),
            86 => 
            array (
                'id' => 87,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000013',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-10-29 15:02:27',
                'updated_at' => '2024-10-29 15:02:27',
            ),
            87 => 
            array (
                'id' => 88,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '93',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 17:25:19',
                'updated_at' => '2024-11-16 17:25:19',
            ),
            88 => 
            array (
                'id' => 89,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '94',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 17:25:19',
                'updated_at' => '2024-11-16 17:25:19',
            ),
            89 => 
            array (
                'id' => 90,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '95',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 17:25:19',
                'updated_at' => '2024-11-16 17:25:19',
            ),
            90 => 
            array (
                'id' => 91,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '97',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 12:21:38',
                'updated_at' => '2024-11-20 12:21:38',
            ),
            91 => 
            array (
                'id' => 92,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '98',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 12:21:38',
                'updated_at' => '2024-11-20 12:21:38',
            ),
            92 => 
            array (
                'id' => 93,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '99',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 12:21:38',
                'updated_at' => '2024-11-20 12:21:38',
            ),
            93 => 
            array (
                'id' => 94,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '101',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 12:21:12',
                'updated_at' => '2024-11-20 12:21:12',
            ),
            94 => 
            array (
                'id' => 95,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '102',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 12:21:12',
                'updated_at' => '2024-11-20 12:21:12',
            ),
            95 => 
            array (
                'id' => 96,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '103',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 12:21:13',
                'updated_at' => '2024-11-20 12:21:13',
            ),
            96 => 
            array (
                'id' => 97,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '20',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 14:13:31',
                'updated_at' => '2024-11-16 14:13:31',
            ),
            97 => 
            array (
                'id' => 98,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '18',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 14:13:27',
                'updated_at' => '2024-11-16 14:13:27',
            ),
            98 => 
            array (
                'id' => 99,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-24 10:11:14',
                'updated_at' => '2024-10-24 10:11:14',
            ),
            99 => 
            array (
                'id' => 100,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '7',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-22 14:41:56',
                'updated_at' => '2024-10-22 14:41:56',
            ),
            100 => 
            array (
                'id' => 101,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '11',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-22 14:42:13',
                'updated_at' => '2024-10-22 14:42:13',
            ),
            101 => 
            array (
                'id' => 102,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '44',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-22 14:42:50',
                'updated_at' => '2024-10-22 14:42:50',
            ),
            102 => 
            array (
                'id' => 103,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '3',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-17 14:24:34',
                'updated_at' => '2024-11-17 14:24:34',
            ),
            103 => 
            array (
                'id' => 104,
                'data_type' => 'App\\Models\\ItemCampaign',
                'data_id' => '12',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-22 18:01:12',
                'updated_at' => '2024-10-22 18:01:12',
            ),
            104 => 
            array (
                'id' => 105,
                'data_type' => 'App\\Models\\ItemCampaign',
                'data_id' => '11',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-22 18:02:26',
                'updated_at' => '2024-10-22 18:02:26',
            ),
            105 => 
            array (
                'id' => 106,
                'data_type' => 'App\\Models\\ItemCampaign',
                'data_id' => '10',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 11:30:31',
                'updated_at' => '2024-10-23 11:30:31',
            ),
            106 => 
            array (
                'id' => 107,
                'data_type' => 'App\\Models\\ItemCampaign',
                'data_id' => '9',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 11:30:47',
                'updated_at' => '2024-10-23 11:30:47',
            ),
            107 => 
            array (
                'id' => 108,
                'data_type' => 'App\\Models\\ItemCampaign',
                'data_id' => '8',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 13:42:36',
                'updated_at' => '2024-10-23 13:42:36',
            ),
            108 => 
            array (
                'id' => 109,
                'data_type' => 'App\\Models\\ItemCampaign',
                'data_id' => '6',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 13:45:31',
                'updated_at' => '2024-10-23 13:45:31',
            ),
            109 => 
            array (
                'id' => 110,
                'data_type' => 'App\\Models\\ItemCampaign',
                'data_id' => '23',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 15:43:35',
                'updated_at' => '2024-10-23 15:43:35',
            ),
            110 => 
            array (
                'id' => 111,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '7',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 18:51:24',
                'updated_at' => '2024-10-23 18:51:24',
            ),
            111 => 
            array (
                'id' => 112,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '6',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-17 09:31:16',
                'updated_at' => '2024-11-17 09:31:16',
            ),
            112 => 
            array (
                'id' => 113,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '99',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 18:09:09',
                'updated_at' => '2024-10-23 18:09:09',
            ),
            113 => 
            array (
                'id' => 114,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '100',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 18:09:31',
                'updated_at' => '2024-10-23 18:09:31',
            ),
            114 => 
            array (
                'id' => 115,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '12',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 18:20:12',
                'updated_at' => '2024-10-23 18:20:12',
            ),
            115 => 
            array (
                'id' => 116,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '11',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 18:50:25',
                'updated_at' => '2024-10-23 18:50:25',
            ),
            116 => 
            array (
                'id' => 117,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '10',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 18:50:40',
                'updated_at' => '2024-10-23 18:50:40',
            ),
            117 => 
            array (
                'id' => 118,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '9',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 18:50:56',
                'updated_at' => '2024-10-23 18:50:56',
            ),
            118 => 
            array (
                'id' => 119,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '8',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 18:51:11',
                'updated_at' => '2024-10-23 18:51:11',
            ),
            119 => 
            array (
                'id' => 120,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 18:55:03',
                'updated_at' => '2024-10-23 18:55:03',
            ),
            120 => 
            array (
                'id' => 121,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-24 10:08:59',
                'updated_at' => '2024-10-24 10:08:59',
            ),
            121 => 
            array (
                'id' => 122,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-23 18:55:48',
                'updated_at' => '2024-10-23 18:55:48',
            ),
            122 => 
            array (
                'id' => 123,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '101',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-24 10:04:34',
                'updated_at' => '2024-10-24 10:04:34',
            ),
            123 => 
            array (
                'id' => 124,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '102',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-17 09:31:49',
                'updated_at' => '2024-11-17 09:31:49',
            ),
            124 => 
            array (
                'id' => 125,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-24 10:03:38',
                'updated_at' => '2024-10-24 10:03:38',
            ),
            125 => 
            array (
                'id' => 126,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-24 10:03:52',
                'updated_at' => '2024-10-24 10:03:52',
            ),
            126 => 
            array (
                'id' => 127,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '5',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 12:39:05',
                'updated_at' => '2024-10-24 12:39:05',
            ),
            127 => 
            array (
                'id' => 128,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '18',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 12:47:28',
                'updated_at' => '2024-10-24 12:47:28',
            ),
            128 => 
            array (
                'id' => 129,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '12',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 13:29:06',
                'updated_at' => '2024-10-24 13:29:06',
            ),
            129 => 
            array (
                'id' => 130,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '33',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 13:36:51',
                'updated_at' => '2024-10-24 13:36:51',
            ),
            130 => 
            array (
                'id' => 131,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '30',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 13:59:01',
                'updated_at' => '2024-10-24 13:59:01',
            ),
            131 => 
            array (
                'id' => 132,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '32',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 14:24:20',
                'updated_at' => '2024-10-24 14:24:20',
            ),
            132 => 
            array (
                'id' => 133,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '11',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 14:46:17',
                'updated_at' => '2024-10-24 14:46:17',
            ),
            133 => 
            array (
                'id' => 134,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '9',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 15:32:41',
                'updated_at' => '2024-10-24 15:32:41',
            ),
            134 => 
            array (
                'id' => 135,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '16',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 17:30:53',
                'updated_at' => '2024-10-24 17:30:53',
            ),
            135 => 
            array (
                'id' => 136,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '1',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 17:31:52',
                'updated_at' => '2024-10-24 17:31:52',
            ),
            136 => 
            array (
                'id' => 137,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '14',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 17:32:19',
                'updated_at' => '2024-10-24 17:32:19',
            ),
            137 => 
            array (
                'id' => 138,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '31',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 17:33:09',
                'updated_at' => '2024-10-24 17:33:09',
            ),
            138 => 
            array (
                'id' => 139,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '3',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 17:34:25',
                'updated_at' => '2024-10-24 17:34:25',
            ),
            139 => 
            array (
                'id' => 140,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '7',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-24 17:39:49',
                'updated_at' => '2024-10-24 17:39:49',
            ),
            140 => 
            array (
                'id' => 141,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '103',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:42:22',
                'updated_at' => '2024-10-27 09:42:22',
            ),
            141 => 
            array (
                'id' => 142,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '104',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:42:30',
                'updated_at' => '2024-10-27 09:42:30',
            ),
            142 => 
            array (
                'id' => 143,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '105',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:42:37',
                'updated_at' => '2024-10-27 09:42:37',
            ),
            143 => 
            array (
                'id' => 144,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '106',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:42:49',
                'updated_at' => '2024-10-27 09:42:49',
            ),
            144 => 
            array (
                'id' => 145,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '107',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:42:56',
                'updated_at' => '2024-10-27 09:42:56',
            ),
            145 => 
            array (
                'id' => 146,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '108',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:43:02',
                'updated_at' => '2024-10-27 09:43:02',
            ),
            146 => 
            array (
                'id' => 147,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '109',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:43:22',
                'updated_at' => '2024-10-27 09:43:22',
            ),
            147 => 
            array (
                'id' => 148,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '110',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:46:39',
                'updated_at' => '2024-10-27 09:46:39',
            ),
            148 => 
            array (
                'id' => 149,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '111',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:47:51',
                'updated_at' => '2024-10-27 09:47:51',
            ),
            149 => 
            array (
                'id' => 150,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '112',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:48:04',
                'updated_at' => '2024-10-27 09:48:04',
            ),
            150 => 
            array (
                'id' => 151,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '113',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:48:14',
                'updated_at' => '2024-10-27 09:48:14',
            ),
            151 => 
            array (
                'id' => 152,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '114',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:48:23',
                'updated_at' => '2024-10-27 09:48:23',
            ),
            152 => 
            array (
                'id' => 153,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '115',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:48:59',
                'updated_at' => '2024-10-27 09:48:59',
            ),
            153 => 
            array (
                'id' => 154,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '116',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:49:07',
                'updated_at' => '2024-10-27 09:49:07',
            ),
            154 => 
            array (
                'id' => 155,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '117',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:49:18',
                'updated_at' => '2024-10-27 09:49:18',
            ),
            155 => 
            array (
                'id' => 156,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '118',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:49:26',
                'updated_at' => '2024-10-27 09:49:26',
            ),
            156 => 
            array (
                'id' => 157,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '119',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:49:34',
                'updated_at' => '2024-10-27 09:49:34',
            ),
            157 => 
            array (
                'id' => 158,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '120',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:50:15',
                'updated_at' => '2024-10-27 09:50:15',
            ),
            158 => 
            array (
                'id' => 159,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '121',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:50:28',
                'updated_at' => '2024-10-27 09:50:28',
            ),
            159 => 
            array (
                'id' => 160,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '122',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:50:36',
                'updated_at' => '2024-10-27 09:50:36',
            ),
            160 => 
            array (
                'id' => 161,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '123',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:52:24',
                'updated_at' => '2024-10-27 09:52:24',
            ),
            161 => 
            array (
                'id' => 162,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '124',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:52:32',
                'updated_at' => '2024-10-27 09:52:32',
            ),
            162 => 
            array (
                'id' => 163,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '125',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:52:45',
                'updated_at' => '2024-10-27 09:52:45',
            ),
            163 => 
            array (
                'id' => 164,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '126',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:52:55',
                'updated_at' => '2024-10-27 09:52:55',
            ),
            164 => 
            array (
                'id' => 165,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '127',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:53:03',
                'updated_at' => '2024-10-27 09:53:03',
            ),
            165 => 
            array (
                'id' => 166,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '128',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:53:11',
                'updated_at' => '2024-10-27 09:53:11',
            ),
            166 => 
            array (
                'id' => 167,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '129',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:56:03',
                'updated_at' => '2024-10-27 09:56:03',
            ),
            167 => 
            array (
                'id' => 168,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '130',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:56:33',
                'updated_at' => '2024-10-27 09:56:33',
            ),
            168 => 
            array (
                'id' => 169,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '131',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:56:42',
                'updated_at' => '2024-10-27 09:56:42',
            ),
            169 => 
            array (
                'id' => 170,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '132',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:56:49',
                'updated_at' => '2024-10-27 09:56:49',
            ),
            170 => 
            array (
                'id' => 171,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '133',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:57:09',
                'updated_at' => '2024-10-27 09:57:09',
            ),
            171 => 
            array (
                'id' => 172,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '134',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:57:18',
                'updated_at' => '2024-10-27 09:57:18',
            ),
            172 => 
            array (
                'id' => 173,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '135',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:57:28',
                'updated_at' => '2024-10-27 09:57:28',
            ),
            173 => 
            array (
                'id' => 174,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '136',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:57:36',
                'updated_at' => '2024-10-27 09:57:36',
            ),
            174 => 
            array (
                'id' => 175,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '137',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:59:47',
                'updated_at' => '2024-10-27 09:59:47',
            ),
            175 => 
            array (
                'id' => 176,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '138',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 09:59:55',
                'updated_at' => '2024-10-27 09:59:55',
            ),
            176 => 
            array (
                'id' => 177,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '139',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 10:00:11',
                'updated_at' => '2024-10-27 10:00:11',
            ),
            177 => 
            array (
                'id' => 178,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '140',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 10:00:21',
                'updated_at' => '2024-10-27 10:00:21',
            ),
            178 => 
            array (
                'id' => 179,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '141',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 10:00:28',
                'updated_at' => '2024-10-27 10:00:28',
            ),
            179 => 
            array (
                'id' => 180,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '142',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 10:00:35',
                'updated_at' => '2024-10-27 10:00:35',
            ),
            180 => 
            array (
                'id' => 181,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '143',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 10:00:42',
                'updated_at' => '2024-10-27 10:00:42',
            ),
            181 => 
            array (
                'id' => 182,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '63',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 10:17:35',
                'updated_at' => '2024-10-27 10:17:35',
            ),
            182 => 
            array (
                'id' => 183,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '63',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 10:24:00',
                'updated_at' => '2024-10-27 10:24:00',
            ),
            183 => 
            array (
                'id' => 184,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '42',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 11:15:53',
                'updated_at' => '2024-10-27 11:15:53',
            ),
            184 => 
            array (
                'id' => 185,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '42',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 11:15:53',
                'updated_at' => '2024-10-27 11:15:53',
            ),
            185 => 
            array (
                'id' => 186,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '24',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 11:20:16',
                'updated_at' => '2024-10-27 11:20:16',
            ),
            186 => 
            array (
                'id' => 187,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '24',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 11:20:16',
                'updated_at' => '2024-10-27 11:20:16',
            ),
            187 => 
            array (
                'id' => 188,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '136',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 14:11:57',
                'updated_at' => '2024-10-27 14:11:57',
            ),
            188 => 
            array (
                'id' => 189,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '136',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 14:11:57',
                'updated_at' => '2024-10-27 14:11:57',
            ),
            189 => 
            array (
                'id' => 190,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '57',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 14:16:42',
                'updated_at' => '2024-10-27 14:16:42',
            ),
            190 => 
            array (
                'id' => 191,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '57',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 14:16:42',
                'updated_at' => '2024-10-27 14:16:42',
            ),
            191 => 
            array (
                'id' => 192,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '13',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 14:19:54',
                'updated_at' => '2024-10-27 14:19:54',
            ),
            192 => 
            array (
                'id' => 193,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '13',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 14:19:54',
                'updated_at' => '2024-10-27 14:19:54',
            ),
            193 => 
            array (
                'id' => 194,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '85',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 14:23:37',
                'updated_at' => '2024-10-27 14:23:37',
            ),
            194 => 
            array (
                'id' => 195,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '85',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 14:23:37',
                'updated_at' => '2024-10-27 14:23:37',
            ),
            195 => 
            array (
                'id' => 196,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '81',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 14:27:59',
                'updated_at' => '2024-10-27 14:27:59',
            ),
            196 => 
            array (
                'id' => 197,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '81',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 14:27:59',
                'updated_at' => '2024-10-27 14:27:59',
            ),
            197 => 
            array (
                'id' => 198,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '90',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 14:32:30',
                'updated_at' => '2024-10-27 14:32:30',
            ),
            198 => 
            array (
                'id' => 199,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '90',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 14:32:30',
                'updated_at' => '2024-10-27 14:32:30',
            ),
            199 => 
            array (
                'id' => 200,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '28',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 14:35:14',
                'updated_at' => '2024-10-27 14:35:14',
            ),
            200 => 
            array (
                'id' => 201,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '28',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 14:35:14',
                'updated_at' => '2024-10-27 14:35:14',
            ),
            201 => 
            array (
                'id' => 202,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '60',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 15:10:08',
                'updated_at' => '2024-10-27 15:10:08',
            ),
            202 => 
            array (
                'id' => 203,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '60',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 15:10:08',
                'updated_at' => '2024-10-27 15:10:08',
            ),
            203 => 
            array (
                'id' => 204,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '29',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 15:14:02',
                'updated_at' => '2024-10-27 15:14:02',
            ),
            204 => 
            array (
                'id' => 205,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '29',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 15:14:02',
                'updated_at' => '2024-10-27 15:14:02',
            ),
            205 => 
            array (
                'id' => 206,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '97',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 15:20:52',
                'updated_at' => '2024-10-27 15:20:52',
            ),
            206 => 
            array (
                'id' => 207,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '97',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 15:20:52',
                'updated_at' => '2024-10-27 15:20:52',
            ),
            207 => 
            array (
                'id' => 208,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '34',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 15:26:17',
                'updated_at' => '2024-10-27 15:26:17',
            ),
            208 => 
            array (
                'id' => 209,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '34',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 15:26:17',
                'updated_at' => '2024-10-27 15:26:17',
            ),
            209 => 
            array (
                'id' => 210,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '46',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 15:39:00',
                'updated_at' => '2024-10-27 15:39:00',
            ),
            210 => 
            array (
                'id' => 211,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '46',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 15:39:00',
                'updated_at' => '2024-10-27 15:39:00',
            ),
            211 => 
            array (
                'id' => 212,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '96',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 15:42:49',
                'updated_at' => '2024-10-27 15:42:49',
            ),
            212 => 
            array (
                'id' => 213,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '96',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 15:42:49',
                'updated_at' => '2024-10-27 15:42:49',
            ),
            213 => 
            array (
                'id' => 214,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '134',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 15:59:30',
                'updated_at' => '2024-10-27 15:59:30',
            ),
            214 => 
            array (
                'id' => 215,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '134',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 15:59:30',
                'updated_at' => '2024-10-27 15:59:30',
            ),
            215 => 
            array (
                'id' => 216,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '38',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 16:03:53',
                'updated_at' => '2024-10-27 16:03:53',
            ),
            216 => 
            array (
                'id' => 217,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '38',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 16:03:53',
                'updated_at' => '2024-10-27 16:03:53',
            ),
            217 => 
            array (
                'id' => 218,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '135',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 16:07:36',
                'updated_at' => '2024-10-27 16:07:36',
            ),
            218 => 
            array (
                'id' => 219,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '135',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 16:07:36',
                'updated_at' => '2024-10-27 16:07:36',
            ),
            219 => 
            array (
                'id' => 220,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '94',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 16:14:18',
                'updated_at' => '2024-10-27 16:14:18',
            ),
            220 => 
            array (
                'id' => 221,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '94',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 16:14:18',
                'updated_at' => '2024-10-27 16:14:18',
            ),
            221 => 
            array (
                'id' => 222,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '22',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 16:28:13',
                'updated_at' => '2024-10-27 16:28:13',
            ),
            222 => 
            array (
                'id' => 223,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '22',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 16:28:13',
                'updated_at' => '2024-10-27 16:28:13',
            ),
            223 => 
            array (
                'id' => 224,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '48',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 16:34:18',
                'updated_at' => '2024-10-27 16:34:18',
            ),
            224 => 
            array (
                'id' => 225,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '48',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 16:34:18',
                'updated_at' => '2024-10-27 16:34:18',
            ),
            225 => 
            array (
                'id' => 226,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '123',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 16:48:01',
                'updated_at' => '2024-10-27 16:48:01',
            ),
            226 => 
            array (
                'id' => 227,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '123',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 16:48:01',
                'updated_at' => '2024-10-27 16:48:01',
            ),
            227 => 
            array (
                'id' => 228,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '52',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 16:56:20',
                'updated_at' => '2024-10-27 16:56:20',
            ),
            228 => 
            array (
                'id' => 229,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '52',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 16:56:20',
                'updated_at' => '2024-10-27 16:56:20',
            ),
            229 => 
            array (
                'id' => 230,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '131',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:01:31',
                'updated_at' => '2024-10-27 17:01:31',
            ),
            230 => 
            array (
                'id' => 231,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '131',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:01:31',
                'updated_at' => '2024-10-27 17:01:31',
            ),
            231 => 
            array (
                'id' => 232,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '7',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:05:49',
                'updated_at' => '2024-10-27 17:05:49',
            ),
            232 => 
            array (
                'id' => 233,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '7',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:05:49',
                'updated_at' => '2024-10-27 17:05:49',
            ),
            233 => 
            array (
                'id' => 234,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '141',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:12:04',
                'updated_at' => '2024-10-27 17:12:04',
            ),
            234 => 
            array (
                'id' => 235,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '141',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:12:04',
                'updated_at' => '2024-10-27 17:12:04',
            ),
            235 => 
            array (
                'id' => 236,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '18',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:20:43',
                'updated_at' => '2024-10-27 17:20:43',
            ),
            236 => 
            array (
                'id' => 237,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '18',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:20:43',
                'updated_at' => '2024-10-27 17:20:43',
            ),
            237 => 
            array (
                'id' => 238,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:25:00',
                'updated_at' => '2024-10-27 17:25:00',
            ),
            238 => 
            array (
                'id' => 239,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '5',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:25:00',
                'updated_at' => '2024-10-27 17:25:00',
            ),
            239 => 
            array (
                'id' => 240,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '139',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:28:08',
                'updated_at' => '2024-10-27 17:28:08',
            ),
            240 => 
            array (
                'id' => 241,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '139',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:28:08',
                'updated_at' => '2024-10-27 17:28:08',
            ),
            241 => 
            array (
                'id' => 242,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '137',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:32:04',
                'updated_at' => '2024-10-27 17:32:04',
            ),
            242 => 
            array (
                'id' => 243,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '137',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:32:04',
                'updated_at' => '2024-10-27 17:32:04',
            ),
            243 => 
            array (
                'id' => 244,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '21',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:35:01',
                'updated_at' => '2024-10-27 17:35:01',
            ),
            244 => 
            array (
                'id' => 245,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '21',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:35:01',
                'updated_at' => '2024-10-27 17:35:01',
            ),
            245 => 
            array (
                'id' => 246,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '15',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:40:21',
                'updated_at' => '2024-10-27 17:40:21',
            ),
            246 => 
            array (
                'id' => 247,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '15',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:40:21',
                'updated_at' => '2024-10-27 17:40:21',
            ),
            247 => 
            array (
                'id' => 248,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '130',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:42:56',
                'updated_at' => '2024-10-27 17:42:56',
            ),
            248 => 
            array (
                'id' => 249,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '130',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:42:56',
                'updated_at' => '2024-10-27 17:42:56',
            ),
            249 => 
            array (
                'id' => 250,
                'data_type' => 'App\\Models\\TempProduct',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:50:26',
                'updated_at' => '2024-10-27 17:50:26',
            ),
            250 => 
            array (
                'id' => 251,
                'data_type' => 'App\\Models\\TempProduct',
                'data_id' => '1',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:50:26',
                'updated_at' => '2024-10-27 17:50:26',
            ),
            251 => 
            array (
                'id' => 252,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '138',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:50:42',
                'updated_at' => '2024-10-27 17:50:42',
            ),
            252 => 
            array (
                'id' => 253,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '138',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:50:42',
                'updated_at' => '2024-10-27 17:50:42',
            ),
            253 => 
            array (
                'id' => 254,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '133',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:54:35',
                'updated_at' => '2024-10-27 17:54:35',
            ),
            254 => 
            array (
                'id' => 255,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '133',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:54:35',
                'updated_at' => '2024-10-27 17:54:35',
            ),
            255 => 
            array (
                'id' => 256,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '10',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 17:59:09',
                'updated_at' => '2024-10-27 17:59:09',
            ),
            256 => 
            array (
                'id' => 257,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '10',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-27 17:59:09',
                'updated_at' => '2024-10-27 17:59:09',
            ),
            257 => 
            array (
                'id' => 258,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '31',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:35:32',
                'updated_at' => '2024-10-27 18:35:32',
            ),
            258 => 
            array (
                'id' => 259,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '33',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:36:35',
                'updated_at' => '2024-10-27 18:36:35',
            ),
            259 => 
            array (
                'id' => 260,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '32',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:36:53',
                'updated_at' => '2024-10-27 18:36:53',
            ),
            260 => 
            array (
                'id' => 261,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '30',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:37:07',
                'updated_at' => '2024-10-27 18:37:07',
            ),
            261 => 
            array (
                'id' => 262,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '18',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:37:28',
                'updated_at' => '2024-10-27 18:37:28',
            ),
            262 => 
            array (
                'id' => 263,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '16',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:37:46',
                'updated_at' => '2024-10-27 18:37:46',
            ),
            263 => 
            array (
                'id' => 264,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '14',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:38:07',
                'updated_at' => '2024-10-27 18:38:07',
            ),
            264 => 
            array (
                'id' => 265,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '12',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:38:28',
                'updated_at' => '2024-10-27 18:38:28',
            ),
            265 => 
            array (
                'id' => 266,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '11',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:38:44',
                'updated_at' => '2024-10-27 18:38:44',
            ),
            266 => 
            array (
                'id' => 267,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '9',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:39:01',
                'updated_at' => '2024-10-27 18:39:01',
            ),
            267 => 
            array (
                'id' => 268,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '7',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:39:19',
                'updated_at' => '2024-10-27 18:39:19',
            ),
            268 => 
            array (
                'id' => 269,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '5',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:39:38',
                'updated_at' => '2024-10-27 18:39:38',
            ),
            269 => 
            array (
                'id' => 270,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '3',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:39:53',
                'updated_at' => '2024-10-27 18:39:53',
            ),
            270 => 
            array (
                'id' => 271,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-27 18:39:53',
                'updated_at' => '2024-10-27 18:39:53',
            ),
            271 => 
            array (
                'id' => 272,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '1',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-27 18:40:08',
                'updated_at' => '2024-10-27 18:40:08',
            ),
            272 => 
            array (
                'id' => 273,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '20',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 17:10:04',
                'updated_at' => '2024-10-28 17:10:04',
            ),
            273 => 
            array (
                'id' => 274,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '21',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 15:51:14',
                'updated_at' => '2024-10-28 15:51:14',
            ),
            274 => 
            array (
                'id' => 275,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '22',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 14:02:15',
                'updated_at' => '2024-10-28 14:02:15',
            ),
            275 => 
            array (
                'id' => 276,
                'data_type' => 'App\\Models\\Campaign',
                'data_id' => '9',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 15:50:33',
                'updated_at' => '2024-10-28 15:50:33',
            ),
            276 => 
            array (
                'id' => 277,
                'data_type' => 'App\\Models\\Campaign',
                'data_id' => '8',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 15:49:39',
                'updated_at' => '2024-10-28 15:49:39',
            ),
            277 => 
            array (
                'id' => 278,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '8',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-17 10:32:17',
                'updated_at' => '2024-11-17 10:32:17',
            ),
            278 => 
            array (
                'id' => 279,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '144',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 17:25:15',
                'updated_at' => '2024-10-28 17:25:15',
            ),
            279 => 
            array (
                'id' => 280,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '145',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 17:25:22',
                'updated_at' => '2024-10-28 17:25:22',
            ),
            280 => 
            array (
                'id' => 281,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '146',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 17:25:30',
                'updated_at' => '2024-10-28 17:25:30',
            ),
            281 => 
            array (
                'id' => 282,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '147',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 17:25:40',
                'updated_at' => '2024-10-28 17:25:40',
            ),
            282 => 
            array (
                'id' => 283,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '148',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 17:25:50',
                'updated_at' => '2024-10-28 17:25:50',
            ),
            283 => 
            array (
                'id' => 284,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '39',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:05:15',
                'updated_at' => '2024-10-28 18:05:15',
            ),
            284 => 
            array (
                'id' => 285,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '38',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:05:46',
                'updated_at' => '2024-10-28 18:05:46',
            ),
            285 => 
            array (
                'id' => 286,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '37',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:06:12',
                'updated_at' => '2024-10-28 18:06:12',
            ),
            286 => 
            array (
                'id' => 287,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '36',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:06:25',
                'updated_at' => '2024-10-28 18:06:25',
            ),
            287 => 
            array (
                'id' => 288,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '35',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:06:42',
                'updated_at' => '2024-10-28 18:06:42',
            ),
            288 => 
            array (
                'id' => 289,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '34',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:06:59',
                'updated_at' => '2024-10-28 18:06:59',
            ),
            289 => 
            array (
                'id' => 290,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '33',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:07:19',
                'updated_at' => '2024-10-28 18:07:19',
            ),
            290 => 
            array (
                'id' => 291,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '32',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:07:33',
                'updated_at' => '2024-10-28 18:07:33',
            ),
            291 => 
            array (
                'id' => 292,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '31',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:07:49',
                'updated_at' => '2024-10-28 18:07:49',
            ),
            292 => 
            array (
                'id' => 293,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '30',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:08:09',
                'updated_at' => '2024-10-28 18:08:09',
            ),
            293 => 
            array (
                'id' => 294,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '28',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:08:24',
                'updated_at' => '2024-10-28 18:08:24',
            ),
            294 => 
            array (
                'id' => 295,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '27',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:08:37',
                'updated_at' => '2024-10-28 18:08:37',
            ),
            295 => 
            array (
                'id' => 296,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '26',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:08:51',
                'updated_at' => '2024-10-28 18:08:51',
            ),
            296 => 
            array (
                'id' => 297,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '25',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-28 18:09:03',
                'updated_at' => '2024-10-28 18:09:03',
            ),
            297 => 
            array (
                'id' => 298,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '36',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 09:41:54',
                'updated_at' => '2024-10-29 09:41:54',
            ),
            298 => 
            array (
                'id' => 299,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '36',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-29 09:41:54',
                'updated_at' => '2024-10-29 09:41:54',
            ),
            299 => 
            array (
                'id' => 300,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '28',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 09:57:47',
                'updated_at' => '2024-10-29 09:57:47',
            ),
            300 => 
            array (
                'id' => 301,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '28',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-29 09:57:47',
                'updated_at' => '2024-10-29 09:57:47',
            ),
            301 => 
            array (
                'id' => 302,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '21',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 10:09:21',
                'updated_at' => '2024-10-29 10:09:21',
            ),
            302 => 
            array (
                'id' => 303,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '21',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-29 10:09:21',
                'updated_at' => '2024-10-29 10:09:21',
            ),
            303 => 
            array (
                'id' => 304,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '25',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 10:25:30',
                'updated_at' => '2024-10-29 10:25:30',
            ),
            304 => 
            array (
                'id' => 305,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '25',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-29 10:25:30',
                'updated_at' => '2024-10-29 10:25:30',
            ),
            305 => 
            array (
                'id' => 306,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '22',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 10:38:35',
                'updated_at' => '2024-10-29 10:38:35',
            ),
            306 => 
            array (
                'id' => 307,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '22',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-29 10:38:35',
                'updated_at' => '2024-10-29 10:38:35',
            ),
            307 => 
            array (
                'id' => 308,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '39',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 11:00:15',
                'updated_at' => '2024-10-29 11:00:15',
            ),
            308 => 
            array (
                'id' => 309,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '39',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-29 11:00:15',
                'updated_at' => '2024-10-29 11:00:15',
            ),
            309 => 
            array (
                'id' => 310,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '29',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 11:35:27',
                'updated_at' => '2024-10-29 11:35:27',
            ),
            310 => 
            array (
                'id' => 311,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '29',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-29 11:35:27',
                'updated_at' => '2024-10-29 11:35:27',
            ),
            311 => 
            array (
                'id' => 312,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '23',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 11:47:29',
                'updated_at' => '2024-10-29 11:47:29',
            ),
            312 => 
            array (
                'id' => 313,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '23',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-17 10:37:04',
                'updated_at' => '2024-11-17 10:37:04',
            ),
            313 => 
            array (
                'id' => 314,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '38',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 12:39:19',
                'updated_at' => '2024-10-29 12:39:19',
            ),
            314 => 
            array (
                'id' => 315,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '38',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-29 12:39:19',
                'updated_at' => '2024-10-29 12:39:19',
            ),
            315 => 
            array (
                'id' => 316,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '26',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 12:49:41',
                'updated_at' => '2024-10-29 12:49:41',
            ),
            316 => 
            array (
                'id' => 317,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '26',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-29 12:49:41',
                'updated_at' => '2024-10-29 12:49:41',
            ),
            317 => 
            array (
                'id' => 318,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '27',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 13:00:42',
                'updated_at' => '2024-10-29 13:00:42',
            ),
            318 => 
            array (
                'id' => 319,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '27',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-29 13:00:42',
                'updated_at' => '2024-10-29 13:00:42',
            ),
            319 => 
            array (
                'id' => 320,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '24',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-10-29 13:08:53',
                'updated_at' => '2024-10-29 13:08:53',
            ),
            320 => 
            array (
                'id' => 321,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '24',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-10-29 13:08:53',
                'updated_at' => '2024-10-29 13:08:53',
            ),
            321 => 
            array (
                'id' => 322,
                'data_type' => 'App\\Models\\Brand',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 13:36:58',
                'updated_at' => '2024-10-29 13:36:58',
            ),
            322 => 
            array (
                'id' => 323,
                'data_type' => 'App\\Models\\Brand',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 13:37:17',
                'updated_at' => '2024-10-29 13:37:17',
            ),
            323 => 
            array (
                'id' => 324,
                'data_type' => 'App\\Models\\Brand',
                'data_id' => '6',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 13:37:53',
                'updated_at' => '2024-10-29 13:37:53',
            ),
            324 => 
            array (
                'id' => 325,
                'data_type' => 'App\\Models\\Brand',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 13:38:13',
                'updated_at' => '2024-10-29 13:38:13',
            ),
            325 => 
            array (
                'id' => 326,
                'data_type' => 'App\\Models\\Brand',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 13:38:36',
                'updated_at' => '2024-10-29 13:38:36',
            ),
            326 => 
            array (
                'id' => 327,
                'data_type' => 'App\\Models\\Brand',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 13:38:57',
                'updated_at' => '2024-10-29 13:38:57',
            ),
            327 => 
            array (
                'id' => 328,
                'data_type' => 'App\\Models\\Brand',
                'data_id' => '7',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 13:39:15',
                'updated_at' => '2024-10-29 13:39:15',
            ),
            328 => 
            array (
                'id' => 329,
                'data_type' => 'App\\Models\\Brand',
                'data_id' => '8',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 13:44:15',
                'updated_at' => '2024-10-29 13:44:15',
            ),
            329 => 
            array (
                'id' => 330,
                'data_type' => 'App\\Models\\Brand',
                'data_id' => '9',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 13:44:38',
                'updated_at' => '2024-10-29 13:44:38',
            ),
            330 => 
            array (
                'id' => 331,
                'data_type' => 'App\\Models\\Brand',
                'data_id' => '10',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 13:44:58',
                'updated_at' => '2024-10-29 13:44:58',
            ),
            331 => 
            array (
                'id' => 332,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '7',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-10-29 14:13:29',
                'updated_at' => '2024-10-29 14:13:29',
            ),
            332 => 
            array (
                'id' => 333,
                'data_type' => 'App\\Models\\Campaign',
                'data_id' => '12',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 14:25:09',
                'updated_at' => '2024-10-29 14:25:09',
            ),
            333 => 
            array (
                'id' => 334,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000014',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2024-10-29 15:05:49',
                'updated_at' => '2024-10-29 15:05:49',
            ),
            334 => 
            array (
                'id' => 335,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000014',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2024-10-29 15:05:49',
                'updated_at' => '2024-10-29 15:05:49',
            ),
            335 => 
            array (
                'id' => 336,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000014',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2024-11-17 11:18:32',
                'updated_at' => '2024-11-17 11:18:32',
            ),
            336 => 
            array (
                'id' => 337,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '36',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 16:56:44',
                'updated_at' => '2024-10-29 16:56:44',
            ),
            337 => 
            array (
                'id' => 338,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '36',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 16:57:35',
                'updated_at' => '2024-10-29 16:57:35',
            ),
            338 => 
            array (
                'id' => 339,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '99',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:00:51',
                'updated_at' => '2024-10-29 17:00:51',
            ),
            339 => 
            array (
                'id' => 340,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '99',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:00:51',
                'updated_at' => '2024-10-29 17:00:51',
            ),
            340 => 
            array (
                'id' => 341,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '92',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:03:13',
                'updated_at' => '2024-10-29 17:03:13',
            ),
            341 => 
            array (
                'id' => 342,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '92',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:03:13',
                'updated_at' => '2024-10-29 17:03:13',
            ),
            342 => 
            array (
                'id' => 343,
                'data_type' => 'App\\Models\\TempProduct',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:10:22',
                'updated_at' => '2024-10-29 17:10:22',
            ),
            343 => 
            array (
                'id' => 344,
                'data_type' => 'App\\Models\\TempProduct',
                'data_id' => '2',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:10:22',
                'updated_at' => '2024-10-29 17:10:22',
            ),
            344 => 
            array (
                'id' => 345,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '103',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:13:24',
                'updated_at' => '2024-10-29 17:13:24',
            ),
            345 => 
            array (
                'id' => 346,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '103',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:13:24',
                'updated_at' => '2024-10-29 17:13:24',
            ),
            346 => 
            array (
                'id' => 347,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '113',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:16:27',
                'updated_at' => '2024-10-29 17:16:27',
            ),
            347 => 
            array (
                'id' => 348,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '113',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:16:27',
                'updated_at' => '2024-10-29 17:16:27',
            ),
            348 => 
            array (
                'id' => 349,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '98',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:19:10',
                'updated_at' => '2024-10-29 17:19:10',
            ),
            349 => 
            array (
                'id' => 350,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '98',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:19:10',
                'updated_at' => '2024-10-29 17:19:10',
            ),
            350 => 
            array (
                'id' => 351,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '107',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:21:30',
                'updated_at' => '2024-10-29 17:21:30',
            ),
            351 => 
            array (
                'id' => 352,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '107',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:21:30',
                'updated_at' => '2024-10-29 17:21:30',
            ),
            352 => 
            array (
                'id' => 353,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '39',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:24:35',
                'updated_at' => '2024-10-29 17:24:35',
            ),
            353 => 
            array (
                'id' => 354,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '39',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:24:35',
                'updated_at' => '2024-10-29 17:24:35',
            ),
            354 => 
            array (
                'id' => 355,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '87',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:27:19',
                'updated_at' => '2024-10-29 17:27:19',
            ),
            355 => 
            array (
                'id' => 356,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '87',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:27:19',
                'updated_at' => '2024-10-29 17:27:19',
            ),
            356 => 
            array (
                'id' => 357,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '161',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:30:18',
                'updated_at' => '2024-10-29 17:30:18',
            ),
            357 => 
            array (
                'id' => 358,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '161',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:30:18',
                'updated_at' => '2024-10-29 17:30:18',
            ),
            358 => 
            array (
                'id' => 359,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '95',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:33:23',
                'updated_at' => '2024-10-29 17:33:23',
            ),
            359 => 
            array (
                'id' => 360,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '95',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:33:23',
                'updated_at' => '2024-10-29 17:33:23',
            ),
            360 => 
            array (
                'id' => 361,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '49',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:38:43',
                'updated_at' => '2024-10-29 17:38:43',
            ),
            361 => 
            array (
                'id' => 362,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '49',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:38:43',
                'updated_at' => '2024-10-29 17:38:43',
            ),
            362 => 
            array (
                'id' => 363,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '65',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:42:14',
                'updated_at' => '2024-10-29 17:42:14',
            ),
            363 => 
            array (
                'id' => 364,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '65',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:42:14',
                'updated_at' => '2024-10-29 17:42:14',
            ),
            364 => 
            array (
                'id' => 365,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '55',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:45:03',
                'updated_at' => '2024-10-29 17:45:03',
            ),
            365 => 
            array (
                'id' => 366,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '55',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:45:03',
                'updated_at' => '2024-10-29 17:45:03',
            ),
            366 => 
            array (
                'id' => 367,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '104',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:47:57',
                'updated_at' => '2024-10-29 17:47:57',
            ),
            367 => 
            array (
                'id' => 368,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '104',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:47:57',
                'updated_at' => '2024-10-29 17:47:57',
            ),
            368 => 
            array (
                'id' => 369,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '82',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:50:38',
                'updated_at' => '2024-10-29 17:50:38',
            ),
            369 => 
            array (
                'id' => 370,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '82',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:50:38',
                'updated_at' => '2024-10-29 17:50:38',
            ),
            370 => 
            array (
                'id' => 371,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '58',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:53:56',
                'updated_at' => '2024-10-29 17:53:56',
            ),
            371 => 
            array (
                'id' => 372,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '58',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:53:56',
                'updated_at' => '2024-10-29 17:53:56',
            ),
            372 => 
            array (
                'id' => 373,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '72',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 17:57:08',
                'updated_at' => '2024-10-29 17:57:08',
            ),
            373 => 
            array (
                'id' => 374,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '72',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 17:57:08',
                'updated_at' => '2024-10-29 17:57:08',
            ),
            374 => 
            array (
                'id' => 375,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '120',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 18:00:25',
                'updated_at' => '2024-10-29 18:00:25',
            ),
            375 => 
            array (
                'id' => 376,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '120',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 18:00:25',
                'updated_at' => '2024-10-29 18:00:25',
            ),
            376 => 
            array (
                'id' => 377,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '73',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 18:03:24',
                'updated_at' => '2024-10-29 18:03:24',
            ),
            377 => 
            array (
                'id' => 378,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '73',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 18:03:24',
                'updated_at' => '2024-10-29 18:03:24',
            ),
            378 => 
            array (
                'id' => 379,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '132',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 18:06:15',
                'updated_at' => '2024-10-29 18:06:15',
            ),
            379 => 
            array (
                'id' => 380,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '132',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 18:06:15',
                'updated_at' => '2024-10-29 18:06:15',
            ),
            380 => 
            array (
                'id' => 381,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '53',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 18:09:01',
                'updated_at' => '2024-10-29 18:09:01',
            ),
            381 => 
            array (
                'id' => 382,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '53',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 18:09:01',
                'updated_at' => '2024-10-29 18:09:01',
            ),
            382 => 
            array (
                'id' => 383,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '126',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 18:12:14',
                'updated_at' => '2024-10-29 18:12:14',
            ),
            383 => 
            array (
                'id' => 384,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '126',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 18:12:14',
                'updated_at' => '2024-10-29 18:12:14',
            ),
            384 => 
            array (
                'id' => 385,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '109',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 18:14:39',
                'updated_at' => '2024-10-29 18:14:39',
            ),
            385 => 
            array (
                'id' => 386,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '109',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 18:14:39',
                'updated_at' => '2024-10-29 18:14:39',
            ),
            386 => 
            array (
                'id' => 387,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '114',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 18:17:28',
                'updated_at' => '2024-10-29 18:17:28',
            ),
            387 => 
            array (
                'id' => 388,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '114',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 18:17:28',
                'updated_at' => '2024-10-29 18:17:28',
            ),
            388 => 
            array (
                'id' => 389,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '116',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 18:19:28',
                'updated_at' => '2024-10-29 18:19:28',
            ),
            389 => 
            array (
                'id' => 390,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '116',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 18:19:28',
                'updated_at' => '2024-10-29 18:19:28',
            ),
            390 => 
            array (
                'id' => 391,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '163',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 18:23:46',
                'updated_at' => '2024-10-29 18:23:46',
            ),
            391 => 
            array (
                'id' => 392,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '163',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 18:23:46',
                'updated_at' => '2024-10-29 18:23:46',
            ),
            392 => 
            array (
                'id' => 393,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '129',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-29 18:25:58',
                'updated_at' => '2024-10-29 18:25:58',
            ),
            393 => 
            array (
                'id' => 394,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '129',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-29 18:25:58',
                'updated_at' => '2024-10-29 18:25:58',
            ),
            394 => 
            array (
                'id' => 395,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '100',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 13:37:49',
                'updated_at' => '2024-10-31 13:37:49',
            ),
            395 => 
            array (
                'id' => 396,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '100',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 13:37:49',
                'updated_at' => '2024-10-31 13:37:49',
            ),
            396 => 
            array (
                'id' => 397,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '102',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 13:41:15',
                'updated_at' => '2024-10-31 13:41:15',
            ),
            397 => 
            array (
                'id' => 398,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '102',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 13:41:15',
                'updated_at' => '2024-10-31 13:41:15',
            ),
            398 => 
            array (
                'id' => 399,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '105',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 13:43:35',
                'updated_at' => '2024-10-31 13:43:35',
            ),
            399 => 
            array (
                'id' => 400,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '105',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 13:43:35',
                'updated_at' => '2024-10-31 13:43:35',
            ),
            400 => 
            array (
                'id' => 401,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '122',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 13:46:54',
                'updated_at' => '2024-10-31 13:46:54',
            ),
            401 => 
            array (
                'id' => 402,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '122',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 13:46:54',
                'updated_at' => '2024-10-31 13:46:54',
            ),
            402 => 
            array (
                'id' => 403,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '125',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 13:50:33',
                'updated_at' => '2024-10-31 13:50:33',
            ),
            403 => 
            array (
                'id' => 404,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '125',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 13:50:33',
                'updated_at' => '2024-10-31 13:50:33',
            ),
            404 => 
            array (
                'id' => 405,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '165',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 13:53:47',
                'updated_at' => '2024-10-31 13:53:47',
            ),
            405 => 
            array (
                'id' => 406,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '165',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 13:53:47',
                'updated_at' => '2024-10-31 13:53:47',
            ),
            406 => 
            array (
                'id' => 407,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '162',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 13:58:02',
                'updated_at' => '2024-10-31 13:58:02',
            ),
            407 => 
            array (
                'id' => 408,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '162',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 13:58:02',
                'updated_at' => '2024-10-31 13:58:02',
            ),
            408 => 
            array (
                'id' => 409,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '157',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 14:06:23',
                'updated_at' => '2024-10-31 14:06:23',
            ),
            409 => 
            array (
                'id' => 410,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '157',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 14:06:23',
                'updated_at' => '2024-10-31 14:06:23',
            ),
            410 => 
            array (
                'id' => 411,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '159',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 14:10:07',
                'updated_at' => '2024-10-31 14:10:07',
            ),
            411 => 
            array (
                'id' => 412,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '159',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 14:10:07',
                'updated_at' => '2024-10-31 14:10:07',
            ),
            412 => 
            array (
                'id' => 413,
                'data_type' => 'App\\Models\\Campaign',
                'data_id' => '13',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 14:26:36',
                'updated_at' => '2024-10-31 14:26:36',
            ),
            413 => 
            array (
                'id' => 414,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '43',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 15:20:39',
                'updated_at' => '2024-10-31 15:20:39',
            ),
            414 => 
            array (
                'id' => 415,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '43',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 15:20:39',
                'updated_at' => '2024-10-31 15:20:39',
            ),
            415 => 
            array (
                'id' => 416,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '33',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 15:23:11',
                'updated_at' => '2024-10-31 15:23:11',
            ),
            416 => 
            array (
                'id' => 417,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '33',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 15:23:11',
                'updated_at' => '2024-10-31 15:23:11',
            ),
            417 => 
            array (
                'id' => 418,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '119',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 15:28:29',
                'updated_at' => '2024-10-31 15:28:29',
            ),
            418 => 
            array (
                'id' => 419,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '119',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 15:28:29',
                'updated_at' => '2024-10-31 15:28:29',
            ),
            419 => 
            array (
                'id' => 420,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '45',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 15:34:09',
                'updated_at' => '2024-10-31 15:34:09',
            ),
            420 => 
            array (
                'id' => 421,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '45',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 15:34:09',
                'updated_at' => '2024-10-31 15:34:09',
            ),
            421 => 
            array (
                'id' => 422,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '124',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 15:40:59',
                'updated_at' => '2024-10-31 15:40:59',
            ),
            422 => 
            array (
                'id' => 423,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '124',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 15:40:59',
                'updated_at' => '2024-10-31 15:40:59',
            ),
            423 => 
            array (
                'id' => 424,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '111',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 15:44:23',
                'updated_at' => '2024-10-31 15:44:23',
            ),
            424 => 
            array (
                'id' => 425,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '111',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 15:45:42',
                'updated_at' => '2024-10-31 15:45:42',
            ),
            425 => 
            array (
                'id' => 426,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '118',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 15:47:33',
                'updated_at' => '2024-10-31 15:47:33',
            ),
            426 => 
            array (
                'id' => 427,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '118',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 15:47:33',
                'updated_at' => '2024-10-31 15:47:33',
            ),
            427 => 
            array (
                'id' => 428,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '128',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 15:49:26',
                'updated_at' => '2024-10-31 15:49:26',
            ),
            428 => 
            array (
                'id' => 429,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '128',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 15:49:26',
                'updated_at' => '2024-10-31 15:49:26',
            ),
            429 => 
            array (
                'id' => 430,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '78',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 15:53:14',
                'updated_at' => '2024-10-31 15:53:14',
            ),
            430 => 
            array (
                'id' => 431,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '78',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-10-31 15:53:14',
                'updated_at' => '2024-10-31 15:53:14',
            ),
            431 => 
            array (
                'id' => 432,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '14',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 17:28:55',
                'updated_at' => '2024-10-31 17:28:55',
            ),
            432 => 
            array (
                'id' => 433,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '15',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 18:00:28',
                'updated_at' => '2024-10-31 18:00:28',
            ),
            433 => 
            array (
                'id' => 434,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '16',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-10-31 18:01:22',
                'updated_at' => '2024-10-31 18:01:22',
            ),
            434 => 
            array (
                'id' => 435,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '84',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:43:09',
                'updated_at' => '2024-11-03 11:43:09',
            ),
            435 => 
            array (
                'id' => 436,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '82',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:43:37',
                'updated_at' => '2024-11-03 11:43:37',
            ),
            436 => 
            array (
                'id' => 437,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '81',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:43:58',
                'updated_at' => '2024-11-03 11:43:58',
            ),
            437 => 
            array (
                'id' => 438,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '80',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:44:40',
                'updated_at' => '2024-11-03 11:44:40',
            ),
            438 => 
            array (
                'id' => 439,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '77',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:45:08',
                'updated_at' => '2024-11-03 11:45:08',
            ),
            439 => 
            array (
                'id' => 440,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '75',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:45:32',
                'updated_at' => '2024-11-03 11:45:32',
            ),
            440 => 
            array (
                'id' => 441,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '74',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:45:50',
                'updated_at' => '2024-11-03 11:45:50',
            ),
            441 => 
            array (
                'id' => 442,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '79',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:46:09',
                'updated_at' => '2024-11-03 11:46:09',
            ),
            442 => 
            array (
                'id' => 443,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '72',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:46:26',
                'updated_at' => '2024-11-03 11:46:26',
            ),
            443 => 
            array (
                'id' => 444,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '71',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:47:00',
                'updated_at' => '2024-11-03 11:47:00',
            ),
            444 => 
            array (
                'id' => 445,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '70',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:47:37',
                'updated_at' => '2024-11-03 11:47:37',
            ),
            445 => 
            array (
                'id' => 446,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '78',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:48:26',
                'updated_at' => '2024-11-03 11:48:26',
            ),
            446 => 
            array (
                'id' => 447,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '73',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 11:49:41',
                'updated_at' => '2024-11-03 11:49:41',
            ),
            447 => 
            array (
                'id' => 448,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '58',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:05:40',
                'updated_at' => '2024-11-03 14:05:40',
            ),
            448 => 
            array (
                'id' => 449,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '57',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:06:02',
                'updated_at' => '2024-11-03 14:06:02',
            ),
            449 => 
            array (
                'id' => 450,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '56',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:06:24',
                'updated_at' => '2024-11-03 14:06:24',
            ),
            450 => 
            array (
                'id' => 451,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '55',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:06:54',
                'updated_at' => '2024-11-03 14:06:54',
            ),
            451 => 
            array (
                'id' => 452,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '54',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:07:26',
                'updated_at' => '2024-11-03 14:07:26',
            ),
            452 => 
            array (
                'id' => 453,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '53',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:08:09',
                'updated_at' => '2024-11-03 14:08:09',
            ),
            453 => 
            array (
                'id' => 454,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '52',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:08:29',
                'updated_at' => '2024-11-03 14:08:29',
            ),
            454 => 
            array (
                'id' => 455,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '51',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:08:55',
                'updated_at' => '2024-11-03 14:08:55',
            ),
            455 => 
            array (
                'id' => 456,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '50',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:09:18',
                'updated_at' => '2024-11-03 14:09:18',
            ),
            456 => 
            array (
                'id' => 457,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '49',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:09:46',
                'updated_at' => '2024-11-03 14:09:46',
            ),
            457 => 
            array (
                'id' => 458,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '48',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:10:10',
                'updated_at' => '2024-11-03 14:10:10',
            ),
            458 => 
            array (
                'id' => 459,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '47',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:10:45',
                'updated_at' => '2024-11-03 14:10:45',
            ),
            459 => 
            array (
                'id' => 460,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '46',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:11:23',
                'updated_at' => '2024-11-03 14:11:23',
            ),
            460 => 
            array (
                'id' => 461,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '45',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-03 14:11:45',
                'updated_at' => '2024-11-03 14:11:45',
            ),
            461 => 
            array (
                'id' => 462,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '58',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:39:42',
                'updated_at' => '2024-11-03 16:39:42',
            ),
            462 => 
            array (
                'id' => 463,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '57',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:39:58',
                'updated_at' => '2024-11-03 16:39:58',
            ),
            463 => 
            array (
                'id' => 464,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '56',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:40:13',
                'updated_at' => '2024-11-03 16:40:13',
            ),
            464 => 
            array (
                'id' => 465,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '55',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:40:35',
                'updated_at' => '2024-11-03 16:40:35',
            ),
            465 => 
            array (
                'id' => 466,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '54',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:40:57',
                'updated_at' => '2024-11-03 16:40:57',
            ),
            466 => 
            array (
                'id' => 467,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '53',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:41:21',
                'updated_at' => '2024-11-03 16:41:21',
            ),
            467 => 
            array (
                'id' => 468,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '52',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:41:49',
                'updated_at' => '2024-11-03 16:41:49',
            ),
            468 => 
            array (
                'id' => 469,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '51',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:42:05',
                'updated_at' => '2024-11-03 16:42:05',
            ),
            469 => 
            array (
                'id' => 470,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '50',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:42:23',
                'updated_at' => '2024-11-03 16:42:23',
            ),
            470 => 
            array (
                'id' => 471,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '49',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:42:45',
                'updated_at' => '2024-11-03 16:42:45',
            ),
            471 => 
            array (
                'id' => 472,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '48',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:43:02',
                'updated_at' => '2024-11-03 16:43:02',
            ),
            472 => 
            array (
                'id' => 473,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '47',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:43:17',
                'updated_at' => '2024-11-03 16:43:17',
            ),
            473 => 
            array (
                'id' => 474,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '46',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:43:44',
                'updated_at' => '2024-11-03 16:43:44',
            ),
            474 => 
            array (
                'id' => 475,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '8',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-03 16:43:44',
                'updated_at' => '2024-11-03 16:43:44',
            ),
            475 => 
            array (
                'id' => 476,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '45',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-03 16:43:59',
                'updated_at' => '2024-11-03 16:43:59',
            ),
            476 => 
            array (
                'id' => 477,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '1',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-17 17:26:54',
                'updated_at' => '2024-11-17 17:26:54',
            ),
            477 => 
            array (
                'id' => 478,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '9',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-17 14:07:45',
                'updated_at' => '2024-11-17 14:07:45',
            ),
            478 => 
            array (
                'id' => 479,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '10',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 12:47:45',
                'updated_at' => '2024-11-04 12:47:45',
            ),
            479 => 
            array (
                'id' => 480,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '11',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 12:47:45',
                'updated_at' => '2024-11-04 12:47:45',
            ),
            480 => 
            array (
                'id' => 481,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '12',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 12:47:45',
                'updated_at' => '2024-11-04 12:47:45',
            ),
            481 => 
            array (
                'id' => 482,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '13',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 12:47:45',
                'updated_at' => '2024-11-04 12:47:45',
            ),
            482 => 
            array (
                'id' => 483,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '14',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 12:47:45',
                'updated_at' => '2024-11-04 12:47:45',
            ),
            483 => 
            array (
                'id' => 484,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '15',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 12:47:45',
                'updated_at' => '2024-11-04 12:47:45',
            ),
            484 => 
            array (
                'id' => 485,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '16',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 12:44:28',
                'updated_at' => '2024-11-04 12:44:28',
            ),
            485 => 
            array (
                'id' => 486,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '17',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 12:44:28',
                'updated_at' => '2024-11-04 12:44:28',
            ),
            486 => 
            array (
                'id' => 487,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '18',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 12:44:28',
                'updated_at' => '2024-11-04 12:44:28',
            ),
            487 => 
            array (
                'id' => 488,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '19',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 12:44:28',
                'updated_at' => '2024-11-04 12:44:28',
            ),
            488 => 
            array (
                'id' => 489,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '20',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 12:44:28',
                'updated_at' => '2024-11-04 12:44:28',
            ),
            489 => 
            array (
                'id' => 490,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '21',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-04 15:14:40',
                'updated_at' => '2024-11-04 15:14:40',
            ),
            490 => 
            array (
                'id' => 491,
                'data_type' => 'App\\Models\\ParcelCategory',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-04 12:28:53',
                'updated_at' => '2024-11-04 12:28:53',
            ),
            491 => 
            array (
                'id' => 492,
                'data_type' => 'App\\Models\\ParcelCategory',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-04 12:30:43',
                'updated_at' => '2024-11-04 12:30:43',
            ),
            492 => 
            array (
                'id' => 493,
                'data_type' => 'App\\Models\\ParcelCategory',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-04 12:32:04',
                'updated_at' => '2024-11-04 12:32:04',
            ),
            493 => 
            array (
                'id' => 494,
                'data_type' => 'App\\Models\\ParcelCategory',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-04 12:36:32',
                'updated_at' => '2024-11-04 12:36:32',
            ),
            494 => 
            array (
                'id' => 495,
                'data_type' => 'App\\Models\\ParcelCategory',
                'data_id' => '6',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-04 12:37:38',
                'updated_at' => '2024-11-04 12:37:38',
            ),
            495 => 
            array (
                'id' => 496,
                'data_type' => 'App\\Models\\ParcelCategory',
                'data_id' => '7',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-04 12:38:51',
                'updated_at' => '2024-11-04 12:38:51',
            ),
            496 => 
            array (
                'id' => 497,
                'data_type' => 'App\\Models\\ModuleWiseWhyChoose',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-04 13:55:25',
                'updated_at' => '2024-11-04 13:55:25',
            ),
            497 => 
            array (
                'id' => 498,
                'data_type' => 'App\\Models\\ModuleWiseWhyChoose',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-04 13:55:34',
                'updated_at' => '2024-11-04 13:55:34',
            ),
            498 => 
            array (
                'id' => 499,
                'data_type' => 'App\\Models\\ModuleWiseWhyChoose',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-04 13:55:43',
                'updated_at' => '2024-11-04 13:55:43',
            ),
            499 => 
            array (
                'id' => 500,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '17',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 14:18:41',
                'updated_at' => '2024-11-05 14:18:41',
            ),
        ));
        \DB::table('storages')->insert(array (
            0 => 
            array (
                'id' => 501,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '18',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-04 16:33:24',
                'updated_at' => '2024-11-04 16:33:24',
            ),
            1 => 
            array (
                'id' => 502,
                'data_type' => 'App\\Models\\ModuleWiseBanner',
                'data_id' => '5',
                'key' => 'value',
                'value' => 'public',
                'created_at' => '2024-11-17 10:15:42',
                'updated_at' => '2024-11-17 10:15:42',
            ),
            2 => 
            array (
                'id' => 503,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '149',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 10:29:41',
                'updated_at' => '2024-11-05 10:29:41',
            ),
            3 => 
            array (
                'id' => 504,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '150',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 09:46:04',
                'updated_at' => '2024-11-05 09:46:04',
            ),
            4 => 
            array (
                'id' => 505,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '23',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 10:29:57',
                'updated_at' => '2024-11-05 10:29:57',
            ),
            5 => 
            array (
                'id' => 506,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '22',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 10:30:13',
                'updated_at' => '2024-11-05 10:30:13',
            ),
            6 => 
            array (
                'id' => 507,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '21',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 10:30:28',
                'updated_at' => '2024-11-05 10:30:28',
            ),
            7 => 
            array (
                'id' => 508,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '20',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 10:30:43',
                'updated_at' => '2024-11-05 10:30:43',
            ),
            8 => 
            array (
                'id' => 509,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '19',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 10:30:56',
                'updated_at' => '2024-11-05 10:30:56',
            ),
            9 => 
            array (
                'id' => 510,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '18',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 10:31:11',
                'updated_at' => '2024-11-05 10:31:11',
            ),
            10 => 
            array (
                'id' => 511,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '17',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 10:31:24',
                'updated_at' => '2024-11-05 10:31:24',
            ),
            11 => 
            array (
                'id' => 512,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '16',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 10:31:36',
                'updated_at' => '2024-11-05 10:31:36',
            ),
            12 => 
            array (
                'id' => 513,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '14',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 10:31:49',
                'updated_at' => '2024-11-05 10:31:49',
            ),
            13 => 
            array (
                'id' => 514,
                'data_type' => 'App\\Models\\Category',
                'data_id' => '13',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 10:32:03',
                'updated_at' => '2024-11-05 10:32:03',
            ),
            14 => 
            array (
                'id' => 515,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '44',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:29:10',
                'updated_at' => '2024-11-05 13:29:10',
            ),
            15 => 
            array (
                'id' => 516,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '43',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:29:26',
                'updated_at' => '2024-11-05 13:29:26',
            ),
            16 => 
            array (
                'id' => 517,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '42',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:29:43',
                'updated_at' => '2024-11-05 13:29:43',
            ),
            17 => 
            array (
                'id' => 518,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '41',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:30:01',
                'updated_at' => '2024-11-05 13:30:01',
            ),
            18 => 
            array (
                'id' => 519,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '40',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:30:18',
                'updated_at' => '2024-11-05 13:30:18',
            ),
            19 => 
            array (
                'id' => 520,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '20',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:30:38',
                'updated_at' => '2024-11-05 13:30:38',
            ),
            20 => 
            array (
                'id' => 521,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '19',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:31:01',
                'updated_at' => '2024-11-05 13:31:01',
            ),
            21 => 
            array (
                'id' => 522,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '17',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-17 10:27:00',
                'updated_at' => '2024-11-17 10:27:00',
            ),
            22 => 
            array (
                'id' => 523,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '15',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:31:57',
                'updated_at' => '2024-11-05 13:31:57',
            ),
            23 => 
            array (
                'id' => 524,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '13',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:32:16',
                'updated_at' => '2024-11-05 13:32:16',
            ),
            24 => 
            array (
                'id' => 525,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '10',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:32:48',
                'updated_at' => '2024-11-05 13:32:48',
            ),
            25 => 
            array (
                'id' => 526,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '8',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:33:06',
                'updated_at' => '2024-11-05 13:33:06',
            ),
            26 => 
            array (
                'id' => 527,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '6',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:33:30',
                'updated_at' => '2024-11-05 13:33:30',
            ),
            27 => 
            array (
                'id' => 528,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '4',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:33:47',
                'updated_at' => '2024-11-05 13:33:47',
            ),
            28 => 
            array (
                'id' => 529,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '44',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:50:29',
                'updated_at' => '2024-11-05 13:50:29',
            ),
            29 => 
            array (
                'id' => 530,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '43',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:51:20',
                'updated_at' => '2024-11-05 13:51:20',
            ),
            30 => 
            array (
                'id' => 531,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '42',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:51:39',
                'updated_at' => '2024-11-05 13:51:39',
            ),
            31 => 
            array (
                'id' => 532,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '41',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:52:00',
                'updated_at' => '2024-11-05 13:52:00',
            ),
            32 => 
            array (
                'id' => 533,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '40',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:52:18',
                'updated_at' => '2024-11-05 13:52:18',
            ),
            33 => 
            array (
                'id' => 534,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '20',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:52:40',
                'updated_at' => '2024-11-05 13:52:40',
            ),
            34 => 
            array (
                'id' => 535,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '19',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:53:00',
                'updated_at' => '2024-11-05 13:53:00',
            ),
            35 => 
            array (
                'id' => 536,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '17',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:53:17',
                'updated_at' => '2024-11-05 13:53:17',
            ),
            36 => 
            array (
                'id' => 537,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '15',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:53:51',
                'updated_at' => '2024-11-05 13:53:51',
            ),
            37 => 
            array (
                'id' => 538,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '13',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:54:10',
                'updated_at' => '2024-11-05 13:54:10',
            ),
            38 => 
            array (
                'id' => 539,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '10',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:54:28',
                'updated_at' => '2024-11-05 13:54:28',
            ),
            39 => 
            array (
                'id' => 540,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '8',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:54:52',
                'updated_at' => '2024-11-05 13:54:52',
            ),
            40 => 
            array (
                'id' => 541,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '6',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:55:12',
                'updated_at' => '2024-11-05 13:55:12',
            ),
            41 => 
            array (
                'id' => 542,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '4',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2024-11-05 13:55:31',
                'updated_at' => '2024-11-05 13:55:31',
            ),
            42 => 
            array (
                'id' => 543,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '160',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:39:51',
                'updated_at' => '2024-11-06 09:39:51',
            ),
            43 => 
            array (
                'id' => 544,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '160',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 16:09:11',
                'updated_at' => '2024-11-05 16:09:11',
            ),
            44 => 
            array (
                'id' => 545,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '158',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:40:22',
                'updated_at' => '2024-11-06 09:40:22',
            ),
            45 => 
            array (
                'id' => 546,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '158',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 16:18:28',
                'updated_at' => '2024-11-05 16:18:28',
            ),
            46 => 
            array (
                'id' => 547,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '154',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:40:51',
                'updated_at' => '2024-11-06 09:40:51',
            ),
            47 => 
            array (
                'id' => 548,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '154',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 16:22:59',
                'updated_at' => '2024-11-05 16:22:59',
            ),
            48 => 
            array (
                'id' => 549,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '91',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 16:25:30',
                'updated_at' => '2024-11-05 16:25:30',
            ),
            49 => 
            array (
                'id' => 550,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '91',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 16:25:30',
                'updated_at' => '2024-11-05 16:25:30',
            ),
            50 => 
            array (
                'id' => 551,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '68',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:41:34',
                'updated_at' => '2024-11-06 09:41:34',
            ),
            51 => 
            array (
                'id' => 552,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '68',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 16:27:28',
                'updated_at' => '2024-11-05 16:27:28',
            ),
            52 => 
            array (
                'id' => 553,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '41',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:45:50',
                'updated_at' => '2024-11-06 09:45:50',
            ),
            53 => 
            array (
                'id' => 554,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '41',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 16:31:57',
                'updated_at' => '2024-11-05 16:31:57',
            ),
            54 => 
            array (
                'id' => 555,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '37',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:46:21',
                'updated_at' => '2024-11-06 09:46:21',
            ),
            55 => 
            array (
                'id' => 556,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '37',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 16:34:47',
                'updated_at' => '2024-11-05 16:34:47',
            ),
            56 => 
            array (
                'id' => 557,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '69',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:44:58',
                'updated_at' => '2024-11-06 09:44:58',
            ),
            57 => 
            array (
                'id' => 558,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '69',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 16:39:08',
                'updated_at' => '2024-11-05 16:39:08',
            ),
            58 => 
            array (
                'id' => 559,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '40',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:59:33',
                'updated_at' => '2024-11-06 09:59:33',
            ),
            59 => 
            array (
                'id' => 560,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '40',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 16:47:20',
                'updated_at' => '2024-11-05 16:47:20',
            ),
            60 => 
            array (
                'id' => 561,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '74',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:43:25',
                'updated_at' => '2024-11-06 09:43:25',
            ),
            61 => 
            array (
                'id' => 562,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '74',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 16:55:32',
                'updated_at' => '2024-11-05 16:55:32',
            ),
            62 => 
            array (
                'id' => 563,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '155',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 17:00:10',
                'updated_at' => '2024-11-05 17:00:10',
            ),
            63 => 
            array (
                'id' => 564,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '155',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:00:10',
                'updated_at' => '2024-11-05 17:00:10',
            ),
            64 => 
            array (
                'id' => 565,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '149',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:54:36',
                'updated_at' => '2024-11-06 09:54:36',
            ),
            65 => 
            array (
                'id' => 566,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '149',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:03:00',
                'updated_at' => '2024-11-05 17:03:00',
            ),
            66 => 
            array (
                'id' => 567,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '152',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 17:05:42',
                'updated_at' => '2024-11-05 17:05:42',
            ),
            67 => 
            array (
                'id' => 568,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '152',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:05:42',
                'updated_at' => '2024-11-05 17:05:42',
            ),
            68 => 
            array (
                'id' => 569,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '156',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:53:55',
                'updated_at' => '2024-11-06 09:53:55',
            ),
            69 => 
            array (
                'id' => 570,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '156',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 09:53:55',
                'updated_at' => '2024-11-06 09:53:55',
            ),
            70 => 
            array (
                'id' => 571,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '62',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:42:20',
                'updated_at' => '2024-11-06 09:42:20',
            ),
            71 => 
            array (
                'id' => 572,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '62',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:15:34',
                'updated_at' => '2024-11-05 17:15:34',
            ),
            72 => 
            array (
                'id' => 573,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '64',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:59:01',
                'updated_at' => '2024-11-06 09:59:01',
            ),
            73 => 
            array (
                'id' => 574,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '64',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:21:01',
                'updated_at' => '2024-11-05 17:21:01',
            ),
            74 => 
            array (
                'id' => 575,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '66',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:58:06',
                'updated_at' => '2024-11-06 09:58:06',
            ),
            75 => 
            array (
                'id' => 576,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '66',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:24:49',
                'updated_at' => '2024-11-05 17:24:49',
            ),
            76 => 
            array (
                'id' => 577,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '151',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:56:22',
                'updated_at' => '2024-11-06 09:56:22',
            ),
            77 => 
            array (
                'id' => 578,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '151',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:27:47',
                'updated_at' => '2024-11-05 17:27:47',
            ),
            78 => 
            array (
                'id' => 579,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '148',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:57:16',
                'updated_at' => '2024-11-06 09:57:16',
            ),
            79 => 
            array (
                'id' => 580,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '148',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:32:02',
                'updated_at' => '2024-11-05 17:32:02',
            ),
            80 => 
            array (
                'id' => 581,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '93',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:57:41',
                'updated_at' => '2024-11-06 09:57:41',
            ),
            81 => 
            array (
                'id' => 582,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '93',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:33:58',
                'updated_at' => '2024-11-05 17:33:58',
            ),
            82 => 
            array (
                'id' => 583,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '89',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:00:46',
                'updated_at' => '2024-11-06 10:00:46',
            ),
            83 => 
            array (
                'id' => 584,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '89',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:36:58',
                'updated_at' => '2024-11-05 17:36:58',
            ),
            84 => 
            array (
                'id' => 585,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '88',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:14:19',
                'updated_at' => '2024-11-06 10:14:19',
            ),
            85 => 
            array (
                'id' => 586,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '88',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:39:23',
                'updated_at' => '2024-11-05 17:39:23',
            ),
            86 => 
            array (
                'id' => 587,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '86',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:01:39',
                'updated_at' => '2024-11-06 10:01:39',
            ),
            87 => 
            array (
                'id' => 588,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '86',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:41:16',
                'updated_at' => '2024-11-05 17:41:16',
            ),
            88 => 
            array (
                'id' => 589,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '84',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:15:31',
                'updated_at' => '2024-11-06 10:15:31',
            ),
            89 => 
            array (
                'id' => 590,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '84',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:43:00',
                'updated_at' => '2024-11-05 17:43:00',
            ),
            90 => 
            array (
                'id' => 591,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '83',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:16:22',
                'updated_at' => '2024-11-06 10:16:22',
            ),
            91 => 
            array (
                'id' => 592,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '83',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 17:49:50',
                'updated_at' => '2024-11-05 17:49:50',
            ),
            92 => 
            array (
                'id' => 593,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '80',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:44:15',
                'updated_at' => '2024-11-06 09:44:15',
            ),
            93 => 
            array (
                'id' => 594,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '80',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 18:02:01',
                'updated_at' => '2024-11-05 18:02:01',
            ),
            94 => 
            array (
                'id' => 595,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '79',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:48:05',
                'updated_at' => '2024-11-06 09:48:05',
            ),
            95 => 
            array (
                'id' => 596,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '79',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 09:48:05',
                'updated_at' => '2024-11-06 09:48:05',
            ),
            96 => 
            array (
                'id' => 597,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '77',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:48:34',
                'updated_at' => '2024-11-06 09:48:34',
            ),
            97 => 
            array (
                'id' => 598,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '77',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 18:07:04',
                'updated_at' => '2024-11-05 18:07:04',
            ),
            98 => 
            array (
                'id' => 599,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '76',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 09:49:40',
                'updated_at' => '2024-11-06 09:49:40',
            ),
            99 => 
            array (
                'id' => 600,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '76',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 18:08:37',
                'updated_at' => '2024-11-05 18:08:37',
            ),
            100 => 
            array (
                'id' => 601,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '75',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-05 18:10:13',
                'updated_at' => '2024-11-05 18:10:13',
            ),
            101 => 
            array (
                'id' => 602,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '75',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-05 18:10:13',
                'updated_at' => '2024-11-05 18:10:13',
            ),
            102 => 
            array (
                'id' => 603,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '70',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:26:12',
                'updated_at' => '2024-11-06 10:26:12',
            ),
            103 => 
            array (
                'id' => 604,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '70',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:26:12',
                'updated_at' => '2024-11-06 10:26:12',
            ),
            104 => 
            array (
                'id' => 605,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '61',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:28:59',
                'updated_at' => '2024-11-06 10:28:59',
            ),
            105 => 
            array (
                'id' => 606,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '61',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:28:59',
                'updated_at' => '2024-11-06 10:28:59',
            ),
            106 => 
            array (
                'id' => 607,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '59',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:30:41',
                'updated_at' => '2024-11-06 10:30:41',
            ),
            107 => 
            array (
                'id' => 608,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '59',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:30:41',
                'updated_at' => '2024-11-06 10:30:41',
            ),
            108 => 
            array (
                'id' => 609,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '56',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:32:32',
                'updated_at' => '2024-11-06 10:32:32',
            ),
            109 => 
            array (
                'id' => 610,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '56',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:32:32',
                'updated_at' => '2024-11-06 10:32:32',
            ),
            110 => 
            array (
                'id' => 611,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '54',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:34:24',
                'updated_at' => '2024-11-06 10:34:24',
            ),
            111 => 
            array (
                'id' => 612,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '54',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:34:24',
                'updated_at' => '2024-11-06 10:34:24',
            ),
            112 => 
            array (
                'id' => 613,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '51',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:38:57',
                'updated_at' => '2024-11-06 10:38:57',
            ),
            113 => 
            array (
                'id' => 614,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '51',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:38:57',
                'updated_at' => '2024-11-06 10:38:57',
            ),
            114 => 
            array (
                'id' => 615,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '50',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:40:45',
                'updated_at' => '2024-11-06 10:40:45',
            ),
            115 => 
            array (
                'id' => 616,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '50',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:40:45',
                'updated_at' => '2024-11-06 10:40:45',
            ),
            116 => 
            array (
                'id' => 617,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '47',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:42:37',
                'updated_at' => '2024-11-06 10:42:37',
            ),
            117 => 
            array (
                'id' => 618,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '47',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:42:37',
                'updated_at' => '2024-11-06 10:42:37',
            ),
            118 => 
            array (
                'id' => 619,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '44',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:44:45',
                'updated_at' => '2024-11-06 10:44:45',
            ),
            119 => 
            array (
                'id' => 620,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '44',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:44:45',
                'updated_at' => '2024-11-06 10:44:45',
            ),
            120 => 
            array (
                'id' => 621,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '35',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:46:17',
                'updated_at' => '2024-11-06 10:46:17',
            ),
            121 => 
            array (
                'id' => 622,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '35',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:46:17',
                'updated_at' => '2024-11-06 10:46:17',
            ),
            122 => 
            array (
                'id' => 623,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '32',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:49:21',
                'updated_at' => '2024-11-06 10:49:21',
            ),
            123 => 
            array (
                'id' => 624,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '32',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:49:21',
                'updated_at' => '2024-11-06 10:49:21',
            ),
            124 => 
            array (
                'id' => 625,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '30',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:51:21',
                'updated_at' => '2024-11-06 10:51:21',
            ),
            125 => 
            array (
                'id' => 626,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '30',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:51:21',
                'updated_at' => '2024-11-06 10:51:21',
            ),
            126 => 
            array (
                'id' => 627,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '27',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:53:07',
                'updated_at' => '2024-11-06 10:53:07',
            ),
            127 => 
            array (
                'id' => 628,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '27',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:53:07',
                'updated_at' => '2024-11-06 10:53:07',
            ),
            128 => 
            array (
                'id' => 629,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '26',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 10:54:47',
                'updated_at' => '2024-11-06 10:54:47',
            ),
            129 => 
            array (
                'id' => 630,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '26',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 10:56:24',
                'updated_at' => '2024-11-06 10:56:24',
            ),
            130 => 
            array (
                'id' => 631,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '25',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 11:02:20',
                'updated_at' => '2024-11-06 11:02:20',
            ),
            131 => 
            array (
                'id' => 632,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '25',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 11:02:20',
                'updated_at' => '2024-11-06 11:02:20',
            ),
            132 => 
            array (
                'id' => 633,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '23',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 11:06:35',
                'updated_at' => '2024-11-06 11:06:35',
            ),
            133 => 
            array (
                'id' => 634,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '23',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 11:06:35',
                'updated_at' => '2024-11-06 11:06:35',
            ),
            134 => 
            array (
                'id' => 635,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '20',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 11:08:23',
                'updated_at' => '2024-11-06 11:08:23',
            ),
            135 => 
            array (
                'id' => 636,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '20',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 11:08:23',
                'updated_at' => '2024-11-06 11:08:23',
            ),
            136 => 
            array (
                'id' => 637,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '19',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 11:10:12',
                'updated_at' => '2024-11-06 11:10:12',
            ),
            137 => 
            array (
                'id' => 638,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '19',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 11:10:12',
                'updated_at' => '2024-11-06 11:10:12',
            ),
            138 => 
            array (
                'id' => 639,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '363',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 11:12:20',
                'updated_at' => '2024-11-06 11:12:20',
            ),
            139 => 
            array (
                'id' => 640,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '363',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 11:12:20',
                'updated_at' => '2024-11-06 11:12:20',
            ),
            140 => 
            array (
                'id' => 641,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '364',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-06 11:13:46',
                'updated_at' => '2024-11-06 11:13:46',
            ),
            141 => 
            array (
                'id' => 642,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '364',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-06 11:13:46',
                'updated_at' => '2024-11-06 11:13:46',
            ),
            142 => 
            array (
                'id' => 643,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '5',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 09:47:44',
                'updated_at' => '2024-11-16 09:47:44',
            ),
            143 => 
            array (
                'id' => 644,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '6',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 09:47:44',
                'updated_at' => '2024-11-16 09:47:44',
            ),
            144 => 
            array (
                'id' => 645,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '7',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 09:47:44',
                'updated_at' => '2024-11-16 09:47:44',
            ),
            145 => 
            array (
                'id' => 646,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '8',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 09:47:44',
                'updated_at' => '2024-11-16 09:47:44',
            ),
            146 => 
            array (
                'id' => 647,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '9',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 09:47:44',
                'updated_at' => '2024-11-16 09:47:44',
            ),
            147 => 
            array (
                'id' => 648,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '10',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 09:47:44',
                'updated_at' => '2024-11-16 09:47:44',
            ),
            148 => 
            array (
                'id' => 649,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '11',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 09:47:44',
                'updated_at' => '2024-11-16 09:47:44',
            ),
            149 => 
            array (
                'id' => 650,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '12',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 09:47:44',
                'updated_at' => '2024-11-16 09:47:44',
            ),
            150 => 
            array (
                'id' => 651,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '13',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 09:47:44',
                'updated_at' => '2024-11-16 09:47:44',
            ),
            151 => 
            array (
                'id' => 652,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '2',
                'key' => 'thumbnail',
                'value' => 'public',
                'created_at' => '2025-02-06 10:22:14',
                'updated_at' => '2025-02-06 10:22:14',
            ),
            152 => 
            array (
                'id' => 653,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '1',
                'key' => 'thumbnail',
                'value' => 'public',
                'created_at' => '2024-11-16 11:05:54',
                'updated_at' => '2024-11-16 11:05:54',
            ),
            153 => 
            array (
                'id' => 654,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '3',
                'key' => 'thumbnail',
                'value' => 'public',
                'created_at' => '2025-02-06 10:21:18',
                'updated_at' => '2025-02-06 10:21:18',
            ),
            154 => 
            array (
                'id' => 655,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '4',
                'key' => 'thumbnail',
                'value' => 'public',
                'created_at' => '2025-02-06 10:20:49',
                'updated_at' => '2025-02-06 10:20:49',
            ),
            155 => 
            array (
                'id' => 656,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '5',
                'key' => 'thumbnail',
                'value' => 'public',
                'created_at' => '2025-02-06 10:20:24',
                'updated_at' => '2025-02-06 10:20:24',
            ),
            156 => 
            array (
                'id' => 657,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '16',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 14:15:07',
                'updated_at' => '2024-11-16 14:15:07',
            ),
            157 => 
            array (
                'id' => 658,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '17',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 14:15:07',
                'updated_at' => '2024-11-16 14:15:07',
            ),
            158 => 
            array (
                'id' => 659,
                'data_type' => 'App\\Models\\AdminSpecialCriteria',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 14:21:10',
                'updated_at' => '2024-11-16 14:21:10',
            ),
            159 => 
            array (
                'id' => 660,
                'data_type' => 'App\\Models\\AdminSpecialCriteria',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 14:21:37',
                'updated_at' => '2024-11-16 14:21:37',
            ),
            160 => 
            array (
                'id' => 661,
                'data_type' => 'App\\Models\\AdminSpecialCriteria',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 14:21:59',
                'updated_at' => '2024-11-16 14:21:59',
            ),
            161 => 
            array (
                'id' => 662,
                'data_type' => 'App\\Models\\AdminSpecialCriteria',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 14:22:17',
                'updated_at' => '2024-11-16 14:22:17',
            ),
            162 => 
            array (
                'id' => 663,
                'data_type' => 'App\\Models\\AdminSpecialCriteria',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 14:22:36',
                'updated_at' => '2024-11-16 14:22:36',
            ),
            163 => 
            array (
                'id' => 664,
                'data_type' => 'App\\Models\\AdminSpecialCriteria',
                'data_id' => '6',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 14:22:55',
                'updated_at' => '2024-11-16 14:22:55',
            ),
            164 => 
            array (
                'id' => 665,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '24',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 14:26:04',
                'updated_at' => '2024-11-16 14:26:04',
            ),
            165 => 
            array (
                'id' => 666,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '25',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 14:26:04',
                'updated_at' => '2024-11-16 14:26:04',
            ),
            166 => 
            array (
                'id' => 667,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '26',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 14:26:04',
                'updated_at' => '2024-11-16 14:26:04',
            ),
            167 => 
            array (
                'id' => 668,
                'data_type' => 'App\\Models\\AdminPromotionalBanner',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 14:48:51',
                'updated_at' => '2024-11-16 14:48:51',
            ),
            168 => 
            array (
                'id' => 669,
                'data_type' => 'App\\Models\\AdminPromotionalBanner',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 14:47:47',
                'updated_at' => '2024-11-16 14:47:47',
            ),
            169 => 
            array (
                'id' => 670,
                'data_type' => 'App\\Models\\AdminPromotionalBanner',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 14:44:09',
                'updated_at' => '2024-11-16 14:44:09',
            ),
            170 => 
            array (
                'id' => 671,
                'data_type' => 'App\\Models\\AdminPromotionalBanner',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 14:51:11',
                'updated_at' => '2024-11-16 14:51:11',
            ),
            171 => 
            array (
                'id' => 672,
                'data_type' => 'App\\Models\\AdminFeature',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 15:47:24',
                'updated_at' => '2024-11-16 15:47:24',
            ),
            172 => 
            array (
                'id' => 673,
                'data_type' => 'App\\Models\\AdminFeature',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 15:47:40',
                'updated_at' => '2024-11-16 15:47:40',
            ),
            173 => 
            array (
                'id' => 674,
                'data_type' => 'App\\Models\\AdminFeature',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 15:47:56',
                'updated_at' => '2024-11-16 15:47:56',
            ),
            174 => 
            array (
                'id' => 675,
                'data_type' => 'App\\Models\\AdminFeature',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 15:48:12',
                'updated_at' => '2024-11-16 15:48:12',
            ),
            175 => 
            array (
                'id' => 676,
                'data_type' => 'App\\Models\\AdminFeature',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-16 15:48:24',
                'updated_at' => '2024-11-16 15:48:24',
            ),
            176 => 
            array (
                'id' => 677,
                'data_type' => 'App\\Models\\AdminTestimonial',
                'data_id' => '2',
                'key' => 'reviewer_image',
                'value' => 'public',
                'created_at' => '2024-11-16 17:43:55',
                'updated_at' => '2024-11-16 17:43:55',
            ),
            177 => 
            array (
                'id' => 678,
                'data_type' => 'App\\Models\\AdminTestimonial',
                'data_id' => '2',
                'key' => 'company_image',
                'value' => 'public',
                'created_at' => '2024-11-16 17:43:55',
                'updated_at' => '2024-11-16 17:43:55',
            ),
            178 => 
            array (
                'id' => 679,
                'data_type' => 'App\\Models\\AdminTestimonial',
                'data_id' => '3',
                'key' => 'reviewer_image',
                'value' => 'public',
                'created_at' => '2024-11-16 17:44:37',
                'updated_at' => '2024-11-16 17:44:37',
            ),
            179 => 
            array (
                'id' => 680,
                'data_type' => 'App\\Models\\AdminTestimonial',
                'data_id' => '3',
                'key' => 'company_image',
                'value' => 'public',
                'created_at' => '2024-11-16 17:44:37',
                'updated_at' => '2024-11-16 17:44:37',
            ),
            180 => 
            array (
                'id' => 681,
                'data_type' => 'App\\Models\\AdminTestimonial',
                'data_id' => '4',
                'key' => 'reviewer_image',
                'value' => 'public',
                'created_at' => '2024-11-16 17:45:16',
                'updated_at' => '2024-11-16 17:45:16',
            ),
            181 => 
            array (
                'id' => 682,
                'data_type' => 'App\\Models\\AdminTestimonial',
                'data_id' => '4',
                'key' => 'company_image',
                'value' => 'public',
                'created_at' => '2024-11-16 17:45:16',
                'updated_at' => '2024-11-16 17:45:16',
            ),
            182 => 
            array (
                'id' => 683,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '29',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 17:54:17',
                'updated_at' => '2024-11-16 17:54:17',
            ),
            183 => 
            array (
                'id' => 684,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '30',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 17:54:17',
                'updated_at' => '2024-11-16 17:54:17',
            ),
            184 => 
            array (
                'id' => 685,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '31',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-16 17:54:17',
                'updated_at' => '2024-11-16 17:54:17',
            ),
            185 => 
            array (
                'id' => 686,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '365',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-17 11:06:42',
                'updated_at' => '2024-11-17 11:06:42',
            ),
            186 => 
            array (
                'id' => 687,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '365',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-17 11:06:42',
                'updated_at' => '2024-11-17 11:06:42',
            ),
            187 => 
            array (
                'id' => 688,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '366',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-17 11:09:31',
                'updated_at' => '2024-11-17 11:09:31',
            ),
            188 => 
            array (
                'id' => 689,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '366',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-17 11:09:31',
                'updated_at' => '2024-11-17 11:09:31',
            ),
            189 => 
            array (
                'id' => 690,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '367',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-17 11:12:19',
                'updated_at' => '2024-11-17 11:12:19',
            ),
            190 => 
            array (
                'id' => 691,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '367',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-17 11:12:19',
                'updated_at' => '2024-11-17 11:12:19',
            ),
            191 => 
            array (
                'id' => 692,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '368',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-17 11:15:25',
                'updated_at' => '2024-11-17 11:15:25',
            ),
            192 => 
            array (
                'id' => 693,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '368',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-17 11:15:25',
                'updated_at' => '2024-11-17 11:15:25',
            ),
            193 => 
            array (
                'id' => 694,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '369',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-17 11:23:10',
                'updated_at' => '2024-11-17 11:23:10',
            ),
            194 => 
            array (
                'id' => 695,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '369',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-17 11:23:10',
                'updated_at' => '2024-11-17 11:23:10',
            ),
            195 => 
            array (
                'id' => 696,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '370',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-17 11:25:21',
                'updated_at' => '2024-11-17 11:25:21',
            ),
            196 => 
            array (
                'id' => 697,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '370',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-17 11:25:21',
                'updated_at' => '2024-11-17 11:25:21',
            ),
            197 => 
            array (
                'id' => 698,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '371',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-17 11:27:45',
                'updated_at' => '2024-11-17 11:27:45',
            ),
            198 => 
            array (
                'id' => 699,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '371',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-17 11:27:45',
                'updated_at' => '2024-11-17 11:27:45',
            ),
            199 => 
            array (
                'id' => 700,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '372',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-17 14:18:23',
                'updated_at' => '2024-11-17 14:18:23',
            ),
            200 => 
            array (
                'id' => 701,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '372',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-17 14:18:23',
                'updated_at' => '2024-11-17 14:18:23',
            ),
            201 => 
            array (
                'id' => 702,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '373',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-17 14:20:04',
                'updated_at' => '2024-11-17 14:20:04',
            ),
            202 => 
            array (
                'id' => 703,
                'data_type' => 'App\\Models\\Item',
                'data_id' => '373',
                'key' => 'images',
                'value' => 'public',
                'created_at' => '2024-11-17 14:20:04',
                'updated_at' => '2024-11-17 14:20:04',
            ),
            203 => 
            array (
                'id' => 704,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '34',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:05:52',
                'updated_at' => '2024-11-19 13:05:52',
            ),
            204 => 
            array (
                'id' => 705,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '35',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:05:52',
                'updated_at' => '2024-11-19 13:05:52',
            ),
            205 => 
            array (
                'id' => 706,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '36',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:05:52',
                'updated_at' => '2024-11-19 13:05:52',
            ),
            206 => 
            array (
                'id' => 707,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '37',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:05:52',
                'updated_at' => '2024-11-19 13:05:52',
            ),
            207 => 
            array (
                'id' => 708,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '38',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:05:52',
                'updated_at' => '2024-11-19 13:05:52',
            ),
            208 => 
            array (
                'id' => 709,
                'data_type' => 'App\\Models\\ReactTestimonial',
                'data_id' => '1',
                'key' => 'reviewer_image',
                'value' => 'public',
                'created_at' => '2024-11-19 13:43:42',
                'updated_at' => '2024-11-19 13:43:42',
            ),
            209 => 
            array (
                'id' => 710,
                'data_type' => 'App\\Models\\ReactTestimonial',
                'data_id' => '2',
                'key' => 'reviewer_image',
                'value' => 'public',
                'created_at' => '2024-11-19 13:44:05',
                'updated_at' => '2024-11-19 13:44:05',
            ),
            210 => 
            array (
                'id' => 711,
                'data_type' => 'App\\Models\\ReactTestimonial',
                'data_id' => '3',
                'key' => 'reviewer_image',
                'value' => 'public',
                'created_at' => '2024-11-19 13:44:30',
                'updated_at' => '2024-11-19 13:44:30',
            ),
            211 => 
            array (
                'id' => 712,
                'data_type' => 'App\\Models\\ReactTestimonial',
                'data_id' => '4',
                'key' => 'reviewer_image',
                'value' => 'public',
                'created_at' => '2024-11-19 13:44:58',
                'updated_at' => '2024-11-19 13:44:58',
            ),
            212 => 
            array (
                'id' => 713,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '68',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:45:27',
                'updated_at' => '2024-11-19 13:45:27',
            ),
            213 => 
            array (
                'id' => 714,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '69',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:45:27',
                'updated_at' => '2024-11-19 13:45:27',
            ),
            214 => 
            array (
                'id' => 715,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '70',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:45:27',
                'updated_at' => '2024-11-19 13:45:27',
            ),
            215 => 
            array (
                'id' => 716,
                'data_type' => 'App\\Models\\FlutterSpecialCriteria',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-19 13:47:36',
                'updated_at' => '2024-11-19 13:47:36',
            ),
            216 => 
            array (
                'id' => 717,
                'data_type' => 'App\\Models\\FlutterSpecialCriteria',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-19 13:48:00',
                'updated_at' => '2024-11-19 13:48:00',
            ),
            217 => 
            array (
                'id' => 718,
                'data_type' => 'App\\Models\\FlutterSpecialCriteria',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-19 13:49:09',
                'updated_at' => '2024-11-19 13:49:09',
            ),
            218 => 
            array (
                'id' => 719,
                'data_type' => 'App\\Models\\FlutterSpecialCriteria',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2024-11-19 13:49:50',
                'updated_at' => '2024-11-19 13:49:50',
            ),
            219 => 
            array (
                'id' => 720,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '82',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:54:14',
                'updated_at' => '2024-11-19 13:54:14',
            ),
            220 => 
            array (
                'id' => 721,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '83',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:54:14',
                'updated_at' => '2024-11-19 13:54:14',
            ),
            221 => 
            array (
                'id' => 722,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '84',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:54:14',
                'updated_at' => '2024-11-19 13:54:14',
            ),
            222 => 
            array (
                'id' => 723,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '85',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:54:15',
                'updated_at' => '2024-11-19 13:54:15',
            ),
            223 => 
            array (
                'id' => 724,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '59',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:55:36',
                'updated_at' => '2024-11-19 13:55:36',
            ),
            224 => 
            array (
                'id' => 725,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '60',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:55:36',
                'updated_at' => '2024-11-19 13:55:36',
            ),
            225 => 
            array (
                'id' => 726,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '61',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:55:36',
                'updated_at' => '2024-11-19 13:55:36',
            ),
            226 => 
            array (
                'id' => 727,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '62',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:55:36',
                'updated_at' => '2024-11-19 13:55:36',
            ),
            227 => 
            array (
                'id' => 728,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '64',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 13:56:00',
                'updated_at' => '2024-11-19 13:56:00',
            ),
            228 => 
            array (
                'id' => 729,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '24',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-04 05:00:24',
                'updated_at' => '2025-09-04 05:00:24',
            ),
            229 => 
            array (
                'id' => 730,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '64',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-04 05:00:24',
                'updated_at' => '2025-09-04 05:00:24',
            ),
            230 => 
            array (
                'id' => 731,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '261',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 15:04:40',
                'updated_at' => '2025-02-05 15:04:40',
            ),
            231 => 
            array (
                'id' => 732,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '262',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 15:04:40',
                'updated_at' => '2025-02-05 15:04:40',
            ),
            232 => 
            array (
                'id' => 733,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '263',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 15:04:40',
                'updated_at' => '2025-02-05 15:04:40',
            ),
            233 => 
            array (
                'id' => 734,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '264',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 15:04:40',
                'updated_at' => '2025-02-05 15:04:40',
            ),
            234 => 
            array (
                'id' => 735,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '265',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 15:04:40',
                'updated_at' => '2025-02-05 15:04:40',
            ),
            235 => 
            array (
                'id' => 736,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '266',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 15:04:40',
                'updated_at' => '2025-02-05 15:04:40',
            ),
            236 => 
            array (
                'id' => 737,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '267',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 15:04:40',
                'updated_at' => '2025-02-05 15:04:40',
            ),
            237 => 
            array (
                'id' => 738,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '268',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 15:04:40',
                'updated_at' => '2025-02-05 15:04:40',
            ),
            238 => 
            array (
                'id' => 739,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '242',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            239 => 
            array (
                'id' => 740,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '16',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            240 => 
            array (
                'id' => 741,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '17',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            241 => 
            array (
                'id' => 742,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '37',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            242 => 
            array (
                'id' => 743,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '132',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            243 => 
            array (
                'id' => 744,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '19',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            244 => 
            array (
                'id' => 745,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '20',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            245 => 
            array (
                'id' => 746,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '21',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            246 => 
            array (
                'id' => 747,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '22',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            247 => 
            array (
                'id' => 748,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '170',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            248 => 
            array (
                'id' => 749,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '27',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            249 => 
            array (
                'id' => 750,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '28',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            250 => 
            array (
                'id' => 751,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '39',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            251 => 
            array (
                'id' => 752,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '171',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            252 => 
            array (
                'id' => 753,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '59',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            253 => 
            array (
                'id' => 754,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '172',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            254 => 
            array (
                'id' => 755,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '173',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            255 => 
            array (
                'id' => 756,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '42',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            256 => 
            array (
                'id' => 757,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '43',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            257 => 
            array (
                'id' => 758,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '44',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            258 => 
            array (
                'id' => 759,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '46',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            259 => 
            array (
                'id' => 760,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '73',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            260 => 
            array (
                'id' => 761,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '174',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            261 => 
            array (
                'id' => 762,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '114',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 05:35:20',
                'updated_at' => '2024-11-20 05:35:20',
            ),
            262 => 
            array (
                'id' => 763,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '51',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            263 => 
            array (
                'id' => 764,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '175',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            264 => 
            array (
                'id' => 765,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '176',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            265 => 
            array (
                'id' => 766,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '177',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:47',
                'updated_at' => '2025-10-12 15:52:47',
            ),
            266 => 
            array (
                'id' => 767,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '182',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:47',
                'updated_at' => '2025-10-12 15:52:47',
            ),
            267 => 
            array (
                'id' => 768,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '79',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:47',
                'updated_at' => '2025-10-12 15:52:47',
            ),
            268 => 
            array (
                'id' => 769,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '84',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:47',
                'updated_at' => '2025-10-12 15:52:47',
            ),
            269 => 
            array (
                'id' => 770,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '95',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:47',
                'updated_at' => '2025-10-12 15:52:47',
            ),
            270 => 
            array (
                'id' => 771,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '116',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:47',
                'updated_at' => '2025-10-12 15:52:47',
            ),
            271 => 
            array (
                'id' => 772,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '221',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:47',
                'updated_at' => '2025-10-12 15:52:47',
            ),
            272 => 
            array (
                'id' => 773,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '222',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:47',
                'updated_at' => '2025-10-12 15:52:47',
            ),
            273 => 
            array (
                'id' => 774,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '133',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 14:43:27',
                'updated_at' => '2024-11-19 14:43:27',
            ),
            274 => 
            array (
                'id' => 775,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '58',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-19 14:58:11',
                'updated_at' => '2024-11-19 14:58:11',
            ),
            275 => 
            array (
                'id' => 776,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '104',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 12:21:13',
                'updated_at' => '2024-11-20 12:21:13',
            ),
            276 => 
            array (
                'id' => 777,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '100',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 12:21:38',
                'updated_at' => '2024-11-20 12:21:38',
            ),
            277 => 
            array (
                'id' => 778,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '106',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 04:57:03',
                'updated_at' => '2024-11-20 04:57:03',
            ),
            278 => 
            array (
                'id' => 779,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '107',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 04:57:18',
                'updated_at' => '2024-11-20 04:57:18',
            ),
            279 => 
            array (
                'id' => 780,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '108',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 04:58:02',
                'updated_at' => '2024-11-20 04:58:02',
            ),
            280 => 
            array (
                'id' => 781,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '109',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2024-11-20 04:58:13',
                'updated_at' => '2024-11-20 04:58:13',
            ),
            281 => 
            array (
                'id' => 782,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '45',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 15:19:11',
                'updated_at' => '2025-02-05 15:19:11',
            ),
            282 => 
            array (
                'id' => 783,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '60',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 16:19:19',
                'updated_at' => '2025-02-05 16:19:19',
            ),
            283 => 
            array (
                'id' => 784,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '60',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2025-02-05 16:19:19',
                'updated_at' => '2025-02-05 16:19:19',
            ),
            284 => 
            array (
                'id' => 785,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '46',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 16:53:18',
                'updated_at' => '2025-02-05 16:53:18',
            ),
            285 => 
            array (
                'id' => 786,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '47',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-08 09:16:58',
                'updated_at' => '2025-02-08 09:16:58',
            ),
            286 => 
            array (
                'id' => 787,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '61',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 16:24:29',
                'updated_at' => '2025-02-05 16:24:29',
            ),
            287 => 
            array (
                'id' => 788,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '61',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2025-02-05 16:24:29',
                'updated_at' => '2025-02-05 16:24:29',
            ),
            288 => 
            array (
                'id' => 789,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '48',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-08 09:17:12',
                'updated_at' => '2025-02-08 09:17:12',
            ),
            289 => 
            array (
                'id' => 790,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '49',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-08 09:17:29',
                'updated_at' => '2025-02-08 09:17:29',
            ),
            290 => 
            array (
                'id' => 791,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '62',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 16:35:15',
                'updated_at' => '2025-02-05 16:35:15',
            ),
            291 => 
            array (
                'id' => 792,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '62',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2025-02-05 16:35:15',
                'updated_at' => '2025-02-05 16:35:15',
            ),
            292 => 
            array (
                'id' => 793,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '63',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 16:40:52',
                'updated_at' => '2025-02-05 16:40:52',
            ),
            293 => 
            array (
                'id' => 794,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '63',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2025-02-05 16:40:52',
                'updated_at' => '2025-02-05 16:40:52',
            ),
            294 => 
            array (
                'id' => 795,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '64',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:10:08',
                'updated_at' => '2025-02-05 17:10:08',
            ),
            295 => 
            array (
                'id' => 796,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '64',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:10:08',
                'updated_at' => '2025-02-05 17:10:08',
            ),
            296 => 
            array (
                'id' => 797,
                'data_type' => 'App\\Models\\Notification',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:20:43',
                'updated_at' => '2025-02-05 17:20:43',
            ),
            297 => 
            array (
                'id' => 798,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '269',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:21:10',
                'updated_at' => '2025-02-05 17:21:10',
            ),
            298 => 
            array (
                'id' => 799,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '65',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:22:34',
                'updated_at' => '2025-02-05 17:22:34',
            ),
            299 => 
            array (
                'id' => 800,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '65',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:22:34',
                'updated_at' => '2025-02-05 17:22:34',
            ),
            300 => 
            array (
                'id' => 801,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '66',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:27:33',
                'updated_at' => '2025-02-05 17:27:33',
            ),
            301 => 
            array (
                'id' => 802,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '66',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:27:33',
                'updated_at' => '2025-02-05 17:27:33',
            ),
            302 => 
            array (
                'id' => 803,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '67',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:30:10',
                'updated_at' => '2025-02-05 17:30:10',
            ),
            303 => 
            array (
                'id' => 804,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '67',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:30:10',
                'updated_at' => '2025-02-05 17:30:10',
            ),
            304 => 
            array (
                'id' => 805,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-08 09:35:33',
                'updated_at' => '2025-02-08 09:35:33',
            ),
            305 => 
            array (
                'id' => 806,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '1',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-08 09:35:33',
                'updated_at' => '2025-02-08 09:35:33',
            ),
            306 => 
            array (
                'id' => 807,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '1',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-05 17:31:39',
                'updated_at' => '2025-02-05 17:31:39',
            ),
            307 => 
            array (
                'id' => 808,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '270',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:32:04',
                'updated_at' => '2025-02-05 17:32:04',
            ),
            308 => 
            array (
                'id' => 809,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:34:23',
                'updated_at' => '2025-02-05 17:34:23',
            ),
            309 => 
            array (
                'id' => 810,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '2',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:34:23',
                'updated_at' => '2025-02-05 17:34:23',
            ),
            310 => 
            array (
                'id' => 811,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '2',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:36:05',
                'updated_at' => '2025-02-08 09:36:05',
            ),
            311 => 
            array (
                'id' => 812,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '271',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:34:43',
                'updated_at' => '2025-02-05 17:34:43',
            ),
            312 => 
            array (
                'id' => 813,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:35:50',
                'updated_at' => '2025-02-05 17:35:50',
            ),
            313 => 
            array (
                'id' => 814,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '3',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:35:50',
                'updated_at' => '2025-02-05 17:35:50',
            ),
            314 => 
            array (
                'id' => 815,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '3',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:37:40',
                'updated_at' => '2025-02-08 09:37:40',
            ),
            315 => 
            array (
                'id' => 816,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '272',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:35:58',
                'updated_at' => '2025-02-05 17:35:58',
            ),
            316 => 
            array (
                'id' => 817,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:37:57',
                'updated_at' => '2025-02-05 17:37:57',
            ),
            317 => 
            array (
                'id' => 818,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '4',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:37:57',
                'updated_at' => '2025-02-05 17:37:57',
            ),
            318 => 
            array (
                'id' => 819,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '4',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:38:15',
                'updated_at' => '2025-02-08 09:38:15',
            ),
            319 => 
            array (
                'id' => 820,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '273',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:38:15',
                'updated_at' => '2025-02-05 17:38:15',
            ),
            320 => 
            array (
                'id' => 821,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:39:02',
                'updated_at' => '2025-02-05 17:39:02',
            ),
            321 => 
            array (
                'id' => 822,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '5',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:39:02',
                'updated_at' => '2025-02-05 17:39:02',
            ),
            322 => 
            array (
                'id' => 823,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '5',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:38:48',
                'updated_at' => '2025-02-08 09:38:48',
            ),
            323 => 
            array (
                'id' => 824,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '274',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:39:12',
                'updated_at' => '2025-02-05 17:39:12',
            ),
            324 => 
            array (
                'id' => 825,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '6',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:39:43',
                'updated_at' => '2025-02-05 17:39:43',
            ),
            325 => 
            array (
                'id' => 826,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '6',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:39:43',
                'updated_at' => '2025-02-05 17:39:43',
            ),
            326 => 
            array (
                'id' => 827,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '6',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:39:18',
                'updated_at' => '2025-02-08 09:39:18',
            ),
            327 => 
            array (
                'id' => 828,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '275',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:39:57',
                'updated_at' => '2025-02-05 17:39:57',
            ),
            328 => 
            array (
                'id' => 829,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '7',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:41:46',
                'updated_at' => '2025-02-05 17:41:46',
            ),
            329 => 
            array (
                'id' => 830,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '7',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:41:46',
                'updated_at' => '2025-02-05 17:41:46',
            ),
            330 => 
            array (
                'id' => 831,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '7',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:39:50',
                'updated_at' => '2025-02-08 09:39:50',
            ),
            331 => 
            array (
                'id' => 832,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '8',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:42:45',
                'updated_at' => '2025-02-05 17:42:45',
            ),
            332 => 
            array (
                'id' => 833,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '8',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:42:45',
                'updated_at' => '2025-02-05 17:42:45',
            ),
            333 => 
            array (
                'id' => 834,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '8',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:40:20',
                'updated_at' => '2025-02-08 09:40:20',
            ),
            334 => 
            array (
                'id' => 835,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '276',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:42:58',
                'updated_at' => '2025-02-05 17:42:58',
            ),
            335 => 
            array (
                'id' => 836,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '9',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:43:50',
                'updated_at' => '2025-02-05 17:43:50',
            ),
            336 => 
            array (
                'id' => 837,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '9',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:43:50',
                'updated_at' => '2025-02-05 17:43:50',
            ),
            337 => 
            array (
                'id' => 838,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '9',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:40:55',
                'updated_at' => '2025-02-08 09:40:55',
            ),
            338 => 
            array (
                'id' => 839,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '10',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:45:59',
                'updated_at' => '2025-02-05 17:45:59',
            ),
            339 => 
            array (
                'id' => 840,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '10',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:45:59',
                'updated_at' => '2025-02-05 17:45:59',
            ),
            340 => 
            array (
                'id' => 841,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '10',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:42:06',
                'updated_at' => '2025-02-08 09:42:06',
            ),
            341 => 
            array (
                'id' => 842,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '277',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:46:15',
                'updated_at' => '2025-02-05 17:46:15',
            ),
            342 => 
            array (
                'id' => 843,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '278',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:55:11',
                'updated_at' => '2025-02-05 17:55:11',
            ),
            343 => 
            array (
                'id' => 844,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '11',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:56:17',
                'updated_at' => '2025-02-05 17:56:17',
            ),
            344 => 
            array (
                'id' => 845,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '11',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:56:17',
                'updated_at' => '2025-02-05 17:56:17',
            ),
            345 => 
            array (
                'id' => 846,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '11',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:42:33',
                'updated_at' => '2025-02-08 09:42:33',
            ),
            346 => 
            array (
                'id' => 847,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '279',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:56:58',
                'updated_at' => '2025-02-05 17:56:58',
            ),
            347 => 
            array (
                'id' => 848,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '12',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:57:46',
                'updated_at' => '2025-02-05 17:57:46',
            ),
            348 => 
            array (
                'id' => 849,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '12',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:57:46',
                'updated_at' => '2025-02-05 17:57:46',
            ),
            349 => 
            array (
                'id' => 850,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '12',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:44:16',
                'updated_at' => '2025-02-08 09:44:16',
            ),
            350 => 
            array (
                'id' => 851,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '280',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:58:12',
                'updated_at' => '2025-02-05 17:58:12',
            ),
            351 => 
            array (
                'id' => 852,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '13',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 17:59:00',
                'updated_at' => '2025-02-05 17:59:00',
            ),
            352 => 
            array (
                'id' => 853,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '13',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 17:59:00',
                'updated_at' => '2025-02-05 17:59:00',
            ),
            353 => 
            array (
                'id' => 854,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '13',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:43:47',
                'updated_at' => '2025-02-08 09:43:47',
            ),
            354 => 
            array (
                'id' => 855,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '281',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 17:59:14',
                'updated_at' => '2025-02-05 17:59:14',
            ),
            355 => 
            array (
                'id' => 856,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '14',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 18:00:02',
                'updated_at' => '2025-02-05 18:00:02',
            ),
            356 => 
            array (
                'id' => 857,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '14',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-05 18:00:02',
                'updated_at' => '2025-02-05 18:00:02',
            ),
            357 => 
            array (
                'id' => 858,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '14',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-08 09:44:55',
                'updated_at' => '2025-02-08 09:44:55',
            ),
            358 => 
            array (
                'id' => 859,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '15',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-05 18:01:30',
                'updated_at' => '2025-02-05 18:01:30',
            ),
            359 => 
            array (
                'id' => 860,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '15',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-02-08 09:36:47',
                'updated_at' => '2025-02-08 09:36:47',
            ),
            360 => 
            array (
                'id' => 861,
                'data_type' => 'Modules\\Rental\\Entities\\RentalEmailTemplate',
                'data_id' => '15',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-05 18:01:30',
                'updated_at' => '2025-02-05 18:01:30',
            ),
            361 => 
            array (
                'id' => 862,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '282',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-05 18:01:38',
                'updated_at' => '2025-02-05 18:01:38',
            ),
            362 => 
            array (
                'id' => 863,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '6',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-09-09 12:40:04',
                'updated_at' => '2025-09-09 12:40:04',
            ),
            363 => 
            array (
                'id' => 864,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '6',
                'key' => 'thumbnail',
                'value' => 'public',
                'created_at' => '2025-02-06 10:17:25',
                'updated_at' => '2025-02-06 10:17:25',
            ),
            364 => 
            array (
                'id' => 865,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '5',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-09-09 12:39:34',
                'updated_at' => '2025-09-09 12:39:34',
            ),
            365 => 
            array (
                'id' => 866,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '4',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-06 10:18:31',
                'updated_at' => '2025-02-06 10:18:31',
            ),
            366 => 
            array (
                'id' => 867,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '3',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-06 10:18:47',
                'updated_at' => '2025-02-06 10:18:47',
            ),
            367 => 
            array (
                'id' => 868,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '2',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-06 10:19:01',
                'updated_at' => '2025-02-06 10:19:01',
            ),
            368 => 
            array (
                'id' => 869,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '1',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-02-06 10:19:18',
                'updated_at' => '2025-02-06 10:19:18',
            ),
            369 => 
            array (
                'id' => 870,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '110',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-06 10:41:27',
                'updated_at' => '2025-02-06 10:41:27',
            ),
            370 => 
            array (
                'id' => 871,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '111',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-06 10:41:27',
                'updated_at' => '2025-02-06 10:41:27',
            ),
            371 => 
            array (
                'id' => 872,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '112',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-06 10:41:27',
                'updated_at' => '2025-02-06 10:41:27',
            ),
            372 => 
            array (
                'id' => 873,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '113',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-06 10:34:58',
                'updated_at' => '2025-02-06 10:34:58',
            ),
            373 => 
            array (
                'id' => 874,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '114',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-06 10:34:58',
                'updated_at' => '2025-02-06 10:34:58',
            ),
            374 => 
            array (
                'id' => 875,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '115',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-06 10:34:58',
                'updated_at' => '2025-02-06 10:34:58',
            ),
            375 => 
            array (
                'id' => 876,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '116',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-06 10:34:58',
                'updated_at' => '2025-02-06 10:34:58',
            ),
            376 => 
            array (
                'id' => 877,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '12',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-06 15:10:09',
                'updated_at' => '2025-02-06 15:10:09',
            ),
            377 => 
            array (
                'id' => 878,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '13',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-06 15:10:09',
                'updated_at' => '2025-02-06 15:10:09',
            ),
            378 => 
            array (
                'id' => 879,
                'data_type' => 'App\\Models\\User',
                'data_id' => '26',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-06 15:11:09',
                'updated_at' => '2025-02-06 15:11:09',
            ),
            379 => 
            array (
                'id' => 880,
                'data_type' => 'App\\Models\\User',
                'data_id' => '28',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-06 17:19:54',
                'updated_at' => '2025-02-06 17:19:54',
            ),
            380 => 
            array (
                'id' => 881,
                'data_type' => 'App\\Models\\User',
                'data_id' => '21',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-06 17:24:31',
                'updated_at' => '2025-02-06 17:24:31',
            ),
            381 => 
            array (
                'id' => 882,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '14',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-06 17:36:43',
                'updated_at' => '2025-02-06 17:36:43',
            ),
            382 => 
            array (
                'id' => 883,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '15',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-06 17:36:43',
                'updated_at' => '2025-02-06 17:36:43',
            ),
            383 => 
            array (
                'id' => 884,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '202',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 11:50:22',
                'updated_at' => '2025-10-13 11:50:22',
            ),
            384 => 
            array (
                'id' => 885,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '203',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 11:50:22',
                'updated_at' => '2025-10-13 11:50:22',
            ),
            385 => 
            array (
                'id' => 886,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '204',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 11:50:22',
                'updated_at' => '2025-10-13 11:50:22',
            ),
            386 => 
            array (
                'id' => 887,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '229',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 11:50:22',
                'updated_at' => '2025-10-13 11:50:22',
            ),
            387 => 
            array (
                'id' => 888,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '98',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 11:50:22',
                'updated_at' => '2025-10-13 11:50:22',
            ),
            388 => 
            array (
                'id' => 889,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '97',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 11:50:22',
                'updated_at' => '2025-10-13 11:50:22',
            ),
            389 => 
            array (
                'id' => 890,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '183',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 11:50:22',
                'updated_at' => '2025-10-13 11:50:22',
            ),
            390 => 
            array (
                'id' => 891,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '184',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 11:50:22',
                'updated_at' => '2025-10-13 11:50:22',
            ),
            391 => 
            array (
                'id' => 892,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '185',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 11:50:22',
                'updated_at' => '2025-10-13 11:50:22',
            ),
            392 => 
            array (
                'id' => 893,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '186',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 11:50:22',
                'updated_at' => '2025-10-13 11:50:22',
            ),
            393 => 
            array (
                'id' => 894,
                'data_type' => 'App\\Models\\User',
                'data_id' => '8',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-02-08 15:06:59',
                'updated_at' => '2025-02-08 15:06:59',
            ),
            394 => 
            array (
                'id' => 895,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '283',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-02-08 09:46:25',
                'updated_at' => '2025-02-08 09:46:25',
            ),
            395 => 
            array (
                'id' => 896,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '284',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            396 => 
            array (
                'id' => 897,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '285',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:52:46',
                'updated_at' => '2025-10-12 15:52:46',
            ),
            397 => 
            array (
                'id' => 898,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '119',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 15:06:04',
                'updated_at' => '2025-10-13 15:06:04',
            ),
            398 => 
            array (
                'id' => 899,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '120',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 13:05:05',
                'updated_at' => '2025-09-28 13:05:05',
            ),
            399 => 
            array (
                'id' => 900,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '121',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 13:05:05',
                'updated_at' => '2025-09-28 13:05:05',
            ),
            400 => 
            array (
                'id' => 901,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '122',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 15:06:04',
                'updated_at' => '2025-10-13 15:06:04',
            ),
            401 => 
            array (
                'id' => 902,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '123',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 15:06:04',
                'updated_at' => '2025-10-13 15:06:04',
            ),
            402 => 
            array (
                'id' => 903,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '124',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 15:06:04',
                'updated_at' => '2025-10-13 15:06:04',
            ),
            403 => 
            array (
                'id' => 904,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '125',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 15:06:04',
                'updated_at' => '2025-10-13 15:06:04',
            ),
            404 => 
            array (
                'id' => 905,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '126',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-13 15:06:04',
                'updated_at' => '2025-10-13 15:06:04',
            ),
            405 => 
            array (
                'id' => 906,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '127',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 17:17:15',
                'updated_at' => '2025-10-12 17:17:15',
            ),
            406 => 
            array (
                'id' => 907,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '128',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 17:17:15',
                'updated_at' => '2025-10-12 17:17:15',
            ),
            407 => 
            array (
                'id' => 908,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '129',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 17:17:15',
                'updated_at' => '2025-10-12 17:17:15',
            ),
            408 => 
            array (
                'id' => 909,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '130',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 17:17:15',
                'updated_at' => '2025-10-12 17:17:15',
            ),
            409 => 
            array (
                'id' => 910,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '131',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 17:17:15',
                'updated_at' => '2025-10-12 17:17:15',
            ),
            410 => 
            array (
                'id' => 911,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '132',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-04 03:40:25',
                'updated_at' => '2025-09-04 03:40:25',
            ),
            411 => 
            array (
                'id' => 912,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '133',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 11:37:46',
                'updated_at' => '2025-10-12 11:37:46',
            ),
            412 => 
            array (
                'id' => 913,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '134',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 11:37:46',
                'updated_at' => '2025-10-12 11:37:46',
            ),
            413 => 
            array (
                'id' => 914,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '135',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 11:37:46',
                'updated_at' => '2025-10-12 11:37:46',
            ),
            414 => 
            array (
                'id' => 915,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '136',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 11:37:46',
                'updated_at' => '2025-10-12 11:37:46',
            ),
            415 => 
            array (
                'id' => 916,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '137',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 11:37:47',
                'updated_at' => '2025-10-12 11:37:47',
            ),
            416 => 
            array (
                'id' => 917,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '138',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-04 03:42:25',
                'updated_at' => '2025-09-04 03:42:25',
            ),
            417 => 
            array (
                'id' => 918,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '139',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-18 12:59:11',
                'updated_at' => '2025-09-18 12:59:11',
            ),
            418 => 
            array (
                'id' => 919,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '140',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-18 12:59:11',
                'updated_at' => '2025-09-18 12:59:11',
            ),
            419 => 
            array (
                'id' => 920,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '141',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-18 12:59:11',
                'updated_at' => '2025-09-18 12:59:11',
            ),
            420 => 
            array (
                'id' => 921,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '142',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-04 03:43:25',
                'updated_at' => '2025-09-04 03:43:25',
            ),
            421 => 
            array (
                'id' => 922,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '143',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            422 => 
            array (
                'id' => 923,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '144',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            423 => 
            array (
                'id' => 924,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '145',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            424 => 
            array (
                'id' => 925,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '146',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            425 => 
            array (
                'id' => 926,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '147',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            426 => 
            array (
                'id' => 927,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '148',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            427 => 
            array (
                'id' => 928,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '149',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            428 => 
            array (
                'id' => 929,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '150',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            429 => 
            array (
                'id' => 930,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '151',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            430 => 
            array (
                'id' => 931,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '152',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            431 => 
            array (
                'id' => 932,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '153',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            432 => 
            array (
                'id' => 933,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '154',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            433 => 
            array (
                'id' => 934,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '155',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            434 => 
            array (
                'id' => 935,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '156',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            435 => 
            array (
                'id' => 936,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '157',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            436 => 
            array (
                'id' => 937,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '158',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            437 => 
            array (
                'id' => 938,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '159',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-28 16:15:28',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            438 => 
            array (
                'id' => 939,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '160',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            439 => 
            array (
                'id' => 940,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '161',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            440 => 
            array (
                'id' => 941,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '162',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            441 => 
            array (
                'id' => 942,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '163',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            442 => 
            array (
                'id' => 943,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '164',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            443 => 
            array (
                'id' => 944,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '165',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            444 => 
            array (
                'id' => 945,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '166',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            445 => 
            array (
                'id' => 946,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '167',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            446 => 
            array (
                'id' => 947,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '168',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            447 => 
            array (
                'id' => 948,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '169',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            448 => 
            array (
                'id' => 949,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '170',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            449 => 
            array (
                'id' => 950,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '171',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-08 10:12:34',
                'updated_at' => '2025-10-08 10:12:34',
            ),
            450 => 
            array (
                'id' => 951,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '172',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-08 10:12:34',
                'updated_at' => '2025-10-08 10:12:34',
            ),
            451 => 
            array (
                'id' => 952,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '173',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-04 03:55:58',
                'updated_at' => '2025-09-04 03:55:58',
            ),
            452 => 
            array (
                'id' => 953,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '174',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-04 03:55:58',
                'updated_at' => '2025-09-04 03:55:58',
            ),
            453 => 
            array (
                'id' => 954,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '175',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-04 03:55:58',
                'updated_at' => '2025-09-04 03:55:58',
            ),
            454 => 
            array (
                'id' => 955,
                'data_type' => 'App\\Models\\UserLevel',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-04 04:00:45',
                'updated_at' => '2025-09-04 04:00:45',
            ),
            455 => 
            array (
                'id' => 956,
                'data_type' => 'App\\Models\\UserLevel',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-04 04:01:53',
                'updated_at' => '2025-09-04 04:01:53',
            ),
            456 => 
            array (
                'id' => 957,
                'data_type' => 'App\\Models\\UserLevel',
                'data_id' => '3',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-10-09 15:53:32',
                'updated_at' => '2025-10-09 15:53:32',
            ),
            457 => 
            array (
                'id' => 958,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '16',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-04 05:05:25',
                'updated_at' => '2025-09-04 05:05:25',
            ),
            458 => 
            array (
                'id' => 959,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '17',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-04 06:10:10',
                'updated_at' => '2025-09-04 06:10:10',
            ),
            459 => 
            array (
                'id' => 960,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '18',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-04 08:51:46',
                'updated_at' => '2025-09-04 08:51:46',
            ),
            460 => 
            array (
                'id' => 961,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '19',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-04 10:03:19',
                'updated_at' => '2025-09-04 10:03:19',
            ),
            461 => 
            array (
                'id' => 962,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '20',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-04 10:40:41',
                'updated_at' => '2025-09-04 10:40:41',
            ),
            462 => 
            array (
                'id' => 963,
                'data_type' => 'App\\Models\\User',
                'data_id' => '29',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-04 10:43:39',
                'updated_at' => '2025-09-04 10:43:39',
            ),
            463 => 
            array (
                'id' => 964,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '21',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-07 06:29:43',
                'updated_at' => '2025-09-07 06:29:43',
            ),
            464 => 
            array (
                'id' => 965,
                'data_type' => 'App\\Models\\RiderVehicleBrand',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-08 05:03:00',
                'updated_at' => '2025-09-08 05:03:00',
            ),
            465 => 
            array (
                'id' => 966,
                'data_type' => 'App\\Models\\RiderVehicleBrand',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-08 05:03:21',
                'updated_at' => '2025-09-08 05:03:21',
            ),
            466 => 
            array (
                'id' => 967,
                'data_type' => 'App\\Models\\RiderVehicleBrand',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-08 05:03:47',
                'updated_at' => '2025-09-08 05:03:47',
            ),
            467 => 
            array (
                'id' => 968,
                'data_type' => 'App\\Models\\RiderVehicleModel',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-08 05:04:47',
                'updated_at' => '2025-09-08 05:04:47',
            ),
            468 => 
            array (
                'id' => 969,
                'data_type' => 'App\\Models\\RiderVehicleModel',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-08 05:05:05',
                'updated_at' => '2025-09-08 05:05:05',
            ),
            469 => 
            array (
                'id' => 970,
                'data_type' => 'App\\Models\\RiderVehicleModel',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-08 05:05:31',
                'updated_at' => '2025-09-08 05:05:31',
            ),
            470 => 
            array (
                'id' => 971,
                'data_type' => 'App\\Models\\RiderVehicleModel',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-08 05:09:24',
                'updated_at' => '2025-09-08 05:09:24',
            ),
            471 => 
            array (
                'id' => 972,
                'data_type' => 'App\\Models\\RiderVehicleCategory',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-08 05:12:57',
                'updated_at' => '2025-09-08 05:12:57',
            ),
            472 => 
            array (
                'id' => 973,
                'data_type' => 'App\\Models\\RiderVehicleCategory',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-08 05:14:28',
                'updated_at' => '2025-09-08 05:14:28',
            ),
            473 => 
            array (
                'id' => 974,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '219',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-17 11:47:02',
                'updated_at' => '2025-09-17 11:47:02',
            ),
            474 => 
            array (
                'id' => 975,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '5',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-17 11:47:02',
                'updated_at' => '2025-09-17 11:47:02',
            ),
            475 => 
            array (
                'id' => 976,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '113',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-17 11:47:02',
                'updated_at' => '2025-09-17 11:47:02',
            ),
            476 => 
            array (
                'id' => 977,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '22',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-08 08:56:57',
                'updated_at' => '2025-09-08 08:56:57',
            ),
            477 => 
            array (
                'id' => 978,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '8',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-08 09:13:00',
                'updated_at' => '2025-09-08 09:13:00',
            ),
            478 => 
            array (
                'id' => 979,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '23',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-09 10:49:35',
                'updated_at' => '2025-09-09 10:49:35',
            ),
            479 => 
            array (
                'id' => 980,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '9',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-09 10:51:43',
                'updated_at' => '2025-09-09 10:51:43',
            ),
            480 => 
            array (
                'id' => 981,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '8',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-09-09 12:00:55',
                'updated_at' => '2025-09-09 12:00:55',
            ),
            481 => 
            array (
                'id' => 982,
                'data_type' => 'App\\Models\\Module',
                'data_id' => '7',
                'key' => 'icon',
                'value' => 'public',
                'created_at' => '2025-09-09 11:19:45',
                'updated_at' => '2025-09-09 11:19:45',
            ),
            482 => 
            array (
                'id' => 983,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '24',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-09 11:32:21',
                'updated_at' => '2025-09-09 11:32:21',
            ),
            483 => 
            array (
                'id' => 984,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '50',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-09 12:02:54',
                'updated_at' => '2025-09-09 12:02:54',
            ),
            484 => 
            array (
                'id' => 985,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '51',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-09 11:34:01',
                'updated_at' => '2025-09-09 11:34:01',
            ),
            485 => 
            array (
                'id' => 986,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '52',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-09 12:05:58',
                'updated_at' => '2025-09-09 12:05:58',
            ),
            486 => 
            array (
                'id' => 987,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '53',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-09 11:35:34',
                'updated_at' => '2025-09-09 11:35:34',
            ),
            487 => 
            array (
                'id' => 988,
                'data_type' => 'Modules\\Service\\Entities\\PromotionManagement\\Campaign',
                'data_id' => '1',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2025-09-09 12:09:24',
                'updated_at' => '2025-09-09 12:09:24',
            ),
            488 => 
            array (
                'id' => 989,
                'data_type' => 'Modules\\Service\\Entities\\PromotionManagement\\Campaign',
                'data_id' => '1',
                'key' => 'thumbnail',
                'value' => 'public',
                'created_at' => '2025-09-09 12:09:24',
                'updated_at' => '2025-09-09 12:09:24',
            ),
            489 => 
            array (
                'id' => 990,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '25',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-09 11:59:37',
                'updated_at' => '2025-09-09 11:59:37',
            ),
            490 => 
            array (
                'id' => 991,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000015',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2025-09-09 12:14:01',
                'updated_at' => '2025-09-09 12:14:01',
            ),
            491 => 
            array (
                'id' => 992,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000015',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2025-09-09 12:14:01',
                'updated_at' => '2025-09-09 12:14:01',
            ),
            492 => 
            array (
                'id' => 993,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000015',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2025-09-09 12:14:01',
                'updated_at' => '2025-09-09 12:14:01',
            ),
            493 => 
            array (
                'id' => 994,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '54',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-09 12:37:26',
                'updated_at' => '2025-09-09 12:37:26',
            ),
            494 => 
            array (
                'id' => 995,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '10',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-09 12:46:57',
                'updated_at' => '2025-09-09 12:46:57',
            ),
            495 => 
            array (
                'id' => 996,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '26',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-09 13:14:45',
                'updated_at' => '2025-09-09 13:14:45',
            ),
            496 => 
            array (
                'id' => 997,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '55',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-10 16:51:20',
                'updated_at' => '2025-09-10 16:51:20',
            ),
            497 => 
            array (
                'id' => 998,
                'data_type' => 'App\\Models\\RiderVehicleBrand',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-11 12:08:31',
                'updated_at' => '2025-09-11 12:08:31',
            ),
            498 => 
            array (
                'id' => 999,
                'data_type' => 'App\\Models\\RiderVehicleModel',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-11 12:09:05',
                'updated_at' => '2025-09-11 12:09:05',
            ),
            499 => 
            array (
                'id' => 1000,
                'data_type' => 'App\\Models\\RiderVehicleCategory',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-11 12:13:43',
                'updated_at' => '2025-09-11 12:13:43',
            ),
        ));
        \DB::table('storages')->insert(array (
            0 => 
            array (
                'id' => 1001,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '11',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-11 12:16:23',
                'updated_at' => '2025-09-11 12:16:23',
            ),
            1 => 
            array (
                'id' => 1002,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '27',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-11 13:07:14',
                'updated_at' => '2025-09-11 13:07:14',
            ),
            2 => 
            array (
                'id' => 1003,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '12',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-15 15:28:09',
                'updated_at' => '2025-09-15 15:28:09',
            ),
            3 => 
            array (
                'id' => 1004,
                'data_type' => 'App\\Models\\RiderVehicleCategory',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-15 17:30:29',
                'updated_at' => '2025-09-15 17:30:29',
            ),
            4 => 
            array (
                'id' => 1005,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '13',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-15 18:12:00',
                'updated_at' => '2025-09-15 18:12:00',
            ),
            5 => 
            array (
                'id' => 1006,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '205',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            6 => 
            array (
                'id' => 1007,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '206',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            7 => 
            array (
                'id' => 1008,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '207',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            8 => 
            array (
                'id' => 1009,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '112',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            9 => 
            array (
                'id' => 1010,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '58',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            10 => 
            array (
                'id' => 1011,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '81',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            11 => 
            array (
                'id' => 1012,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '82',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            12 => 
            array (
                'id' => 1013,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '85',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            13 => 
            array (
                'id' => 1014,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '180',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            14 => 
            array (
                'id' => 1015,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '286',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            15 => 
            array (
                'id' => 1016,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '287',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            16 => 
            array (
                'id' => 1017,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '176',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            17 => 
            array (
                'id' => 1018,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '177',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            18 => 
            array (
                'id' => 1019,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '178',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            19 => 
            array (
                'id' => 1020,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '179',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            20 => 
            array (
                'id' => 1021,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '180',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            21 => 
            array (
                'id' => 1022,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '181',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            22 => 
            array (
                'id' => 1023,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '182',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 13:07:31',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            23 => 
            array (
                'id' => 1024,
                'data_type' => 'App\\Models\\RiderVehicleBrand',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-16 11:29:00',
                'updated_at' => '2025-09-16 11:29:00',
            ),
            24 => 
            array (
                'id' => 1025,
                'data_type' => 'App\\Models\\RiderVehicleCategory',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-16 12:15:59',
                'updated_at' => '2025-09-16 12:15:59',
            ),
            25 => 
            array (
                'id' => 1026,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '68',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-09-16 12:45:58',
                'updated_at' => '2025-09-16 12:45:58',
            ),
            26 => 
            array (
                'id' => 1027,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '68',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2025-09-16 12:45:58',
                'updated_at' => '2025-09-16 12:45:58',
            ),
            27 => 
            array (
                'id' => 1028,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '69',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-09-16 13:00:49',
                'updated_at' => '2025-09-16 13:00:49',
            ),
            28 => 
            array (
                'id' => 1029,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '69',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2025-09-16 13:00:49',
                'updated_at' => '2025-09-16 13:00:49',
            ),
            29 => 
            array (
                'id' => 1030,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '70',
                'key' => 'logo',
                'value' => 'public',
                'created_at' => '2025-09-16 13:00:58',
                'updated_at' => '2025-09-16 13:00:58',
            ),
            30 => 
            array (
                'id' => 1031,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '70',
                'key' => 'cover_photo',
                'value' => 'public',
                'created_at' => '2025-09-16 13:00:58',
                'updated_at' => '2025-09-16 13:00:58',
            ),
            31 => 
            array (
                'id' => 1032,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '14',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-16 15:03:24',
                'updated_at' => '2025-09-16 15:03:24',
            ),
            32 => 
            array (
                'id' => 1033,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '56',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-16 16:01:14',
                'updated_at' => '2025-09-16 16:01:14',
            ),
            33 => 
            array (
                'id' => 1034,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '15',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-16 16:13:05',
                'updated_at' => '2025-09-16 16:13:05',
            ),
            34 => 
            array (
                'id' => 1035,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '57',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-16 17:12:52',
                'updated_at' => '2025-09-16 17:12:52',
            ),
            35 => 
            array (
                'id' => 1036,
                'data_type' => 'App\\Models\\Notification',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-17 11:31:18',
                'updated_at' => '2025-09-17 11:31:18',
            ),
            36 => 
            array (
                'id' => 1037,
                'data_type' => 'App\\Models\\Notification',
                'data_id' => '6',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-17 11:32:47',
                'updated_at' => '2025-09-17 11:32:47',
            ),
            37 => 
            array (
                'id' => 1038,
                'data_type' => 'App\\Models\\Notification',
                'data_id' => '7',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-17 12:18:53',
                'updated_at' => '2025-09-17 12:18:53',
            ),
            38 => 
            array (
                'id' => 1039,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '28',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-17 12:20:28',
                'updated_at' => '2025-09-17 12:20:28',
            ),
            39 => 
            array (
                'id' => 1040,
                'data_type' => 'App\\Models\\Notification',
                'data_id' => '8',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-17 12:34:37',
                'updated_at' => '2025-09-17 12:34:37',
            ),
            40 => 
            array (
                'id' => 1041,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '58',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-17 13:12:21',
                'updated_at' => '2025-09-17 13:12:21',
            ),
            41 => 
            array (
                'id' => 1042,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000016',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2025-09-18 11:13:37',
                'updated_at' => '2025-09-18 11:13:37',
            ),
            42 => 
            array (
                'id' => 1043,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000016',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2025-09-18 11:13:37',
                'updated_at' => '2025-09-18 11:13:37',
            ),
            43 => 
            array (
                'id' => 1044,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000016',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2025-09-18 11:13:37',
                'updated_at' => '2025-09-18 11:13:37',
            ),
            44 => 
            array (
                'id' => 1045,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000017',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2025-09-18 11:14:10',
                'updated_at' => '2025-09-18 11:14:10',
            ),
            45 => 
            array (
                'id' => 1046,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000017',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2025-09-18 11:14:10',
                'updated_at' => '2025-09-18 11:14:10',
            ),
            46 => 
            array (
                'id' => 1047,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000017',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2025-09-18 11:14:10',
                'updated_at' => '2025-09-18 11:14:10',
            ),
            47 => 
            array (
                'id' => 1048,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '29',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-18 11:19:29',
                'updated_at' => '2025-09-18 11:19:29',
            ),
            48 => 
            array (
                'id' => 1049,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '30',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-18 11:19:29',
                'updated_at' => '2025-09-18 11:19:29',
            ),
            49 => 
            array (
                'id' => 1050,
                'data_type' => 'Modules\\Service\\Entities\\PromotionManagement\\Campaign',
                'data_id' => '2',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2025-09-18 11:22:47',
                'updated_at' => '2025-09-18 11:22:47',
            ),
            50 => 
            array (
                'id' => 1051,
                'data_type' => 'Modules\\Service\\Entities\\PromotionManagement\\Campaign',
                'data_id' => '2',
                'key' => 'thumbnail',
                'value' => 'public',
                'created_at' => '2025-09-18 11:22:47',
                'updated_at' => '2025-09-18 11:22:47',
            ),
            51 => 
            array (
                'id' => 1052,
                'data_type' => 'App\\Models\\Notification',
                'data_id' => '9',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-21 10:44:03',
                'updated_at' => '2025-09-21 10:44:03',
            ),
            52 => 
            array (
                'id' => 1053,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '31',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-21 15:06:14',
                'updated_at' => '2025-09-21 15:06:14',
            ),
            53 => 
            array (
                'id' => 1054,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000018',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2025-09-21 15:06:34',
                'updated_at' => '2025-09-21 15:06:34',
            ),
            54 => 
            array (
                'id' => 1055,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000018',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2025-09-21 15:06:34',
                'updated_at' => '2025-09-21 15:06:34',
            ),
            55 => 
            array (
                'id' => 1056,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000018',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2025-09-21 15:06:34',
                'updated_at' => '2025-09-21 15:06:34',
            ),
            56 => 
            array (
                'id' => 1057,
                'data_type' => 'App\\Models\\User',
                'data_id' => '33',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-21 16:33:32',
                'updated_at' => '2025-09-21 16:33:32',
            ),
            57 => 
            array (
                'id' => 1058,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '32',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-22 11:23:47',
                'updated_at' => '2025-09-22 11:23:47',
            ),
            58 => 
            array (
                'id' => 1059,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '33',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-22 13:21:29',
                'updated_at' => '2025-09-22 13:21:29',
            ),
            59 => 
            array (
                'id' => 1060,
                'data_type' => 'App\\Models\\Notification',
                'data_id' => '10',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-22 16:25:00',
                'updated_at' => '2025-09-22 16:25:00',
            ),
            60 => 
            array (
                'id' => 1061,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '32',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-25 10:46:37',
                'updated_at' => '2025-09-25 10:46:37',
            ),
            61 => 
            array (
                'id' => 1062,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '91',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-09-25 10:45:15',
                'updated_at' => '2025-09-25 10:45:15',
            ),
            62 => 
            array (
                'id' => 1063,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '88',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-22 16:39:46',
                'updated_at' => '2025-09-22 16:39:46',
            ),
            63 => 
            array (
                'id' => 1064,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '33',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-09-22 16:44:39',
                'updated_at' => '2025-09-22 16:44:39',
            ),
            64 => 
            array (
                'id' => 1065,
                'data_type' => 'Modules\\Service\\Entities\\EmployeeManagement\\ProviderEmployee',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-23 12:09:16',
                'updated_at' => '2025-09-23 12:09:16',
            ),
            65 => 
            array (
                'id' => 1066,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000019',
                'key' => 'video_attachment',
                'value' => 'public',
                'created_at' => '2025-09-24 16:28:22',
                'updated_at' => '2025-09-24 16:28:22',
            ),
            66 => 
            array (
                'id' => 1067,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000019',
                'key' => 'cover_image',
                'value' => 'public',
                'created_at' => '2025-09-24 16:28:22',
                'updated_at' => '2025-09-24 16:28:22',
            ),
            67 => 
            array (
                'id' => 1068,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000019',
                'key' => 'profile_image',
                'value' => 'public',
                'created_at' => '2025-09-24 16:28:22',
                'updated_at' => '2025-09-24 16:28:22',
            ),
            68 => 
            array (
                'id' => 1069,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '288',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-11 13:59:16',
                'updated_at' => '2025-10-11 13:59:16',
            ),
            69 => 
            array (
                'id' => 1070,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '289',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-11 13:59:16',
                'updated_at' => '2025-10-11 13:59:16',
            ),
            70 => 
            array (
                'id' => 1071,
                'data_type' => 'App\\Models\\DataSetting',
                'data_id' => '183',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-11 11:39:06',
                'updated_at' => '2025-10-11 11:39:06',
            ),
            71 => 
            array (
                'id' => 1072,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000020',
                'key' => 'video_attachment',
                'value' => 's3',
                'created_at' => '2025-09-25 11:12:00',
                'updated_at' => '2025-09-25 11:12:00',
            ),
            72 => 
            array (
                'id' => 1073,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000020',
                'key' => 'cover_image',
                'value' => 's3',
                'created_at' => '2025-09-25 11:12:00',
                'updated_at' => '2025-09-25 11:12:00',
            ),
            73 => 
            array (
                'id' => 1074,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000020',
                'key' => 'profile_image',
                'value' => 's3',
                'created_at' => '2025-09-25 11:12:00',
                'updated_at' => '2025-09-25 11:12:00',
            ),
            74 => 
            array (
                'id' => 1075,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000021',
                'key' => 'video_attachment',
                'value' => 's3',
                'created_at' => '2025-09-25 11:13:26',
                'updated_at' => '2025-09-25 11:13:26',
            ),
            75 => 
            array (
                'id' => 1076,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000021',
                'key' => 'cover_image',
                'value' => 's3',
                'created_at' => '2025-09-25 11:13:26',
                'updated_at' => '2025-09-25 11:13:26',
            ),
            76 => 
            array (
                'id' => 1077,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000021',
                'key' => 'profile_image',
                'value' => 's3',
                'created_at' => '2025-09-25 11:13:26',
                'updated_at' => '2025-09-25 11:13:26',
            ),
            77 => 
            array (
                'id' => 1078,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000022',
                'key' => 'video_attachment',
                'value' => 's3',
                'created_at' => '2025-09-25 11:14:40',
                'updated_at' => '2025-09-25 11:14:40',
            ),
            78 => 
            array (
                'id' => 1079,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000022',
                'key' => 'cover_image',
                'value' => 's3',
                'created_at' => '2025-09-25 11:14:40',
                'updated_at' => '2025-09-25 11:14:40',
            ),
            79 => 
            array (
                'id' => 1080,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000022',
                'key' => 'profile_image',
                'value' => 's3',
                'created_at' => '2025-09-25 11:14:40',
                'updated_at' => '2025-09-25 11:14:40',
            ),
            80 => 
            array (
                'id' => 1081,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '71',
                'key' => 'logo',
                'value' => 's3',
                'created_at' => '2025-09-25 14:45:46',
                'updated_at' => '2025-09-25 14:45:46',
            ),
            81 => 
            array (
                'id' => 1082,
                'data_type' => 'App\\Models\\Store',
                'data_id' => '71',
                'key' => 'cover_photo',
                'value' => 's3',
                'created_at' => '2025-09-25 14:45:46',
                'updated_at' => '2025-09-25 14:45:46',
            ),
            82 => 
            array (
                'id' => 1083,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '16',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-09-25 17:25:21',
                'updated_at' => '2025-09-25 17:25:21',
            ),
            83 => 
            array (
                'id' => 1084,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '17',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-09-25 18:01:17',
                'updated_at' => '2025-09-25 18:01:17',
            ),
            84 => 
            array (
                'id' => 1085,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '18',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-09-25 18:04:16',
                'updated_at' => '2025-09-25 18:04:16',
            ),
            85 => 
            array (
                'id' => 1086,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000023',
                'key' => 'video_attachment',
                'value' => 's3',
                'created_at' => '2025-09-28 10:48:28',
                'updated_at' => '2025-09-28 10:48:28',
            ),
            86 => 
            array (
                'id' => 1087,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000023',
                'key' => 'cover_image',
                'value' => 's3',
                'created_at' => '2025-09-28 10:48:28',
                'updated_at' => '2025-09-28 10:48:28',
            ),
            87 => 
            array (
                'id' => 1088,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000023',
                'key' => 'profile_image',
                'value' => 's3',
                'created_at' => '2025-09-28 10:48:28',
                'updated_at' => '2025-09-28 10:48:28',
            ),
            88 => 
            array (
                'id' => 1089,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000024',
                'key' => 'video_attachment',
                'value' => 's3',
                'created_at' => '2025-09-28 11:10:15',
                'updated_at' => '2025-09-28 11:10:15',
            ),
            89 => 
            array (
                'id' => 1090,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000024',
                'key' => 'cover_image',
                'value' => 's3',
                'created_at' => '2025-09-28 11:10:15',
                'updated_at' => '2025-09-28 11:10:15',
            ),
            90 => 
            array (
                'id' => 1091,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000024',
                'key' => 'profile_image',
                'value' => 's3',
                'created_at' => '2025-09-28 11:10:15',
                'updated_at' => '2025-09-28 11:10:15',
            ),
            91 => 
            array (
                'id' => 1092,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '34',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-09-28 16:55:35',
                'updated_at' => '2025-09-28 16:55:35',
            ),
            92 => 
            array (
                'id' => 1093,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '35',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-09-30 15:01:43',
                'updated_at' => '2025-09-30 15:01:43',
            ),
            93 => 
            array (
                'id' => 1094,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '36',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-09-30 15:02:24',
                'updated_at' => '2025-09-30 15:02:24',
            ),
            94 => 
            array (
                'id' => 1095,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '19',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-10-05 17:53:22',
                'updated_at' => '2025-10-05 17:53:22',
            ),
            95 => 
            array (
                'id' => 1096,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '59',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-10-06 15:53:28',
                'updated_at' => '2025-10-06 15:53:28',
            ),
            96 => 
            array (
                'id' => 1097,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '37',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-10-08 09:49:38',
                'updated_at' => '2025-10-08 09:49:38',
            ),
            97 => 
            array (
                'id' => 1098,
                'data_type' => 'App\\Models\\RiderVehicleCategory',
                'data_id' => '6',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-10-08 09:56:01',
                'updated_at' => '2025-10-08 09:56:01',
            ),
            98 => 
            array (
                'id' => 1099,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '20',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-13 13:32:12',
                'updated_at' => '2025-10-13 13:32:12',
            ),
            99 => 
            array (
                'id' => 1100,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000025',
                'key' => 'video_attachment',
                'value' => 's3',
                'created_at' => '2025-10-09 12:52:31',
                'updated_at' => '2025-10-09 12:52:31',
            ),
            100 => 
            array (
                'id' => 1101,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000025',
                'key' => 'cover_image',
                'value' => 's3',
                'created_at' => '2025-10-09 12:52:31',
                'updated_at' => '2025-10-09 12:52:31',
            ),
            101 => 
            array (
                'id' => 1102,
                'data_type' => 'App\\Models\\Advertisement',
                'data_id' => '1000025',
                'key' => 'profile_image',
                'value' => 's3',
                'created_at' => '2025-10-09 12:52:31',
                'updated_at' => '2025-10-09 12:52:31',
            ),
            102 => 
            array (
                'id' => 1103,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '290',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:00:38',
                'updated_at' => '2025-10-12 15:00:38',
            ),
            103 => 
            array (
                'id' => 1104,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '291',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:00:38',
                'updated_at' => '2025-10-12 15:00:38',
            ),
            104 => 
            array (
                'id' => 1105,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '292',
                'key' => NULL,
                'value' => 'public',
                'created_at' => '2025-10-12 15:00:38',
                'updated_at' => '2025-10-12 15:00:38',
            ),
            105 => 
            array (
                'id' => 1106,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '21',
                'key' => 'image',
                'value' => 's3',
                'created_at' => '2025-10-09 15:57:45',
                'updated_at' => '2025-10-09 15:57:45',
            ),
            106 => 
            array (
                'id' => 1107,
                'data_type' => 'App\\Models\\BusinessSetting',
                'data_id' => '4',
                'key' => NULL,
                'value' => 's3',
                'created_at' => '2025-10-10 17:30:01',
                'updated_at' => '2025-10-10 17:30:01',
            ),
            107 => 
            array (
                'id' => 1108,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '22',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-13 13:30:28',
                'updated_at' => '2025-10-13 13:30:28',
            ),
            108 => 
            array (
                'id' => 1109,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '38',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-13 13:30:28',
                'updated_at' => '2025-10-13 13:30:28',
            ),
            109 => 
            array (
                'id' => 1110,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '23',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-11 14:35:14',
                'updated_at' => '2025-10-11 14:35:14',
            ),
            110 => 
            array (
                'id' => 1111,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '24',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-11 16:06:11',
                'updated_at' => '2025-10-11 16:06:11',
            ),
            111 => 
            array (
                'id' => 1112,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '39',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-11 16:10:30',
                'updated_at' => '2025-10-11 16:10:30',
            ),
            112 => 
            array (
                'id' => 1113,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '40',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-11 16:16:08',
                'updated_at' => '2025-10-11 16:16:08',
            ),
            113 => 
            array (
                'id' => 1114,
                'data_type' => 'App\\Models\\User',
                'data_id' => '32',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-11 16:55:05',
                'updated_at' => '2025-10-11 16:55:05',
            ),
            114 => 
            array (
                'id' => 1115,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '25',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-13 13:17:20',
                'updated_at' => '2025-10-13 13:17:20',
            ),
            115 => 
            array (
                'id' => 1116,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '41',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-11 17:31:42',
                'updated_at' => '2025-10-11 17:31:42',
            ),
            116 => 
            array (
                'id' => 1117,
                'data_type' => 'App\\Models\\UserLevel',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-12 10:26:31',
                'updated_at' => '2025-10-12 10:26:31',
            ),
            117 => 
            array (
                'id' => 1118,
                'data_type' => 'App\\Models\\UserLevel',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-12 10:30:13',
                'updated_at' => '2025-10-12 10:30:13',
            ),
            118 => 
            array (
                'id' => 1119,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '26',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-12 14:33:23',
                'updated_at' => '2025-10-12 14:33:23',
            ),
            119 => 
            array (
                'id' => 1120,
                'data_type' => 'App\\Models\\UserInfo',
                'data_id' => '42',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-10-13 15:46:10',
                'updated_at' => '2025-10-13 15:46:10',
            ),
        ));
        
        
    }
}