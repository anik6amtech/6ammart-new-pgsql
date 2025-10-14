<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceReviewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_reviews')->delete();
        
        \DB::table('service_reviews')->insert(array (
            0 => 
            array (
                'id' => 1011100,
                'module_id' => 8,
                'booking_id' => 1011,
                'service_id' => 1,
                'provider_id' => 1,
                'customer_id' => 8,
                'review_rating' => 5,
                'review_comment' => '12336',
                'review_images' => '[]',
                'booking_date' => '2025-09-07 12:27:59',
                'is_active' => 1,
                'created_at' => '2025-09-07 11:22:25',
                'updated_at' => '2025-09-07 11:22:25',
            ),
            1 => 
            array (
                'id' => 1056100,
                'module_id' => 8,
                'booking_id' => 1056,
                'service_id' => 1,
                'provider_id' => 7,
                'customer_id' => 21,
                'review_rating' => 5,
                'review_comment' => 'good service',
                'review_images' => '[]',
                'booking_date' => '2025-09-09 11:58:37',
                'is_active' => 1,
                'created_at' => '2025-09-09 12:02:32',
                'updated_at' => '2025-09-09 12:02:32',
            ),
            2 => 
            array (
                'id' => 1080100,
                'module_id' => 8,
                'booking_id' => 1080,
                'service_id' => 1,
                'provider_id' => 7,
                'customer_id' => 8,
                'review_rating' => 5,
                'review_comment' => NULL,
                'review_images' => '[]',
                'booking_date' => '2025-09-11 23:29:28',
                'is_active' => 1,
                'created_at' => '2025-09-11 23:34:30',
                'updated_at' => '2025-09-11 23:34:30',
            ),
            3 => 
            array (
                'id' => 1090100,
                'module_id' => 8,
                'booking_id' => 1090,
                'service_id' => 1,
                'provider_id' => 8,
                'customer_id' => 33,
                'review_rating' => 3,
                'review_comment' => 'goooood work',
                'review_images' => '[]',
                'booking_date' => '2025-09-21 14:59:18',
                'is_active' => 1,
                'created_at' => '2025-09-21 15:47:13',
                'updated_at' => '2025-09-21 15:47:13',
            ),
            4 => 
            array (
                'id' => 1107100,
                'module_id' => 8,
                'booking_id' => 1107,
                'service_id' => 6,
                'provider_id' => 7,
                'customer_id' => 33,
                'review_rating' => 5,
                'review_comment' => NULL,
                'review_images' => '[]',
                'booking_date' => '2025-09-23 17:15:46',
                'is_active' => 1,
                'created_at' => '2025-09-23 17:54:26',
                'updated_at' => '2025-09-23 17:54:26',
            ),
            5 => 
            array (
                'id' => 1110100,
                'module_id' => 8,
                'booking_id' => 1110,
                'service_id' => 1,
                'provider_id' => 8,
                'customer_id' => 33,
                'review_rating' => 5,
                'review_comment' => 'nice',
                'review_images' => '[]',
                'booking_date' => '2025-09-24 12:04:45',
                'is_active' => 1,
                'created_at' => '2025-09-24 15:12:36',
                'updated_at' => '2025-09-24 15:12:36',
            ),
            6 => 
            array (
                'id' => 1124100,
                'module_id' => 8,
                'booking_id' => 1124,
                'service_id' => 10,
                'provider_id' => 1,
                'customer_id' => 32,
                'review_rating' => 5,
                'review_comment' => NULL,
                'review_images' => '[]',
                'booking_date' => '2025-09-28 16:54:59',
                'is_active' => 1,
                'created_at' => '2025-09-28 17:02:24',
                'updated_at' => '2025-09-28 17:02:28',
            ),
            7 => 
            array (
                'id' => 1130100,
                'module_id' => 8,
                'booking_id' => 1130,
                'service_id' => 8,
                'provider_id' => 1,
                'customer_id' => 32,
                'review_rating' => 5,
                'review_comment' => 'uyiytity',
                'review_images' => '[]',
                'booking_date' => '2025-09-29 17:21:06',
                'is_active' => 1,
                'created_at' => '2025-10-09 15:20:13',
                'updated_at' => '2025-10-09 15:20:13',
            ),
            8 => 
            array (
                'id' => 1142100,
                'module_id' => 8,
                'booking_id' => 1142,
                'service_id' => 3,
                'provider_id' => 8,
                'customer_id' => 33,
                'review_rating' => 5,
                'review_comment' => 'uiyyuiuyiyuiouioipui',
                'review_images' => '[]',
                'booking_date' => '2025-10-05 15:52:28',
                'is_active' => 1,
                'created_at' => '2025-10-05 17:19:09',
                'updated_at' => '2025-10-05 17:19:09',
            ),
            9 => 
            array (
                'id' => 1173100,
                'module_id' => 8,
                'booking_id' => 1173,
                'service_id' => 1,
                'provider_id' => 1,
                'customer_id' => 33,
                'review_rating' => 5,
                'review_comment' => 'nice',
                'review_images' => '[]',
                'booking_date' => '2025-10-11 11:10:47',
                'is_active' => 1,
                'created_at' => '2025-10-11 12:11:35',
                'updated_at' => '2025-10-11 12:11:39',
            ),
            10 => 
            array (
                'id' => 1176100,
                'module_id' => 8,
                'booking_id' => 1176,
                'service_id' => 3,
                'provider_id' => 8,
                'customer_id' => 14,
                'review_rating' => 5,
                'review_comment' => 'testt',
                'review_images' => '[]',
                'booking_date' => '2025-10-12 12:41:57',
                'is_active' => 1,
                'created_at' => '2025-10-12 12:43:30',
                'updated_at' => '2025-10-12 12:43:30',
            ),
        ));
        
        
    }
}