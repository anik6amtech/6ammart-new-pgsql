<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RentalCartUserDataTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rental_cart_user_data')->delete();
        
        \DB::table('rental_cart_user_data')->insert(array (
            0 => 
            array (
                'id' => 46,
                'user_id' => 33,
                'pickup_location' => '{"lat":"23.837327583559567","lng":"90.37574630230665","location_name":"1005 Avenue 11, Dhaka, Bangladesh","location_type":null}',
                'destination_location' => '{"lat":"23.795603699999997","lng":"90.3536548","location_name":"Mirpur-1, Dhaka, Bangladesh","location_type":null}',
                'pickup_time' => '2025-09-16 17:32:13',
                'rental_type' => 'hourly',
                'estimated_hours' => 1.0,
                'distance' => 5.1608771,
                'total_cart_price' => 0.0,
                'destination_time' => -1.0,
                'is_guest' => 0,
                'created_at' => '2025-09-16 17:32:25',
                'updated_at' => '2025-09-17 15:49:44',
            ),
        ));
        
        
    }
}