<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideSafetyPrecautionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_safety_precautions')->delete();
        
        \DB::table('ride_safety_precautions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'for_whom' => '["driver"]',
                'title' => 'Check Trip Route Regularly',
                'description' => 'Keep an eye on the route within the app to ensure you’re heading in the right direction. Double-check the driver’s name, vehicle model, and license pl',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:45:58',
                'updated_at' => '2025-09-04 03:45:58',
            ),
            1 => 
            array (
                'id' => 2,
                'for_whom' => '["customer", "driver"]',
                'title' => 'Trust Your Instincts',
                'description' => 'The cost of taxi booking app development varies based on the package you choose. Also, additional costs can add up depending on the level of customiza',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:46:33',
                'updated_at' => '2025-09-04 03:46:33',
            ),
            2 => 
            array (
                'id' => 3,
                'for_whom' => '["customer"]',
                'title' => 'Verify Driver and Vehicle Details',
                'description' => 'Double-check the driver’s name, vehicle model, and license plate before starting your trip.',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:46:51',
                'updated_at' => '2025-09-04 03:46:51',
            ),
        ));
        
        
    }
}