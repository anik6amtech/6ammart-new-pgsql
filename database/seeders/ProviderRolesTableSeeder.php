<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProviderRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('provider_roles')->delete();
        
        \DB::table('provider_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'provider_id' => 8,
                'name' => 'Tester Pro',
                'modules' => '["promotion","service","user","report_analytics","business","employee"]',
                'status' => 1,
                'created_at' => '2025-09-23 12:08:40',
                'updated_at' => '2025-09-23 12:12:29',
            ),
        ));
        
        
    }
}