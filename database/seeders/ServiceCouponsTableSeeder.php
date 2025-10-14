<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceCouponsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_coupons')->delete();
        
        \DB::table('service_coupons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 8,
                'coupon_type' => 'default',
                'coupon_code' => 'SMILE10',
                'discount_id' => 3,
                'is_active' => 1,
                'created_at' => '2025-09-09 11:57:40',
                'updated_at' => '2025-09-09 11:57:40',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 8,
                'coupon_type' => 'default',
                'coupon_code' => '6ammart',
                'discount_id' => 4,
                'is_active' => 1,
                'created_at' => '2025-09-10 16:46:12',
                'updated_at' => '2025-09-10 16:46:12',
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => 8,
                'coupon_type' => 'first_booking',
                'coupon_code' => '2626',
                'discount_id' => 6,
                'is_active' => 1,
                'created_at' => '2025-09-28 11:22:12',
                'updated_at' => '2025-09-28 11:22:12',
            ),
            3 => 
            array (
                'id' => 4,
                'module_id' => 8,
                'coupon_type' => 'default',
                'coupon_code' => 'Esse mollitia neque',
                'discount_id' => 7,
                'is_active' => 1,
                'created_at' => '2025-09-28 15:31:30',
                'updated_at' => '2025-09-28 15:31:30',
            ),
            4 => 
            array (
                'id' => 5,
                'module_id' => 8,
                'coupon_type' => 'customer_wise',
                'coupon_code' => '54364',
                'discount_id' => 12,
                'is_active' => 1,
                'created_at' => '2025-10-06 16:05:19',
                'updated_at' => '2025-10-06 16:05:19',
            ),
            5 => 
            array (
                'id' => 6,
                'module_id' => 8,
                'coupon_type' => 'default',
                'coupon_code' => 'TRY150',
                'discount_id' => 13,
                'is_active' => 1,
                'created_at' => '2025-10-07 17:10:07',
                'updated_at' => '2025-10-07 17:10:07',
            ),
            6 => 
            array (
                'id' => 7,
                'module_id' => 8,
                'coupon_type' => 'first_booking',
                'coupon_code' => 'Eos est tempore at',
                'discount_id' => 14,
                'is_active' => 1,
                'created_at' => '2025-10-09 18:14:10',
                'updated_at' => '2025-10-09 18:14:10',
            ),
        ));
        
        
    }
}