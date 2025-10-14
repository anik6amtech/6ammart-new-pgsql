<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attributes')->delete();
        
        \DB::table('attributes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Size',
                'created_at' => '2022-03-21 20:24:47',
                'updated_at' => '2022-03-22 13:52:19',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Color',
                'created_at' => '2022-03-22 16:47:26',
                'updated_at' => '2022-03-22 16:52:29',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Type',
                'created_at' => '2022-09-29 11:54:28',
                'updated_at' => '2022-09-29 11:54:28',
            ),
        ));
        
        
    }
}