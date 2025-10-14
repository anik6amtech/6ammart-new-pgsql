<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RiderVehicleCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rider_vehicle_categories')->delete();
        
        \DB::table('rider_vehicle_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bike',
                'description' => 'bike',
                'image' => '2025-09-08-68be65d91f5cc.png',
                'type' => 'motor_bike',
                'is_active' => 1,
                'starting_coverage_area' => 2.0,
                'maximum_coverage_area' => 20.0,
                'extra_charges' => 30.0,
                'is_delivery' => 1,
                'is_ride' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-08 05:12:57',
                'updated_at' => '2025-09-08 05:12:57',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Car',
                'description' => 'car',
                'image' => '2025-09-08-68be66345da9c.png',
                'type' => 'car',
                'is_active' => 1,
                'starting_coverage_area' => 20.0,
                'maximum_coverage_area' => 50.0,
                'extra_charges' => 120.0,
                'is_delivery' => 1,
                'is_ride' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-08 05:14:28',
                'updated_at' => '2025-09-08 05:14:28',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'test',
                'description' => 'test description',
                'image' => '2025-09-11-68c2689738528.png',
                'type' => 'car',
                'is_active' => 1,
                'starting_coverage_area' => 10.0,
                'maximum_coverage_area' => 20.0,
                'extra_charges' => 10.0,
                'is_delivery' => 1,
                'is_ride' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-11 12:13:43',
                'updated_at' => '2025-09-11 12:13:43',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'v',
                'description' => 'v',
                'image' => '2025-09-15-68c7f8d54663d.png',
                'type' => 'car',
                'is_active' => 1,
                'starting_coverage_area' => NULL,
                'maximum_coverage_area' => NULL,
                'extra_charges' => NULL,
                'is_delivery' => 0,
                'is_ride' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-15 17:30:29',
                'updated_at' => '2025-09-15 17:30:29',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'tttt',
                'description' => 'reter',
                'image' => '2025-09-16-68c9009f7f3e8.png',
                'type' => 'motor_bike',
                'is_active' => 1,
                'starting_coverage_area' => NULL,
                'maximum_coverage_area' => NULL,
                'extra_charges' => NULL,
                'is_delivery' => 0,
                'is_ride' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-16 12:15:59',
                'updated_at' => '2025-09-16 12:15:59',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '654',
                'description' => '56745',
                'image' => '2025-10-08-68e5e0d0f16db.png',
                'type' => 'motor_bike',
                'is_active' => 1,
                'starting_coverage_area' => 5.0,
                'maximum_coverage_area' => 33.0,
                'extra_charges' => 76.0,
                'is_delivery' => 1,
                'is_ride' => 0,
                'deleted_at' => NULL,
                'created_at' => '2025-10-08 09:56:00',
                'updated_at' => '2025-10-08 09:56:00',
            ),
        ));
        
        
    }
}