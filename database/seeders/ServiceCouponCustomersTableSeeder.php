<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceCouponCustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_coupon_customers')->delete();
        
        \DB::table('service_coupon_customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => NULL,
                'coupon_id' => 5,
                'customer_user_id' => 33,
                'created_at' => '2025-10-06 16:05:19',
                'updated_at' => '2025-10-06 16:05:19',
            ),
        ));
        
        
    }
}