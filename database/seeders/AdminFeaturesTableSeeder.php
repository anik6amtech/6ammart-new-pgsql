<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminFeaturesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_features')->delete();
        
        \DB::table('admin_features')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Trusted',
                'sub_title' => 'Trusted by customers and store owners',
                'image' => '2024-11-16-67386a2c9e9d8.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:16:41',
                'updated_at' => '2024-11-16 15:47:24',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Shopping',
                'sub_title' => 'Best shopping experience',
                'image' => '2024-11-16-67386a3c71414.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:18:16',
                'updated_at' => '2024-11-16 15:47:40',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Payment',
                'sub_title' => 'Total secured payment system',
                'image' => '2024-11-16-67386a4ce8e3f.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:22:28',
                'updated_at' => '2024-11-16 15:47:56',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Delivery',
                'sub_title' => 'Flexible delivery system',
                'image' => '2024-11-16-67386a5c12165.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:23:21',
                'updated_at' => '2024-11-16 15:48:12',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Location',
                'sub_title' => 'Location tracking system',
                'image' => '2024-11-16-67386a68bee7e.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:24:05',
                'updated_at' => '2024-11-16 15:48:24',
            ),
        ));
        
        
    }
}