<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideZoneCouponSetupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_zone_coupon_setups')->delete();
        
        \DB::table('ride_zone_coupon_setups')->insert(array (
            0 => 
            array (
                'zone_id' => 1,
                'coupon_setup_id' => 1,
            ),
            1 => 
            array (
                'zone_id' => 1,
                'coupon_setup_id' => 2,
            ),
            2 => 
            array (
                'zone_id' => 1,
                'coupon_setup_id' => 3,
            ),
            3 => 
            array (
                'zone_id' => 1,
                'coupon_setup_id' => 4,
            ),
            4 => 
            array (
                'zone_id' => 1,
                'coupon_setup_id' => 5,
            ),
            5 => 
            array (
                'zone_id' => 1,
                'coupon_setup_id' => 6,
            ),
            6 => 
            array (
                'zone_id' => 1,
                'coupon_setup_id' => 7,
            ),
            7 => 
            array (
                'zone_id' => 2,
                'coupon_setup_id' => 1,
            ),
            8 => 
            array (
                'zone_id' => 2,
                'coupon_setup_id' => 2,
            ),
            9 => 
            array (
                'zone_id' => 2,
                'coupon_setup_id' => 3,
            ),
            10 => 
            array (
                'zone_id' => 2,
                'coupon_setup_id' => 4,
            ),
            11 => 
            array (
                'zone_id' => 2,
                'coupon_setup_id' => 6,
            ),
            12 => 
            array (
                'zone_id' => 2,
                'coupon_setup_id' => 7,
            ),
            13 => 
            array (
                'zone_id' => 3,
                'coupon_setup_id' => 1,
            ),
            14 => 
            array (
                'zone_id' => 3,
                'coupon_setup_id' => 2,
            ),
            15 => 
            array (
                'zone_id' => 3,
                'coupon_setup_id' => 3,
            ),
            16 => 
            array (
                'zone_id' => 3,
                'coupon_setup_id' => 4,
            ),
            17 => 
            array (
                'zone_id' => 3,
                'coupon_setup_id' => 6,
            ),
            18 => 
            array (
                'zone_id' => 3,
                'coupon_setup_id' => 7,
            ),
        ));
        
        
    }
}