<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'id' => 1,
                'unit' => 'Kg',
                'created_at' => '2022-03-16 14:32:07',
                'updated_at' => '2022-03-16 14:32:07',
            ),
            1 => 
            array (
                'id' => 2,
                'unit' => 'Pcs',
                'created_at' => '2022-03-16 14:32:52',
                'updated_at' => '2022-03-16 14:32:59',
            ),
            2 => 
            array (
                'id' => 3,
                'unit' => 'Ltr',
                'created_at' => '2022-03-22 13:49:40',
                'updated_at' => '2022-03-22 13:49:40',
            ),
            3 => 
            array (
                'id' => 4,
                'unit' => 'Pack',
                'created_at' => '2022-03-22 19:27:18',
                'updated_at' => '2022-03-22 19:27:18',
            ),
            4 => 
            array (
                'id' => 5,
                'unit' => '5',
                'created_at' => '2024-10-31 14:42:34',
                'updated_at' => '2024-10-31 14:42:34',
            ),
        ));
        
        
    }
}