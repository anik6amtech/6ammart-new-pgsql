<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleWiseWhyChoosesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('module_wise_why_chooses')->delete();
        
        \DB::table('module_wise_why_chooses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 5,
                'title' => 'Product Safety',
                'short_description' => 'All packages are handled with most care to ensure product safety during transit.',
                'image' => '2024-11-04-67287dff26607.png',
                'status' => 1,
                'created_at' => '2023-10-19 13:05:05',
                'updated_at' => '2024-11-04 13:55:43',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 5,
                'title' => 'Faster Delivery',
                'short_description' => 'Our team work round the clock to ensure fastest delivery and minimize cancellation ratio',
                'image' => '2024-11-04-67287df6ae00b.png',
                'status' => 1,
                'created_at' => '2023-10-19 13:05:51',
                'updated_at' => '2024-11-04 13:55:34',
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => 5,
                'title' => '24/7 Services',
                'short_description' => 'Whether it’s urgent or last-minute, our 24/7 parcel delivery service is here for you.',
                'image' => '2024-11-04-67287dedc169c.png',
                'status' => 1,
                'created_at' => '2023-10-19 13:06:54',
                'updated_at' => '2024-11-04 13:55:25',
            ),
        ));
        
        
    }
}