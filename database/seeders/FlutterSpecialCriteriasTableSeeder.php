<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FlutterSpecialCriteriasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('flutter_special_criterias')->delete();
        
        \DB::table('flutter_special_criterias')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Trusted by customers & sellers',
                'image' => '2024-11-19-673c96f840528.png',
                'status' => 1,
                'created_at' => '2023-06-12 18:02:33',
                'updated_at' => '2024-11-19 13:47:36',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Thousands of stores',
                'image' => '2024-11-19-673c9710c471c.png',
                'status' => 1,
                'created_at' => '2023-06-12 18:04:32',
                'updated_at' => '2024-11-19 13:48:00',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Excellent Shopping Experience',
                'image' => '2024-11-19-673c975591844.png',
                'status' => 1,
                'created_at' => '2023-06-12 18:06:13',
                'updated_at' => '2024-11-19 13:49:09',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Easy Checkout & Payment system',
                'image' => '2024-11-19-673c977e9a403.png',
                'status' => 1,
                'created_at' => '2023-06-12 18:08:15',
                'updated_at' => '2024-11-19 13:49:50',
            ),
        ));
        
        
    }
}