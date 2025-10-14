<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceCampaignsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_campaigns')->delete();
        
        \DB::table('service_campaigns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'campaign_name' => 'HappinessClick',
                'short_description' => 'Happiness in Every ClickHappiness in Every ClickHappiness in Every ClickHappiness in Every ClickHappiness in Every ClickHappiness in Every Click',
                'cover_image' => '2025-09-09-68bfc49490a8f.png',
                'thumbnail' => '2025-09-09-68bfc4948e9c5.png',
                'discount_id' => '2',
                'is_active' => 0,
                'created_at' => '2025-09-09 11:55:40',
                'updated_at' => '2025-09-21 14:36:58',
            ),
            1 => 
            array (
                'id' => 2,
                'campaign_name' => 'CC',
                'short_description' => 'Tempor excepturi dolorem fuga Aliquam aute consequuntur earum dolore distinctio Illo sunt dolorum laborum Ullam',
                'cover_image' => '2025-09-18-68cb972729408.png',
                'thumbnail' => '2025-09-18-68cb972728955.png',
                'discount_id' => '5',
                'is_active' => 0,
                'created_at' => '2025-09-18 11:22:47',
                'updated_at' => '2025-10-06 10:22:26',
            ),
        ));
        
        
    }
}