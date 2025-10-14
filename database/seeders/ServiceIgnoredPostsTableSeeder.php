<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceIgnoredPostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_ignored_posts')->delete();
        
        
        
    }
}