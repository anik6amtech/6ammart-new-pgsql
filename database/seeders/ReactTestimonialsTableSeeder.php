<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReactTestimonialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('react_testimonials')->delete();
        
        \DB::table('react_testimonials')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Jane Cooper',
                'designation' => 'President of Sales',
                'review' => 'This application is well organized and I think they have listened to their customer\'s wishes. Layout very well, easy to use.',
                'reviewer_image' => '2024-11-19-673c960de5337.png',
                'company_image' => 'def.png',
                'status' => 1,
                'created_at' => '2023-06-12 16:54:10',
                'updated_at' => '2024-11-19 13:43:41',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Ronald Richards',
                'designation' => 'Trainer',
                'review' => 'Wonderful experience with 6amTech. What actually i was looking for multivendor app for my delivery project.',
                'reviewer_image' => '2024-11-19-673c9625b6c5a.png',
                'company_image' => 'def.png',
                'status' => 1,
                'created_at' => '2023-06-12 16:55:08',
                'updated_at' => '2024-11-19 13:44:05',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Devon Lane',
                'designation' => 'Nursing Assistant',
                'review' => 'The best in the business. With 6amMart, I\'ve just reinvented the way of online ordering and delivery system.',
                'reviewer_image' => '2024-11-19-673c963e443d3.png',
                'company_image' => 'def.png',
                'status' => 1,
                'created_at' => '2023-06-12 16:56:02',
                'updated_at' => '2024-11-19 13:44:30',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Darrell Steward',
                'designation' => 'CTO',
            'review' => 'This is a complete package! I\'m running a multivendor (food, grocery) online ordering and delivery business with it very smoothly.',
                'reviewer_image' => '2024-11-19-673c965a1a5c3.png',
                'company_image' => 'def.png',
                'status' => 1,
                'created_at' => '2023-06-12 16:57:04',
                'updated_at' => '2024-11-19 13:44:58',
            ),
        ));
        
        
    }
}