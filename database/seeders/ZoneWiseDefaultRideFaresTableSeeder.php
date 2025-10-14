<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ZoneWiseDefaultRideFaresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zone_wise_default_ride_fares')->delete();
        
        \DB::table('zone_wise_default_ride_fares')->insert(array (
            0 => 
            array (
                'id' => 1,
                'zone_id' => 1,
                'base_fare' => 20.0,
                'base_fare_per_km' => 5.0,
                'waiting_fee_per_min' => 0.0,
                'cancellation_fee_percent' => 50.0,
                'min_cancellation_fee' => 30.0,
                'idle_fee_per_min' => 10.0,
                'ride_delay_fee_per_min' => 20.0,
                'penalty_fee_for_cancel' => 0.0,
                'fee_add_to_next' => 0.0,
                'category_wise_different_fare' => 1,
                'created_at' => '2025-09-08 05:47:43',
                'updated_at' => '2025-10-07 17:57:45',
            ),
        ));
        
        
    }
}