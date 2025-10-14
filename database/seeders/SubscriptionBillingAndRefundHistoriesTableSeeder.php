<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubscriptionBillingAndRefundHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subscription_billing_and_refund_histories')->delete();
        
        \DB::table('subscription_billing_and_refund_histories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'store_id' => 8,
                'subscription_id' => 10,
                'package_id' => 6,
                'transaction_type' => 'refund',
                'amount' => 1490.0,
                'is_success' => 1,
                'reference' => 'validity_left_149',
                'created_at' => '2025-09-24 16:52:39',
                'updated_at' => '2025-09-24 16:52:39',
                'module_type' => 'service',
            ),
            1 => 
            array (
                'id' => 2,
                'store_id' => 8,
                'subscription_id' => 12,
                'package_id' => 6,
                'transaction_type' => 'pending_bill',
                'amount' => 300.0,
                'is_success' => 0,
                'reference' => NULL,
                'created_at' => '2025-09-24 17:40:19',
                'updated_at' => '2025-09-24 17:40:19',
                'module_type' => 'default',
            ),
            2 => 
            array (
                'id' => 3,
                'store_id' => 8,
                'subscription_id' => 14,
                'package_id' => 6,
                'transaction_type' => 'refund',
                'amount' => 230.0,
                'is_success' => 1,
                'reference' => 'validity_left_23',
                'created_at' => '2025-10-05 15:50:03',
                'updated_at' => '2025-10-05 15:50:03',
                'module_type' => 'service',
            ),
            3 => 
            array (
                'id' => 4,
                'store_id' => 8,
                'subscription_id' => 14,
                'package_id' => 6,
                'transaction_type' => 'refund',
                'amount' => 1180.0,
                'is_success' => 1,
                'reference' => 'validity_left_118',
                'created_at' => '2025-10-07 10:29:57',
                'updated_at' => '2025-10-07 10:29:57',
                'module_type' => 'service',
            ),
            4 => 
            array (
                'id' => 5,
                'store_id' => 8,
                'subscription_id' => 14,
                'package_id' => 6,
                'transaction_type' => 'refund',
                'amount' => 290.0,
                'is_success' => 1,
                'reference' => 'validity_left_29',
                'created_at' => '2025-10-07 14:06:32',
                'updated_at' => '2025-10-07 14:06:32',
                'module_type' => 'service',
            ),
            5 => 
            array (
                'id' => 6,
                'store_id' => 7,
                'subscription_id' => 26,
                'package_id' => 6,
                'transaction_type' => 'refund',
                'amount' => 290.0,
                'is_success' => 1,
                'reference' => 'validity_left_29',
                'created_at' => '2025-10-12 16:43:46',
                'updated_at' => '2025-10-12 16:43:46',
                'module_type' => 'service',
            ),
        ));
        
        
    }
}