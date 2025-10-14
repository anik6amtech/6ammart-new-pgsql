<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemGenericNamesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('item_generic_names')->delete();
        
        \DB::table('item_generic_names')->insert(array (
            0 => 
            array (
                'id' => 2,
                'item_id' => 156,
                'generic_name_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 4,
                'item_id' => 9,
                'generic_name_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 5,
                'item_id' => 74,
                'generic_name_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 8,
                'item_id' => 19,
                'generic_name_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 9,
                'item_id' => 3,
                'generic_name_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 10,
                'item_id' => 152,
                'generic_name_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 11,
                'item_id' => 69,
                'generic_name_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}