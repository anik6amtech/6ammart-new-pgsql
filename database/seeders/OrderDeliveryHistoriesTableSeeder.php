<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderDeliveryHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_delivery_histories')->delete();
        
        
        
    }
}