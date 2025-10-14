<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParcelDeliveryInstructionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('parcel_delivery_instructions')->delete();
        
        \DB::table('parcel_delivery_instructions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'instruction' => 'Parcel contain fragile product so take care of this.',
                'status' => 1,
                'created_at' => '2023-11-27 12:15:43',
                'updated_at' => '2023-11-27 12:15:43',
            ),
            1 => 
            array (
                'id' => 2,
                'instruction' => 'Parcel have some medical equipment so be careful to deliver this products.',
                'status' => 1,
                'created_at' => '2023-11-27 12:18:09',
                'updated_at' => '2023-11-27 12:18:09',
            ),
            2 => 
            array (
                'id' => 3,
                'instruction' => 'Parcel contains food, make sure not to leak the food.',
                'status' => 1,
                'created_at' => '2023-11-27 12:19:23',
                'updated_at' => '2023-11-27 12:19:23',
            ),
        ));
        
        
    }
}