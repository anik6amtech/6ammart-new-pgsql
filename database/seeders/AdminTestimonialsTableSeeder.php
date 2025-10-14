<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminTestimonialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_testimonials')->delete();
        
        \DB::table('admin_testimonials')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Jane Cooper',
                'designation' => 'President of Sales',
                'review' => 'This application is well organized & I think they have listened to their customer\'s wishes. Layout very well, easy to use. This application saves a lot of time because it is comprehensive and everything you need to set it up as a multi-vendor system.',
                'reviewer_image' => '2023-06-11-64859721539c6.png',
                'company_image' => '2023-06-11-6485972158a4b.png',
                'status' => 0,
                'created_at' => '2023-06-11 15:42:57',
                'updated_at' => '2024-11-16 17:45:29',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Devon Lane',
                'designation' => 'Nursing Assistant',
                'review' => 'Wonderful experience with 6amTech. What actually i was looking for multivendor app for my delivery project. You made it everything with your well organized app and quality of the code, in customer service, support & Admin Panel which is perfect to me',
                'reviewer_image' => '2024-11-16-6738857be9bc6.png',
                'company_image' => '2024-11-16-6738857bea66f.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:46:43',
                'updated_at' => '2024-11-16 17:43:55',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Darrell Steward',
                'designation' => 'President of Sales',
                'review' => 'The best in the business. With 6amMart, I\'ve just reinvented the way of online ordering and delivery system. The readymade & highly responsive mobile apps helps me to manage my business effectively. Long live 6amTech and Prosper!',
                'reviewer_image' => '2024-11-16-673885a5b1564.png',
                'company_image' => '2024-11-16-673885a5b2c45.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:50:07',
                'updated_at' => '2024-11-16 17:44:37',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Liam Carter',
                'designation' => 'Trainer',
            'review' => 'This is a complete package! I\'m running a multivendor (food, grocery) online ordering and delivery business with it very smoothly. Seeing the revenue that I never thought of! Thank you 6amTech, keep doing the good work! Trainer',
                'reviewer_image' => '2024-11-16-673885cc2ecf7.png',
                'company_image' => '2024-11-16-673885cc2f60c.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:51:33',
                'updated_at' => '2024-11-16 17:46:21',
            ),
        ));
        
        
    }
}