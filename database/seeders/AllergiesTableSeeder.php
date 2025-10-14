<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AllergiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('allergies')->delete();
        
        \DB::table('allergies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'allergy' => 'wheat/gluten,',
                'created_at' => '2024-09-24 10:41:16',
                'updated_at' => '2024-09-24 10:41:16',
            ),
            1 => 
            array (
                'id' => 2,
                'allergy' => 'eggs',
                'created_at' => '2024-09-24 10:41:16',
                'updated_at' => '2024-09-24 10:41:16',
            ),
            2 => 
            array (
                'id' => 3,
                'allergy' => 'dairy',
                'created_at' => '2024-09-24 10:41:16',
                'updated_at' => '2024-09-24 10:41:16',
            ),
            3 => 
            array (
                'id' => 4,
                'allergy' => 'soy',
                'created_at' => '2024-09-24 10:41:16',
                'updated_at' => '2024-09-24 10:41:16',
            ),
            4 => 
            array (
                'id' => 5,
                'allergy' => 'nuts',
                'created_at' => '2024-09-24 10:41:16',
                'updated_at' => '2024-09-24 10:41:16',
            ),
            5 => 
            array (
                'id' => 6,
                'allergy' => 'itching',
                'created_at' => '2024-09-24 10:50:33',
                'updated_at' => '2024-09-24 10:50:33',
            ),
            6 => 
            array (
                'id' => 7,
                'allergy' => 'swelling',
                'created_at' => '2024-09-24 10:50:33',
                'updated_at' => '2024-09-24 10:50:33',
            ),
            7 => 
            array (
                'id' => 8,
                'allergy' => 'digestive issues',
                'created_at' => '2024-09-24 10:50:33',
                'updated_at' => '2024-09-24 10:50:33',
            ),
        ));
        
        
    }
}