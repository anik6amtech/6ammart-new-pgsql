<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleZoneTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('module_zone')->delete();
        
        \DB::table('module_zone')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 1,
                'zone_id' => 2,
                'per_km_shipping_charge' => 5.0,
                'minimum_shipping_charge' => 10.0,
                'maximum_cod_order_amount' => 50000.0,
                'maximum_shipping_charge' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 2,
                'zone_id' => 2,
                'per_km_shipping_charge' => 4.0,
                'minimum_shipping_charge' => 15.0,
                'maximum_cod_order_amount' => 40000.0,
                'maximum_shipping_charge' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => 3,
                'zone_id' => 2,
                'per_km_shipping_charge' => 5.0,
                'minimum_shipping_charge' => 20.0,
                'maximum_cod_order_amount' => 35000.0,
                'maximum_shipping_charge' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'module_id' => 4,
                'zone_id' => 2,
                'per_km_shipping_charge' => 5.0,
                'minimum_shipping_charge' => 20.0,
                'maximum_cod_order_amount' => 30000.0,
                'maximum_shipping_charge' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'module_id' => 5,
                'zone_id' => 2,
                'per_km_shipping_charge' => NULL,
                'minimum_shipping_charge' => NULL,
                'maximum_cod_order_amount' => 100000.0,
                'maximum_shipping_charge' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'module_id' => 1,
                'zone_id' => 1,
                'per_km_shipping_charge' => 5.0,
                'minimum_shipping_charge' => 10.0,
                'maximum_cod_order_amount' => 80000.0,
                'maximum_shipping_charge' => 500.0,
            ),
            6 => 
            array (
                'id' => 7,
                'module_id' => 2,
                'zone_id' => 1,
                'per_km_shipping_charge' => 4.0,
                'minimum_shipping_charge' => 20.0,
                'maximum_cod_order_amount' => 70000.0,
                'maximum_shipping_charge' => 500.0,
            ),
            7 => 
            array (
                'id' => 8,
                'module_id' => 3,
                'zone_id' => 1,
                'per_km_shipping_charge' => 5.0,
                'minimum_shipping_charge' => 20.0,
                'maximum_cod_order_amount' => 75000.0,
                'maximum_shipping_charge' => 500.0,
            ),
            8 => 
            array (
                'id' => 9,
                'module_id' => 4,
                'zone_id' => 1,
                'per_km_shipping_charge' => 5.0,
                'minimum_shipping_charge' => 25.0,
                'maximum_cod_order_amount' => 75000.0,
                'maximum_shipping_charge' => 500.0,
            ),
            9 => 
            array (
                'id' => 10,
                'module_id' => 5,
                'zone_id' => 1,
                'per_km_shipping_charge' => NULL,
                'minimum_shipping_charge' => NULL,
                'maximum_cod_order_amount' => 60000.0,
                'maximum_shipping_charge' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'module_id' => 6,
                'zone_id' => 1,
                'per_km_shipping_charge' => NULL,
                'minimum_shipping_charge' => NULL,
                'maximum_cod_order_amount' => NULL,
                'maximum_shipping_charge' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'module_id' => 6,
                'zone_id' => 3,
                'per_km_shipping_charge' => NULL,
                'minimum_shipping_charge' => NULL,
                'maximum_cod_order_amount' => NULL,
                'maximum_shipping_charge' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'module_id' => 6,
                'zone_id' => 4,
                'per_km_shipping_charge' => NULL,
                'minimum_shipping_charge' => NULL,
                'maximum_cod_order_amount' => NULL,
                'maximum_shipping_charge' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'module_id' => 6,
                'zone_id' => 5,
                'per_km_shipping_charge' => NULL,
                'minimum_shipping_charge' => NULL,
                'maximum_cod_order_amount' => NULL,
                'maximum_shipping_charge' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'module_id' => 7,
                'zone_id' => 1,
                'per_km_shipping_charge' => NULL,
                'minimum_shipping_charge' => NULL,
                'maximum_cod_order_amount' => NULL,
                'maximum_shipping_charge' => NULL,
            ),
            15 => 
            array (
                'id' => 17,
                'module_id' => 8,
                'zone_id' => 1,
                'per_km_shipping_charge' => 1.0,
                'minimum_shipping_charge' => 1.0,
                'maximum_cod_order_amount' => 1.0,
                'maximum_shipping_charge' => 1.0,
            ),
        ));
        
        
    }
}