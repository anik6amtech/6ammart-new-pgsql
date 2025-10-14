<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DMVehiclesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('d_m_vehicles')->delete();
        
        \DB::table('d_m_vehicles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type' => 'Bicycle',
                'starting_coverage_area' => 0.0,
                'maximum_coverage_area' => 1000.0,
                'extra_charges' => 50.0,
                'status' => 1,
                'created_at' => '2023-03-15 21:27:17',
                'updated_at' => '2023-03-15 21:28:38',
            ),
            1 => 
            array (
                'id' => 2,
                'type' => 'Bike',
                'starting_coverage_area' => 1001.0,
                'maximum_coverage_area' => 5000.0,
                'extra_charges' => 100.0,
                'status' => 1,
                'created_at' => '2023-03-15 21:29:08',
                'updated_at' => '2023-03-15 21:29:08',
            ),
        ));
        
        
    }
}