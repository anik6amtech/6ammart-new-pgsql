<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WishlistsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('wishlists')->delete();
        
        \DB::table('wishlists')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'item_id' => NULL,
                'created_at' => '2022-03-22 15:00:09',
                'updated_at' => '2022-03-22 15:00:09',
                'store_id' => 14,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'item_id' => 2,
                'created_at' => '2022-03-22 17:13:55',
                'updated_at' => '2022-03-22 17:13:55',
                'store_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 5,
                'item_id' => 93,
                'created_at' => '2022-03-23 10:40:21',
                'updated_at' => '2022-03-23 10:40:21',
                'store_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 5,
                'item_id' => 11,
                'created_at' => '2022-03-23 10:41:11',
                'updated_at' => '2022-03-23 10:41:11',
                'store_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 5,
                'item_id' => 84,
                'created_at' => '2022-03-23 14:52:13',
                'updated_at' => '2022-03-23 14:52:13',
                'store_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 5,
                'item_id' => NULL,
                'created_at' => '2022-03-23 14:53:54',
                'updated_at' => '2022-03-23 14:53:54',
                'store_id' => 4,
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 5,
                'item_id' => NULL,
                'created_at' => '2022-03-23 14:54:05',
                'updated_at' => '2022-03-23 14:54:05',
                'store_id' => 10,
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 9,
                'item_id' => NULL,
                'created_at' => '2022-09-29 12:33:44',
                'updated_at' => '2022-09-29 12:33:44',
                'store_id' => 54,
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 9,
                'item_id' => NULL,
                'created_at' => '2022-09-29 12:33:52',
                'updated_at' => '2022-09-29 12:33:52',
                'store_id' => 6,
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 9,
                'item_id' => NULL,
                'created_at' => '2022-09-29 12:34:06',
                'updated_at' => '2022-09-29 12:34:06',
                'store_id' => 46,
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 13,
                'item_id' => NULL,
                'created_at' => '2022-09-29 15:22:15',
                'updated_at' => '2022-09-29 15:22:15',
                'store_id' => 14,
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 13,
                'item_id' => NULL,
                'created_at' => '2022-09-29 15:22:25',
                'updated_at' => '2022-09-29 15:22:25',
                'store_id' => 8,
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 13,
                'item_id' => NULL,
                'created_at' => '2022-09-29 15:22:26',
                'updated_at' => '2022-09-29 15:22:26',
                'store_id' => 6,
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 11,
                'item_id' => NULL,
                'created_at' => '2022-09-29 15:23:08',
                'updated_at' => '2022-09-29 15:23:08',
                'store_id' => 9,
            ),
            14 => 
            array (
                'id' => 15,
                'user_id' => 11,
                'item_id' => NULL,
                'created_at' => '2022-09-29 15:23:12',
                'updated_at' => '2022-09-29 15:23:12',
                'store_id' => 14,
            ),
            15 => 
            array (
                'id' => 16,
                'user_id' => 8,
                'item_id' => NULL,
                'created_at' => '2025-09-07 10:59:28',
                'updated_at' => '2025-09-07 10:59:28',
                'store_id' => 5,
            ),
            16 => 
            array (
                'id' => 17,
                'user_id' => 21,
                'item_id' => NULL,
                'created_at' => '2025-09-09 12:19:28',
                'updated_at' => '2025-09-09 12:19:28',
                'store_id' => 32,
            ),
            17 => 
            array (
                'id' => 19,
                'user_id' => 21,
                'item_id' => NULL,
                'created_at' => '2025-09-14 12:38:20',
                'updated_at' => '2025-09-14 12:38:20',
                'store_id' => 5,
            ),
            18 => 
            array (
                'id' => 20,
                'user_id' => 21,
                'item_id' => NULL,
                'created_at' => '2025-09-14 12:38:49',
                'updated_at' => '2025-09-14 12:38:49',
                'store_id' => 1,
            ),
            19 => 
            array (
                'id' => 21,
                'user_id' => 21,
                'item_id' => NULL,
                'created_at' => '2025-09-14 12:38:56',
                'updated_at' => '2025-09-14 12:38:56',
                'store_id' => 2,
            ),
            20 => 
            array (
                'id' => 22,
                'user_id' => 14,
                'item_id' => NULL,
                'created_at' => '2025-09-16 15:09:02',
                'updated_at' => '2025-09-16 15:09:02',
                'store_id' => 8,
            ),
            21 => 
            array (
                'id' => 25,
                'user_id' => 32,
                'item_id' => NULL,
                'created_at' => '2025-10-13 17:06:53',
                'updated_at' => '2025-10-13 17:06:53',
                'store_id' => 57,
            ),
            22 => 
            array (
                'id' => 31,
                'user_id' => 32,
                'item_id' => 284,
                'created_at' => '2025-10-13 17:09:53',
                'updated_at' => '2025-10-13 17:09:53',
                'store_id' => NULL,
            ),
            23 => 
            array (
                'id' => 33,
                'user_id' => 32,
                'item_id' => 307,
                'created_at' => '2025-10-13 17:12:01',
                'updated_at' => '2025-10-13 17:12:01',
                'store_id' => NULL,
            ),
            24 => 
            array (
                'id' => 34,
                'user_id' => 32,
                'item_id' => 306,
                'created_at' => '2025-10-13 17:12:03',
                'updated_at' => '2025-10-13 17:12:03',
                'store_id' => NULL,
            ),
            25 => 
            array (
                'id' => 36,
                'user_id' => 32,
                'item_id' => 286,
                'created_at' => '2025-10-13 17:12:18',
                'updated_at' => '2025-10-13 17:12:18',
                'store_id' => NULL,
            ),
            26 => 
            array (
                'id' => 37,
                'user_id' => 32,
                'item_id' => 270,
                'created_at' => '2025-10-13 17:13:13',
                'updated_at' => '2025-10-13 17:13:13',
                'store_id' => NULL,
            ),
            27 => 
            array (
                'id' => 38,
                'user_id' => 32,
                'item_id' => 340,
                'created_at' => '2025-10-13 17:13:36',
                'updated_at' => '2025-10-13 17:13:36',
                'store_id' => NULL,
            ),
            28 => 
            array (
                'id' => 39,
                'user_id' => 32,
                'item_id' => 342,
                'created_at' => '2025-10-13 17:13:38',
                'updated_at' => '2025-10-13 17:13:38',
                'store_id' => NULL,
            ),
            29 => 
            array (
                'id' => 40,
                'user_id' => 32,
                'item_id' => 357,
                'created_at' => '2025-10-13 17:13:40',
                'updated_at' => '2025-10-13 17:13:40',
                'store_id' => NULL,
            ),
        ));
        
        
    }
}