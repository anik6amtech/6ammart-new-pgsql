<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RiderVehicleModelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rider_vehicle_models')->delete();
        
        \DB::table('rider_vehicle_models')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Corolla',
                'brand_id' => 1,
                'seat_capacity' => 0,
                'maximum_weight' => '0.00',
                'hatch_bag_capacity' => 0,
                'engine' => NULL,
                'description' => 'Corolla',
                'image' => '2025-09-08-68be63efbee26.png',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-08 05:04:47',
                'updated_at' => '2025-09-08 05:04:47',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Camry',
                'brand_id' => 1,
                'seat_capacity' => 0,
                'maximum_weight' => '0.00',
                'hatch_bag_capacity' => 0,
                'engine' => NULL,
                'description' => 'Camry',
                'image' => '2025-09-08-68be6401b06dc.png',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-08 05:05:05',
                'updated_at' => '2025-09-08 05:05:05',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Hornet 2.0',
                'brand_id' => 2,
                'seat_capacity' => 0,
                'maximum_weight' => '0.00',
                'hatch_bag_capacity' => 0,
                'engine' => NULL,
                'description' => 'Hornet 2.0',
                'image' => '2025-09-08-68be641b19fcf.png',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-08 05:05:31',
                'updated_at' => '2025-09-08 05:05:31',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'XBlade',
                'brand_id' => 2,
                'seat_capacity' => 0,
                'maximum_weight' => '0.00',
                'hatch_bag_capacity' => 0,
                'engine' => NULL,
                'description' => 'XBlade',
                'image' => '2025-09-08-68be650422534.png',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-08 05:09:24',
                'updated_at' => '2025-09-08 05:09:24',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'test',
                'brand_id' => 4,
                'seat_capacity' => 0,
                'maximum_weight' => '0.00',
                'hatch_bag_capacity' => 0,
                'engine' => NULL,
                'description' => 'test description',
                'image' => '2025-09-11-68c26781abb80.png',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-11 12:09:05',
                'updated_at' => '2025-09-11 12:09:05',
            ),
        ));
        
        
    }
}