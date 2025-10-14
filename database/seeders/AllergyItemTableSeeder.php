<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AllergyItemTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('allergy_item')->delete();
        
        \DB::table('allergy_item')->insert(array (
            0 => 
            array (
                'id' => 1,
                'item_id' => 270,
                'allergy_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'item_id' => 270,
                'allergy_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'item_id' => 270,
                'allergy_id' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'item_id' => 270,
                'allergy_id' => 4,
            ),
            4 => 
            array (
                'id' => 5,
                'item_id' => 270,
                'allergy_id' => 5,
            ),
            5 => 
            array (
                'id' => 6,
                'item_id' => 290,
                'allergy_id' => 2,
            ),
            6 => 
            array (
                'id' => 7,
                'item_id' => 290,
                'allergy_id' => 3,
            ),
            7 => 
            array (
                'id' => 8,
                'item_id' => 290,
                'allergy_id' => 4,
            ),
            8 => 
            array (
                'id' => 9,
                'item_id' => 320,
                'allergy_id' => 2,
            ),
            9 => 
            array (
                'id' => 10,
                'item_id' => 320,
                'allergy_id' => 4,
            ),
            10 => 
            array (
                'id' => 11,
                'item_id' => 264,
                'allergy_id' => 4,
            ),
            11 => 
            array (
                'id' => 12,
                'item_id' => 264,
                'allergy_id' => 5,
            ),
            12 => 
            array (
                'id' => 13,
                'item_id' => 328,
                'allergy_id' => 3,
            ),
            13 => 
            array (
                'id' => 14,
                'item_id' => 326,
                'allergy_id' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'item_id' => 325,
                'allergy_id' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'item_id' => 325,
                'allergy_id' => 2,
            ),
            16 => 
            array (
                'id' => 17,
                'item_id' => 324,
                'allergy_id' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'item_id' => 324,
                'allergy_id' => 2,
            ),
            18 => 
            array (
                'id' => 19,
                'item_id' => 318,
                'allergy_id' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'item_id' => 318,
                'allergy_id' => 2,
            ),
            20 => 
            array (
                'id' => 26,
                'item_id' => 373,
                'allergy_id' => 2,
            ),
            21 => 
            array (
                'id' => 27,
                'item_id' => 373,
                'allergy_id' => 3,
            ),
            22 => 
            array (
                'id' => 28,
                'item_id' => 360,
                'allergy_id' => 1,
            ),
            23 => 
            array (
                'id' => 29,
                'item_id' => 13,
                'allergy_id' => 1,
            ),
            24 => 
            array (
                'id' => 30,
                'item_id' => 13,
                'allergy_id' => 8,
            ),
            25 => 
            array (
                'id' => 31,
                'item_id' => 353,
                'allergy_id' => 3,
            ),
            26 => 
            array (
                'id' => 32,
                'item_id' => 353,
                'allergy_id' => 4,
            ),
        ));
        
        
    }
}