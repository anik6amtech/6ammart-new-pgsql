<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PriorityListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('priority_lists')->delete();
        
        \DB::table('priority_lists')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'category_list_sort_by_general',
                'value' => 'latest',
                'type' => 'general',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'special_offer_sort_by_general',
                'value' => 'a_to_z',
                'type' => 'general',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'brand_sort_by_general',
                'value' => 'z_to_a',
                'type' => 'general',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}