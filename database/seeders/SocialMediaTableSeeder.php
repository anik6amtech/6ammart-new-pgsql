<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SocialMediaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('social_media')->delete();
        
        \DB::table('social_media')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'instagram',
                'link' => 'https://www.instagram.com/?hl=en',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'facebook',
                'link' => 'https://www.facebook.com/',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'twitter',
                'link' => 'https://twitter.com/?lang=en',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'linkedin',
                'link' => 'https://www.linkedin.com/',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'pinterest',
                'link' => 'https://www.pinterest.com/',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}