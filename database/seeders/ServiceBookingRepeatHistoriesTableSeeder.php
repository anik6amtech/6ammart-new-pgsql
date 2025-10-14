<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceBookingRepeatHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_booking_repeat_histories')->delete();
        
        \DB::table('service_booking_repeat_histories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'booking_id' => 1097,
                'booking_repeat_id' => 93,
                'booking_repeat_details_id' => NULL,
                'old_quantity' => 3,
                'new_quantity' => 1,
                'is_multiple' => 0,
                'total_booking_amount' => '-19.700',
                'total_tax_amount' => '-2.700',
                'total_discount_amount' => '-10.000',
                'extra_fee' => '10.000',
                'total_referral_discount_amount' => '0.000',
                'log_details' => '[{"quantity": 1, "service_id": "1", "tax_amount": "-3.700", "total_cost": "-40.700", "variant_key": "In-1200-SFT", "service_cost": "50.000", "service_name": "Full house cleaning", "discount_amount": "0.000", "repeat_details_id": 182}]',
                'created_at' => '2025-09-22 16:08:11',
                'updated_at' => '2025-09-22 16:08:11',
                'readable_id' => '1097-A',
            ),
        ));
        
        
    }
}