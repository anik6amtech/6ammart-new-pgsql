<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserLevelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_levels')->delete();
        
        \DB::table('user_levels')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sequence' => 1,
                'name' => 'Level 1',
                'reward_type' => 'no_rewards',
                'reward_amount' => NULL,
                'image' => '2025-09-04-68b90eed7ea26.png',
                'targeted_ride' => 1,
                'targeted_ride_point' => 1,
                'targeted_amount' => 0.0,
                'targeted_amount_point' => 0,
                'targeted_cancel' => 0,
                'targeted_cancel_point' => 0,
                'targeted_review' => 0,
                'targeted_review_point' => 0,
                'user_type' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 04:00:45',
                'updated_at' => '2025-09-04 04:00:45',
            ),
            1 => 
            array (
                'id' => 2,
                'sequence' => 2,
                'name' => 'Level 2',
                'reward_type' => 'loyalty_points',
                'reward_amount' => '50.00',
                'image' => '2025-09-04-68b90f318ff60.png',
                'targeted_ride' => 5,
                'targeted_ride_point' => 5,
                'targeted_amount' => 0.0,
                'targeted_amount_point' => 0,
                'targeted_cancel' => 0,
                'targeted_cancel_point' => 0,
                'targeted_review' => 0,
                'targeted_review_point' => 0,
                'user_type' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 04:01:53',
                'updated_at' => '2025-09-04 04:01:53',
            ),
            2 => 
            array (
                'id' => 3,
                'sequence' => 3,
                'name' => 'Level 3',
                'reward_type' => 'wallet',
                'reward_amount' => '150.00',
                'image' => '2025-10-09-68e7861c8df32.png',
                'targeted_ride' => 50,
                'targeted_ride_point' => 50,
                'targeted_amount' => 5000.0,
                'targeted_amount_point' => 500,
                'targeted_cancel' => 10,
                'targeted_cancel_point' => 10,
                'targeted_review' => 20,
                'targeted_review_point' => 10,
                'user_type' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-09-04 04:04:48',
                'updated_at' => '2025-10-09 15:53:32',
            ),
            3 => 
            array (
                'id' => 4,
                'sequence' => 4,
                'name' => 'Martha Garrett',
                'reward_type' => 'loyalty_points',
                'reward_amount' => NULL,
                'image' => '2025-10-12-68eb2df7899e7.png',
                'targeted_ride' => 0,
                'targeted_ride_point' => 0,
                'targeted_amount' => 0.0,
                'targeted_amount_point' => 0,
                'targeted_cancel' => 1,
                'targeted_cancel_point' => 29,
                'targeted_review' => 695033126,
                'targeted_review_point' => 842223272,
                'user_type' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-10-12 10:26:31',
                'updated_at' => '2025-10-12 10:26:31',
            ),
            4 => 
            array (
                'id' => 5,
                'sequence' => 5,
                'name' => 'Preston Blevins',
                'reward_type' => 'loyalty_points',
                'reward_amount' => NULL,
                'image' => '2025-10-12-68eb2ed50e038.png',
                'targeted_ride' => 103357868,
                'targeted_ride_point' => 396587020,
                'targeted_amount' => 33346859.0,
                'targeted_amount_point' => 769371521,
                'targeted_cancel' => 0,
                'targeted_cancel_point' => 0,
                'targeted_review' => 0,
                'targeted_review_point' => 0,
                'user_type' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-10-12 10:30:13',
                'updated_at' => '2025-10-12 10:30:13',
            ),
        ));
        
        
    }
}