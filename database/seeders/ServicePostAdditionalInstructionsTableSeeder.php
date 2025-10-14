<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicePostAdditionalInstructionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_post_additional_instructions')->delete();
        
        \DB::table('service_post_additional_instructions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'details' => 'fedf',
                'post_id' => 1,
                'created_at' => '2025-09-07 10:54:05',
                'updated_at' => '2025-09-07 10:54:05',
            ),
            1 => 
            array (
                'id' => 2,
                'details' => 'StackFood - React User Website - CodeCanyon Item for Sale
Live Preview Screenshots',
                'post_id' => 2,
                'created_at' => '2025-09-09 12:36:54',
                'updated_at' => '2025-09-09 12:36:54',
            ),
            2 => 
            array (
                'id' => 3,
                'details' => 'StackFood - React User Website - CodeCanyon Item for Sale
Live Preview Screenshots
Introducing the React User Website for StackFood Multi Restaurant – Food Delivery',
                'post_id' => 3,
                'created_at' => '2025-09-09 14:44:47',
                'updated_at' => '2025-09-09 14:44:47',
            ),
            3 => 
            array (
                'id' => 4,
                'details' => 'dfsfd',
                'post_id' => 7,
                'created_at' => '2025-09-17 09:44:43',
                'updated_at' => '2025-09-17 09:44:43',
            ),
        ));
        
        
    }
}