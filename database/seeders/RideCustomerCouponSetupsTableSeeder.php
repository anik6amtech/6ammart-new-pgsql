<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RideCustomerCouponSetupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ride_customer_coupon_setups')->delete();
        
        \DB::table('ride_customer_coupon_setups')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'coupon_setup_id' => 2,
                'limit_per_user' => 0,
            ),
            1 => 
            array (
                'user_id' => 1,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            2 => 
            array (
                'user_id' => 1,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            3 => 
            array (
                'user_id' => 2,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            4 => 
            array (
                'user_id' => 2,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            5 => 
            array (
                'user_id' => 2,
                'coupon_setup_id' => 7,
                'limit_per_user' => 0,
            ),
            6 => 
            array (
                'user_id' => 3,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            7 => 
            array (
                'user_id' => 3,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            8 => 
            array (
                'user_id' => 4,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            9 => 
            array (
                'user_id' => 4,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            10 => 
            array (
                'user_id' => 5,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            11 => 
            array (
                'user_id' => 5,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            12 => 
            array (
                'user_id' => 6,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            13 => 
            array (
                'user_id' => 6,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            14 => 
            array (
                'user_id' => 7,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            15 => 
            array (
                'user_id' => 7,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            16 => 
            array (
                'user_id' => 8,
                'coupon_setup_id' => 1,
                'limit_per_user' => 0,
            ),
            17 => 
            array (
                'user_id' => 8,
                'coupon_setup_id' => 3,
                'limit_per_user' => 0,
            ),
            18 => 
            array (
                'user_id' => 8,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            19 => 
            array (
                'user_id' => 8,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            20 => 
            array (
                'user_id' => 9,
                'coupon_setup_id' => 1,
                'limit_per_user' => 0,
            ),
            21 => 
            array (
                'user_id' => 9,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            22 => 
            array (
                'user_id' => 9,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            23 => 
            array (
                'user_id' => 10,
                'coupon_setup_id' => 1,
                'limit_per_user' => 0,
            ),
            24 => 
            array (
                'user_id' => 10,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            25 => 
            array (
                'user_id' => 10,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            26 => 
            array (
                'user_id' => 11,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            27 => 
            array (
                'user_id' => 11,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            28 => 
            array (
                'user_id' => 12,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            29 => 
            array (
                'user_id' => 12,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            30 => 
            array (
                'user_id' => 13,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            31 => 
            array (
                'user_id' => 13,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            32 => 
            array (
                'user_id' => 14,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            33 => 
            array (
                'user_id' => 14,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            34 => 
            array (
                'user_id' => 15,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            35 => 
            array (
                'user_id' => 15,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            36 => 
            array (
                'user_id' => 16,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            37 => 
            array (
                'user_id' => 16,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            38 => 
            array (
                'user_id' => 17,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            39 => 
            array (
                'user_id' => 17,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            40 => 
            array (
                'user_id' => 18,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            41 => 
            array (
                'user_id' => 18,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            42 => 
            array (
                'user_id' => 19,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            43 => 
            array (
                'user_id' => 19,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            44 => 
            array (
                'user_id' => 20,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            45 => 
            array (
                'user_id' => 20,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            46 => 
            array (
                'user_id' => 21,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            47 => 
            array (
                'user_id' => 21,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            48 => 
            array (
                'user_id' => 22,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            49 => 
            array (
                'user_id' => 22,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            50 => 
            array (
                'user_id' => 23,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            51 => 
            array (
                'user_id' => 23,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            52 => 
            array (
                'user_id' => 24,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            53 => 
            array (
                'user_id' => 24,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            54 => 
            array (
                'user_id' => 25,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            55 => 
            array (
                'user_id' => 25,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            56 => 
            array (
                'user_id' => 26,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            57 => 
            array (
                'user_id' => 26,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            58 => 
            array (
                'user_id' => 28,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            59 => 
            array (
                'user_id' => 28,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            60 => 
            array (
                'user_id' => 29,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            61 => 
            array (
                'user_id' => 29,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            62 => 
            array (
                'user_id' => 30,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            63 => 
            array (
                'user_id' => 30,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            64 => 
            array (
                'user_id' => 31,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            65 => 
            array (
                'user_id' => 31,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            66 => 
            array (
                'user_id' => 32,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            67 => 
            array (
                'user_id' => 32,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            68 => 
            array (
                'user_id' => 33,
                'coupon_setup_id' => 1,
                'limit_per_user' => 0,
            ),
            69 => 
            array (
                'user_id' => 33,
                'coupon_setup_id' => 3,
                'limit_per_user' => 0,
            ),
            70 => 
            array (
                'user_id' => 33,
                'coupon_setup_id' => 4,
                'limit_per_user' => 0,
            ),
            71 => 
            array (
                'user_id' => 33,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            72 => 
            array (
                'user_id' => 33,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
            73 => 
            array (
                'user_id' => 34,
                'coupon_setup_id' => 5,
                'limit_per_user' => 0,
            ),
            74 => 
            array (
                'user_id' => 34,
                'coupon_setup_id' => 6,
                'limit_per_user' => 0,
            ),
        ));
        
        
    }
}