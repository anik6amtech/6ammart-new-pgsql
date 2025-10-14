<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemNutritionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('item_nutrition')->delete();
        
        \DB::table('item_nutrition')->insert(array (
            0 => 
            array (
                'id' => 1,
                'item_id' => 270,
                'nutrition_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'item_id' => 270,
                'nutrition_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'item_id' => 270,
                'nutrition_id' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'item_id' => 270,
                'nutrition_id' => 4,
            ),
            4 => 
            array (
                'id' => 5,
                'item_id' => 290,
                'nutrition_id' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'item_id' => 290,
                'nutrition_id' => 2,
            ),
            6 => 
            array (
                'id' => 7,
                'item_id' => 290,
                'nutrition_id' => 3,
            ),
            7 => 
            array (
                'id' => 8,
                'item_id' => 320,
                'nutrition_id' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'item_id' => 320,
                'nutrition_id' => 2,
            ),
            9 => 
            array (
                'id' => 10,
                'item_id' => 320,
                'nutrition_id' => 3,
            ),
            10 => 
            array (
                'id' => 11,
                'item_id' => 264,
                'nutrition_id' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'item_id' => 264,
                'nutrition_id' => 2,
            ),
            12 => 
            array (
                'id' => 13,
                'item_id' => 264,
                'nutrition_id' => 3,
            ),
            13 => 
            array (
                'id' => 14,
                'item_id' => 328,
                'nutrition_id' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'item_id' => 328,
                'nutrition_id' => 2,
            ),
            15 => 
            array (
                'id' => 16,
                'item_id' => 326,
                'nutrition_id' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'item_id' => 326,
                'nutrition_id' => 2,
            ),
            17 => 
            array (
                'id' => 18,
                'item_id' => 325,
                'nutrition_id' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'item_id' => 325,
                'nutrition_id' => 2,
            ),
            19 => 
            array (
                'id' => 20,
                'item_id' => 325,
                'nutrition_id' => 3,
            ),
            20 => 
            array (
                'id' => 21,
                'item_id' => 324,
                'nutrition_id' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'item_id' => 324,
                'nutrition_id' => 2,
            ),
            22 => 
            array (
                'id' => 23,
                'item_id' => 324,
                'nutrition_id' => 3,
            ),
            23 => 
            array (
                'id' => 24,
                'item_id' => 318,
                'nutrition_id' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'item_id' => 318,
                'nutrition_id' => 2,
            ),
            25 => 
            array (
                'id' => 37,
                'item_id' => 373,
                'nutrition_id' => 1,
            ),
            26 => 
            array (
                'id' => 38,
                'item_id' => 373,
                'nutrition_id' => 3,
            ),
            27 => 
            array (
                'id' => 39,
                'item_id' => 360,
                'nutrition_id' => 3,
            ),
            28 => 
            array (
                'id' => 40,
                'item_id' => 360,
                'nutrition_id' => 5,
            ),
            29 => 
            array (
                'id' => 41,
                'item_id' => 13,
                'nutrition_id' => 3,
            ),
            30 => 
            array (
                'id' => 42,
                'item_id' => 13,
                'nutrition_id' => 5,
            ),
            31 => 
            array (
                'id' => 43,
                'item_id' => 13,
                'nutrition_id' => 7,
            ),
            32 => 
            array (
                'id' => 44,
                'item_id' => 353,
                'nutrition_id' => 1,
            ),
        ));
        
        
    }
}