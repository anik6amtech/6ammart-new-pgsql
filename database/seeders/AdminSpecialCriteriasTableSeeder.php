<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSpecialCriteriasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_special_criterias')->delete();
        
        \DB::table('admin_special_criterias')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Easy to Manage Multiple Store',
                'image' => '2024-11-16-673855f6070d0.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:31:42',
                'updated_at' => '2024-11-16 14:21:10',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Easy to Manage E-Commerce',
                'image' => '2024-11-16-67385611eb596.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:33:42',
                'updated_at' => '2024-11-16 14:21:37',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Easy to Manage Parcel Delivery',
                'image' => '2024-11-16-6738562736ba0.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:34:13',
                'updated_at' => '2024-11-16 14:21:59',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Easy to Manage Location Tracking',
                'image' => '2024-11-16-67385639bbe5d.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:34:34',
                'updated_at' => '2024-11-16 14:22:17',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Easy to Manage Grocery Business',
                'image' => '2024-11-16-6738564ce09c4.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:35:03',
                'updated_at' => '2024-11-16 14:22:36',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Easy to Get Help & Support',
                'image' => '2024-11-16-6738565f668c6.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:35:24',
                'updated_at' => '2024-11-16 14:22:55',
            ),
        ));
        
        
    }
}