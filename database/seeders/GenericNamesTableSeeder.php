<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GenericNamesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('generic_names')->delete();
        
        \DB::table('generic_names')->insert(array (
            0 => 
            array (
                'id' => 1,
                'generic_name' => 'silodosin systemic',
                'created_at' => '2024-09-24 10:40:25',
                'updated_at' => '2024-09-24 10:40:25',
            ),
            1 => 
            array (
                'id' => 2,
                'generic_name' => 'VItamin A, E D3',
                'created_at' => '2024-09-24 10:41:49',
                'updated_at' => '2024-09-24 10:41:49',
            ),
            2 => 
            array (
                'id' => 3,
                'generic_name' => 'Povidone-iodine 5%',
                'created_at' => '2024-09-24 10:42:27',
                'updated_at' => '2024-09-24 10:42:27',
            ),
            3 => 
            array (
                'id' => 4,
                'generic_name' => 'dexlansoprazole',
                'created_at' => '2024-09-24 10:43:27',
                'updated_at' => '2024-09-24 10:43:27',
            ),
            4 => 
            array (
                'id' => 5,
                'generic_name' => 'acetylsalicylic acid',
                'created_at' => '2024-09-24 10:44:53',
                'updated_at' => '2024-09-24 10:44:53',
            ),
            5 => 
            array (
                'id' => 6,
                'generic_name' => 'Serum 5% 2 Oz',
                'created_at' => '2024-09-24 10:46:12',
                'updated_at' => '2024-09-24 10:46:12',
            ),
            6 => 
            array (
                'id' => 7,
                'generic_name' => 'ubiquinone',
                'created_at' => '2024-09-24 10:46:56',
                'updated_at' => '2024-09-24 10:46:56',
            ),
            7 => 
            array (
                'id' => 8,
                'generic_name' => 'Omeprazol',
                'created_at' => '2024-09-24 10:48:42',
                'updated_at' => '2024-09-24 10:48:42',
            ),
        ));
        
        
    }
}