<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferralDriversTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('referral_drivers')->delete();
        
        \DB::table('referral_drivers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'driver_id' => 14,
                'ref_by' => 9,
                'ref_by_earning_amount' => 20.0,
                'driver_earning_amount' => 50.0,
                'is_used' => 1,
                'created_at' => '2025-09-16 15:03:24',
                'updated_at' => '2025-09-16 15:03:24',
            ),
            1 => 
            array (
                'id' => 2,
                'driver_id' => 19,
                'ref_by' => 9,
                'ref_by_earning_amount' => 20.0,
                'driver_earning_amount' => 50.0,
                'is_used' => 1,
                'created_at' => '2025-10-05 17:53:22',
                'updated_at' => '2025-10-05 17:53:22',
            ),
            2 => 
            array (
                'id' => 3,
                'driver_id' => 20,
                'ref_by' => 9,
                'ref_by_earning_amount' => 20.0,
                'driver_earning_amount' => 50.0,
                'is_used' => 1,
                'created_at' => '2025-10-08 16:01:26',
                'updated_at' => '2025-10-08 16:01:26',
            ),
            3 => 
            array (
                'id' => 4,
                'driver_id' => 21,
                'ref_by' => 9,
                'ref_by_earning_amount' => 20.0,
                'driver_earning_amount' => 50.0,
                'is_used' => 1,
                'created_at' => '2025-10-09 15:57:45',
                'updated_at' => '2025-10-09 15:57:45',
            ),
        ));
        
        
    }
}