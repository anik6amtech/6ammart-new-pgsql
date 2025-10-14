<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CashBacksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cash_backs')->delete();
        
        \DB::table('cash_backs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'First Order Cash Splash!',
                'customer_id' => '["all"]',
                'cashback_type' => 'percentage',
                'same_user_limit' => 2,
                'total_used' => 4,
                'cashback_amount' => 10.0,
                'min_purchase' => 500.0,
                'max_discount' => 100.0,
                'start_date' => '2024-04-20',
                'end_date' => '2031-12-24',
                'status' => 1,
                'created_at' => '2024-04-20 14:18:01',
                'updated_at' => '2025-10-12 15:59:10',
                'is_rental' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Get Rewarded Instantly!',
                'customer_id' => '["all"]',
                'cashback_type' => 'amount',
                'same_user_limit' => 5,
                'total_used' => 0,
                'cashback_amount' => 20.0,
                'min_purchase' => 100.0,
                'max_discount' => 0.0,
                'start_date' => '2024-04-20',
                'end_date' => '2028-12-20',
                'status' => 1,
                'created_at' => '2024-04-20 14:18:39',
                'updated_at' => '2024-04-20 14:20:41',
                'is_rental' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Get Up to $20 Cashback on Your First Ride!',
                'customer_id' => '["all"]',
                'cashback_type' => 'amount',
                'same_user_limit' => 5,
                'total_used' => 2,
                'cashback_amount' => 20.0,
                'min_purchase' => 100.0,
                'max_discount' => 0.0,
                'start_date' => '2025-02-05',
                'end_date' => '2029-07-30',
                'status' => 1,
                'created_at' => '2025-02-05 15:55:37',
                'updated_at' => '2025-02-06 17:23:07',
                'is_rental' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Earn 10% Cashback on All Rentals – Limited Time Offer!',
                'customer_id' => '["all"]',
                'cashback_type' => 'percentage',
                'same_user_limit' => 10,
                'total_used' => 9,
                'cashback_amount' => 10.0,
                'min_purchase' => 100.0,
                'max_discount' => 1000.0,
                'start_date' => '2025-02-05',
                'end_date' => '2028-12-22',
                'status' => 1,
                'created_at' => '2025-02-05 15:56:21',
                'updated_at' => '2025-10-12 18:06:21',
                'is_rental' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Enjoy $15 Cashback on Your Next Taxi Booking!',
                'customer_id' => '["all"]',
                'cashback_type' => 'amount',
                'same_user_limit' => 1,
                'total_used' => 0,
                'cashback_amount' => 15.0,
                'min_purchase' => 100.0,
                'max_discount' => 0.0,
                'start_date' => '2025-02-05',
                'end_date' => '2028-12-21',
                'status' => 1,
                'created_at' => '2025-02-05 15:56:50',
                'updated_at' => '2025-02-05 15:56:50',
                'is_rental' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Exclusive Cashback Offer: Save More on Your Next Ride!',
                'customer_id' => '["all"]',
                'cashback_type' => 'amount',
                'same_user_limit' => 1,
                'total_used' => 1,
                'cashback_amount' => 100.0,
                'min_purchase' => 200.0,
                'max_discount' => 0.0,
                'start_date' => '2025-02-05',
                'end_date' => '2029-12-20',
                'status' => 1,
                'created_at' => '2025-02-05 15:57:29',
                'updated_at' => '2025-02-08 12:49:31',
                'is_rental' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'Get Instant $10 Cashback When You Book a Full Day Rental!',
                'customer_id' => '["all"]',
                'cashback_type' => 'amount',
                'same_user_limit' => 5,
                'total_used' => 2,
                'cashback_amount' => 10.0,
                'min_purchase' => 100.0,
                'max_discount' => 0.0,
                'start_date' => '2025-02-05',
                'end_date' => '2029-07-27',
                'status' => 1,
                'created_at' => '2025-02-05 15:58:05',
                'updated_at' => '2025-02-06 17:04:22',
                'is_rental' => 1,
            ),
        ));
        
        
    }
}