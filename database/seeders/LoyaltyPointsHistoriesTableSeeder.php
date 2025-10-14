<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LoyaltyPointsHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('loyalty_points_histories')->delete();
        
        \DB::table('loyalty_points_histories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_type' => 'driver',
                'user_id' => 9,
                'model' => 'user_level',
                'model_id' => 2,
                'points' => 50.0,
                'type' => 'credit',
                'created_at' => '2025-09-16 14:40:51',
                'updated_at' => '2025-09-16 14:40:51',
            ),
            1 => 
            array (
                'id' => 2,
                'user_type' => 'driver',
                'user_id' => 24,
                'model' => 'user_level',
                'model_id' => 2,
                'points' => 50.0,
                'type' => 'credit',
                'created_at' => '2025-10-12 17:47:02',
                'updated_at' => '2025-10-12 17:47:02',
            ),
            2 => 
            array (
                'id' => 3,
                'user_type' => 'driver',
                'user_id' => 2,
                'model' => 'user_level',
                'model_id' => 2,
                'points' => 50.0,
                'type' => 'credit',
                'created_at' => '2025-10-12 19:16:38',
                'updated_at' => '2025-10-12 19:16:38',
            ),
        ));
        
        
    }
}