<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideFaresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_fares')->delete();
        
        \DB::table('ride_fares')->insert(array (
            0 => 
            array (
                'id' => 15,
                'zone_wise_default_ride_fare_id' => 1,
                'zone_id' => 1,
                'vehicle_category_id' => 1,
                'base_fare' => '20.00',
                'base_fare_per_km' => '5.00',
                'waiting_fee_per_min' => '0.00',
                'cancellation_fee_percent' => '50.00',
                'min_cancellation_fee' => '30.00',
                'idle_fee_per_min' => '10.00',
                'ride_delay_fee_per_min' => '20.00',
                'penalty_fee_for_cancel' => '0.00',
                'fee_add_to_next' => '0.00',
                'created_at' => '2025-10-07 17:57:45',
                'updated_at' => '2025-10-07 17:57:45',
            ),
            1 => 
            array (
                'id' => 16,
                'zone_wise_default_ride_fare_id' => 1,
                'zone_id' => 1,
                'vehicle_category_id' => 2,
                'base_fare' => '20.00',
                'base_fare_per_km' => '5.00',
                'waiting_fee_per_min' => '0.00',
                'cancellation_fee_percent' => '50.00',
                'min_cancellation_fee' => '30.00',
                'idle_fee_per_min' => '10.00',
                'ride_delay_fee_per_min' => '20.00',
                'penalty_fee_for_cancel' => '0.00',
                'fee_add_to_next' => '0.00',
                'created_at' => '2025-10-07 17:57:45',
                'updated_at' => '2025-10-07 17:57:45',
            ),
            2 => 
            array (
                'id' => 17,
                'zone_wise_default_ride_fare_id' => 1,
                'zone_id' => 1,
                'vehicle_category_id' => 3,
                'base_fare' => '10.00',
                'base_fare_per_km' => '20.00',
                'waiting_fee_per_min' => '0.00',
                'cancellation_fee_percent' => '30.00',
                'min_cancellation_fee' => '30.00',
                'idle_fee_per_min' => '10.00',
                'ride_delay_fee_per_min' => '20.00',
                'penalty_fee_for_cancel' => '0.00',
                'fee_add_to_next' => '0.00',
                'created_at' => '2025-10-07 17:57:45',
                'updated_at' => '2025-10-07 17:57:45',
            ),
        ));
        
        
    }
}