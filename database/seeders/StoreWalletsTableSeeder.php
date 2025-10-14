<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreWalletsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_wallets')->delete();
        
        \DB::table('store_wallets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'vendor_id' => 1,
                'total_earning' => '62.10',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-16 14:28:11',
                'updated_at' => '2025-04-20 18:16:07',
            ),
            1 => 
            array (
                'id' => 2,
                'vendor_id' => 2,
                'total_earning' => '2040.91',
                'total_withdrawn' => '736.36',
                'pending_withdraw' => '940.91',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 11:10:46',
                'updated_at' => '2023-11-27 13:50:23',
            ),
            2 => 
            array (
                'id' => 3,
                'vendor_id' => 3,
                'total_earning' => '13400.00',
                'total_withdrawn' => '3500.00',
                'pending_withdraw' => '4100.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 11:19:39',
                'updated_at' => '2022-09-29 15:14:38',
            ),
            3 => 
            array (
                'id' => 4,
                'vendor_id' => 5,
                'total_earning' => '119.19',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 11:23:10',
                'updated_at' => '2025-10-12 18:06:21',
            ),
            4 => 
            array (
                'id' => 5,
                'vendor_id' => 4,
                'total_earning' => '4248.82',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 11:24:42',
                'updated_at' => '2024-01-02 17:24:06',
            ),
            5 => 
            array (
                'id' => 6,
                'vendor_id' => 7,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 11:29:40',
                'updated_at' => '2022-03-22 11:29:40',
            ),
            6 => 
            array (
                'id' => 7,
                'vendor_id' => 16,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 11:47:07',
                'updated_at' => '2022-03-22 11:47:07',
            ),
            7 => 
            array (
                'id' => 8,
                'vendor_id' => 18,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 11:51:36',
                'updated_at' => '2022-03-22 11:51:36',
            ),
            8 => 
            array (
                'id' => 9,
                'vendor_id' => 21,
                'total_earning' => '427.60',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 12:03:38',
                'updated_at' => '2025-04-20 18:18:29',
            ),
            9 => 
            array (
                'id' => 10,
                'vendor_id' => 28,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 12:14:08',
                'updated_at' => '2022-03-22 12:14:08',
            ),
            10 => 
            array (
                'id' => 11,
                'vendor_id' => 29,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 13:15:51',
                'updated_at' => '2022-03-22 13:15:51',
            ),
            11 => 
            array (
                'id' => 12,
                'vendor_id' => 11,
                'total_earning' => '474.22',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 15:37:53',
                'updated_at' => '2024-01-02 16:59:09',
            ),
            12 => 
            array (
                'id' => 13,
                'vendor_id' => 14,
                'total_earning' => '187.87',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 17:31:46',
                'updated_at' => '2025-04-20 18:14:43',
            ),
            13 => 
            array (
                'id' => 14,
                'vendor_id' => 20,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 18:42:24',
                'updated_at' => '2022-03-22 18:42:24',
            ),
            14 => 
            array (
                'id' => 15,
                'vendor_id' => 12,
                'total_earning' => '203.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-22 18:59:34',
                'updated_at' => '2022-09-29 15:48:54',
            ),
            15 => 
            array (
                'id' => 16,
                'vendor_id' => 30,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 10:47:02',
                'updated_at' => '2022-03-23 10:47:02',
            ),
            16 => 
            array (
                'id' => 17,
                'vendor_id' => 44,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 11:59:22',
                'updated_at' => '2022-03-23 11:59:22',
            ),
            17 => 
            array (
                'id' => 18,
                'vendor_id' => 43,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 13:04:40',
                'updated_at' => '2022-03-23 13:04:40',
            ),
            18 => 
            array (
                'id' => 19,
                'vendor_id' => 42,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 13:06:52',
                'updated_at' => '2022-03-23 13:06:52',
            ),
            19 => 
            array (
                'id' => 20,
                'vendor_id' => 41,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 13:08:57',
                'updated_at' => '2022-03-23 13:08:57',
            ),
            20 => 
            array (
                'id' => 21,
                'vendor_id' => 40,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 13:12:44',
                'updated_at' => '2022-03-23 13:12:44',
            ),
            21 => 
            array (
                'id' => 22,
                'vendor_id' => 19,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 13:20:10',
                'updated_at' => '2022-03-23 13:20:10',
            ),
            22 => 
            array (
                'id' => 23,
                'vendor_id' => 17,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 13:25:04',
                'updated_at' => '2022-03-23 13:25:04',
            ),
            23 => 
            array (
                'id' => 24,
                'vendor_id' => 15,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 13:27:07',
                'updated_at' => '2022-03-23 13:27:07',
            ),
            24 => 
            array (
                'id' => 25,
                'vendor_id' => 34,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 15:36:21',
                'updated_at' => '2022-03-23 15:36:21',
            ),
            25 => 
            array (
                'id' => 26,
                'vendor_id' => 33,
                'total_earning' => '4200.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 15:38:08',
                'updated_at' => '2022-09-29 15:37:35',
            ),
            26 => 
            array (
                'id' => 27,
                'vendor_id' => 32,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 15:39:32',
                'updated_at' => '2022-03-23 15:39:32',
            ),
            27 => 
            array (
                'id' => 28,
                'vendor_id' => 31,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-03-23 15:41:52',
                'updated_at' => '2022-03-23 15:41:52',
            ),
            28 => 
            array (
                'id' => 29,
                'vendor_id' => 52,
                'total_earning' => '36.75',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-09-29 10:31:14',
                'updated_at' => '2022-09-29 10:31:14',
            ),
            29 => 
            array (
                'id' => 30,
                'vendor_id' => 46,
                'total_earning' => '1793.62',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '441.00',
                'created_at' => '2022-09-29 11:29:51',
                'updated_at' => '2025-09-08 05:59:29',
            ),
            30 => 
            array (
                'id' => 31,
                'vendor_id' => 9,
                'total_earning' => '240.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-09-29 13:03:14',
                'updated_at' => '2022-09-29 13:03:14',
            ),
            31 => 
            array (
                'id' => 32,
                'vendor_id' => 45,
                'total_earning' => '954.80',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-09-29 14:41:46',
                'updated_at' => '2023-01-17 17:40:09',
            ),
            32 => 
            array (
                'id' => 33,
                'vendor_id' => 26,
                'total_earning' => '55.76',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-09-29 14:53:53',
                'updated_at' => '2022-09-29 14:53:53',
            ),
            33 => 
            array (
                'id' => 34,
                'vendor_id' => 48,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-09-29 15:01:06',
                'updated_at' => '2022-09-29 15:01:06',
            ),
            34 => 
            array (
                'id' => 35,
                'vendor_id' => 37,
                'total_earning' => '3420.90',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2022-09-29 15:16:16',
                'updated_at' => '2022-09-29 15:52:45',
            ),
            35 => 
            array (
                'id' => 36,
                'vendor_id' => 6,
                'total_earning' => '177.27',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-01-18 11:36:52',
                'updated_at' => '2025-04-20 18:15:14',
            ),
            36 => 
            array (
                'id' => 37,
                'vendor_id' => 13,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-01-21 18:10:13',
                'updated_at' => '2023-01-21 18:10:13',
            ),
            37 => 
            array (
                'id' => 38,
                'vendor_id' => 10,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-01-21 18:10:15',
                'updated_at' => '2023-01-21 18:10:15',
            ),
            38 => 
            array (
                'id' => 39,
                'vendor_id' => 8,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-01-21 18:10:15',
                'updated_at' => '2023-01-21 18:10:15',
            ),
            39 => 
            array (
                'id' => 40,
                'vendor_id' => 24,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-08-20 06:40:56',
                'updated_at' => '2023-08-20 06:40:56',
            ),
            40 => 
            array (
                'id' => 41,
                'vendor_id' => 36,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-08-20 06:41:43',
                'updated_at' => '2023-08-20 06:41:43',
            ),
            41 => 
            array (
                'id' => 42,
                'vendor_id' => 35,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-08-20 06:41:53',
                'updated_at' => '2023-08-20 06:41:53',
            ),
            42 => 
            array (
                'id' => 43,
                'vendor_id' => 27,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-08-20 06:43:21',
                'updated_at' => '2023-08-20 06:43:21',
            ),
            43 => 
            array (
                'id' => 44,
                'vendor_id' => 56,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-10-19 11:34:03',
                'updated_at' => '2023-10-19 11:34:03',
            ),
            44 => 
            array (
                'id' => 45,
                'vendor_id' => 55,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-10-19 11:35:02',
                'updated_at' => '2023-10-19 11:35:02',
            ),
            45 => 
            array (
                'id' => 46,
                'vendor_id' => 39,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-10-19 12:51:10',
                'updated_at' => '2023-10-19 12:51:10',
            ),
            46 => 
            array (
                'id' => 47,
                'vendor_id' => 58,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-10-19 16:01:13',
                'updated_at' => '2023-10-19 16:01:13',
            ),
            47 => 
            array (
                'id' => 48,
                'vendor_id' => 57,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2023-10-19 16:01:14',
                'updated_at' => '2023-10-19 16:01:14',
            ),
            48 => 
            array (
                'id' => 49,
                'vendor_id' => 38,
                'total_earning' => '1445.46',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2024-01-02 17:29:59',
                'updated_at' => '2025-09-08 06:00:42',
            ),
            49 => 
            array (
                'id' => 50,
                'vendor_id' => 49,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2024-04-20 14:45:31',
                'updated_at' => '2024-04-20 14:45:31',
            ),
            50 => 
            array (
                'id' => 51,
                'vendor_id' => 54,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2024-04-20 14:49:23',
                'updated_at' => '2024-04-20 14:49:23',
            ),
            51 => 
            array (
                'id' => 52,
                'vendor_id' => 47,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2024-04-20 16:45:51',
                'updated_at' => '2024-04-20 16:45:51',
            ),
            52 => 
            array (
                'id' => 53,
                'vendor_id' => 50,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2024-04-20 16:47:19',
                'updated_at' => '2024-04-20 16:47:19',
            ),
            53 => 
            array (
                'id' => 54,
                'vendor_id' => 23,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2024-10-29 16:57:19',
                'updated_at' => '2024-10-29 16:57:19',
            ),
            54 => 
            array (
                'id' => 55,
                'vendor_id' => 25,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2024-10-29 17:05:06',
                'updated_at' => '2024-10-29 17:05:06',
            ),
            55 => 
            array (
                'id' => 56,
                'vendor_id' => 53,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2024-11-03 14:07:41',
                'updated_at' => '2024-11-03 14:07:41',
            ),
            56 => 
            array (
                'id' => 57,
                'vendor_id' => 51,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2024-11-03 14:08:39',
                'updated_at' => '2024-11-03 14:08:39',
            ),
            57 => 
            array (
                'id' => 58,
                'vendor_id' => 60,
                'total_earning' => '160.32',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2025-02-06 12:19:36',
                'updated_at' => '2025-02-06 17:23:07',
            ),
            58 => 
            array (
                'id' => 59,
                'vendor_id' => 67,
                'total_earning' => '225.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '235.00',
                'created_at' => '2025-02-06 14:35:53',
                'updated_at' => '2025-02-08 12:49:31',
            ),
            59 => 
            array (
                'id' => 60,
                'vendor_id' => 66,
                'total_earning' => '21349.66',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2025-02-06 14:35:56',
                'updated_at' => '2025-02-06 17:38:58',
            ),
            60 => 
            array (
                'id' => 61,
                'vendor_id' => 64,
                'total_earning' => '11887.49',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '4946.17',
                'created_at' => '2025-02-06 14:36:35',
                'updated_at' => '2025-02-06 17:54:39',
            ),
            61 => 
            array (
                'id' => 62,
                'vendor_id' => 65,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2025-02-08 11:22:59',
                'updated_at' => '2025-02-08 11:22:59',
            ),
            62 => 
            array (
                'id' => 63,
                'vendor_id' => 61,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2025-02-08 11:23:26',
                'updated_at' => '2025-02-08 11:23:26',
            ),
            63 => 
            array (
                'id' => 64,
                'vendor_id' => 62,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2025-02-08 11:23:35',
                'updated_at' => '2025-02-08 11:23:35',
            ),
            64 => 
            array (
                'id' => 65,
                'vendor_id' => 63,
                'total_earning' => '0.00',
                'total_withdrawn' => '0.00',
                'pending_withdraw' => '0.00',
                'collected_cash' => '0.00',
                'created_at' => '2025-02-08 11:23:44',
                'updated_at' => '2025-02-08 11:23:44',
            ),
        ));
        
        
    }
}