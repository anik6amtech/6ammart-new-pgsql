<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('item_tag')->delete();
        
        \DB::table('item_tag')->insert(array (
            0 => 
            array (
                'id' => 1,
                'item_id' => 265,
                'tag_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'item_id' => 327,
                'tag_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'item_id' => 264,
                'tag_id' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'item_id' => 326,
                'tag_id' => 4,
            ),
            4 => 
            array (
                'id' => 5,
                'item_id' => 325,
                'tag_id' => 5,
            ),
            5 => 
            array (
                'id' => 7,
                'item_id' => 272,
                'tag_id' => 6,
            ),
            6 => 
            array (
                'id' => 8,
                'item_id' => 272,
                'tag_id' => 7,
            ),
            7 => 
            array (
                'id' => 9,
                'item_id' => 272,
                'tag_id' => 8,
            ),
            8 => 
            array (
                'id' => 10,
                'item_id' => 324,
                'tag_id' => 4,
            ),
            9 => 
            array (
                'id' => 11,
                'item_id' => 274,
                'tag_id' => 9,
            ),
            10 => 
            array (
                'id' => 12,
                'item_id' => 322,
                'tag_id' => 10,
            ),
            11 => 
            array (
                'id' => 13,
                'item_id' => 321,
                'tag_id' => 4,
            ),
            12 => 
            array (
                'id' => 22,
                'item_id' => 147,
                'tag_id' => 19,
            ),
            13 => 
            array (
                'id' => 23,
                'item_id' => 143,
                'tag_id' => 15,
            ),
            14 => 
            array (
                'id' => 24,
                'item_id' => 142,
                'tag_id' => 20,
            ),
            15 => 
            array (
                'id' => 27,
                'item_id' => 127,
                'tag_id' => 23,
            ),
            16 => 
            array (
                'id' => 28,
                'item_id' => 112,
                'tag_id' => 24,
            ),
            17 => 
            array (
                'id' => 36,
                'item_id' => 3,
                'tag_id' => 29,
            ),
            18 => 
            array (
                'id' => 37,
                'item_id' => 6,
                'tag_id' => 30,
            ),
            19 => 
            array (
                'id' => 38,
                'item_id' => 8,
                'tag_id' => 31,
            ),
            20 => 
            array (
                'id' => 47,
                'item_id' => 58,
                'tag_id' => 39,
            ),
            21 => 
            array (
                'id' => 48,
                'item_id' => 335,
                'tag_id' => 40,
            ),
            22 => 
            array (
                'id' => 49,
                'item_id' => 268,
                'tag_id' => 41,
            ),
            23 => 
            array (
                'id' => 50,
                'item_id' => 328,
                'tag_id' => 42,
            ),
            24 => 
            array (
                'id' => 52,
                'item_id' => 142,
                'tag_id' => 44,
            ),
            25 => 
            array (
                'id' => 53,
                'item_id' => 142,
                'tag_id' => 45,
            ),
            26 => 
            array (
                'id' => 54,
                'item_id' => 112,
                'tag_id' => 46,
            ),
            27 => 
            array (
                'id' => 57,
                'item_id' => 325,
                'tag_id' => 49,
            ),
        ));
        
        
    }
}