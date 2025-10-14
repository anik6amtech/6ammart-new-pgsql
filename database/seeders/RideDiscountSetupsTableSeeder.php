<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideDiscountSetupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_discount_setups')->delete();
        
        \DB::table('ride_discount_setups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Weekend Adda',
                'short_description' => 'Weekend Adda',
                'terms_conditions' => 'Weekend Adda',
                'image' => '2025-09-08-68bea00e9aba5.png',
                'zone_discount_type' => 'custom',
                'customer_discount_type' => 'custom',
                'module_discount_type' => '["custom"]',
                'discount_amount_type' => 'amount',
                'limit_per_user' => 2,
                'discount_amount' => 30.0,
                'max_discount_amount' => 30.0,
                'min_trip_amount' => 120.0,
                'start_date' => '2025-09-08',
                'end_date' => '2025-09-30',
                'total_used' => 1,
                'total_amount' => 30.0,
                'is_active' => 0,
                'module_id' => 7,
                'deleted_at' => NULL,
                'created_at' => '2025-09-08 09:21:18',
                'updated_at' => '2025-10-13 18:26:25',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Incredible Savings! Get 45% Off Today!',
                'short_description' => 'Key Features:
- **Rich Cocoa Base**: Indulge in the deep, velvety richness of premium cocoa, offering a comforting embrace with every sip. Perfect for those moments when words aren\'t enough.',
                'terms_conditions' => 'wejqlerjtgferkgjerbrw',
                'image' => '2025-09-14-68c69d6dbc22e.png',
                'zone_discount_type' => 'custom',
                'customer_discount_type' => 'custom',
                'module_discount_type' => '["custom"]',
                'discount_amount_type' => 'amount',
                'limit_per_user' => 77,
                'discount_amount' => 50.0,
                'max_discount_amount' => 55.0,
                'min_trip_amount' => 50.0,
                'start_date' => '2025-09-14',
                'end_date' => '2026-10-31',
                'total_used' => 71,
                'total_amount' => 3512.89,
                'is_active' => 1,
                'module_id' => 7,
                'deleted_at' => NULL,
                'created_at' => '2025-09-14 16:09:25',
                'updated_at' => '2025-10-13 18:30:02',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'retrey',
                'short_description' => '5e5',
                'terms_conditions' => '5465',
                'image' => '2025-09-14-68c69e0c230ff.png',
                'zone_discount_type' => 'custom',
                'customer_discount_type' => 'custom',
                'module_discount_type' => '["custom"]',
                'discount_amount_type' => 'amount',
                'limit_per_user' => 55,
                'discount_amount' => 33.0,
                'max_discount_amount' => 55.0,
                'min_trip_amount' => 33.0,
                'start_date' => '2025-09-14',
                'end_date' => '2025-11-08',
                'total_used' => 1,
                'total_amount' => 33.0,
                'is_active' => 0,
                'module_id' => 7,
                'deleted_at' => NULL,
                'created_at' => '2025-09-14 16:50:52',
                'updated_at' => '2025-09-25 17:19:53',
            ),
        ));
        
        
    }
}