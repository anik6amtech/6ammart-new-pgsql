<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProviderEmployeesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('provider_employees')->delete();
        
        \DB::table('provider_employees')->insert(array (
            0 => 
            array (
                'id' => 1,
                'provider_id' => 8,
                'provider_role_id' => 1,
                'f_name' => 'Octavia',
                'l_name' => 'Kerr',
                'email' => 'cc@gmail.com',
                'phone' => '+1 683-456-4182',
                'password' => '$2y$10$USZPXJCHNcJ9YWZ0oiK0Q.pv1hOE.JjcFlsvEMYkUH.fC8aiCa0OK',
                'image' => '2025-09-23-68d2398c362d2.png',
                'status' => 1,
                'remember_token' => 'LSkJtEz6XOp0hrPrxKNbDXxOBMgnXfSRARvzIprSCCdMXnC2zb6L2shzEDYT',
                'firebase_token' => NULL,
                'auth_token' => NULL,
                'is_logged_in' => 1,
                'created_at' => '2025-09-23 12:09:16',
                'updated_at' => '2025-09-23 12:09:16',
            ),
        ));
        
        
    }
}