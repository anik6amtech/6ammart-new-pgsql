<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewslettersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('newsletters')->delete();
        
        \DB::table('newsletters')->insert(array (
            0 => 
            array (
                'id' => 1,
                'email' => 'user@6amtech.com',
                'created_at' => '2024-09-24 10:53:35',
                'updated_at' => '2024-09-24 10:53:35',
            ),
            1 => 
            array (
                'id' => 2,
                'email' => 'jhone@gmail.com',
                'created_at' => '2024-09-24 10:54:23',
                'updated_at' => '2024-09-24 10:54:23',
            ),
            2 => 
            array (
                'id' => 3,
                'email' => 'bingo@demo.com',
                'created_at' => '2024-09-24 10:55:06',
                'updated_at' => '2024-09-24 10:55:06',
            ),
            3 => 
            array (
                'id' => 4,
                'email' => 'newuser@gmail.com',
                'created_at' => '2024-09-24 10:55:29',
                'updated_at' => '2024-09-24 10:55:29',
            ),
        ));
        
        
    }
}