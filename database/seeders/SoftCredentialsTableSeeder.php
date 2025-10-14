<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SoftCredentialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('soft_credentials')->delete();
        
        
        
    }
}