<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceProviderSchedulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_provider_schedules')->delete();
        
        \DB::table('service_provider_schedules')->insert(array (
            0 => 
            array (
                'id' => 2,
                'service_provider_id' => 8,
                'day' => 5,
                'opening_time' => '03:52:00',
                'closing_time' => '15:52:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 6,
                'service_provider_id' => 1,
                'day' => 5,
                'opening_time' => '06:00:00',
                'closing_time' => '18:00:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}