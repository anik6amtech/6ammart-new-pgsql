<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NutritionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('nutritions')->delete();
        
        \DB::table('nutritions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nutrition' => 'Calories: Approximately 200-250 kcal',
                'created_at' => '2024-09-24 10:41:16',
                'updated_at' => '2024-09-24 10:41:16',
            ),
            1 => 
            array (
                'id' => 2,
                'nutrition' => 'Protein: 25-30g',
                'created_at' => '2024-09-24 10:41:16',
                'updated_at' => '2024-09-24 10:41:16',
            ),
            2 => 
            array (
                'id' => 3,
                'nutrition' => 'Fat: 5-10g',
                'created_at' => '2024-09-24 10:41:16',
                'updated_at' => '2024-09-24 10:41:16',
            ),
            3 => 
            array (
                'id' => 4,
                'nutrition' => 'Magnesium: 5-8%',
                'created_at' => '2024-09-24 10:41:16',
                'updated_at' => '2024-09-24 10:41:16',
            ),
            4 => 
            array (
                'id' => 5,
                'nutrition' => 'Vitamin',
                'created_at' => '2024-09-24 10:48:56',
                'updated_at' => '2024-09-24 10:48:56',
            ),
            5 => 
            array (
                'id' => 6,
                'nutrition' => 'Calories',
                'created_at' => '2024-09-24 10:48:56',
                'updated_at' => '2024-09-24 10:48:56',
            ),
            6 => 
            array (
                'id' => 7,
                'nutrition' => 'Carbohydrates',
                'created_at' => '2024-09-24 10:48:56',
                'updated_at' => '2024-09-24 10:48:56',
            ),
        ));
        
        
    }
}