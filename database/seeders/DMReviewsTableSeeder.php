<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DMReviewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('d_m_reviews')->delete();
        
        \DB::table('d_m_reviews')->insert(array (
            0 => 
            array (
                'id' => 1,
                'delivery_man_id' => 1,
                'user_id' => 12,
                'order_id' => 100039,
                'comment' => 'Punctual man.',
                'attachment' => '[]',
                'rating' => 5,
                'created_at' => '2022-09-29 14:43:42',
                'updated_at' => '2022-09-29 14:43:42',
                'status' => 1,
            ),
        ));
        
        
    }
}