<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleWiseBannersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('module_wise_banners')->delete();
        
        \DB::table('module_wise_banners')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 4,
                'key' => 'best_reviewed_section_banner',
                'value' => '2024-11-17-6739d2feadd54.png',
                'type' => 'promotional_banner',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2024-11-17 17:26:54',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 1,
                'key' => 'best_reviewed_section_banner',
                'value' => '2023-10-19-6530b366ef47b.png',
                'type' => 'promotional_banner',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => 1,
                'key' => 'bottom_section_banner',
                'value' => '2024-11-17-6739a8421c877.png',
                'type' => 'promotional_banner',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2024-11-17 14:24:34',
            ),
            3 => 
            array (
                'id' => 4,
                'module_id' => 2,
                'key' => 'basic_section_nearby',
                'value' => '2023-10-19-6530c6b27dafc.png',
                'type' => 'promotional_banner',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'module_id' => 2,
                'key' => 'bottom_section_banner',
                'value' => '2024-11-17-67396dee1c2c1.png',
                'type' => 'promotional_banner',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2024-11-17 10:15:42',
            ),
            5 => 
            array (
                'id' => 6,
                'module_id' => 3,
                'key' => 'best_reviewed_section_banner',
                'value' => '2023-10-19-6530d3a9e78af.png',
                'type' => 'promotional_banner',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'module_id' => 3,
                'key' => 'new_arrival_section_banner',
                'value' => '2024-10-29-672099296b4d5.png',
                'type' => 'promotional_banner',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2024-10-29 14:13:29',
            ),
            7 => 
            array (
                'id' => 8,
                'module_id' => 3,
                'key' => 'bottom_section_banner',
                'value' => '2024-11-17-673971d1587eb.png',
                'type' => 'promotional_banner',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2024-11-17 10:32:17',
            ),
            8 => 
            array (
                'id' => 9,
                'module_id' => 5,
                'key' => 'promotional_banner',
                'value' => '2024-11-17-6739a451efd6f.png',
                'type' => 'promotional_banner',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2024-11-17 14:07:45',
            ),
            9 => 
            array (
                'id' => 10,
                'module_id' => 5,
                'key' => 'content1_title',
                'value' => 'Select the service',
                'type' => 'video_banner_content',
                'status' => 1,
                'created_at' => '2023-10-19 13:08:46',
                'updated_at' => '2023-10-19 13:08:46',
            ),
            10 => 
            array (
                'id' => 11,
                'module_id' => 5,
                'key' => 'content1_subtitle',
                'value' => 'Choose the parcel service you need from our easy options.',
                'type' => 'video_banner_content',
                'status' => 1,
                'created_at' => '2023-10-19 13:08:46',
                'updated_at' => '2024-11-04 10:14:08',
            ),
            11 => 
            array (
                'id' => 12,
                'module_id' => 5,
                'key' => 'content2_title',
                'value' => 'Fill in the information',
                'type' => 'video_banner_content',
                'status' => 1,
                'created_at' => '2023-10-19 13:08:46',
                'updated_at' => '2023-10-19 13:08:46',
            ),
            12 => 
            array (
                'id' => 13,
                'module_id' => 5,
                'key' => 'content2_subtitle',
                'value' => 'Enter delivery details, pick-up time, and location info.',
                'type' => 'video_banner_content',
                'status' => 1,
                'created_at' => '2023-10-19 13:08:46',
                'updated_at' => '2024-11-04 10:14:08',
            ),
            13 => 
            array (
                'id' => 14,
                'module_id' => 5,
                'key' => 'content3_title',
                'value' => 'And now wait for the delivery!',
                'type' => 'video_banner_content',
                'status' => 1,
                'created_at' => '2023-10-19 13:08:46',
                'updated_at' => '2023-10-19 13:08:46',
            ),
            14 => 
            array (
                'id' => 15,
                'module_id' => 5,
                'key' => 'content3_subtitle',
                'value' => 'Relax! Your parcel is on the way with real-time tracking.',
                'type' => 'video_banner_content',
                'status' => 1,
                'created_at' => '2023-10-19 13:08:46',
                'updated_at' => '2024-11-04 10:14:08',
            ),
            15 => 
            array (
                'id' => 16,
                'module_id' => 5,
                'key' => 'section_title',
                'value' => 'Easiest Way Section',
                'type' => 'video_banner_content',
                'status' => 1,
                'created_at' => '2023-10-19 13:16:25',
                'updated_at' => '2024-11-04 10:15:45',
            ),
            16 => 
            array (
                'id' => 17,
                'module_id' => 5,
                'key' => 'banner_type',
                'value' => 'video_content',
                'type' => 'video_banner_content',
                'status' => 1,
                'created_at' => '2023-10-19 13:16:25',
                'updated_at' => '2024-01-02 17:45:57',
            ),
            17 => 
            array (
                'id' => 18,
                'module_id' => 5,
                'key' => 'banner_video',
                'value' => 'https://www.youtube.com/watch?v=s8m6oHByjjI',
                'type' => 'video_banner_content',
                'status' => 1,
                'created_at' => '2023-10-19 13:16:25',
                'updated_at' => '2024-01-02 17:44:38',
            ),
            18 => 
            array (
                'id' => 19,
                'module_id' => 5,
                'key' => 'banner_image',
                'value' => '2023-10-19-6530d7c943c7c.png',
                'type' => 'video_banner_content',
                'status' => 1,
                'created_at' => '2023-10-19 13:16:25',
                'updated_at' => '2023-10-19 13:16:25',
            ),
            19 => 
            array (
                'id' => 20,
                'module_id' => 5,
                'key' => 'banner_video_content',
                'value' => '2024-11-04-67286d4cf23a5.mp4',
                'type' => 'video_banner_content',
                'status' => 1,
                'created_at' => '2023-12-26 20:10:00',
                'updated_at' => '2024-11-04 12:44:28',
            ),
            20 => 
            array (
                'id' => 21,
                'module_id' => 5,
                'key' => 'promotional_banner',
                'value' => '2024-11-04-672890809e726.png',
                'type' => 'promotional_banner',
                'status' => 1,
                'created_at' => '2024-11-04 12:01:50',
                'updated_at' => '2024-11-04 15:14:40',
            ),
        ));
        
        
    }
}