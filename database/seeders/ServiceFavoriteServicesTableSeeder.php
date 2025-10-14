<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceFavoriteServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_favorite_services')->delete();
        
        \DB::table('service_favorite_services')->insert(array (
            0 => 
            array (
                'id' => 2,
                'module_id' => 8,
                'customer_user_id' => 30,
                'service_id' => 1,
                'created_at' => '2025-09-09 14:23:00',
                'updated_at' => '2025-09-09 14:23:00',
            ),
            1 => 
            array (
                'id' => 4,
                'module_id' => 8,
                'customer_user_id' => 31,
                'service_id' => 7,
                'created_at' => '2025-09-11 12:10:56',
                'updated_at' => '2025-09-11 12:10:56',
            ),
            2 => 
            array (
                'id' => 5,
                'module_id' => 8,
                'customer_user_id' => 31,
                'service_id' => 2,
                'created_at' => '2025-09-11 12:11:18',
                'updated_at' => '2025-09-11 12:11:18',
            ),
            3 => 
            array (
                'id' => 6,
                'module_id' => 8,
                'customer_user_id' => 31,
                'service_id' => 6,
                'created_at' => '2025-09-11 12:11:38',
                'updated_at' => '2025-09-11 12:11:38',
            ),
            4 => 
            array (
                'id' => 7,
                'module_id' => 8,
                'customer_user_id' => 14,
                'service_id' => 3,
                'created_at' => '2025-09-17 11:30:13',
                'updated_at' => '2025-09-17 11:30:13',
            ),
            5 => 
            array (
                'id' => 9,
                'module_id' => 8,
                'customer_user_id' => 33,
                'service_id' => 5,
                'created_at' => '2025-09-17 12:25:09',
                'updated_at' => '2025-09-17 12:25:09',
            ),
            6 => 
            array (
                'id' => 13,
                'module_id' => 8,
                'customer_user_id' => 14,
                'service_id' => 1,
                'created_at' => '2025-09-21 10:47:43',
                'updated_at' => '2025-09-21 10:47:43',
            ),
            7 => 
            array (
                'id' => 15,
                'module_id' => 8,
                'customer_user_id' => 8,
                'service_id' => 9,
                'created_at' => '2025-09-24 14:46:33',
                'updated_at' => '2025-09-24 14:46:33',
            ),
            8 => 
            array (
                'id' => 16,
                'module_id' => 8,
                'customer_user_id' => 8,
                'service_id' => 2,
                'created_at' => '2025-09-24 14:46:34',
                'updated_at' => '2025-09-24 14:46:34',
            ),
            9 => 
            array (
                'id' => 17,
                'module_id' => 8,
                'customer_user_id' => 8,
                'service_id' => 3,
                'created_at' => '2025-09-24 14:46:35',
                'updated_at' => '2025-09-24 14:46:35',
            ),
            10 => 
            array (
                'id' => 18,
                'module_id' => 8,
                'customer_user_id' => 33,
                'service_id' => 6,
                'created_at' => '2025-09-24 17:50:40',
                'updated_at' => '2025-09-24 17:50:40',
            ),
            11 => 
            array (
                'id' => 19,
                'module_id' => 8,
                'customer_user_id' => 33,
                'service_id' => 7,
                'created_at' => '2025-09-24 17:50:41',
                'updated_at' => '2025-09-24 17:50:41',
            ),
            12 => 
            array (
                'id' => 20,
                'module_id' => 8,
                'customer_user_id' => 33,
                'service_id' => 8,
                'created_at' => '2025-09-24 17:50:42',
                'updated_at' => '2025-09-24 17:50:42',
            ),
            13 => 
            array (
                'id' => 21,
                'module_id' => 8,
                'customer_user_id' => 31,
                'service_id' => 8,
                'created_at' => '2025-10-08 10:58:51',
                'updated_at' => '2025-10-08 10:58:51',
            ),
            14 => 
            array (
                'id' => 22,
                'module_id' => 8,
                'customer_user_id' => 33,
                'service_id' => 1,
                'created_at' => '2025-10-11 16:02:28',
                'updated_at' => '2025-10-11 16:02:28',
            ),
        ));
        
        
    }
}