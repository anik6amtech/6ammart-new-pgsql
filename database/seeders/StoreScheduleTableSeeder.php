<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreScheduleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_schedule')->delete();
        
        \DB::table('store_schedule')->insert(array (
            0 => 
            array (
                'id' => 1,
                'store_id' => 3,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:19:28',
                'updated_at' => '2022-03-22 11:19:28',
            ),
            1 => 
            array (
                'id' => 2,
                'store_id' => 3,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:19:28',
                'updated_at' => '2022-03-22 11:19:28',
            ),
            2 => 
            array (
                'id' => 3,
                'store_id' => 3,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:19:28',
                'updated_at' => '2022-03-22 11:19:28',
            ),
            3 => 
            array (
                'id' => 4,
                'store_id' => 3,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:19:28',
                'updated_at' => '2022-03-22 11:19:28',
            ),
            4 => 
            array (
                'id' => 5,
                'store_id' => 3,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:19:28',
                'updated_at' => '2022-03-22 11:19:28',
            ),
            5 => 
            array (
                'id' => 6,
                'store_id' => 3,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:19:28',
                'updated_at' => '2022-03-22 11:19:28',
            ),
            6 => 
            array (
                'id' => 7,
                'store_id' => 3,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:19:28',
                'updated_at' => '2022-03-22 11:19:28',
            ),
            7 => 
            array (
                'id' => 8,
                'store_id' => 4,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:21:08',
                'updated_at' => '2022-03-22 11:21:08',
            ),
            8 => 
            array (
                'id' => 9,
                'store_id' => 4,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:21:08',
                'updated_at' => '2022-03-22 11:21:08',
            ),
            9 => 
            array (
                'id' => 10,
                'store_id' => 4,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:21:08',
                'updated_at' => '2022-03-22 11:21:08',
            ),
            10 => 
            array (
                'id' => 11,
                'store_id' => 4,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:21:08',
                'updated_at' => '2022-03-22 11:21:08',
            ),
            11 => 
            array (
                'id' => 12,
                'store_id' => 4,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:21:08',
                'updated_at' => '2022-03-22 11:21:08',
            ),
            12 => 
            array (
                'id' => 13,
                'store_id' => 4,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:21:08',
                'updated_at' => '2022-03-22 11:21:08',
            ),
            13 => 
            array (
                'id' => 14,
                'store_id' => 4,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:21:08',
                'updated_at' => '2022-03-22 11:21:08',
            ),
            14 => 
            array (
                'id' => 15,
                'store_id' => 5,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:23:03',
                'updated_at' => '2022-03-22 11:23:03',
            ),
            15 => 
            array (
                'id' => 16,
                'store_id' => 5,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:23:03',
                'updated_at' => '2022-03-22 11:23:03',
            ),
            16 => 
            array (
                'id' => 17,
                'store_id' => 5,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:23:03',
                'updated_at' => '2022-03-22 11:23:03',
            ),
            17 => 
            array (
                'id' => 18,
                'store_id' => 5,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:23:03',
                'updated_at' => '2022-03-22 11:23:03',
            ),
            18 => 
            array (
                'id' => 19,
                'store_id' => 5,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:23:03',
                'updated_at' => '2022-03-22 11:23:03',
            ),
            19 => 
            array (
                'id' => 20,
                'store_id' => 5,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:23:03',
                'updated_at' => '2022-03-22 11:23:03',
            ),
            20 => 
            array (
                'id' => 21,
                'store_id' => 5,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:23:03',
                'updated_at' => '2022-03-22 11:23:03',
            ),
            21 => 
            array (
                'id' => 22,
                'store_id' => 6,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:25:09',
                'updated_at' => '2022-03-22 11:25:09',
            ),
            22 => 
            array (
                'id' => 23,
                'store_id' => 6,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:25:09',
                'updated_at' => '2022-03-22 11:25:09',
            ),
            23 => 
            array (
                'id' => 24,
                'store_id' => 6,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:25:09',
                'updated_at' => '2022-03-22 11:25:09',
            ),
            24 => 
            array (
                'id' => 25,
                'store_id' => 6,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:25:09',
                'updated_at' => '2022-03-22 11:25:09',
            ),
            25 => 
            array (
                'id' => 26,
                'store_id' => 6,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:25:09',
                'updated_at' => '2022-03-22 11:25:09',
            ),
            26 => 
            array (
                'id' => 27,
                'store_id' => 6,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:25:09',
                'updated_at' => '2022-03-22 11:25:09',
            ),
            27 => 
            array (
                'id' => 28,
                'store_id' => 6,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:25:09',
                'updated_at' => '2022-03-22 11:25:09',
            ),
            28 => 
            array (
                'id' => 29,
                'store_id' => 7,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:28:20',
                'updated_at' => '2022-03-22 11:28:20',
            ),
            29 => 
            array (
                'id' => 30,
                'store_id' => 7,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:28:20',
                'updated_at' => '2022-03-22 11:28:20',
            ),
            30 => 
            array (
                'id' => 31,
                'store_id' => 7,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:28:20',
                'updated_at' => '2022-03-22 11:28:20',
            ),
            31 => 
            array (
                'id' => 32,
                'store_id' => 7,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:28:20',
                'updated_at' => '2022-03-22 11:28:20',
            ),
            32 => 
            array (
                'id' => 33,
                'store_id' => 7,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:28:20',
                'updated_at' => '2022-03-22 11:28:20',
            ),
            33 => 
            array (
                'id' => 34,
                'store_id' => 7,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:28:20',
                'updated_at' => '2022-03-22 11:28:20',
            ),
            34 => 
            array (
                'id' => 35,
                'store_id' => 7,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:28:20',
                'updated_at' => '2022-03-22 11:28:20',
            ),
            35 => 
            array (
                'id' => 36,
                'store_id' => 8,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:29:44',
                'updated_at' => '2022-03-22 11:29:44',
            ),
            36 => 
            array (
                'id' => 37,
                'store_id' => 8,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:29:44',
                'updated_at' => '2022-03-22 11:29:44',
            ),
            37 => 
            array (
                'id' => 38,
                'store_id' => 8,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:29:44',
                'updated_at' => '2022-03-22 11:29:44',
            ),
            38 => 
            array (
                'id' => 39,
                'store_id' => 8,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:29:44',
                'updated_at' => '2022-03-22 11:29:44',
            ),
            39 => 
            array (
                'id' => 40,
                'store_id' => 8,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:29:44',
                'updated_at' => '2022-03-22 11:29:44',
            ),
            40 => 
            array (
                'id' => 41,
                'store_id' => 8,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:29:44',
                'updated_at' => '2022-03-22 11:29:44',
            ),
            41 => 
            array (
                'id' => 42,
                'store_id' => 8,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:29:44',
                'updated_at' => '2022-03-22 11:29:44',
            ),
            42 => 
            array (
                'id' => 43,
                'store_id' => 9,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:14',
                'updated_at' => '2022-03-22 11:33:14',
            ),
            43 => 
            array (
                'id' => 44,
                'store_id' => 9,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:14',
                'updated_at' => '2022-03-22 11:33:14',
            ),
            44 => 
            array (
                'id' => 45,
                'store_id' => 9,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:14',
                'updated_at' => '2022-03-22 11:33:14',
            ),
            45 => 
            array (
                'id' => 46,
                'store_id' => 9,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:14',
                'updated_at' => '2022-03-22 11:33:14',
            ),
            46 => 
            array (
                'id' => 47,
                'store_id' => 9,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:14',
                'updated_at' => '2022-03-22 11:33:14',
            ),
            47 => 
            array (
                'id' => 48,
                'store_id' => 9,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:14',
                'updated_at' => '2022-03-22 11:33:14',
            ),
            48 => 
            array (
                'id' => 49,
                'store_id' => 9,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:14',
                'updated_at' => '2022-03-22 11:33:14',
            ),
            49 => 
            array (
                'id' => 50,
                'store_id' => 10,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:26',
                'updated_at' => '2022-03-22 11:33:26',
            ),
            50 => 
            array (
                'id' => 51,
                'store_id' => 10,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:26',
                'updated_at' => '2022-03-22 11:33:26',
            ),
            51 => 
            array (
                'id' => 52,
                'store_id' => 10,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:26',
                'updated_at' => '2022-03-22 11:33:26',
            ),
            52 => 
            array (
                'id' => 53,
                'store_id' => 10,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:26',
                'updated_at' => '2022-03-22 11:33:26',
            ),
            53 => 
            array (
                'id' => 54,
                'store_id' => 10,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:26',
                'updated_at' => '2022-03-22 11:33:26',
            ),
            54 => 
            array (
                'id' => 55,
                'store_id' => 10,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:26',
                'updated_at' => '2022-03-22 11:33:26',
            ),
            55 => 
            array (
                'id' => 56,
                'store_id' => 10,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:33:26',
                'updated_at' => '2022-03-22 11:33:26',
            ),
            56 => 
            array (
                'id' => 57,
                'store_id' => 11,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:36:10',
                'updated_at' => '2022-03-22 11:36:10',
            ),
            57 => 
            array (
                'id' => 58,
                'store_id' => 11,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:36:10',
                'updated_at' => '2022-03-22 11:36:10',
            ),
            58 => 
            array (
                'id' => 59,
                'store_id' => 11,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:36:10',
                'updated_at' => '2022-03-22 11:36:10',
            ),
            59 => 
            array (
                'id' => 60,
                'store_id' => 11,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:36:10',
                'updated_at' => '2022-03-22 11:36:10',
            ),
            60 => 
            array (
                'id' => 61,
                'store_id' => 11,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:36:10',
                'updated_at' => '2022-03-22 11:36:10',
            ),
            61 => 
            array (
                'id' => 62,
                'store_id' => 11,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:36:10',
                'updated_at' => '2022-03-22 11:36:10',
            ),
            62 => 
            array (
                'id' => 63,
                'store_id' => 11,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:36:10',
                'updated_at' => '2022-03-22 11:36:10',
            ),
            63 => 
            array (
                'id' => 64,
                'store_id' => 12,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:39:51',
                'updated_at' => '2022-03-22 11:39:51',
            ),
            64 => 
            array (
                'id' => 65,
                'store_id' => 12,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:39:51',
                'updated_at' => '2022-03-22 11:39:51',
            ),
            65 => 
            array (
                'id' => 66,
                'store_id' => 12,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:39:51',
                'updated_at' => '2022-03-22 11:39:51',
            ),
            66 => 
            array (
                'id' => 67,
                'store_id' => 12,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:39:51',
                'updated_at' => '2022-03-22 11:39:51',
            ),
            67 => 
            array (
                'id' => 68,
                'store_id' => 12,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:39:51',
                'updated_at' => '2022-03-22 11:39:51',
            ),
            68 => 
            array (
                'id' => 69,
                'store_id' => 12,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:39:51',
                'updated_at' => '2022-03-22 11:39:51',
            ),
            69 => 
            array (
                'id' => 70,
                'store_id' => 12,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:39:51',
                'updated_at' => '2022-03-22 11:39:51',
            ),
            70 => 
            array (
                'id' => 71,
                'store_id' => 13,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:33',
                'updated_at' => '2022-03-22 11:42:33',
            ),
            71 => 
            array (
                'id' => 72,
                'store_id' => 13,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:33',
                'updated_at' => '2022-03-22 11:42:33',
            ),
            72 => 
            array (
                'id' => 73,
                'store_id' => 13,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:33',
                'updated_at' => '2022-03-22 11:42:33',
            ),
            73 => 
            array (
                'id' => 74,
                'store_id' => 13,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:33',
                'updated_at' => '2022-03-22 11:42:33',
            ),
            74 => 
            array (
                'id' => 75,
                'store_id' => 13,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:33',
                'updated_at' => '2022-03-22 11:42:33',
            ),
            75 => 
            array (
                'id' => 76,
                'store_id' => 13,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:33',
                'updated_at' => '2022-03-22 11:42:33',
            ),
            76 => 
            array (
                'id' => 77,
                'store_id' => 13,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:33',
                'updated_at' => '2022-03-22 11:42:33',
            ),
            77 => 
            array (
                'id' => 78,
                'store_id' => 14,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:51',
                'updated_at' => '2022-03-22 11:42:51',
            ),
            78 => 
            array (
                'id' => 79,
                'store_id' => 14,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:51',
                'updated_at' => '2022-03-22 11:42:51',
            ),
            79 => 
            array (
                'id' => 80,
                'store_id' => 14,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:51',
                'updated_at' => '2022-03-22 11:42:51',
            ),
            80 => 
            array (
                'id' => 81,
                'store_id' => 14,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:51',
                'updated_at' => '2022-03-22 11:42:51',
            ),
            81 => 
            array (
                'id' => 82,
                'store_id' => 14,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:51',
                'updated_at' => '2022-03-22 11:42:51',
            ),
            82 => 
            array (
                'id' => 83,
                'store_id' => 14,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:51',
                'updated_at' => '2022-03-22 11:42:51',
            ),
            83 => 
            array (
                'id' => 84,
                'store_id' => 14,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 11:42:51',
                'updated_at' => '2022-03-22 11:42:51',
            ),
            84 => 
            array (
                'id' => 85,
                'store_id' => 21,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:20',
                'updated_at' => '2022-03-22 12:03:20',
            ),
            85 => 
            array (
                'id' => 86,
                'store_id' => 21,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:20',
                'updated_at' => '2022-03-22 12:03:20',
            ),
            86 => 
            array (
                'id' => 87,
                'store_id' => 21,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:20',
                'updated_at' => '2022-03-22 12:03:20',
            ),
            87 => 
            array (
                'id' => 88,
                'store_id' => 21,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:20',
                'updated_at' => '2022-03-22 12:03:20',
            ),
            88 => 
            array (
                'id' => 89,
                'store_id' => 21,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:20',
                'updated_at' => '2022-03-22 12:03:20',
            ),
            89 => 
            array (
                'id' => 90,
                'store_id' => 21,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:20',
                'updated_at' => '2022-03-22 12:03:20',
            ),
            90 => 
            array (
                'id' => 91,
                'store_id' => 21,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:20',
                'updated_at' => '2022-03-22 12:03:20',
            ),
            91 => 
            array (
                'id' => 92,
                'store_id' => 22,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:36',
                'updated_at' => '2022-03-22 12:03:36',
            ),
            92 => 
            array (
                'id' => 93,
                'store_id' => 22,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:36',
                'updated_at' => '2022-03-22 12:03:36',
            ),
            93 => 
            array (
                'id' => 94,
                'store_id' => 22,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:36',
                'updated_at' => '2022-03-22 12:03:36',
            ),
            94 => 
            array (
                'id' => 95,
                'store_id' => 22,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:36',
                'updated_at' => '2022-03-22 12:03:36',
            ),
            95 => 
            array (
                'id' => 96,
                'store_id' => 22,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:36',
                'updated_at' => '2022-03-22 12:03:36',
            ),
            96 => 
            array (
                'id' => 97,
                'store_id' => 22,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:36',
                'updated_at' => '2022-03-22 12:03:36',
            ),
            97 => 
            array (
                'id' => 98,
                'store_id' => 22,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:03:36',
                'updated_at' => '2022-03-22 12:03:36',
            ),
            98 => 
            array (
                'id' => 99,
                'store_id' => 23,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:32',
                'updated_at' => '2022-03-22 12:05:32',
            ),
            99 => 
            array (
                'id' => 100,
                'store_id' => 23,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:32',
                'updated_at' => '2022-03-22 12:05:32',
            ),
            100 => 
            array (
                'id' => 101,
                'store_id' => 23,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:32',
                'updated_at' => '2022-03-22 12:05:32',
            ),
            101 => 
            array (
                'id' => 102,
                'store_id' => 23,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:32',
                'updated_at' => '2022-03-22 12:05:32',
            ),
            102 => 
            array (
                'id' => 103,
                'store_id' => 23,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:32',
                'updated_at' => '2022-03-22 12:05:32',
            ),
            103 => 
            array (
                'id' => 104,
                'store_id' => 23,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:32',
                'updated_at' => '2022-03-22 12:05:32',
            ),
            104 => 
            array (
                'id' => 105,
                'store_id' => 23,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:32',
                'updated_at' => '2022-03-22 12:05:32',
            ),
            105 => 
            array (
                'id' => 106,
                'store_id' => 24,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:54',
                'updated_at' => '2022-03-22 12:05:54',
            ),
            106 => 
            array (
                'id' => 107,
                'store_id' => 24,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:54',
                'updated_at' => '2022-03-22 12:05:54',
            ),
            107 => 
            array (
                'id' => 108,
                'store_id' => 24,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:54',
                'updated_at' => '2022-03-22 12:05:54',
            ),
            108 => 
            array (
                'id' => 109,
                'store_id' => 24,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:54',
                'updated_at' => '2022-03-22 12:05:54',
            ),
            109 => 
            array (
                'id' => 110,
                'store_id' => 24,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:54',
                'updated_at' => '2022-03-22 12:05:54',
            ),
            110 => 
            array (
                'id' => 111,
                'store_id' => 24,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:54',
                'updated_at' => '2022-03-22 12:05:54',
            ),
            111 => 
            array (
                'id' => 112,
                'store_id' => 24,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:05:54',
                'updated_at' => '2022-03-22 12:05:54',
            ),
            112 => 
            array (
                'id' => 113,
                'store_id' => 25,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:19',
                'updated_at' => '2022-03-22 12:08:19',
            ),
            113 => 
            array (
                'id' => 114,
                'store_id' => 25,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:19',
                'updated_at' => '2022-03-22 12:08:19',
            ),
            114 => 
            array (
                'id' => 115,
                'store_id' => 25,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:19',
                'updated_at' => '2022-03-22 12:08:19',
            ),
            115 => 
            array (
                'id' => 116,
                'store_id' => 25,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:19',
                'updated_at' => '2022-03-22 12:08:19',
            ),
            116 => 
            array (
                'id' => 117,
                'store_id' => 25,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:19',
                'updated_at' => '2022-03-22 12:08:19',
            ),
            117 => 
            array (
                'id' => 118,
                'store_id' => 25,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:19',
                'updated_at' => '2022-03-22 12:08:19',
            ),
            118 => 
            array (
                'id' => 119,
                'store_id' => 25,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:19',
                'updated_at' => '2022-03-22 12:08:19',
            ),
            119 => 
            array (
                'id' => 120,
                'store_id' => 26,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:38',
                'updated_at' => '2022-03-22 12:08:38',
            ),
            120 => 
            array (
                'id' => 121,
                'store_id' => 26,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:38',
                'updated_at' => '2022-03-22 12:08:38',
            ),
            121 => 
            array (
                'id' => 122,
                'store_id' => 26,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:38',
                'updated_at' => '2022-03-22 12:08:38',
            ),
            122 => 
            array (
                'id' => 123,
                'store_id' => 26,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:38',
                'updated_at' => '2022-03-22 12:08:38',
            ),
            123 => 
            array (
                'id' => 124,
                'store_id' => 26,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:38',
                'updated_at' => '2022-03-22 12:08:38',
            ),
            124 => 
            array (
                'id' => 125,
                'store_id' => 26,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:38',
                'updated_at' => '2022-03-22 12:08:38',
            ),
            125 => 
            array (
                'id' => 126,
                'store_id' => 26,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:08:38',
                'updated_at' => '2022-03-22 12:08:38',
            ),
            126 => 
            array (
                'id' => 127,
                'store_id' => 27,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:03',
                'updated_at' => '2022-03-22 12:12:03',
            ),
            127 => 
            array (
                'id' => 128,
                'store_id' => 27,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:03',
                'updated_at' => '2022-03-22 12:12:03',
            ),
            128 => 
            array (
                'id' => 129,
                'store_id' => 27,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:03',
                'updated_at' => '2022-03-22 12:12:03',
            ),
            129 => 
            array (
                'id' => 130,
                'store_id' => 27,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:03',
                'updated_at' => '2022-03-22 12:12:03',
            ),
            130 => 
            array (
                'id' => 131,
                'store_id' => 27,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:03',
                'updated_at' => '2022-03-22 12:12:03',
            ),
            131 => 
            array (
                'id' => 132,
                'store_id' => 27,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:03',
                'updated_at' => '2022-03-22 12:12:03',
            ),
            132 => 
            array (
                'id' => 133,
                'store_id' => 27,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:03',
                'updated_at' => '2022-03-22 12:12:03',
            ),
            133 => 
            array (
                'id' => 134,
                'store_id' => 28,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:35',
                'updated_at' => '2022-03-22 12:12:35',
            ),
            134 => 
            array (
                'id' => 135,
                'store_id' => 28,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:35',
                'updated_at' => '2022-03-22 12:12:35',
            ),
            135 => 
            array (
                'id' => 136,
                'store_id' => 28,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:35',
                'updated_at' => '2022-03-22 12:12:35',
            ),
            136 => 
            array (
                'id' => 137,
                'store_id' => 28,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:35',
                'updated_at' => '2022-03-22 12:12:35',
            ),
            137 => 
            array (
                'id' => 138,
                'store_id' => 28,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:35',
                'updated_at' => '2022-03-22 12:12:35',
            ),
            138 => 
            array (
                'id' => 139,
                'store_id' => 28,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:35',
                'updated_at' => '2022-03-22 12:12:35',
            ),
            139 => 
            array (
                'id' => 140,
                'store_id' => 28,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:12:35',
                'updated_at' => '2022-03-22 12:12:35',
            ),
            140 => 
            array (
                'id' => 141,
                'store_id' => 29,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:15:07',
                'updated_at' => '2022-03-22 12:15:07',
            ),
            141 => 
            array (
                'id' => 142,
                'store_id' => 29,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:15:07',
                'updated_at' => '2022-03-22 12:15:07',
            ),
            142 => 
            array (
                'id' => 143,
                'store_id' => 29,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:15:07',
                'updated_at' => '2022-03-22 12:15:07',
            ),
            143 => 
            array (
                'id' => 144,
                'store_id' => 29,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:15:07',
                'updated_at' => '2022-03-22 12:15:07',
            ),
            144 => 
            array (
                'id' => 145,
                'store_id' => 29,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:15:07',
                'updated_at' => '2022-03-22 12:15:07',
            ),
            145 => 
            array (
                'id' => 146,
                'store_id' => 29,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:15:07',
                'updated_at' => '2022-03-22 12:15:07',
            ),
            146 => 
            array (
                'id' => 147,
                'store_id' => 29,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-22 12:15:07',
                'updated_at' => '2022-03-22 12:15:07',
            ),
            147 => 
            array (
                'id' => 148,
                'store_id' => 35,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:56:04',
                'updated_at' => '2022-03-23 10:56:04',
            ),
            148 => 
            array (
                'id' => 149,
                'store_id' => 35,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:56:04',
                'updated_at' => '2022-03-23 10:56:04',
            ),
            149 => 
            array (
                'id' => 150,
                'store_id' => 35,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:56:04',
                'updated_at' => '2022-03-23 10:56:04',
            ),
            150 => 
            array (
                'id' => 151,
                'store_id' => 35,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:56:04',
                'updated_at' => '2022-03-23 10:56:04',
            ),
            151 => 
            array (
                'id' => 152,
                'store_id' => 35,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:56:04',
                'updated_at' => '2022-03-23 10:56:04',
            ),
            152 => 
            array (
                'id' => 153,
                'store_id' => 35,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:56:04',
                'updated_at' => '2022-03-23 10:56:04',
            ),
            153 => 
            array (
                'id' => 154,
                'store_id' => 35,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:56:04',
                'updated_at' => '2022-03-23 10:56:04',
            ),
            154 => 
            array (
                'id' => 155,
                'store_id' => 36,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:59:17',
                'updated_at' => '2022-03-23 10:59:17',
            ),
            155 => 
            array (
                'id' => 156,
                'store_id' => 36,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:59:17',
                'updated_at' => '2022-03-23 10:59:17',
            ),
            156 => 
            array (
                'id' => 157,
                'store_id' => 36,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:59:17',
                'updated_at' => '2022-03-23 10:59:17',
            ),
            157 => 
            array (
                'id' => 158,
                'store_id' => 36,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:59:17',
                'updated_at' => '2022-03-23 10:59:17',
            ),
            158 => 
            array (
                'id' => 159,
                'store_id' => 36,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:59:17',
                'updated_at' => '2022-03-23 10:59:17',
            ),
            159 => 
            array (
                'id' => 160,
                'store_id' => 36,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:59:17',
                'updated_at' => '2022-03-23 10:59:17',
            ),
            160 => 
            array (
                'id' => 161,
                'store_id' => 36,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 10:59:17',
                'updated_at' => '2022-03-23 10:59:17',
            ),
            161 => 
            array (
                'id' => 162,
                'store_id' => 37,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:06:47',
                'updated_at' => '2022-03-23 11:06:47',
            ),
            162 => 
            array (
                'id' => 163,
                'store_id' => 37,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:06:47',
                'updated_at' => '2022-03-23 11:06:47',
            ),
            163 => 
            array (
                'id' => 164,
                'store_id' => 37,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:06:47',
                'updated_at' => '2022-03-23 11:06:47',
            ),
            164 => 
            array (
                'id' => 165,
                'store_id' => 37,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:06:47',
                'updated_at' => '2022-03-23 11:06:47',
            ),
            165 => 
            array (
                'id' => 166,
                'store_id' => 37,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:06:47',
                'updated_at' => '2022-03-23 11:06:47',
            ),
            166 => 
            array (
                'id' => 167,
                'store_id' => 37,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:06:47',
                'updated_at' => '2022-03-23 11:06:47',
            ),
            167 => 
            array (
                'id' => 168,
                'store_id' => 37,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:06:47',
                'updated_at' => '2022-03-23 11:06:47',
            ),
            168 => 
            array (
                'id' => 169,
                'store_id' => 38,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:10:13',
                'updated_at' => '2022-03-23 11:10:13',
            ),
            169 => 
            array (
                'id' => 170,
                'store_id' => 38,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:10:13',
                'updated_at' => '2022-03-23 11:10:13',
            ),
            170 => 
            array (
                'id' => 171,
                'store_id' => 38,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:10:13',
                'updated_at' => '2022-03-23 11:10:13',
            ),
            171 => 
            array (
                'id' => 172,
                'store_id' => 38,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:10:13',
                'updated_at' => '2022-03-23 11:10:13',
            ),
            172 => 
            array (
                'id' => 173,
                'store_id' => 38,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:10:13',
                'updated_at' => '2022-03-23 11:10:13',
            ),
            173 => 
            array (
                'id' => 174,
                'store_id' => 38,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:10:13',
                'updated_at' => '2022-03-23 11:10:13',
            ),
            174 => 
            array (
                'id' => 175,
                'store_id' => 38,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:10:13',
                'updated_at' => '2022-03-23 11:10:13',
            ),
            175 => 
            array (
                'id' => 176,
                'store_id' => 39,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:12:27',
                'updated_at' => '2022-03-23 11:12:27',
            ),
            176 => 
            array (
                'id' => 177,
                'store_id' => 39,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:12:27',
                'updated_at' => '2022-03-23 11:12:27',
            ),
            177 => 
            array (
                'id' => 178,
                'store_id' => 39,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:12:27',
                'updated_at' => '2022-03-23 11:12:27',
            ),
            178 => 
            array (
                'id' => 179,
                'store_id' => 39,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:12:27',
                'updated_at' => '2022-03-23 11:12:27',
            ),
            179 => 
            array (
                'id' => 180,
                'store_id' => 39,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:12:27',
                'updated_at' => '2022-03-23 11:12:27',
            ),
            180 => 
            array (
                'id' => 181,
                'store_id' => 39,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:12:27',
                'updated_at' => '2022-03-23 11:12:27',
            ),
            181 => 
            array (
                'id' => 182,
                'store_id' => 39,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 11:12:27',
                'updated_at' => '2022-03-23 11:12:27',
            ),
            182 => 
            array (
                'id' => 183,
                'store_id' => 44,
                'day' => 6,
                'opening_time' => '08:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 12:55:15',
                'updated_at' => '2022-03-23 12:55:15',
            ),
            183 => 
            array (
                'id' => 184,
                'store_id' => 44,
                'day' => 0,
                'opening_time' => '08:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 12:55:29',
                'updated_at' => '2022-03-23 12:55:29',
            ),
            184 => 
            array (
                'id' => 185,
                'store_id' => 44,
                'day' => 5,
                'opening_time' => '10:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 12:59:33',
                'updated_at' => '2022-03-23 12:59:33',
            ),
            185 => 
            array (
                'id' => 186,
                'store_id' => 44,
                'day' => 1,
                'opening_time' => '09:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 12:59:58',
                'updated_at' => '2022-03-23 12:59:58',
            ),
            186 => 
            array (
                'id' => 187,
                'store_id' => 44,
                'day' => 2,
                'opening_time' => '09:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:02:24',
                'updated_at' => '2022-03-23 13:02:24',
            ),
            187 => 
            array (
                'id' => 188,
                'store_id' => 44,
                'day' => 3,
                'opening_time' => '08:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:03:06',
                'updated_at' => '2022-03-23 13:03:06',
            ),
            188 => 
            array (
                'id' => 189,
                'store_id' => 44,
                'day' => 4,
                'opening_time' => '10:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:03:41',
                'updated_at' => '2022-03-23 13:03:41',
            ),
            189 => 
            array (
                'id' => 190,
                'store_id' => 43,
                'day' => 1,
                'opening_time' => '07:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:05:27',
                'updated_at' => '2022-03-23 13:05:27',
            ),
            190 => 
            array (
                'id' => 191,
                'store_id' => 43,
                'day' => 2,
                'opening_time' => '07:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:05:34',
                'updated_at' => '2022-03-23 13:05:34',
            ),
            191 => 
            array (
                'id' => 192,
                'store_id' => 43,
                'day' => 3,
                'opening_time' => '08:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:05:39',
                'updated_at' => '2022-03-23 13:05:39',
            ),
            192 => 
            array (
                'id' => 193,
                'store_id' => 43,
                'day' => 4,
                'opening_time' => '08:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:05:44',
                'updated_at' => '2022-03-23 13:05:44',
            ),
            193 => 
            array (
                'id' => 194,
                'store_id' => 43,
                'day' => 5,
                'opening_time' => '11:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:05:50',
                'updated_at' => '2022-03-23 13:05:50',
            ),
            194 => 
            array (
                'id' => 195,
                'store_id' => 43,
                'day' => 6,
                'opening_time' => '08:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:06:05',
                'updated_at' => '2022-03-23 13:06:05',
            ),
            195 => 
            array (
                'id' => 196,
                'store_id' => 43,
                'day' => 0,
                'opening_time' => '09:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:06:15',
                'updated_at' => '2022-03-23 13:06:15',
            ),
            196 => 
            array (
                'id' => 197,
                'store_id' => 42,
                'day' => 1,
                'opening_time' => '08:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:07:17',
                'updated_at' => '2022-03-23 13:07:17',
            ),
            197 => 
            array (
                'id' => 198,
                'store_id' => 42,
                'day' => 2,
                'opening_time' => '08:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:07:29',
                'updated_at' => '2022-03-23 13:07:29',
            ),
            198 => 
            array (
                'id' => 199,
                'store_id' => 42,
                'day' => 3,
                'opening_time' => '08:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:07:33',
                'updated_at' => '2022-03-23 13:07:33',
            ),
            199 => 
            array (
                'id' => 200,
                'store_id' => 42,
                'day' => 4,
                'opening_time' => '08:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:07:37',
                'updated_at' => '2022-03-23 13:07:37',
            ),
            200 => 
            array (
                'id' => 201,
                'store_id' => 42,
                'day' => 5,
                'opening_time' => '10:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:07:50',
                'updated_at' => '2022-03-23 13:07:50',
            ),
            201 => 
            array (
                'id' => 202,
                'store_id' => 42,
                'day' => 6,
                'opening_time' => '08:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:08:01',
                'updated_at' => '2022-03-23 13:08:01',
            ),
            202 => 
            array (
                'id' => 203,
                'store_id' => 42,
                'day' => 0,
                'opening_time' => '08:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:08:08',
                'updated_at' => '2022-03-23 13:08:08',
            ),
            203 => 
            array (
                'id' => 204,
                'store_id' => 41,
                'day' => 5,
                'opening_time' => '11:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2022-03-23 13:09:37',
                'updated_at' => '2022-03-23 13:09:37',
            ),
            204 => 
            array (
                'id' => 205,
                'store_id' => 41,
                'day' => 0,
                'opening_time' => '09:00:00',
                'closing_time' => '17:59:59',
                'created_at' => '2022-03-23 13:10:11',
                'updated_at' => '2022-03-23 13:10:11',
            ),
            205 => 
            array (
                'id' => 206,
                'store_id' => 41,
                'day' => 4,
                'opening_time' => '09:00:00',
                'closing_time' => '17:59:59',
                'created_at' => '2022-03-23 13:10:16',
                'updated_at' => '2022-03-23 13:10:16',
            ),
            206 => 
            array (
                'id' => 207,
                'store_id' => 41,
                'day' => 3,
                'opening_time' => '09:00:00',
                'closing_time' => '15:59:59',
                'created_at' => '2022-03-23 13:10:25',
                'updated_at' => '2022-03-23 13:10:25',
            ),
            207 => 
            array (
                'id' => 208,
                'store_id' => 41,
                'day' => 2,
                'opening_time' => '08:00:00',
                'closing_time' => '21:59:59',
                'created_at' => '2022-03-23 13:10:39',
                'updated_at' => '2022-03-23 13:10:39',
            ),
            208 => 
            array (
                'id' => 209,
                'store_id' => 41,
                'day' => 1,
                'opening_time' => '08:00:00',
                'closing_time' => '21:59:59',
                'created_at' => '2022-03-23 13:10:45',
                'updated_at' => '2022-03-23 13:10:45',
            ),
            209 => 
            array (
                'id' => 210,
                'store_id' => 40,
                'day' => 0,
                'opening_time' => '10:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:13:07',
                'updated_at' => '2022-03-23 13:13:07',
            ),
            210 => 
            array (
                'id' => 211,
                'store_id' => 40,
                'day' => 1,
                'opening_time' => '10:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:13:13',
                'updated_at' => '2022-03-23 13:13:13',
            ),
            211 => 
            array (
                'id' => 212,
                'store_id' => 40,
                'day' => 2,
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:13:19',
                'updated_at' => '2022-03-23 13:13:19',
            ),
            212 => 
            array (
                'id' => 213,
                'store_id' => 40,
                'day' => 3,
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:13:23',
                'updated_at' => '2022-03-23 13:13:23',
            ),
            213 => 
            array (
                'id' => 214,
                'store_id' => 40,
                'day' => 4,
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:13:27',
                'updated_at' => '2022-03-23 13:13:27',
            ),
            214 => 
            array (
                'id' => 215,
                'store_id' => 40,
                'day' => 6,
                'opening_time' => '11:00:00',
                'closing_time' => '19:00:59',
                'created_at' => '2022-03-23 13:13:38',
                'updated_at' => '2022-03-23 13:13:38',
            ),
            215 => 
            array (
                'id' => 216,
                'store_id' => 20,
                'day' => 0,
                'opening_time' => '10:00:00',
                'closing_time' => '20:00:59',
                'created_at' => '2022-03-23 13:17:10',
                'updated_at' => '2022-03-23 13:17:10',
            ),
            216 => 
            array (
                'id' => 217,
                'store_id' => 20,
                'day' => 2,
                'opening_time' => '10:00:00',
                'closing_time' => '20:00:59',
                'created_at' => '2022-03-23 13:17:14',
                'updated_at' => '2022-03-23 13:17:14',
            ),
            217 => 
            array (
                'id' => 218,
                'store_id' => 20,
                'day' => 3,
                'opening_time' => '10:00:00',
                'closing_time' => '20:00:59',
                'created_at' => '2022-03-23 13:17:18',
                'updated_at' => '2022-03-23 13:17:18',
            ),
            218 => 
            array (
                'id' => 219,
                'store_id' => 20,
                'day' => 4,
                'opening_time' => '10:00:00',
                'closing_time' => '20:00:59',
                'created_at' => '2022-03-23 13:17:21',
                'updated_at' => '2022-03-23 13:17:21',
            ),
            219 => 
            array (
                'id' => 220,
                'store_id' => 20,
                'day' => 5,
                'opening_time' => '11:00:00',
                'closing_time' => '20:00:59',
                'created_at' => '2022-03-23 13:17:27',
                'updated_at' => '2022-03-23 13:17:27',
            ),
            220 => 
            array (
                'id' => 221,
                'store_id' => 19,
                'day' => 1,
                'opening_time' => '07:00:00',
                'closing_time' => '21:00:59',
                'created_at' => '2022-03-23 13:20:57',
                'updated_at' => '2022-03-23 13:20:57',
            ),
            221 => 
            array (
                'id' => 222,
                'store_id' => 19,
                'day' => 2,
                'opening_time' => '07:00:00',
                'closing_time' => '21:00:59',
                'created_at' => '2022-03-23 13:21:04',
                'updated_at' => '2022-03-23 13:21:04',
            ),
            222 => 
            array (
                'id' => 223,
                'store_id' => 19,
                'day' => 3,
                'opening_time' => '07:00:00',
                'closing_time' => '21:00:59',
                'created_at' => '2022-03-23 13:21:14',
                'updated_at' => '2022-03-23 13:21:14',
            ),
            223 => 
            array (
                'id' => 224,
                'store_id' => 19,
                'day' => 4,
                'opening_time' => '07:00:00',
                'closing_time' => '21:00:59',
                'created_at' => '2022-03-23 13:21:19',
                'updated_at' => '2022-03-23 13:21:19',
            ),
            224 => 
            array (
                'id' => 225,
                'store_id' => 19,
                'day' => 6,
                'opening_time' => '08:00:00',
                'closing_time' => '21:00:59',
                'created_at' => '2022-03-23 13:21:36',
                'updated_at' => '2022-03-23 13:21:36',
            ),
            225 => 
            array (
                'id' => 226,
                'store_id' => 19,
                'day' => 0,
                'opening_time' => '08:00:00',
                'closing_time' => '21:00:59',
                'created_at' => '2022-03-23 13:21:43',
                'updated_at' => '2022-03-23 13:21:43',
            ),
            226 => 
            array (
                'id' => 227,
                'store_id' => 17,
                'day' => 1,
                'opening_time' => '10:00:00',
                'closing_time' => '19:00:59',
                'created_at' => '2022-03-23 13:26:03',
                'updated_at' => '2022-03-23 13:26:03',
            ),
            227 => 
            array (
                'id' => 228,
                'store_id' => 17,
                'day' => 2,
                'opening_time' => '10:00:00',
                'closing_time' => '19:00:59',
                'created_at' => '2022-03-23 13:26:05',
                'updated_at' => '2022-03-23 13:26:05',
            ),
            228 => 
            array (
                'id' => 229,
                'store_id' => 17,
                'day' => 3,
                'opening_time' => '10:00:00',
                'closing_time' => '19:00:59',
                'created_at' => '2022-03-23 13:26:07',
                'updated_at' => '2022-03-23 13:26:07',
            ),
            229 => 
            array (
                'id' => 230,
                'store_id' => 17,
                'day' => 4,
                'opening_time' => '10:00:00',
                'closing_time' => '19:00:59',
                'created_at' => '2022-03-23 13:26:12',
                'updated_at' => '2022-03-23 13:26:12',
            ),
            230 => 
            array (
                'id' => 231,
                'store_id' => 17,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '19:00:59',
                'created_at' => '2022-03-23 13:26:18',
                'updated_at' => '2022-03-23 13:26:18',
            ),
            231 => 
            array (
                'id' => 232,
                'store_id' => 17,
                'day' => 6,
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:26:32',
                'updated_at' => '2022-03-23 13:26:32',
            ),
            232 => 
            array (
                'id' => 233,
                'store_id' => 17,
                'day' => 0,
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:26:35',
                'updated_at' => '2022-03-23 13:26:35',
            ),
            233 => 
            array (
                'id' => 234,
                'store_id' => 15,
                'day' => 1,
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:27:48',
                'updated_at' => '2022-03-23 13:27:48',
            ),
            234 => 
            array (
                'id' => 235,
                'store_id' => 15,
                'day' => 2,
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:27:52',
                'updated_at' => '2022-03-23 13:27:52',
            ),
            235 => 
            array (
                'id' => 236,
                'store_id' => 15,
                'day' => 3,
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:27:55',
                'updated_at' => '2022-03-23 13:27:55',
            ),
            236 => 
            array (
                'id' => 237,
                'store_id' => 15,
                'day' => 4,
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:28:01',
                'updated_at' => '2022-03-23 13:28:01',
            ),
            237 => 
            array (
                'id' => 238,
                'store_id' => 15,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:28:11',
                'updated_at' => '2022-03-23 13:28:11',
            ),
            238 => 
            array (
                'id' => 239,
                'store_id' => 15,
                'day' => 6,
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:28:19',
                'updated_at' => '2022-03-23 13:28:19',
            ),
            239 => 
            array (
                'id' => 240,
                'store_id' => 15,
                'day' => 0,
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:59',
                'created_at' => '2022-03-23 13:28:24',
                'updated_at' => '2022-03-23 13:28:24',
            ),
            240 => 
            array (
                'id' => 241,
                'store_id' => 34,
                'day' => 1,
                'opening_time' => '08:00:00',
                'closing_time' => '17:00:59',
                'created_at' => '2022-03-23 15:36:51',
                'updated_at' => '2022-03-23 15:36:51',
            ),
            241 => 
            array (
                'id' => 242,
                'store_id' => 34,
                'day' => 2,
                'opening_time' => '08:00:00',
                'closing_time' => '17:00:59',
                'created_at' => '2022-03-23 15:36:55',
                'updated_at' => '2022-03-23 15:36:55',
            ),
            242 => 
            array (
                'id' => 243,
                'store_id' => 34,
                'day' => 3,
                'opening_time' => '08:00:00',
                'closing_time' => '17:00:59',
                'created_at' => '2022-03-23 15:36:57',
                'updated_at' => '2022-03-23 15:36:57',
            ),
            243 => 
            array (
                'id' => 244,
                'store_id' => 34,
                'day' => 4,
                'opening_time' => '08:00:00',
                'closing_time' => '17:00:59',
                'created_at' => '2022-03-23 15:37:03',
                'updated_at' => '2022-03-23 15:37:03',
            ),
            244 => 
            array (
                'id' => 245,
                'store_id' => 34,
                'day' => 6,
                'opening_time' => '08:00:00',
                'closing_time' => '17:00:59',
                'created_at' => '2022-03-23 15:37:09',
                'updated_at' => '2022-03-23 15:37:09',
            ),
            245 => 
            array (
                'id' => 246,
                'store_id' => 34,
                'day' => 0,
                'opening_time' => '08:00:00',
                'closing_time' => '17:00:59',
                'created_at' => '2022-03-23 15:37:14',
                'updated_at' => '2022-03-23 15:37:14',
            ),
            246 => 
            array (
                'id' => 247,
                'store_id' => 33,
                'day' => 1,
                'opening_time' => '09:00:00',
                'closing_time' => '17:00:59',
                'created_at' => '2022-03-23 15:38:39',
                'updated_at' => '2022-03-23 15:38:39',
            ),
            247 => 
            array (
                'id' => 248,
                'store_id' => 33,
                'day' => 2,
                'opening_time' => '09:00:00',
                'closing_time' => '17:00:59',
                'created_at' => '2022-03-23 15:38:42',
                'updated_at' => '2022-03-23 15:38:42',
            ),
            248 => 
            array (
                'id' => 249,
                'store_id' => 33,
                'day' => 3,
                'opening_time' => '09:00:00',
                'closing_time' => '17:00:59',
                'created_at' => '2022-03-23 15:38:45',
                'updated_at' => '2022-03-23 15:38:45',
            ),
            249 => 
            array (
                'id' => 251,
                'store_id' => 33,
                'day' => 6,
                'opening_time' => '09:00:00',
                'closing_time' => '17:00:59',
                'created_at' => '2022-03-23 15:38:50',
                'updated_at' => '2022-03-23 15:38:50',
            ),
            250 => 
            array (
                'id' => 252,
                'store_id' => 33,
                'day' => 0,
                'opening_time' => '09:00:00',
                'closing_time' => '17:00:59',
                'created_at' => '2022-03-23 15:38:55',
                'updated_at' => '2022-03-23 15:38:55',
            ),
            251 => 
            array (
                'id' => 259,
                'store_id' => 31,
                'day' => 1,
                'opening_time' => '07:00:00',
                'closing_time' => '20:00:59',
                'created_at' => '2022-03-23 15:42:25',
                'updated_at' => '2022-03-23 15:42:25',
            ),
            252 => 
            array (
                'id' => 260,
                'store_id' => 31,
                'day' => 2,
                'opening_time' => '07:00:00',
                'closing_time' => '20:00:59',
                'created_at' => '2022-03-23 15:42:39',
                'updated_at' => '2022-03-23 15:42:39',
            ),
            253 => 
            array (
                'id' => 261,
                'store_id' => 31,
                'day' => 3,
                'opening_time' => '07:00:00',
                'closing_time' => '20:00:59',
                'created_at' => '2022-03-23 15:42:42',
                'updated_at' => '2022-03-23 15:42:42',
            ),
            254 => 
            array (
                'id' => 262,
                'store_id' => 31,
                'day' => 4,
                'opening_time' => '07:00:00',
                'closing_time' => '20:00:59',
                'created_at' => '2022-03-23 15:42:47',
                'updated_at' => '2022-03-23 15:42:47',
            ),
            255 => 
            array (
                'id' => 263,
                'store_id' => 31,
                'day' => 6,
                'opening_time' => '07:00:00',
                'closing_time' => '20:00:59',
                'created_at' => '2022-03-23 15:42:55',
                'updated_at' => '2022-03-23 15:42:55',
            ),
            256 => 
            array (
                'id' => 264,
                'store_id' => 31,
                'day' => 0,
                'opening_time' => '07:00:00',
                'closing_time' => '20:00:59',
                'created_at' => '2022-03-23 15:42:58',
                'updated_at' => '2022-03-23 15:42:58',
            ),
            257 => 
            array (
                'id' => 271,
                'store_id' => 18,
                'day' => 1,
                'opening_time' => '09:00:00',
                'closing_time' => '18:00:59',
                'created_at' => '2022-03-23 15:46:11',
                'updated_at' => '2022-03-23 15:46:11',
            ),
            258 => 
            array (
                'id' => 272,
                'store_id' => 18,
                'day' => 2,
                'opening_time' => '09:00:00',
                'closing_time' => '18:00:59',
                'created_at' => '2022-03-23 15:46:14',
                'updated_at' => '2022-03-23 15:46:14',
            ),
            259 => 
            array (
                'id' => 273,
                'store_id' => 18,
                'day' => 3,
                'opening_time' => '09:00:00',
                'closing_time' => '18:00:59',
                'created_at' => '2022-03-23 15:46:16',
                'updated_at' => '2022-03-23 15:46:16',
            ),
            260 => 
            array (
                'id' => 275,
                'store_id' => 18,
                'day' => 6,
                'opening_time' => '09:00:00',
                'closing_time' => '18:00:59',
                'created_at' => '2022-03-23 15:46:25',
                'updated_at' => '2022-03-23 15:46:25',
            ),
            261 => 
            array (
                'id' => 276,
                'store_id' => 18,
                'day' => 0,
                'opening_time' => '09:00:00',
                'closing_time' => '18:00:59',
                'created_at' => '2022-03-23 15:46:29',
                'updated_at' => '2022-03-23 15:46:29',
            ),
            262 => 
            array (
                'id' => 283,
                'store_id' => 58,
                'day' => 1,
                'opening_time' => '09:43:00',
                'closing_time' => '21:42:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            263 => 
            array (
                'id' => 284,
                'store_id' => 58,
                'day' => 2,
                'opening_time' => '09:43:00',
                'closing_time' => '15:42:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            264 => 
            array (
                'id' => 286,
                'store_id' => 58,
                'day' => 3,
                'opening_time' => '09:43:00',
                'closing_time' => '23:42:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            265 => 
            array (
                'id' => 287,
                'store_id' => 58,
                'day' => 4,
                'opening_time' => '09:43:00',
                'closing_time' => '23:42:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            266 => 
            array (
                'id' => 288,
                'store_id' => 58,
                'day' => 5,
                'opening_time' => '09:43:00',
                'closing_time' => '23:42:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            267 => 
            array (
                'id' => 289,
                'store_id' => 58,
                'day' => 6,
                'opening_time' => '09:43:00',
                'closing_time' => '23:42:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            268 => 
            array (
                'id' => 291,
                'store_id' => 57,
                'day' => 1,
                'opening_time' => '09:00:00',
                'closing_time' => '23:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            269 => 
            array (
                'id' => 292,
                'store_id' => 57,
                'day' => 2,
                'opening_time' => '09:00:00',
                'closing_time' => '23:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            270 => 
            array (
                'id' => 293,
                'store_id' => 57,
                'day' => 3,
                'opening_time' => '09:00:00',
                'closing_time' => '23:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            271 => 
            array (
                'id' => 294,
                'store_id' => 57,
                'day' => 4,
                'opening_time' => '09:00:00',
                'closing_time' => '23:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            272 => 
            array (
                'id' => 295,
                'store_id' => 57,
                'day' => 5,
                'opening_time' => '09:00:00',
                'closing_time' => '23:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            273 => 
            array (
                'id' => 296,
                'store_id' => 57,
                'day' => 6,
                'opening_time' => '09:00:00',
                'closing_time' => '23:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            274 => 
            array (
                'id' => 297,
                'store_id' => 57,
                'day' => 0,
                'opening_time' => '09:00:00',
                'closing_time' => '23:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            275 => 
            array (
                'id' => 298,
                'store_id' => 56,
                'day' => 1,
                'opening_time' => '00:01:00',
                'closing_time' => '23:58:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            276 => 
            array (
                'id' => 299,
                'store_id' => 56,
                'day' => 2,
                'opening_time' => '00:01:00',
                'closing_time' => '23:58:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            277 => 
            array (
                'id' => 300,
                'store_id' => 56,
                'day' => 3,
                'opening_time' => '00:01:00',
                'closing_time' => '23:58:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            278 => 
            array (
                'id' => 301,
                'store_id' => 56,
                'day' => 4,
                'opening_time' => '00:01:00',
                'closing_time' => '23:58:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            279 => 
            array (
                'id' => 302,
                'store_id' => 56,
                'day' => 5,
                'opening_time' => '00:01:00',
                'closing_time' => '23:58:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            280 => 
            array (
                'id' => 303,
                'store_id' => 56,
                'day' => 6,
                'opening_time' => '00:01:00',
                'closing_time' => '23:58:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            281 => 
            array (
                'id' => 304,
                'store_id' => 56,
                'day' => 0,
                'opening_time' => '00:01:00',
                'closing_time' => '23:58:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            282 => 
            array (
                'id' => 305,
                'store_id' => 55,
                'day' => 1,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            283 => 
            array (
                'id' => 306,
                'store_id' => 55,
                'day' => 2,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            284 => 
            array (
                'id' => 307,
                'store_id' => 55,
                'day' => 3,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            285 => 
            array (
                'id' => 308,
                'store_id' => 55,
                'day' => 4,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            286 => 
            array (
                'id' => 309,
                'store_id' => 55,
                'day' => 5,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            287 => 
            array (
                'id' => 310,
                'store_id' => 55,
                'day' => 6,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            288 => 
            array (
                'id' => 311,
                'store_id' => 55,
                'day' => 0,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            289 => 
            array (
                'id' => 312,
                'store_id' => 54,
                'day' => 1,
                'opening_time' => '10:00:00',
                'closing_time' => '16:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            290 => 
            array (
                'id' => 313,
                'store_id' => 54,
                'day' => 2,
                'opening_time' => '18:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            291 => 
            array (
                'id' => 314,
                'store_id' => 54,
                'day' => 1,
                'opening_time' => '18:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            292 => 
            array (
                'id' => 315,
                'store_id' => 54,
                'day' => 2,
                'opening_time' => '06:00:00',
                'closing_time' => '17:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            293 => 
            array (
                'id' => 316,
                'store_id' => 54,
                'day' => 3,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            294 => 
            array (
                'id' => 317,
                'store_id' => 54,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            295 => 
            array (
                'id' => 318,
                'store_id' => 54,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            296 => 
            array (
                'id' => 319,
                'store_id' => 54,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            297 => 
            array (
                'id' => 320,
                'store_id' => 54,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            298 => 
            array (
                'id' => 321,
                'store_id' => 53,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            299 => 
            array (
                'id' => 322,
                'store_id' => 53,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            300 => 
            array (
                'id' => 323,
                'store_id' => 53,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            301 => 
            array (
                'id' => 324,
                'store_id' => 53,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            302 => 
            array (
                'id' => 325,
                'store_id' => 53,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            303 => 
            array (
                'id' => 326,
                'store_id' => 53,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            304 => 
            array (
                'id' => 327,
                'store_id' => 53,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            305 => 
            array (
                'id' => 328,
                'store_id' => 52,
                'day' => 1,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            306 => 
            array (
                'id' => 329,
                'store_id' => 52,
                'day' => 2,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            307 => 
            array (
                'id' => 330,
                'store_id' => 52,
                'day' => 3,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            308 => 
            array (
                'id' => 331,
                'store_id' => 52,
                'day' => 4,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            309 => 
            array (
                'id' => 332,
                'store_id' => 52,
                'day' => 5,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            310 => 
            array (
                'id' => 333,
                'store_id' => 52,
                'day' => 6,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            311 => 
            array (
                'id' => 334,
                'store_id' => 52,
                'day' => 0,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            312 => 
            array (
                'id' => 335,
                'store_id' => 51,
                'day' => 1,
                'opening_time' => '00:01:00',
                'closing_time' => '23:19:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            313 => 
            array (
                'id' => 336,
                'store_id' => 51,
                'day' => 2,
                'opening_time' => '00:01:00',
                'closing_time' => '23:19:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            314 => 
            array (
                'id' => 337,
                'store_id' => 51,
                'day' => 3,
                'opening_time' => '00:01:00',
                'closing_time' => '23:19:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            315 => 
            array (
                'id' => 338,
                'store_id' => 51,
                'day' => 4,
                'opening_time' => '00:01:00',
                'closing_time' => '23:19:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            316 => 
            array (
                'id' => 339,
                'store_id' => 51,
                'day' => 5,
                'opening_time' => '00:01:00',
                'closing_time' => '23:19:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            317 => 
            array (
                'id' => 340,
                'store_id' => 51,
                'day' => 6,
                'opening_time' => '00:01:00',
                'closing_time' => '23:19:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            318 => 
            array (
                'id' => 341,
                'store_id' => 51,
                'day' => 0,
                'opening_time' => '00:01:00',
                'closing_time' => '23:19:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            319 => 
            array (
                'id' => 342,
                'store_id' => 50,
                'day' => 1,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            320 => 
            array (
                'id' => 343,
                'store_id' => 50,
                'day' => 2,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            321 => 
            array (
                'id' => 344,
                'store_id' => 50,
                'day' => 3,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            322 => 
            array (
                'id' => 345,
                'store_id' => 50,
                'day' => 4,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            323 => 
            array (
                'id' => 346,
                'store_id' => 50,
                'day' => 5,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            324 => 
            array (
                'id' => 347,
                'store_id' => 50,
                'day' => 6,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            325 => 
            array (
                'id' => 348,
                'store_id' => 50,
                'day' => 0,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            326 => 
            array (
                'id' => 349,
                'store_id' => 49,
                'day' => 1,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            327 => 
            array (
                'id' => 350,
                'store_id' => 49,
                'day' => 2,
                'opening_time' => '10:00:00',
                'closing_time' => '18:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            328 => 
            array (
                'id' => 351,
                'store_id' => 49,
                'day' => 3,
                'opening_time' => '10:00:00',
                'closing_time' => '18:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            329 => 
            array (
                'id' => 352,
                'store_id' => 49,
                'day' => 4,
                'opening_time' => '10:00:00',
                'closing_time' => '18:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            330 => 
            array (
                'id' => 353,
                'store_id' => 49,
                'day' => 5,
                'opening_time' => '10:00:00',
                'closing_time' => '18:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            331 => 
            array (
                'id' => 354,
                'store_id' => 49,
                'day' => 6,
                'opening_time' => '10:00:00',
                'closing_time' => '18:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            332 => 
            array (
                'id' => 355,
                'store_id' => 49,
                'day' => 0,
                'opening_time' => '10:00:00',
                'closing_time' => '18:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            333 => 
            array (
                'id' => 356,
                'store_id' => 48,
                'day' => 1,
                'opening_time' => '09:00:00',
                'closing_time' => '20:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            334 => 
            array (
                'id' => 357,
                'store_id' => 48,
                'day' => 2,
                'opening_time' => '09:00:00',
                'closing_time' => '20:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            335 => 
            array (
                'id' => 358,
                'store_id' => 48,
                'day' => 3,
                'opening_time' => '09:00:00',
                'closing_time' => '20:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            336 => 
            array (
                'id' => 359,
                'store_id' => 48,
                'day' => 4,
                'opening_time' => '09:00:00',
                'closing_time' => '20:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            337 => 
            array (
                'id' => 360,
                'store_id' => 48,
                'day' => 5,
                'opening_time' => '09:00:00',
                'closing_time' => '20:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            338 => 
            array (
                'id' => 361,
                'store_id' => 48,
                'day' => 6,
                'opening_time' => '09:00:00',
                'closing_time' => '20:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            339 => 
            array (
                'id' => 362,
                'store_id' => 48,
                'day' => 0,
                'opening_time' => '09:00:00',
                'closing_time' => '20:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            340 => 
            array (
                'id' => 363,
                'store_id' => 47,
                'day' => 1,
                'opening_time' => '13:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            341 => 
            array (
                'id' => 364,
                'store_id' => 47,
                'day' => 2,
                'opening_time' => '13:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            342 => 
            array (
                'id' => 365,
                'store_id' => 47,
                'day' => 3,
                'opening_time' => '13:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            343 => 
            array (
                'id' => 366,
                'store_id' => 47,
                'day' => 4,
                'opening_time' => '13:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            344 => 
            array (
                'id' => 367,
                'store_id' => 47,
                'day' => 5,
                'opening_time' => '13:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            345 => 
            array (
                'id' => 368,
                'store_id' => 47,
                'day' => 6,
                'opening_time' => '13:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            346 => 
            array (
                'id' => 369,
                'store_id' => 47,
                'day' => 0,
                'opening_time' => '13:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            347 => 
            array (
                'id' => 370,
                'store_id' => 46,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '04:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            348 => 
            array (
                'id' => 371,
                'store_id' => 46,
                'day' => 1,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            349 => 
            array (
                'id' => 372,
                'store_id' => 46,
                'day' => 2,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            350 => 
            array (
                'id' => 373,
                'store_id' => 46,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '05:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            351 => 
            array (
                'id' => 374,
                'store_id' => 46,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '06:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            352 => 
            array (
                'id' => 375,
                'store_id' => 46,
                'day' => 3,
                'opening_time' => '08:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            353 => 
            array (
                'id' => 376,
                'store_id' => 46,
                'day' => 4,
                'opening_time' => '08:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            354 => 
            array (
                'id' => 377,
                'store_id' => 46,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            355 => 
            array (
                'id' => 378,
                'store_id' => 46,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '04:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            356 => 
            array (
                'id' => 379,
                'store_id' => 46,
                'day' => 4,
                'opening_time' => '05:00:00',
                'closing_time' => '06:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            357 => 
            array (
                'id' => 380,
                'store_id' => 46,
                'day' => 6,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            358 => 
            array (
                'id' => 381,
                'store_id' => 46,
                'day' => 0,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            359 => 
            array (
                'id' => 382,
                'store_id' => 45,
                'day' => 1,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            360 => 
            array (
                'id' => 383,
                'store_id' => 45,
                'day' => 2,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            361 => 
            array (
                'id' => 384,
                'store_id' => 45,
                'day' => 3,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            362 => 
            array (
                'id' => 385,
                'store_id' => 45,
                'day' => 4,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            363 => 
            array (
                'id' => 386,
                'store_id' => 45,
                'day' => 5,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            364 => 
            array (
                'id' => 387,
                'store_id' => 45,
                'day' => 6,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            365 => 
            array (
                'id' => 388,
                'store_id' => 45,
                'day' => 0,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            366 => 
            array (
                'id' => 389,
                'store_id' => 1,
                'day' => 1,
                'opening_time' => '06:01:00',
                'closing_time' => '23:52:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            367 => 
            array (
                'id' => 390,
                'store_id' => 1,
                'day' => 2,
                'opening_time' => '06:01:00',
                'closing_time' => '23:52:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            368 => 
            array (
                'id' => 391,
                'store_id' => 1,
                'day' => 3,
                'opening_time' => '06:01:00',
                'closing_time' => '23:52:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            369 => 
            array (
                'id' => 392,
                'store_id' => 1,
                'day' => 4,
                'opening_time' => '06:01:00',
                'closing_time' => '23:52:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            370 => 
            array (
                'id' => 393,
                'store_id' => 1,
                'day' => 5,
                'opening_time' => '06:01:00',
                'closing_time' => '23:52:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            371 => 
            array (
                'id' => 394,
                'store_id' => 1,
                'day' => 6,
                'opening_time' => '06:01:00',
                'closing_time' => '23:52:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            372 => 
            array (
                'id' => 395,
                'store_id' => 1,
                'day' => 0,
                'opening_time' => '06:01:00',
                'closing_time' => '23:52:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            373 => 
            array (
                'id' => 396,
                'store_id' => 2,
                'day' => 1,
                'opening_time' => '06:30:00',
                'closing_time' => '23:30:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            374 => 
            array (
                'id' => 398,
                'store_id' => 33,
                'day' => 4,
                'opening_time' => '00:01:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            375 => 
            array (
                'id' => 399,
                'store_id' => 18,
                'day' => 4,
                'opening_time' => '00:01:00',
                'closing_time' => '23:58:59',
                'created_at' => '2024-10-24 18:10:19',
                'updated_at' => '2024-10-24 18:10:19',
            ),
            376 => 
            array (
                'id' => 400,
                'store_id' => 30,
                'day' => 0,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            377 => 
            array (
                'id' => 401,
                'store_id' => 30,
                'day' => 4,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            378 => 
            array (
                'id' => 402,
                'store_id' => 30,
                'day' => 3,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            379 => 
            array (
                'id' => 403,
                'store_id' => 30,
                'day' => 2,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            380 => 
            array (
                'id' => 404,
                'store_id' => 30,
                'day' => 1,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            381 => 
            array (
                'id' => 405,
                'store_id' => 30,
                'day' => 6,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            382 => 
            array (
                'id' => 406,
                'store_id' => 16,
                'day' => 1,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            383 => 
            array (
                'id' => 407,
                'store_id' => 16,
                'day' => 2,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            384 => 
            array (
                'id' => 408,
                'store_id' => 16,
                'day' => 3,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            385 => 
            array (
                'id' => 409,
                'store_id' => 16,
                'day' => 4,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            386 => 
            array (
                'id' => 410,
                'store_id' => 16,
                'day' => 6,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            387 => 
            array (
                'id' => 411,
                'store_id' => 16,
                'day' => 0,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            388 => 
            array (
                'id' => 412,
                'store_id' => 32,
                'day' => 1,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            389 => 
            array (
                'id' => 413,
                'store_id' => 32,
                'day' => 2,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            390 => 
            array (
                'id' => 414,
                'store_id' => 32,
                'day' => 3,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            391 => 
            array (
                'id' => 415,
                'store_id' => 32,
                'day' => 4,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            392 => 
            array (
                'id' => 416,
                'store_id' => 32,
                'day' => 6,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            393 => 
            array (
                'id' => 417,
                'store_id' => 32,
                'day' => 0,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            394 => 
            array (
                'id' => 418,
                'store_id' => 58,
                'day' => 0,
                'opening_time' => '06:00:00',
                'closing_time' => '23:59:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            395 => 
            array (
                'id' => 419,
                'store_id' => 67,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:04:36',
                'updated_at' => '2025-02-06 15:04:36',
            ),
            396 => 
            array (
                'id' => 420,
                'store_id' => 67,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:04:50',
                'updated_at' => '2025-02-06 15:04:50',
            ),
            397 => 
            array (
                'id' => 421,
                'store_id' => 67,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:04:53',
                'updated_at' => '2025-02-06 15:04:53',
            ),
            398 => 
            array (
                'id' => 422,
                'store_id' => 67,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:04:55',
                'updated_at' => '2025-02-06 15:04:55',
            ),
            399 => 
            array (
                'id' => 423,
                'store_id' => 67,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:04:58',
                'updated_at' => '2025-02-06 15:04:58',
            ),
            400 => 
            array (
                'id' => 424,
                'store_id' => 67,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:05:01',
                'updated_at' => '2025-02-06 15:05:01',
            ),
            401 => 
            array (
                'id' => 425,
                'store_id' => 67,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:05:03',
                'updated_at' => '2025-02-06 15:05:03',
            ),
            402 => 
            array (
                'id' => 426,
                'store_id' => 66,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:05:31',
                'updated_at' => '2025-02-06 15:05:31',
            ),
            403 => 
            array (
                'id' => 427,
                'store_id' => 66,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:06:07',
                'updated_at' => '2025-02-06 15:06:07',
            ),
            404 => 
            array (
                'id' => 428,
                'store_id' => 66,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:06:09',
                'updated_at' => '2025-02-06 15:06:09',
            ),
            405 => 
            array (
                'id' => 429,
                'store_id' => 66,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:06:11',
                'updated_at' => '2025-02-06 15:06:11',
            ),
            406 => 
            array (
                'id' => 430,
                'store_id' => 66,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:06:13',
                'updated_at' => '2025-02-06 15:06:13',
            ),
            407 => 
            array (
                'id' => 431,
                'store_id' => 66,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:06:17',
                'updated_at' => '2025-02-06 15:06:17',
            ),
            408 => 
            array (
                'id' => 432,
                'store_id' => 66,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:06:21',
                'updated_at' => '2025-02-06 15:06:21',
            ),
            409 => 
            array (
                'id' => 440,
                'store_id' => 60,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:08:34',
                'updated_at' => '2025-02-06 15:08:34',
            ),
            410 => 
            array (
                'id' => 441,
                'store_id' => 60,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:08:36',
                'updated_at' => '2025-02-06 15:08:36',
            ),
            411 => 
            array (
                'id' => 442,
                'store_id' => 60,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:08:38',
                'updated_at' => '2025-02-06 15:08:38',
            ),
            412 => 
            array (
                'id' => 443,
                'store_id' => 60,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:08:40',
                'updated_at' => '2025-02-06 15:08:40',
            ),
            413 => 
            array (
                'id' => 444,
                'store_id' => 60,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:08:44',
                'updated_at' => '2025-02-06 15:08:44',
            ),
            414 => 
            array (
                'id' => 445,
                'store_id' => 60,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:08:45',
                'updated_at' => '2025-02-06 15:08:45',
            ),
            415 => 
            array (
                'id' => 446,
                'store_id' => 60,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 15:08:49',
                'updated_at' => '2025-02-06 15:08:49',
            ),
            416 => 
            array (
                'id' => 454,
                'store_id' => 64,
                'day' => 1,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 16:19:29',
                'updated_at' => '2025-02-06 16:19:29',
            ),
            417 => 
            array (
                'id' => 455,
                'store_id' => 64,
                'day' => 2,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 16:19:32',
                'updated_at' => '2025-02-06 16:19:32',
            ),
            418 => 
            array (
                'id' => 456,
                'store_id' => 64,
                'day' => 3,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 16:19:35',
                'updated_at' => '2025-02-06 16:19:35',
            ),
            419 => 
            array (
                'id' => 457,
                'store_id' => 64,
                'day' => 4,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 16:19:38',
                'updated_at' => '2025-02-06 16:19:38',
            ),
            420 => 
            array (
                'id' => 458,
                'store_id' => 64,
                'day' => 5,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 16:19:40',
                'updated_at' => '2025-02-06 16:19:40',
            ),
            421 => 
            array (
                'id' => 459,
                'store_id' => 64,
                'day' => 6,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 16:19:42',
                'updated_at' => '2025-02-06 16:19:42',
            ),
            422 => 
            array (
                'id' => 460,
                'store_id' => 64,
                'day' => 0,
                'opening_time' => '00:00:00',
                'closing_time' => '23:59:59',
                'created_at' => '2025-02-06 16:19:45',
                'updated_at' => '2025-02-06 16:19:45',
            ),
        ));
        
        
    }
}