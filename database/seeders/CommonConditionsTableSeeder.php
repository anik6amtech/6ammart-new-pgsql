<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommonConditionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('common_conditions')->delete();
        
        \DB::table('common_conditions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Fever & Pain',
                'slug' => 'fever-pain',
                'status' => 1,
                'created_at' => '2023-10-19 12:08:46',
                'updated_at' => '2023-10-19 12:08:46',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Oral Care',
                'slug' => 'diabetes',
                'status' => 1,
                'created_at' => '2023-10-19 12:08:57',
                'updated_at' => '2024-11-05 17:55:09',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Eye & Ear',
                'slug' => 'eye-ear',
                'status' => 1,
                'created_at' => '2023-10-19 12:09:06',
                'updated_at' => '2023-10-19 12:09:06',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Digestive Health',
                'slug' => 'digestive-health',
                'status' => 1,
                'created_at' => '2023-10-19 12:09:32',
                'updated_at' => '2024-11-06 10:35:02',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Allergy & Asthma',
                'slug' => 'allergy-asthma',
                'status' => 0,
                'created_at' => '2023-10-19 12:09:45',
                'updated_at' => '2024-11-05 16:50:01',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Blood Pressure & Heart Disease',
                'slug' => 'blood-pressure-heart-disease',
                'status' => 0,
                'created_at' => '2023-10-19 12:10:06',
                'updated_at' => '2024-11-05 16:48:35',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Blood Pressure',
                'slug' => 'blood-pressure',
                'status' => 0,
                'created_at' => '2023-10-19 12:10:46',
                'updated_at' => '2024-11-05 18:10:57',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Skin & Hair Condition',
                'slug' => 'skin-hair-condition',
                'status' => 1,
                'created_at' => '2023-10-19 12:11:02',
                'updated_at' => '2023-10-19 12:11:02',
            ),
            8 => 
            array (
                'id' => 10,
                'name' => 'Infection',
                'slug' => 'infection',
                'status' => 0,
                'created_at' => '2023-10-19 12:11:19',
                'updated_at' => '2024-11-05 18:20:11',
            ),
            9 => 
            array (
                'id' => 11,
                'name' => 'All Medicine',
                'slug' => 'all-medicine',
                'status' => 0,
                'created_at' => '2023-10-19 12:11:28',
                'updated_at' => '2024-11-05 18:20:26',
            ),
            10 => 
            array (
                'id' => 12,
                'name' => 'Baby Care',
                'slug' => 'baby-care',
                'status' => 1,
                'created_at' => '2024-11-05 16:40:02',
                'updated_at' => '2024-11-05 16:40:02',
            ),
            11 => 
            array (
                'id' => 13,
                'name' => 'Devices',
                'slug' => 'health',
                'status' => 1,
                'created_at' => '2024-11-05 16:44:35',
                'updated_at' => '2024-11-17 10:29:17',
            ),
        ));
        
        
    }
}