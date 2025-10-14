<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminPromotionalBannersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_promotional_banners')->delete();
        
        \DB::table('admin_promotional_banners')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Find',
                'sub_title' => 'your daily grocery item',
                'image' => '2024-11-16-67385c331a176.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:57:15',
                'updated_at' => '2024-11-16 14:47:47',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Find',
                'sub_title' => 'your daily shopping items',
                'image' => '2024-11-16-67385b5910c2a.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:58:23',
                'updated_at' => '2024-11-16 14:44:09',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Find',
                'sub_title' => 'your daily medicines',
                'image' => '2024-11-16-67385c73f21b7.png',
                'status' => 1,
                'created_at' => '2023-06-11 15:59:11',
                'updated_at' => '2024-11-16 14:48:51',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Find',
                'sub_title' => 'your parcel service',
                'image' => '2024-11-16-67385cff1ca69.png',
                'status' => 1,
                'created_at' => '2023-06-11 16:00:38',
                'updated_at' => '2024-11-16 14:51:11',
            ),
        ));
        
        
    }
}