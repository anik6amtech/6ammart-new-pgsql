<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideVehicleCategoryCouponSetupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_vehicle_category_coupon_setups')->delete();
        
        \DB::table('ride_vehicle_category_coupon_setups')->insert(array (
            0 => 
            array (
                'rider_vehicle_category_id' => 1,
                'coupon_setup_id' => 1,
            ),
            1 => 
            array (
                'rider_vehicle_category_id' => 1,
                'coupon_setup_id' => 2,
            ),
            2 => 
            array (
                'rider_vehicle_category_id' => 1,
                'coupon_setup_id' => 3,
            ),
            3 => 
            array (
                'rider_vehicle_category_id' => 1,
                'coupon_setup_id' => 4,
            ),
            4 => 
            array (
                'rider_vehicle_category_id' => 1,
                'coupon_setup_id' => 5,
            ),
            5 => 
            array (
                'rider_vehicle_category_id' => 1,
                'coupon_setup_id' => 6,
            ),
            6 => 
            array (
                'rider_vehicle_category_id' => 1,
                'coupon_setup_id' => 7,
            ),
            7 => 
            array (
                'rider_vehicle_category_id' => 2,
                'coupon_setup_id' => 1,
            ),
            8 => 
            array (
                'rider_vehicle_category_id' => 2,
                'coupon_setup_id' => 2,
            ),
            9 => 
            array (
                'rider_vehicle_category_id' => 2,
                'coupon_setup_id' => 3,
            ),
            10 => 
            array (
                'rider_vehicle_category_id' => 2,
                'coupon_setup_id' => 4,
            ),
            11 => 
            array (
                'rider_vehicle_category_id' => 2,
                'coupon_setup_id' => 5,
            ),
            12 => 
            array (
                'rider_vehicle_category_id' => 2,
                'coupon_setup_id' => 6,
            ),
            13 => 
            array (
                'rider_vehicle_category_id' => 2,
                'coupon_setup_id' => 7,
            ),
            14 => 
            array (
                'rider_vehicle_category_id' => 3,
                'coupon_setup_id' => 3,
            ),
            15 => 
            array (
                'rider_vehicle_category_id' => 3,
                'coupon_setup_id' => 4,
            ),
            16 => 
            array (
                'rider_vehicle_category_id' => 3,
                'coupon_setup_id' => 5,
            ),
            17 => 
            array (
                'rider_vehicle_category_id' => 3,
                'coupon_setup_id' => 6,
            ),
            18 => 
            array (
                'rider_vehicle_category_id' => 3,
                'coupon_setup_id' => 7,
            ),
            19 => 
            array (
                'rider_vehicle_category_id' => 4,
                'coupon_setup_id' => 5,
            ),
            20 => 
            array (
                'rider_vehicle_category_id' => 4,
                'coupon_setup_id' => 6,
            ),
            21 => 
            array (
                'rider_vehicle_category_id' => 4,
                'coupon_setup_id' => 7,
            ),
            22 => 
            array (
                'rider_vehicle_category_id' => 5,
                'coupon_setup_id' => 5,
            ),
            23 => 
            array (
                'rider_vehicle_category_id' => 5,
                'coupon_setup_id' => 6,
            ),
            24 => 
            array (
                'rider_vehicle_category_id' => 5,
                'coupon_setup_id' => 7,
            ),
        ));
        
        
    }
}