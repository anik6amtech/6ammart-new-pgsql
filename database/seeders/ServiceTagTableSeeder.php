<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_tag')->delete();
        
        \DB::table('service_tag')->insert(array (
            0 => 
            array (
                'id' => 1,
                'service_id' => '1',
                'tag_id' => '52',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 5,
                'service_id' => '2',
                'tag_id' => '56',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 8,
                'service_id' => '3',
                'tag_id' => '59',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 9,
                'service_id' => '2',
                'tag_id' => '60',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 10,
                'service_id' => '2',
                'tag_id' => '61',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 14,
                'service_id' => '4',
                'tag_id' => '65',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 15,
                'service_id' => '4',
                'tag_id' => '66',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 16,
                'service_id' => '4',
                'tag_id' => '67',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 17,
                'service_id' => '4',
                'tag_id' => '68',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 18,
                'service_id' => '4',
                'tag_id' => '69',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 19,
                'service_id' => '5',
                'tag_id' => '70',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 20,
                'service_id' => '5',
                'tag_id' => '71',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 21,
                'service_id' => '6',
                'tag_id' => '72',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 22,
                'service_id' => '6',
                'tag_id' => '71',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 23,
                'service_id' => '6',
                'tag_id' => '73',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 24,
                'service_id' => '7',
                'tag_id' => '74',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 25,
                'service_id' => '8',
                'tag_id' => '75',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 26,
                'service_id' => '8',
                'tag_id' => '76',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 36,
                'service_id' => '10',
                'tag_id' => '86',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 37,
                'service_id' => '10',
                'tag_id' => '87',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 41,
                'service_id' => '1',
                'tag_id' => '91',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 42,
                'service_id' => '1',
                'tag_id' => '92',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 43,
                'service_id' => '1',
                'tag_id' => '93',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}