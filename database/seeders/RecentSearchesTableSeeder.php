<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecentSearchesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('recent_searches')->delete();
        
        \DB::table('recent_searches')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'module_id' => NULL,
                'user_type' => 'admin',
            'route_name' => 'Module Index - (Ride Share)',
                'route_uri' => 'admin/business-settings/module',
                'route_full_url' => 'https://6ammart-derragh.6amdev.xyz/admin/business-settings/module?keyword=share',
                'keyword' => 'share',
                'created_at' => '2025-09-24 09:37:16',
                'updated_at' => '2025-09-24 09:37:16',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'module_id' => NULL,
                'user_type' => 'admin',
            'route_name' => 'Module Create - (Service)',
                'route_uri' => 'admin/business-settings/module/store',
                'route_full_url' => 'https://6ammart-derragh.6amdev.xyz/admin/business-settings/module/store?keyword=service',
                'keyword' => 'service',
                'created_at' => '2025-09-24 09:37:27',
                'updated_at' => '2025-09-24 09:37:27',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'module_id' => NULL,
                'user_type' => 'admin',
                'route_name' => 'Business Settings Customer Index',
                'route_uri' => 'admin/business-settings/business-setup/customer',
                'route_full_url' => 'https://6ammart-derragh.6amdev.xyz/admin/business-settings/business-setup/customer?keyword=referral',
                'keyword' => 'referral',
                'created_at' => '2025-09-30 16:44:51',
                'updated_at' => '2025-09-30 16:44:51',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'module_id' => NULL,
                'user_type' => 'admin',
                'route_name' => 'Provider Create',
                'route_uri' => 'admin/service/provider/create',
                'route_full_url' => 'https://6ammart-derragh.6amdev.xyz/admin/service/provider/create?keyword=provider',
                'keyword' => 'provider',
                'created_at' => '2025-09-28 11:26:20',
                'updated_at' => '2025-09-28 11:26:20',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'module_id' => 8,
                'user_type' => 'admin',
                'route_name' => 'No-Bid Request Yet',
                'route_uri' => 'admin/service/booking/post?type=new_booking_request',
                'route_full_url' => 'https://6ammart-derragh.6amdev.xyz/admin/service/booking/post?type=new_booking_request?keyword=booking',
                'keyword' => 'booking',
                'created_at' => '2025-10-06 16:05:54',
                'updated_at' => '2025-10-06 16:05:54',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'module_id' => 8,
                'user_type' => 'admin',
                'route_name' => 'Banner Edit',
                'route_uri' => 'admin/banner/edit/53',
                'route_full_url' => 'https://6ammart-derragh.6amdev.xyz/admin/banner/edit/53?keyword=cleanning',
                'keyword' => 'cleanning',
                'created_at' => '2025-10-07 10:43:57',
                'updated_at' => '2025-10-07 10:43:57',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 1,
                'module_id' => 8,
                'user_type' => 'admin',
                'route_name' => 'Business Settings Store Index',
                'route_uri' => 'admin/business-settings/business-setup/store',
                'route_full_url' => 'https://6ammart-derragh.6amdev.xyz/admin/business-settings/business-setup/store?keyword=cash in hand',
                'keyword' => 'cash in hand',
                'created_at' => '2025-10-07 10:45:49',
                'updated_at' => '2025-10-07 10:45:49',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 1,
                'module_id' => NULL,
                'user_type' => 'admin',
                'route_name' => 'Item Product Gallery',
                'route_uri' => 'admin/item/product-gallery',
                'route_full_url' => 'https://6ammart-derragh.6amdev.xyz/admin/item/product-gallery?keyword=gall',
                'keyword' => 'gall',
                'created_at' => '2025-10-12 17:00:37',
                'updated_at' => '2025-10-12 17:00:37',
            ),
        ));
        
        
    }
}