<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorEmployeesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vendor_employees')->delete();
        
        
        
    }
}