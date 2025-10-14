<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RentalWishlishesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rental_wishlishes')->delete();
        
        \DB::table('rental_wishlishes')->insert(array (
            0 => 
            array (
                'id' => 3,
                'user_id' => 5,
                'vehicle_id' => 16,
                'provider_id' => NULL,
                'created_at' => '2025-02-06 15:17:13',
                'updated_at' => '2025-02-06 15:17:13',
            ),
            1 => 
            array (
                'id' => 7,
                'user_id' => 21,
                'vehicle_id' => NULL,
                'provider_id' => 64,
                'created_at' => '2025-02-06 16:06:49',
                'updated_at' => '2025-02-06 16:06:49',
            ),
            2 => 
            array (
                'id' => 8,
                'user_id' => 21,
                'vehicle_id' => NULL,
                'provider_id' => 66,
                'created_at' => '2025-02-06 16:06:57',
                'updated_at' => '2025-02-06 16:06:57',
            ),
            3 => 
            array (
                'id' => 9,
                'user_id' => 8,
                'vehicle_id' => 17,
                'provider_id' => NULL,
                'created_at' => '2025-02-08 12:57:59',
                'updated_at' => '2025-02-08 12:57:59',
            ),
            4 => 
            array (
                'id' => 10,
                'user_id' => 8,
                'vehicle_id' => NULL,
                'provider_id' => 64,
                'created_at' => '2025-02-08 12:58:12',
                'updated_at' => '2025-02-08 12:58:12',
            ),
            5 => 
            array (
                'id' => 12,
                'user_id' => 21,
                'vehicle_id' => 16,
                'provider_id' => NULL,
                'created_at' => '2025-02-08 14:14:31',
                'updated_at' => '2025-02-08 14:14:31',
            ),
            6 => 
            array (
                'id' => 14,
                'user_id' => 21,
                'vehicle_id' => 17,
                'provider_id' => NULL,
                'created_at' => '2025-02-08 14:24:29',
                'updated_at' => '2025-02-08 14:24:29',
            ),
        ));
        
        
    }
}