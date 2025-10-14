<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailVerificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('email_verifications')->delete();
        
        
        
    }
}