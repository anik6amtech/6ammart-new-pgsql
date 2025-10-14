<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideSafetyAlertReasonsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_safety_alert_reasons')->delete();
        
        \DB::table('ride_safety_alert_reasons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'reason' => 'Lost item reported: Passenger\'s phone left on the backseat',
                'reason_for_whom' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:43:40',
                'updated_at' => '2025-09-04 03:43:40',
            ),
            1 => 
            array (
                'id' => 2,
                'reason' => 'Driver stopped to pick up items unrelated to the trip.',
                'reason_for_whom' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:43:47',
                'updated_at' => '2025-09-04 03:43:47',
            ),
            2 => 
            array (
                'id' => 3,
                'reason' => 'System flagged that a passenger may have been left at the wrong location.',
                'reason_for_whom' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:43:54',
                'updated_at' => '2025-09-04 03:43:54',
            ),
            3 => 
            array (
                'id' => 4,
                'reason' => 'Vehicle entered a construction zone without proper notification.',
                'reason_for_whom' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:44:00',
                'updated_at' => '2025-09-04 03:44:00',
            ),
            4 => 
            array (
                'id' => 5,
                'reason' => 'Driver allowed an additional rider without authorization.',
                'reason_for_whom' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:44:16',
                'updated_at' => '2025-09-04 03:44:16',
            ),
            5 => 
            array (
                'id' => 6,
                'reason' => 'Abrupt braking was recorded by the system, indicating a potential risk',
                'reason_for_whom' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:44:24',
                'updated_at' => '2025-09-04 03:44:24',
            ),
            6 => 
            array (
                'id' => 7,
                'reason' => 'Abrupt braking was recorded by the system, indicating a potential risk',
                'reason_for_whom' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:44:34',
                'updated_at' => '2025-09-04 03:44:34',
            ),
            7 => 
            array (
                'id' => 8,
                'reason' => 'The vehicle exceeded the predefined speed limits',
                'reason_for_whom' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:44:44',
                'updated_at' => '2025-09-04 03:44:44',
            ),
            8 => 
            array (
                'id' => 9,
                'reason' => 'The vehicle has remained stationary for an unusual period',
                'reason_for_whom' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:44:54',
                'updated_at' => '2025-09-04 03:44:54',
            ),
            9 => 
            array (
                'id' => 10,
                'reason' => 'The driver strayed significantly from the assigned route',
                'reason_for_whom' => 'customer',
                'is_active' => 1,
                'created_at' => '2025-09-04 03:45:05',
                'updated_at' => '2025-09-04 03:45:21',
            ),
        ));
        
        
    }
}