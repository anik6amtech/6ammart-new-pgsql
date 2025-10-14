<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideCustomerDiscountSetupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_customer_discount_setups')->delete();
        
        \DB::table('ride_customer_discount_setups')->insert(array (
            0 => 
            array (
                'user_id' => 8,
                'discount_setup_id' => 1,
                'limit_per_user' => 0,
            ),
            1 => 
            array (
                'user_id' => 9,
                'discount_setup_id' => 1,
                'limit_per_user' => 0,
            ),
            2 => 
            array (
                'user_id' => 10,
                'discount_setup_id' => 1,
                'limit_per_user' => 0,
            ),
            3 => 
            array (
                'user_id' => 11,
                'discount_setup_id' => 1,
                'limit_per_user' => 0,
            ),
            4 => 
            array (
                'user_id' => 21,
                'discount_setup_id' => 2,
                'limit_per_user' => 0,
            ),
            5 => 
            array (
                'user_id' => 24,
                'discount_setup_id' => 1,
                'limit_per_user' => 0,
            ),
            6 => 
            array (
                'user_id' => 33,
                'discount_setup_id' => 2,
                'limit_per_user' => 0,
            ),
            7 => 
            array (
                'user_id' => 33,
                'discount_setup_id' => 3,
                'limit_per_user' => 0,
            ),
        ));
        
        
    }
}