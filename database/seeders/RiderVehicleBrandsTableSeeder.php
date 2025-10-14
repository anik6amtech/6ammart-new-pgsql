<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RiderVehicleBrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rider_vehicle_brands')->delete();
        
        \DB::table('rider_vehicle_brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Toyota',
                'description' => 'toyota',
                'image' => '2025-09-08-68be6384ef1fa.png',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-08 05:03:00',
                'updated_at' => '2025-09-08 05:03:00',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Honda',
                'description' => 'honda',
                'image' => '2025-09-08-68be63997fa59.png',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-08 05:03:21',
                'updated_at' => '2025-09-08 05:03:21',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Ford',
                'description' => 'ford',
                'image' => '2025-09-08-68be63b3d6d9f.png',
                'is_active' => 0,
                'deleted_at' => NULL,
                'created_at' => '2025-09-08 05:03:47',
                'updated_at' => '2025-09-15 18:05:04',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'test',
                'description' => 'test description',
                'image' => '2025-09-11-68c2675f8f54e.png',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-11 12:08:31',
                'updated_at' => '2025-09-11 12:08:31',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Background color and image placeholder will be like Figma in Vehicle Brand, category, and model.Background color and image placeholder will be like Figma in Vehicle Brand, category, and model.Background color and image placeholder will be like Figma in Ve',
                'description' => 'Background color and image placeholder will be like Figma in Vehicle Brand, category, and model.Background color and image placeholder will be like Figma in Vehicle Brand, category, and model.',
                'image' => '2025-09-16-68c8f59c70907.png',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2025-09-16 11:29:00',
                'updated_at' => '2025-09-16 11:36:29',
            ),
        ));
        
        
    }
}