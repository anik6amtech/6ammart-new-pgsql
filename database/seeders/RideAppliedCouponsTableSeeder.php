<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideAppliedCouponsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_applied_coupons')->delete();
        
        \DB::table('ride_applied_coupons')->insert(array (
            0 => 
            array (
                'id' => 3,
                'coupon_setup_id' => 1,
                'user_id' => 10,
                'created_at' => '2025-09-08 10:10:47',
                'updated_at' => '2025-09-08 10:10:47',
            ),
            1 => 
            array (
                'id' => 32,
                'coupon_setup_id' => 3,
                'user_id' => 33,
                'created_at' => '2025-10-10 11:41:34',
                'updated_at' => '2025-10-10 11:41:34',
            ),
            2 => 
            array (
                'id' => 42,
                'coupon_setup_id' => 7,
                'user_id' => 38,
                'created_at' => '2025-10-13 10:34:20',
                'updated_at' => '2025-10-13 10:34:20',
            ),
        ));
        
        
    }
}