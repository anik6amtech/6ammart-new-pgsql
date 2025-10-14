<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideVehicleCategoryDiscountSetupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_vehicle_category_discount_setups')->delete();
        
        \DB::table('ride_vehicle_category_discount_setups')->insert(array (
            0 => 
            array (
                'rider_vehicle_category_id' => '1',
                'discount_setup_id' => '1',
            ),
            1 => 
            array (
                'rider_vehicle_category_id' => '1',
                'discount_setup_id' => '2',
            ),
            2 => 
            array (
                'rider_vehicle_category_id' => '1',
                'discount_setup_id' => '3',
            ),
            3 => 
            array (
                'rider_vehicle_category_id' => '2',
                'discount_setup_id' => '1',
            ),
            4 => 
            array (
                'rider_vehicle_category_id' => '2',
                'discount_setup_id' => '2',
            ),
            5 => 
            array (
                'rider_vehicle_category_id' => '2',
                'discount_setup_id' => '3',
            ),
            6 => 
            array (
                'rider_vehicle_category_id' => '3',
                'discount_setup_id' => '2',
            ),
            7 => 
            array (
                'rider_vehicle_category_id' => '3',
                'discount_setup_id' => '3',
            ),
        ));
        
        
    }
}