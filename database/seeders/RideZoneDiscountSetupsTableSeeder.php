<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideZoneDiscountSetupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_zone_discount_setups')->delete();
        
        \DB::table('ride_zone_discount_setups')->insert(array (
            0 => 
            array (
                'zone_id' => 1,
                'discount_setup_id' => 1,
            ),
            1 => 
            array (
                'zone_id' => 1,
                'discount_setup_id' => 2,
            ),
            2 => 
            array (
                'zone_id' => 1,
                'discount_setup_id' => 3,
            ),
            3 => 
            array (
                'zone_id' => 2,
                'discount_setup_id' => 1,
            ),
            4 => 
            array (
                'zone_id' => 2,
                'discount_setup_id' => 2,
            ),
            5 => 
            array (
                'zone_id' => 2,
                'discount_setup_id' => 3,
            ),
            6 => 
            array (
                'zone_id' => 3,
                'discount_setup_id' => 1,
            ),
            7 => 
            array (
                'zone_id' => 3,
                'discount_setup_id' => 2,
            ),
            8 => 
            array (
                'zone_id' => 3,
                'discount_setup_id' => 3,
            ),
        ));
        
        
    }
}