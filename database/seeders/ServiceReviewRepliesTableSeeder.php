<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceReviewRepliesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_review_replies')->delete();
        
        \DB::table('service_review_replies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => NULL,
                'readable_id' => NULL,
                'user_id' => 7,
                'review_id' => 1056100,
                'reply' => '77895769567',
                'created_at' => '2025-09-09 12:02:45',
                'updated_at' => '2025-09-09 12:02:45',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 8,
                'readable_id' => NULL,
                'user_id' => 1,
                'review_id' => 1011100,
                'reply' => 'thanks 😊',
                'created_at' => '2025-09-21 18:06:29',
                'updated_at' => '2025-09-28 15:44:07',
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => 8,
                'readable_id' => NULL,
                'user_id' => 8,
                'review_id' => 1090100,
                'reply' => 'Thanks',
                'created_at' => '2025-09-23 10:12:47',
                'updated_at' => '2025-09-23 10:12:47',
            ),
        ));
        
        
    }
}