<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupportSavedRepliesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('support_saved_replies')->delete();
        
        \DB::table('support_saved_replies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'topic' => 'test',
                'answer' => 'qweewwe',
                'is_active' => 1,
                'created_at' => '2025-10-08 16:41:09',
                'updated_at' => '2025-10-08 16:41:09',
            ),
        ));
        
        
    }
}