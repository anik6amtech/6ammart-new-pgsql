<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RentalCartsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rental_carts')->delete();
        
        
        
    }
}