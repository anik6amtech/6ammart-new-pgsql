<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WalletBonusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('wallet_bonuses')->delete();
        
        \DB::table('wallet_bonuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Add 100 get 10% Extras',
                'description' => 'Unlock Extra Value: Enjoy a 10% bonus on every addition of 100 units! Elevate your experience with Bonus Title\'s exclusive offer and get more for your investment. Don\'t miss out on this opportunity to supercharge your benefits. Join now and reap the rewards!',
                'bonus_type' => 'percentage',
                'bonus_amount' => 10.0,
                'minimum_add_amount' => 100.0,
                'maximum_bonus_amount' => 200.0,
                'start_date' => '2023-08-20',
                'end_date' => '2027-07-21',
                'status' => 1,
                'created_at' => '2023-08-20 04:33:29',
                'updated_at' => '2023-08-20 06:31:16',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Add $500 Get 30% Extra',
                'description' => 'Enjoy a 30% bonus on every addition of 500! Elevate your experience with Bonus Title\'s exclusive offer and get more for your investment. Don\'t miss out on this opportunity to supercharge your benefits. Join now and reap the rewards!',
                'bonus_type' => 'percentage',
                'bonus_amount' => 30.0,
                'minimum_add_amount' => 500.0,
                'maximum_bonus_amount' => 300.0,
                'start_date' => '2023-08-20',
                'end_date' => '2025-02-20',
                'status' => 1,
                'created_at' => '2023-08-20 06:33:11',
                'updated_at' => '2023-08-20 06:33:11',
            ),
        ));
        
        
    }
}