<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminWalletsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_wallets')->delete();
        
        \DB::table('admin_wallets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'admin_id' => 1,
                'total_commission_earning' => '69980.75',
                'digital_received' => '64793.55',
                'manual_received' => '97476.17',
                'created_at' => '2022-09-29 10:31:14',
                'updated_at' => '2025-10-14 09:24:14',
                'delivery_charge' => '156769.940',
            ),
        ));
        
        
    }
}