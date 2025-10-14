<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleReviewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vehicle_reviews')->delete();
        
        \DB::table('vehicle_reviews')->insert(array (
            0 => 
            array (
                'id' => 1,
                'provider_id' => 64,
                'module_id' => 6,
                'user_id' => 26,
                'trip_id' => 100015,
                'vehicle_id' => 16,
                'vehicle_identity_id' => 45,
                'rating' => 5,
                'comment' => '"The booking process was so simple, and the car was in excellent condition. The driver was professional and friendly. I highly recommend using this service!"
— Sarah L.',
                'attachment' => '[]',
                'status' => 1,
                'reply' => '"Thank you, David! We\'re glad you were impressed with the luxury experience. We aim to provide a premium service for every occasion. Looking forward to your next booking!"',
                'review_id' => '100015',
                'replied_at' => '2025-02-06 17:59:46',
                'created_at' => '2025-02-06 17:15:39',
                'updated_at' => '2025-02-06 17:59:46',
            ),
            1 => 
            array (
                'id' => 2,
                'provider_id' => 64,
                'module_id' => 6,
                'user_id' => 26,
                'trip_id' => 100024,
                'vehicle_id' => 16,
                'vehicle_identity_id' => 45,
                'rating' => 5,
                'comment' => '"I booked a minivan for a family trip, and it was perfect! The ride was comfortable, and the driver knew all the best routes to avoid traffic. A fantastic experience!"
— John M.',
                'attachment' => '[]',
                'status' => 1,
                'reply' => '"We appreciate your positive review, Olivia! We’re so glad you enjoyed the Tesla. We’re all about providing green and efficient travel options. See you again soon!"',
                'review_id' => '100024',
                'replied_at' => '2025-02-06 17:59:35',
                'created_at' => '2025-02-06 17:16:25',
                'updated_at' => '2025-02-06 17:59:35',
            ),
            2 => 
            array (
                'id' => 3,
                'provider_id' => 64,
                'module_id' => 6,
                'user_id' => 28,
                'trip_id' => 100030,
                'vehicle_id' => 16,
                'vehicle_identity_id' => 45,
                'rating' => 5,
                'comment' => '"Great service! The vehicle arrived on time, and the driver was very courteous. It made our trip to the airport stress-free!"
— Emma R.',
                'attachment' => '[]',
                'status' => 1,
                'reply' => '"Thank you for your feedback, Michael. We apologize for the delay and understand how important timeliness is. We are taking steps to ensure our drivers are more punctual in the future. We appreciate your understanding!"',
                'review_id' => '100030',
                'replied_at' => '2025-02-06 17:59:25',
                'created_at' => '2025-02-06 17:20:19',
                'updated_at' => '2025-02-06 17:59:25',
            ),
            3 => 
            array (
                'id' => 4,
                'provider_id' => 60,
                'module_id' => 6,
                'user_id' => 28,
                'trip_id' => 100031,
                'vehicle_id' => 6,
                'vehicle_identity_id' => 18,
                'rating' => 5,
                'comment' => '"Booked a luxury car for a business event, and it was top-notch. The car was clean, and the driver was punctual. Worth every penny!"',
                'attachment' => '[]',
                'status' => 1,
                'reply' => NULL,
                'review_id' => '100031',
                'replied_at' => NULL,
                'created_at' => '2025-02-06 17:23:27',
                'updated_at' => '2025-02-06 17:23:27',
            ),
            4 => 
            array (
                'id' => 5,
                'provider_id' => 66,
                'module_id' => 6,
                'user_id' => 21,
                'trip_id' => 100032,
                'vehicle_id' => 17,
                'vehicle_identity_id' => 47,
                'rating' => 5,
                'comment' => '"I rented a Tesla, and I couldn’t be happier! Fast booking, great ride, and eco-friendly – definitely recommend it!"',
                'attachment' => '[]',
                'status' => 1,
                'reply' => NULL,
                'review_id' => '100032',
                'replied_at' => NULL,
                'created_at' => '2025-02-06 17:42:27',
                'updated_at' => '2025-02-06 17:42:27',
            ),
            5 => 
            array (
                'id' => 6,
                'provider_id' => 64,
                'module_id' => 6,
                'user_id' => 21,
                'trip_id' => 100034,
                'vehicle_id' => 16,
                'vehicle_identity_id' => 45,
                'rating' => 5,
                'comment' => '"The car was fine, but the driver was late. It was still a decent experience overall, but I hope punctuality improves."',
                'attachment' => '[]',
                'status' => 1,
                'reply' => '"Thank you so much for your wonderful review, Mia! We’re thrilled to be your go-to taxi service. We strive to make every ride hassle-free and affordable. We can’t wait to serve you again!"',
                'review_id' => '100034',
                'replied_at' => '2025-02-06 17:59:15',
                'created_at' => '2025-02-06 17:54:59',
                'updated_at' => '2025-02-06 17:59:15',
            ),
            6 => 
            array (
                'id' => 7,
                'provider_id' => 67,
                'module_id' => 6,
                'user_id' => 8,
                'trip_id' => 100037,
                'vehicle_id' => 1,
                'vehicle_identity_id' => 1,
                'rating' => 4,
                'comment' => 'Driver behaviour and overall vehicles conditions is good.',
                'attachment' => '[]',
                'status' => 1,
                'reply' => NULL,
                'review_id' => '100037',
                'replied_at' => NULL,
                'created_at' => '2025-02-08 12:50:12',
                'updated_at' => '2025-02-08 12:50:12',
            ),
        ));
        
        
    }
}