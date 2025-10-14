<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CampaignStoreTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('campaign_store')->delete();
        
        \DB::table('campaign_store')->insert(array (
            0 => 
            array (
                'campaign_id' => 3,
                'store_id' => 1,
                'campaign_status' => 'pending',
            ),
            1 => 
            array (
                'campaign_id' => 3,
                'store_id' => 3,
                'campaign_status' => 'pending',
            ),
            2 => 
            array (
                'campaign_id' => 3,
                'store_id' => 5,
                'campaign_status' => 'pending',
            ),
            3 => 
            array (
                'campaign_id' => 3,
                'store_id' => 7,
                'campaign_status' => 'pending',
            ),
            4 => 
            array (
                'campaign_id' => 2,
                'store_id' => 34,
                'campaign_status' => 'pending',
            ),
            5 => 
            array (
                'campaign_id' => 2,
                'store_id' => 33,
                'campaign_status' => 'pending',
            ),
            6 => 
            array (
                'campaign_id' => 2,
                'store_id' => 32,
                'campaign_status' => 'pending',
            ),
            7 => 
            array (
                'campaign_id' => 2,
                'store_id' => 31,
                'campaign_status' => 'pending',
            ),
            8 => 
            array (
                'campaign_id' => 2,
                'store_id' => 30,
                'campaign_status' => 'pending',
            ),
            9 => 
            array (
                'campaign_id' => 1,
                'store_id' => 11,
                'campaign_status' => 'pending',
            ),
            10 => 
            array (
                'campaign_id' => 1,
                'store_id' => 16,
                'campaign_status' => 'pending',
            ),
            11 => 
            array (
                'campaign_id' => 1,
                'store_id' => 30,
                'campaign_status' => 'pending',
            ),
            12 => 
            array (
                'campaign_id' => 1,
                'store_id' => 18,
                'campaign_status' => 'pending',
            ),
            13 => 
            array (
                'campaign_id' => 1,
                'store_id' => 31,
                'campaign_status' => 'pending',
            ),
            14 => 
            array (
                'campaign_id' => 5,
                'store_id' => 21,
                'campaign_status' => 'pending',
            ),
            15 => 
            array (
                'campaign_id' => 5,
                'store_id' => 24,
                'campaign_status' => 'pending',
            ),
            16 => 
            array (
                'campaign_id' => 4,
                'store_id' => 3,
                'campaign_status' => 'confirmed',
            ),
            17 => 
            array (
                'campaign_id' => 4,
                'store_id' => 34,
                'campaign_status' => 'confirmed',
            ),
            18 => 
            array (
                'campaign_id' => 4,
                'store_id' => 11,
                'campaign_status' => 'confirmed',
            ),
            19 => 
            array (
                'campaign_id' => 6,
                'store_id' => 34,
                'campaign_status' => 'confirmed',
            ),
            20 => 
            array (
                'campaign_id' => 7,
                'store_id' => 55,
                'campaign_status' => 'confirmed',
            ),
            21 => 
            array (
                'campaign_id' => 10,
                'store_id' => 2,
                'campaign_status' => 'pending',
            ),
            22 => 
            array (
                'campaign_id' => 11,
                'store_id' => 2,
                'campaign_status' => 'pending',
            ),
            23 => 
            array (
                'campaign_id' => 9,
                'store_id' => 39,
                'campaign_status' => 'confirmed',
            ),
            24 => 
            array (
                'campaign_id' => 8,
                'store_id' => 39,
                'campaign_status' => 'confirmed',
            ),
            25 => 
            array (
                'campaign_id' => 13,
                'store_id' => 21,
                'campaign_status' => 'confirmed',
            ),
            26 => 
            array (
                'campaign_id' => 13,
                'store_id' => 28,
                'campaign_status' => 'confirmed',
            ),
            27 => 
            array (
                'campaign_id' => 13,
                'store_id' => 26,
                'campaign_status' => 'confirmed',
            ),
        ));
        
        
    }
}