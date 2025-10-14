<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TimeLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('time_logs')->delete();
        
        \DB::table('time_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'time_track_id' => 1,
                'online_at' => '10:57:22',
                'offline_at' => NULL,
                'created_at' => '2025-09-08 04:57:22',
                'updated_at' => '2025-09-08 04:57:22',
            ),
            1 => 
            array (
                'id' => 2,
                'time_track_id' => 2,
                'online_at' => '10:52:25',
                'offline_at' => NULL,
                'created_at' => '2025-09-09 10:52:25',
                'updated_at' => '2025-09-09 10:52:25',
            ),
            2 => 
            array (
                'id' => 3,
                'time_track_id' => 3,
                'online_at' => '12:47:34',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-09 12:47:34',
                'updated_at' => '2025-09-10 17:40:52',
            ),
            3 => 
            array (
                'id' => 4,
                'time_track_id' => 4,
                'online_at' => '17:40:52',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-10 17:40:52',
                'updated_at' => '2025-09-11 10:42:26',
            ),
            4 => 
            array (
                'id' => 5,
                'time_track_id' => 5,
                'online_at' => '10:42:26',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-11 10:42:26',
                'updated_at' => '2025-09-12 00:07:46',
            ),
            5 => 
            array (
                'id' => 6,
                'time_track_id' => 6,
                'online_at' => '12:21:26',
                'offline_at' => NULL,
                'created_at' => '2025-09-11 12:21:26',
                'updated_at' => '2025-09-11 12:21:26',
            ),
            6 => 
            array (
                'id' => 7,
                'time_track_id' => 7,
                'online_at' => '00:07:46',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-12 00:07:46',
                'updated_at' => '2025-09-13 07:21:10',
            ),
            7 => 
            array (
                'id' => 8,
                'time_track_id' => 8,
                'online_at' => '07:21:10',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-13 07:21:10',
                'updated_at' => '2025-09-14 03:30:50',
            ),
            8 => 
            array (
                'id' => 9,
                'time_track_id' => 9,
                'online_at' => '03:30:50',
                'offline_at' => NULL,
                'created_at' => '2025-09-14 03:30:50',
                'updated_at' => '2025-09-14 03:30:50',
            ),
            9 => 
            array (
                'id' => 10,
                'time_track_id' => 10,
                'online_at' => '10:20:41',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-14 10:20:41',
                'updated_at' => '2025-09-15 10:01:09',
            ),
            10 => 
            array (
                'id' => 11,
                'time_track_id' => 11,
                'online_at' => '10:01:09',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-15 10:01:09',
                'updated_at' => '2025-09-16 09:28:47',
            ),
            11 => 
            array (
                'id' => 12,
                'time_track_id' => 12,
                'online_at' => '15:39:26',
                'offline_at' => NULL,
                'created_at' => '2025-09-15 15:39:26',
                'updated_at' => '2025-09-15 15:39:26',
            ),
            12 => 
            array (
                'id' => 13,
                'time_track_id' => 13,
                'online_at' => '18:19:09',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-15 18:19:09',
                'updated_at' => '2025-09-16 10:28:23',
            ),
            13 => 
            array (
                'id' => 14,
                'time_track_id' => 14,
                'online_at' => '09:28:47',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-16 09:28:47',
                'updated_at' => '2025-09-17 09:22:40',
            ),
            14 => 
            array (
                'id' => 15,
                'time_track_id' => 15,
                'online_at' => '10:28:23',
                'offline_at' => NULL,
                'created_at' => '2025-09-16 10:28:23',
                'updated_at' => '2025-09-16 10:28:23',
            ),
            15 => 
            array (
                'id' => 16,
                'time_track_id' => 16,
                'online_at' => '11:25:32',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-16 11:25:32',
                'updated_at' => '2025-09-17 09:21:48',
            ),
            16 => 
            array (
                'id' => 17,
                'time_track_id' => 17,
                'online_at' => '15:32:23',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-16 15:32:23',
                'updated_at' => '2025-09-17 12:27:54',
            ),
            17 => 
            array (
                'id' => 18,
                'time_track_id' => 18,
                'online_at' => '15:49:52',
                'offline_at' => NULL,
                'created_at' => '2025-09-16 15:49:52',
                'updated_at' => '2025-09-16 15:49:52',
            ),
            18 => 
            array (
                'id' => 19,
                'time_track_id' => 19,
                'online_at' => '09:21:48',
                'offline_at' => NULL,
                'created_at' => '2025-09-17 09:21:48',
                'updated_at' => '2025-09-17 09:21:48',
            ),
            19 => 
            array (
                'id' => 20,
                'time_track_id' => 20,
                'online_at' => '09:22:40',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-17 09:22:40',
                'updated_at' => '2025-09-18 11:03:41',
            ),
            20 => 
            array (
                'id' => 21,
                'time_track_id' => 21,
                'online_at' => '12:27:54',
                'offline_at' => NULL,
                'created_at' => '2025-09-17 12:27:54',
                'updated_at' => '2025-09-17 12:27:54',
            ),
            21 => 
            array (
                'id' => 22,
                'time_track_id' => 22,
                'online_at' => '11:03:41',
                'offline_at' => NULL,
                'created_at' => '2025-09-18 11:03:41',
                'updated_at' => '2025-09-18 11:03:41',
            ),
            22 => 
            array (
                'id' => 23,
                'time_track_id' => 23,
                'online_at' => '20:58:55',
                'offline_at' => NULL,
                'created_at' => '2025-09-18 20:58:55',
                'updated_at' => '2025-09-18 20:58:55',
            ),
            23 => 
            array (
                'id' => 24,
                'time_track_id' => 24,
                'online_at' => '10:02:49',
                'offline_at' => NULL,
                'created_at' => '2025-09-21 10:02:49',
                'updated_at' => '2025-09-21 10:02:49',
            ),
            24 => 
            array (
                'id' => 25,
                'time_track_id' => 25,
                'online_at' => '12:56:55',
                'offline_at' => NULL,
                'created_at' => '2025-09-21 12:56:55',
                'updated_at' => '2025-09-21 12:56:55',
            ),
            25 => 
            array (
                'id' => 26,
                'time_track_id' => 26,
                'online_at' => '13:00:26',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-24 13:00:26',
                'updated_at' => '2025-09-25 10:34:21',
            ),
            26 => 
            array (
                'id' => 27,
                'time_track_id' => 27,
                'online_at' => '15:01:30',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-24 15:01:30',
                'updated_at' => '2025-09-25 11:35:20',
            ),
            27 => 
            array (
                'id' => 28,
                'time_track_id' => 28,
                'online_at' => '07:39:34',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-25 07:39:34',
                'updated_at' => '2025-09-26 00:00:08',
            ),
            28 => 
            array (
                'id' => 29,
                'time_track_id' => 29,
                'online_at' => '10:34:21',
                'offline_at' => NULL,
                'created_at' => '2025-09-25 10:34:21',
                'updated_at' => '2025-09-25 10:34:21',
            ),
            29 => 
            array (
                'id' => 30,
                'time_track_id' => 30,
                'online_at' => '11:35:20',
                'offline_at' => NULL,
                'created_at' => '2025-09-25 11:35:20',
                'updated_at' => '2025-09-25 11:35:20',
            ),
            30 => 
            array (
                'id' => 31,
                'time_track_id' => 31,
                'online_at' => '17:27:22',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-25 17:27:22',
                'updated_at' => '2025-09-26 00:33:08',
            ),
            31 => 
            array (
                'id' => 32,
                'time_track_id' => 32,
                'online_at' => '00:00:08',
                'offline_at' => NULL,
                'created_at' => '2025-09-26 00:00:08',
                'updated_at' => '2025-09-26 00:00:08',
            ),
            32 => 
            array (
                'id' => 33,
                'time_track_id' => 33,
                'online_at' => '00:33:08',
                'offline_at' => NULL,
                'created_at' => '2025-09-26 00:33:08',
                'updated_at' => '2025-09-26 00:33:08',
            ),
            33 => 
            array (
                'id' => 34,
                'time_track_id' => 34,
                'online_at' => '09:36:14',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-28 09:36:14',
                'updated_at' => '2025-09-29 10:00:52',
            ),
            34 => 
            array (
                'id' => 35,
                'time_track_id' => 35,
                'online_at' => '09:44:46',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-28 09:44:46',
                'updated_at' => '2025-09-29 11:04:33',
            ),
            35 => 
            array (
                'id' => 36,
                'time_track_id' => 36,
                'online_at' => '10:00:52',
                'offline_at' => '23:59:59',
                'created_at' => '2025-09-29 10:00:52',
                'updated_at' => '2025-09-30 12:03:09',
            ),
            36 => 
            array (
                'id' => 37,
                'time_track_id' => 37,
                'online_at' => '11:04:33',
                'offline_at' => NULL,
                'created_at' => '2025-09-29 11:04:33',
                'updated_at' => '2025-09-29 11:04:33',
            ),
            37 => 
            array (
                'id' => 38,
                'time_track_id' => 38,
                'online_at' => '12:03:09',
                'offline_at' => NULL,
                'created_at' => '2025-09-30 12:03:09',
                'updated_at' => '2025-09-30 12:03:09',
            ),
            38 => 
            array (
                'id' => 39,
                'time_track_id' => 39,
                'online_at' => '00:22:07',
                'offline_at' => NULL,
                'created_at' => '2025-10-01 00:22:07',
                'updated_at' => '2025-10-01 00:22:07',
            ),
            39 => 
            array (
                'id' => 40,
                'time_track_id' => 40,
                'online_at' => '11:08:07',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-04 11:08:07',
                'updated_at' => '2025-10-05 12:32:08',
            ),
            40 => 
            array (
                'id' => 41,
                'time_track_id' => 41,
                'online_at' => '12:32:08',
                'offline_at' => NULL,
                'created_at' => '2025-10-05 12:32:08',
                'updated_at' => '2025-10-05 12:32:08',
            ),
            41 => 
            array (
                'id' => 42,
                'time_track_id' => 42,
                'online_at' => '13:22:03',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-05 13:22:03',
                'updated_at' => '2025-10-06 09:51:37',
            ),
            42 => 
            array (
                'id' => 43,
                'time_track_id' => 43,
                'online_at' => '18:13:59',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-05 18:13:59',
                'updated_at' => '2025-10-06 09:51:10',
            ),
            43 => 
            array (
                'id' => 44,
                'time_track_id' => 44,
                'online_at' => '09:51:10',
                'offline_at' => NULL,
                'created_at' => '2025-10-06 09:51:10',
                'updated_at' => '2025-10-06 09:51:10',
            ),
            44 => 
            array (
                'id' => 45,
                'time_track_id' => 45,
                'online_at' => '09:51:37',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-06 09:51:37',
                'updated_at' => '2025-10-07 11:32:35',
            ),
            45 => 
            array (
                'id' => 46,
                'time_track_id' => 46,
                'online_at' => '11:32:35',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-07 11:32:35',
                'updated_at' => '2025-10-08 11:11:10',
            ),
            46 => 
            array (
                'id' => 47,
                'time_track_id' => 47,
                'online_at' => '09:23:59',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-08 09:23:59',
                'updated_at' => '2025-10-09 09:40:43',
            ),
            47 => 
            array (
                'id' => 48,
                'time_track_id' => 48,
                'online_at' => '11:11:10',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-08 11:11:10',
                'updated_at' => '2025-10-09 11:10:50',
            ),
            48 => 
            array (
                'id' => 49,
                'time_track_id' => 49,
                'online_at' => '16:14:22',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-08 16:14:22',
                'updated_at' => '2025-10-09 14:59:52',
            ),
            49 => 
            array (
                'id' => 50,
                'time_track_id' => 50,
                'online_at' => '09:40:43',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-09 09:40:43',
                'updated_at' => '2025-10-10 09:05:29',
            ),
            50 => 
            array (
                'id' => 51,
                'time_track_id' => 51,
                'online_at' => '11:10:50',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-09 11:10:50',
                'updated_at' => '2025-10-10 09:38:40',
            ),
            51 => 
            array (
                'id' => 52,
                'time_track_id' => 52,
                'online_at' => '14:59:52',
                'offline_at' => NULL,
                'created_at' => '2025-10-09 14:59:52',
                'updated_at' => '2025-10-09 14:59:52',
            ),
            52 => 
            array (
                'id' => 53,
                'time_track_id' => 53,
                'online_at' => '17:41:47',
                'offline_at' => NULL,
                'created_at' => '2025-10-09 17:41:47',
                'updated_at' => '2025-10-09 17:41:47',
            ),
            53 => 
            array (
                'id' => 54,
                'time_track_id' => 54,
                'online_at' => '09:05:29',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-10 09:05:29',
                'updated_at' => '2025-10-11 07:08:27',
            ),
            54 => 
            array (
                'id' => 55,
                'time_track_id' => 55,
                'online_at' => '09:38:40',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-10 09:38:40',
                'updated_at' => '2025-10-11 16:57:22',
            ),
            55 => 
            array (
                'id' => 56,
                'time_track_id' => 56,
                'online_at' => '15:45:43',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-10 15:45:43',
                'updated_at' => '2025-10-11 10:23:38',
            ),
            56 => 
            array (
                'id' => 57,
                'time_track_id' => 57,
                'online_at' => '17:48:05',
                'offline_at' => NULL,
                'created_at' => '2025-10-10 17:48:05',
                'updated_at' => '2025-10-10 17:48:05',
            ),
            57 => 
            array (
                'id' => 58,
                'time_track_id' => 57,
                'online_at' => '17:52:13',
                'offline_at' => NULL,
                'created_at' => '2025-10-10 17:52:13',
                'updated_at' => '2025-10-10 17:52:13',
            ),
            58 => 
            array (
                'id' => 59,
                'time_track_id' => 58,
                'online_at' => '07:08:27',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-11 07:08:27',
                'updated_at' => '2025-10-12 10:24:35',
            ),
            59 => 
            array (
                'id' => 60,
                'time_track_id' => 59,
                'online_at' => '10:23:38',
                'offline_at' => NULL,
                'created_at' => '2025-10-11 10:23:38',
                'updated_at' => '2025-10-11 10:23:38',
            ),
            60 => 
            array (
                'id' => 61,
                'time_track_id' => 59,
                'online_at' => '10:23:47',
                'offline_at' => NULL,
                'created_at' => '2025-10-11 10:23:47',
                'updated_at' => '2025-10-11 10:23:47',
            ),
            61 => 
            array (
                'id' => 62,
                'time_track_id' => 60,
                'online_at' => '12:09:38',
                'offline_at' => NULL,
                'created_at' => '2025-10-11 12:09:38',
                'updated_at' => '2025-10-11 12:09:38',
            ),
            62 => 
            array (
                'id' => 63,
                'time_track_id' => 60,
                'online_at' => '12:13:23',
                'offline_at' => '12:13:26',
                'created_at' => '2025-10-11 12:13:23',
                'updated_at' => '2025-10-11 12:13:26',
            ),
            63 => 
            array (
                'id' => 64,
                'time_track_id' => 60,
                'online_at' => '12:13:36',
                'offline_at' => '12:52:46',
                'created_at' => '2025-10-11 12:13:36',
                'updated_at' => '2025-10-11 12:52:46',
            ),
            64 => 
            array (
                'id' => 65,
                'time_track_id' => 60,
                'online_at' => '12:52:51',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-11 12:52:51',
                'updated_at' => '2025-10-12 10:39:49',
            ),
            65 => 
            array (
                'id' => 66,
                'time_track_id' => 61,
                'online_at' => '16:06:58',
                'offline_at' => NULL,
                'created_at' => '2025-10-11 16:06:58',
                'updated_at' => '2025-10-11 16:06:58',
            ),
            66 => 
            array (
                'id' => 67,
                'time_track_id' => 61,
                'online_at' => '16:07:05',
                'offline_at' => '16:07:10',
                'created_at' => '2025-10-11 16:07:05',
                'updated_at' => '2025-10-11 16:07:10',
            ),
            67 => 
            array (
                'id' => 68,
                'time_track_id' => 61,
                'online_at' => '16:09:37',
                'offline_at' => '16:58:53',
                'created_at' => '2025-10-11 16:09:37',
                'updated_at' => '2025-10-11 16:58:53',
            ),
            68 => 
            array (
                'id' => 69,
                'time_track_id' => 62,
                'online_at' => '16:57:22',
                'offline_at' => '16:58:31',
                'created_at' => '2025-10-11 16:57:22',
                'updated_at' => '2025-10-11 16:58:31',
            ),
            69 => 
            array (
                'id' => 70,
                'time_track_id' => 62,
                'online_at' => '16:58:34',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-11 16:58:34',
                'updated_at' => '2025-10-12 10:12:01',
            ),
            70 => 
            array (
                'id' => 71,
                'time_track_id' => 61,
                'online_at' => '16:59:21',
                'offline_at' => '19:17:36',
                'created_at' => '2025-10-11 16:59:21',
                'updated_at' => '2025-10-11 19:17:36',
            ),
            71 => 
            array (
                'id' => 72,
                'time_track_id' => 63,
                'online_at' => '17:19:59',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-11 17:19:59',
                'updated_at' => '2025-10-12 11:09:36',
            ),
            72 => 
            array (
                'id' => 73,
                'time_track_id' => 61,
                'online_at' => '19:20:39',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-11 19:20:39',
                'updated_at' => '2025-10-12 09:27:36',
            ),
            73 => 
            array (
                'id' => 74,
                'time_track_id' => 64,
                'online_at' => '09:27:36',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-12 09:27:36',
                'updated_at' => '2025-10-13 11:33:26',
            ),
            74 => 
            array (
                'id' => 75,
                'time_track_id' => 65,
                'online_at' => '10:12:01',
                'offline_at' => '10:51:11',
                'created_at' => '2025-10-12 10:12:01',
                'updated_at' => '2025-10-12 10:51:11',
            ),
            75 => 
            array (
                'id' => 76,
                'time_track_id' => 66,
                'online_at' => '10:24:35',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-12 10:24:35',
                'updated_at' => '2025-10-13 09:47:32',
            ),
            76 => 
            array (
                'id' => 77,
                'time_track_id' => 67,
                'online_at' => '10:39:49',
                'offline_at' => '11:35:24',
                'created_at' => '2025-10-12 10:39:49',
                'updated_at' => '2025-10-12 11:35:24',
            ),
            77 => 
            array (
                'id' => 78,
                'time_track_id' => 65,
                'online_at' => '10:51:17',
                'offline_at' => '10:51:37',
                'created_at' => '2025-10-12 10:51:17',
                'updated_at' => '2025-10-12 10:51:37',
            ),
            78 => 
            array (
                'id' => 79,
                'time_track_id' => 65,
                'online_at' => '10:51:40',
                'offline_at' => '10:52:01',
                'created_at' => '2025-10-12 10:51:40',
                'updated_at' => '2025-10-12 10:52:01',
            ),
            79 => 
            array (
                'id' => 80,
                'time_track_id' => 65,
                'online_at' => '11:05:28',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-12 11:05:28',
                'updated_at' => '2025-10-13 12:13:34',
            ),
            80 => 
            array (
                'id' => 81,
                'time_track_id' => 68,
                'online_at' => '11:09:36',
                'offline_at' => NULL,
                'created_at' => '2025-10-12 11:09:36',
                'updated_at' => '2025-10-12 11:09:36',
            ),
            81 => 
            array (
                'id' => 82,
                'time_track_id' => 68,
                'online_at' => '11:13:16',
                'offline_at' => NULL,
                'created_at' => '2025-10-12 11:13:16',
                'updated_at' => '2025-10-12 11:13:16',
            ),
            82 => 
            array (
                'id' => 83,
                'time_track_id' => 67,
                'online_at' => '11:35:50',
                'offline_at' => '11:38:54',
                'created_at' => '2025-10-12 11:35:50',
                'updated_at' => '2025-10-12 11:38:54',
            ),
            83 => 
            array (
                'id' => 84,
                'time_track_id' => 67,
                'online_at' => '11:51:56',
                'offline_at' => '11:52:20',
                'created_at' => '2025-10-12 11:51:56',
                'updated_at' => '2025-10-12 11:52:20',
            ),
            84 => 
            array (
                'id' => 85,
                'time_track_id' => 67,
                'online_at' => '11:53:41',
                'offline_at' => '11:56:20',
                'created_at' => '2025-10-12 11:53:41',
                'updated_at' => '2025-10-12 11:56:20',
            ),
            85 => 
            array (
                'id' => 86,
                'time_track_id' => 67,
                'online_at' => '11:56:27',
                'offline_at' => '11:58:55',
                'created_at' => '2025-10-12 11:56:27',
                'updated_at' => '2025-10-12 11:58:55',
            ),
            86 => 
            array (
                'id' => 87,
                'time_track_id' => 67,
                'online_at' => '11:58:59',
                'offline_at' => '11:59:01',
                'created_at' => '2025-10-12 11:58:59',
                'updated_at' => '2025-10-12 11:59:01',
            ),
            87 => 
            array (
                'id' => 88,
                'time_track_id' => 67,
                'online_at' => '11:59:03',
                'offline_at' => '11:59:07',
                'created_at' => '2025-10-12 11:59:03',
                'updated_at' => '2025-10-12 11:59:07',
            ),
            88 => 
            array (
                'id' => 89,
                'time_track_id' => 67,
                'online_at' => '11:59:08',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-12 11:59:08',
                'updated_at' => '2025-10-13 09:54:10',
            ),
            89 => 
            array (
                'id' => 90,
                'time_track_id' => 69,
                'online_at' => '09:47:32',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-13 09:47:32',
                'updated_at' => '2025-10-14 09:20:41',
            ),
            90 => 
            array (
                'id' => 91,
                'time_track_id' => 70,
                'online_at' => '09:54:10',
                'offline_at' => '23:59:59',
                'created_at' => '2025-10-13 09:54:10',
                'updated_at' => '2025-10-14 09:33:30',
            ),
            91 => 
            array (
                'id' => 92,
                'time_track_id' => 71,
                'online_at' => '11:33:26',
                'offline_at' => NULL,
                'created_at' => '2025-10-13 11:33:26',
                'updated_at' => '2025-10-13 11:33:26',
            ),
            92 => 
            array (
                'id' => 93,
                'time_track_id' => 72,
                'online_at' => '12:13:34',
                'offline_at' => '12:34:37',
                'created_at' => '2025-10-13 12:13:34',
                'updated_at' => '2025-10-13 12:34:37',
            ),
            93 => 
            array (
                'id' => 94,
                'time_track_id' => 72,
                'online_at' => '12:34:40',
                'offline_at' => '12:34:42',
                'created_at' => '2025-10-13 12:34:40',
                'updated_at' => '2025-10-13 12:34:42',
            ),
            94 => 
            array (
                'id' => 95,
                'time_track_id' => 72,
                'online_at' => '12:34:45',
                'offline_at' => '17:09:34',
                'created_at' => '2025-10-13 12:34:45',
                'updated_at' => '2025-10-13 17:09:34',
            ),
            95 => 
            array (
                'id' => 96,
                'time_track_id' => 73,
                'online_at' => '13:42:39',
                'offline_at' => '15:42:18',
                'created_at' => '2025-10-13 13:42:39',
                'updated_at' => '2025-10-13 15:42:18',
            ),
            96 => 
            array (
                'id' => 97,
                'time_track_id' => 73,
                'online_at' => '15:42:26',
                'offline_at' => '15:42:32',
                'created_at' => '2025-10-13 15:42:26',
                'updated_at' => '2025-10-13 15:42:32',
            ),
            97 => 
            array (
                'id' => 98,
                'time_track_id' => 73,
                'online_at' => '15:43:13',
                'offline_at' => '15:48:20',
                'created_at' => '2025-10-13 15:43:13',
                'updated_at' => '2025-10-13 15:48:20',
            ),
            98 => 
            array (
                'id' => 99,
                'time_track_id' => 73,
                'online_at' => '15:48:33',
                'offline_at' => '15:48:40',
                'created_at' => '2025-10-13 15:48:33',
                'updated_at' => '2025-10-13 15:48:40',
            ),
            99 => 
            array (
                'id' => 100,
                'time_track_id' => 73,
                'online_at' => '15:48:40',
                'offline_at' => '15:48:42',
                'created_at' => '2025-10-13 15:48:40',
                'updated_at' => '2025-10-13 15:48:42',
            ),
            100 => 
            array (
                'id' => 101,
                'time_track_id' => 73,
                'online_at' => '15:48:47',
                'offline_at' => NULL,
                'created_at' => '2025-10-13 15:48:47',
                'updated_at' => '2025-10-13 15:48:47',
            ),
            101 => 
            array (
                'id' => 102,
                'time_track_id' => 72,
                'online_at' => '17:09:36',
                'offline_at' => '17:09:37',
                'created_at' => '2025-10-13 17:09:36',
                'updated_at' => '2025-10-13 17:09:37',
            ),
            102 => 
            array (
                'id' => 103,
                'time_track_id' => 72,
                'online_at' => '17:09:41',
                'offline_at' => '17:09:46',
                'created_at' => '2025-10-13 17:09:41',
                'updated_at' => '2025-10-13 17:09:46',
            ),
            103 => 
            array (
                'id' => 104,
                'time_track_id' => 72,
                'online_at' => '17:11:44',
                'offline_at' => '17:12:05',
                'created_at' => '2025-10-13 17:11:44',
                'updated_at' => '2025-10-13 17:12:05',
            ),
            104 => 
            array (
                'id' => 105,
                'time_track_id' => 72,
                'online_at' => '17:12:26',
                'offline_at' => NULL,
                'created_at' => '2025-10-13 17:12:26',
                'updated_at' => '2025-10-13 17:12:26',
            ),
            105 => 
            array (
                'id' => 106,
                'time_track_id' => 74,
                'online_at' => '09:20:41',
                'offline_at' => NULL,
                'created_at' => '2025-10-14 09:20:41',
                'updated_at' => '2025-10-14 09:20:41',
            ),
            106 => 
            array (
                'id' => 107,
                'time_track_id' => 75,
                'online_at' => '09:33:30',
                'offline_at' => NULL,
                'created_at' => '2025-10-14 09:33:30',
                'updated_at' => '2025-10-14 09:33:30',
            ),
        ));
        
        
    }
}