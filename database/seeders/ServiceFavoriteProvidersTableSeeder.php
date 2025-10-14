<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceFavoriteProvidersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_favorite_providers')->delete();
        
        \DB::table('service_favorite_providers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 8,
                'customer_user_id' => 8,
                'provider_id' => 2,
                'created_at' => '2025-09-07 10:59:17',
                'updated_at' => '2025-09-07 10:59:17',
            ),
            1 => 
            array (
                'id' => 4,
                'module_id' => 8,
                'customer_user_id' => 21,
                'provider_id' => 7,
                'created_at' => '2025-09-09 12:24:29',
                'updated_at' => '2025-09-09 12:24:29',
            ),
            2 => 
            array (
                'id' => 5,
                'module_id' => 8,
                'customer_user_id' => 30,
                'provider_id' => 7,
                'created_at' => '2025-09-09 14:23:34',
                'updated_at' => '2025-09-09 14:23:34',
            ),
            3 => 
            array (
                'id' => 6,
                'module_id' => 8,
                'customer_user_id' => 21,
                'provider_id' => 6,
                'created_at' => '2025-09-14 12:37:42',
                'updated_at' => '2025-09-14 12:37:42',
            ),
            4 => 
            array (
                'id' => 7,
                'module_id' => 8,
                'customer_user_id' => 21,
                'provider_id' => 8,
                'created_at' => '2025-09-14 12:37:49',
                'updated_at' => '2025-09-14 12:37:49',
            ),
            5 => 
            array (
                'id' => 8,
                'module_id' => 8,
                'customer_user_id' => 14,
                'provider_id' => 1,
                'created_at' => '2025-09-16 16:03:28',
                'updated_at' => '2025-09-16 16:03:28',
            ),
            6 => 
            array (
                'id' => 9,
                'module_id' => 8,
                'customer_user_id' => 33,
                'provider_id' => 7,
                'created_at' => '2025-09-17 12:25:00',
                'updated_at' => '2025-09-17 12:25:00',
            ),
            7 => 
            array (
                'id' => 10,
                'module_id' => 8,
                'customer_user_id' => 14,
                'provider_id' => 8,
                'created_at' => '2025-09-22 15:50:03',
                'updated_at' => '2025-09-22 15:50:03',
            ),
            8 => 
            array (
                'id' => 11,
                'module_id' => 8,
                'customer_user_id' => 33,
                'provider_id' => 8,
                'created_at' => '2025-09-24 12:58:35',
                'updated_at' => '2025-09-24 12:58:35',
            ),
            9 => 
            array (
                'id' => 12,
                'module_id' => 8,
                'customer_user_id' => 8,
                'provider_id' => 8,
                'created_at' => '2025-09-24 14:46:47',
                'updated_at' => '2025-09-24 14:46:47',
            ),
            10 => 
            array (
                'id' => 13,
                'module_id' => 8,
                'customer_user_id' => 32,
                'provider_id' => 11,
                'created_at' => '2025-09-29 17:22:43',
                'updated_at' => '2025-09-29 17:22:43',
            ),
            11 => 
            array (
                'id' => 14,
                'module_id' => 8,
                'customer_user_id' => 32,
                'provider_id' => 1,
                'created_at' => '2025-09-30 09:51:55',
                'updated_at' => '2025-09-30 09:51:55',
            ),
            12 => 
            array (
                'id' => 15,
                'module_id' => 8,
                'customer_user_id' => 14,
                'provider_id' => 11,
                'created_at' => '2025-10-05 12:43:39',
                'updated_at' => '2025-10-05 12:43:39',
            ),
        ));
        
        
    }
}