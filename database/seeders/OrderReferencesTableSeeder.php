<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderReferencesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_references')->delete();
        
        \DB::table('order_references')->insert(array (
            0 => 
            array (
                'id' => 1,
                'order_id' => 100102,
                'is_reviewed' => 0,
                'is_review_canceled' => 1,
                'created_at' => '2025-04-20 18:13:58',
                'updated_at' => '2025-09-07 10:02:05',
            ),
            1 => 
            array (
                'id' => 2,
                'order_id' => 100103,
                'is_reviewed' => 1,
                'is_review_canceled' => 0,
                'created_at' => '2025-04-20 18:14:55',
                'updated_at' => '2025-04-20 18:16:52',
            ),
            2 => 
            array (
                'id' => 3,
                'order_id' => 100104,
                'is_reviewed' => 1,
                'is_review_canceled' => 0,
                'created_at' => '2025-04-20 18:15:58',
                'updated_at' => '2025-04-20 18:16:31',
            ),
            3 => 
            array (
                'id' => 4,
                'order_id' => 100105,
                'is_reviewed' => 1,
                'is_review_canceled' => 0,
                'created_at' => '2025-04-20 18:18:10',
                'updated_at' => '2025-04-20 18:19:16',
            ),
            4 => 
            array (
                'id' => 5,
                'order_id' => 100106,
                'is_reviewed' => 1,
                'is_review_canceled' => 0,
                'created_at' => '2025-04-20 18:18:58',
                'updated_at' => '2025-04-20 18:20:03',
            ),
            5 => 
            array (
                'id' => 6,
                'order_id' => 100107,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-09-09 14:26:32',
                'updated_at' => '2025-09-09 14:26:32',
            ),
            6 => 
            array (
                'id' => 7,
                'order_id' => 100108,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-09-12 00:26:24',
                'updated_at' => '2025-09-12 00:26:24',
            ),
            7 => 
            array (
                'id' => 8,
                'order_id' => 100109,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-09-18 21:04:55',
                'updated_at' => '2025-09-18 21:04:55',
            ),
            8 => 
            array (
                'id' => 9,
                'order_id' => 100110,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-09-18 21:18:10',
                'updated_at' => '2025-09-18 21:18:10',
            ),
            9 => 
            array (
                'id' => 10,
                'order_id' => 100111,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-09-18 21:23:29',
                'updated_at' => '2025-09-18 21:23:29',
            ),
            10 => 
            array (
                'id' => 11,
                'order_id' => 100112,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-09-25 21:04:44',
                'updated_at' => '2025-09-25 21:04:44',
            ),
            11 => 
            array (
                'id' => 12,
                'order_id' => 100113,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-01 00:27:51',
                'updated_at' => '2025-10-01 00:27:51',
            ),
            12 => 
            array (
                'id' => 13,
                'order_id' => 100114,
                'is_reviewed' => 0,
                'is_review_canceled' => 1,
                'created_at' => '2025-10-07 13:34:30',
                'updated_at' => '2025-10-13 12:45:42',
            ),
            13 => 
            array (
                'id' => 14,
                'order_id' => 100115,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-12 15:42:50',
                'updated_at' => '2025-10-12 15:42:50',
            ),
            14 => 
            array (
                'id' => 15,
                'order_id' => 100116,
                'is_reviewed' => 0,
                'is_review_canceled' => 1,
                'created_at' => '2025-10-12 15:49:28',
                'updated_at' => '2025-10-13 12:45:03',
            ),
            15 => 
            array (
                'id' => 16,
                'order_id' => 100117,
                'is_reviewed' => 0,
                'is_review_canceled' => 1,
                'created_at' => '2025-10-12 16:09:51',
                'updated_at' => '2025-10-13 11:49:27',
            ),
            16 => 
            array (
                'id' => 17,
                'order_id' => 100118,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-12 16:17:43',
                'updated_at' => '2025-10-12 16:17:43',
            ),
            17 => 
            array (
                'id' => 18,
                'order_id' => 100119,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-12 16:20:50',
                'updated_at' => '2025-10-12 16:20:50',
            ),
            18 => 
            array (
                'id' => 19,
                'order_id' => 100120,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-12 16:27:31',
                'updated_at' => '2025-10-12 16:27:31',
            ),
            19 => 
            array (
                'id' => 20,
                'order_id' => 100121,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-12 16:31:26',
                'updated_at' => '2025-10-12 16:31:26',
            ),
            20 => 
            array (
                'id' => 21,
                'order_id' => 100122,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-12 16:39:45',
                'updated_at' => '2025-10-12 16:39:45',
            ),
            21 => 
            array (
                'id' => 22,
                'order_id' => 100123,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-12 17:27:51',
                'updated_at' => '2025-10-12 17:27:51',
            ),
            22 => 
            array (
                'id' => 23,
                'order_id' => 100124,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-12 17:32:09',
                'updated_at' => '2025-10-12 17:32:09',
            ),
            23 => 
            array (
                'id' => 24,
                'order_id' => 100125,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-12 17:34:46',
                'updated_at' => '2025-10-12 17:34:46',
            ),
            24 => 
            array (
                'id' => 25,
                'order_id' => 100126,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-13 12:19:30',
                'updated_at' => '2025-10-13 12:19:30',
            ),
            25 => 
            array (
                'id' => 26,
                'order_id' => 100127,
                'is_reviewed' => 0,
                'is_review_canceled' => 0,
                'created_at' => '2025-10-13 12:27:36',
                'updated_at' => '2025-10-13 12:27:36',
            ),
        ));
        
        
    }
}