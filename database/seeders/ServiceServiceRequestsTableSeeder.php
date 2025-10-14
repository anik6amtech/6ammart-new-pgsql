<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceServiceRequestsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_service_requests')->delete();
        
        \DB::table('service_service_requests')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category_id' => 3,
                'service_name' => 'qwqert',
                'service_description' => 'hjyk,j',
                'status' => 'pending',
                'admin_feedback' => NULL,
                'user_id' => 8,
                'created_at' => '2025-09-07 10:11:26',
                'updated_at' => '2025-09-07 10:11:26',
                'type' => 'customer',
                'module_id' => 8,
            ),
            1 => 
            array (
                'id' => 2,
                'category_id' => 11,
                'service_name' => 'another',
                'service_description' => 'i need ambulance service',
                'status' => 'pending',
                'admin_feedback' => NULL,
                'user_id' => 8,
                'created_at' => '2025-09-09 15:00:51',
                'updated_at' => '2025-09-09 15:00:51',
                'type' => 'customer',
                'module_id' => 8,
            ),
            2 => 
            array (
                'id' => 3,
                'category_id' => 13,
                'service_name' => '1113233',
                'service_description' => 'eeeewwwwwwwwwww',
                'status' => 'approved',
                'admin_feedback' => 'we will try our best',
                'user_id' => 14,
                'created_at' => '2025-09-17 12:37:35',
                'updated_at' => '2025-09-24 11:33:53',
                'type' => 'customer',
                'module_id' => 8,
            ),
            3 => 
            array (
                'id' => 4,
                'category_id' => 1,
                'service_name' => 'New Kitchen Cleaning',
                'service_description' => 'Dvdvsv hsbssb vssvsv gswg hsbw vsbw',
                'status' => 'pending',
                'admin_feedback' => NULL,
                'user_id' => 33,
                'created_at' => '2025-09-21 16:34:21',
                'updated_at' => '2025-09-21 16:34:21',
                'type' => 'customer',
                'module_id' => 8,
            ),
            4 => 
            array (
                'id' => 5,
                'category_id' => 12,
                'service_name' => 'floor cleaning',
                'service_description' => 'Suggest more service that are willing to book and help us make more efficient platform for youSuggest more service that are willing to book and help us make more efficient platform for youSuggest more service that are willing to book and help us make more efficient platform for you',
                'status' => 'pending',
                'admin_feedback' => NULL,
                'user_id' => 33,
                'created_at' => '2025-09-21 16:46:58',
                'updated_at' => '2025-09-21 16:46:58',
                'type' => 'customer',
                'module_id' => 8,
            ),
            5 => 
            array (
                'id' => 6,
                'category_id' => 12,
                'service_name' => 'Testt',
                'service_description' => 'Akvkva',
                'status' => 'pending',
                'admin_feedback' => NULL,
                'user_id' => 14,
                'created_at' => '2025-09-24 11:37:35',
                'updated_at' => '2025-09-24 11:37:35',
                'type' => 'customer',
                'module_id' => 8,
            ),
            6 => 
            array (
                'id' => 7,
                'category_id' => NULL,
                'service_name' => 'test',
                'service_description' => 'jfjf',
                'status' => 'pending',
                'admin_feedback' => NULL,
                'user_id' => 1,
                'created_at' => '2025-09-25 11:29:52',
                'updated_at' => '2025-09-25 11:29:52',
                'type' => 'provider',
                'module_id' => 8,
            ),
            7 => 
            array (
                'id' => 8,
                'category_id' => 1,
                'service_name' => 'test',
                'service_description' => 'pp',
                'status' => 'pending',
                'admin_feedback' => NULL,
                'user_id' => 1,
                'created_at' => '2025-09-25 12:48:42',
                'updated_at' => '2025-09-25 12:48:42',
                'type' => 'provider',
                'module_id' => 8,
            ),
            8 => 
            array (
                'id' => 9,
                'category_id' => 1,
                'service_name' => 'Ppp',
                'service_description' => 'Vvv',
                'status' => 'pending',
                'admin_feedback' => NULL,
                'user_id' => 14,
                'created_at' => '2025-09-25 12:59:05',
                'updated_at' => '2025-09-25 12:59:05',
                'type' => 'customer',
                'module_id' => 8,
            ),
            9 => 
            array (
                'id' => 10,
                'category_id' => 2,
                'service_name' => '768568',
                'service_description' => '5678567856',
                'status' => 'denied',
                'admin_feedback' => '354753474357345',
                'user_id' => 32,
                'created_at' => '2025-09-28 12:22:34',
                'updated_at' => '2025-09-28 12:25:07',
                'type' => 'customer',
                'module_id' => 8,
            ),
            10 => 
            array (
                'id' => 11,
                'category_id' => 13,
                'service_name' => 'Test Service name',
                'service_description' => 'Description',
                'status' => 'approved',
                'admin_feedback' => 'Thank you',
                'user_id' => 32,
                'created_at' => '2025-09-28 12:41:00',
                'updated_at' => '2025-09-28 12:41:38',
                'type' => 'customer',
                'module_id' => 8,
            ),
            11 => 
            array (
                'id' => 12,
                'category_id' => 12,
                'service_name' => 'Ac Cleaning',
                'service_description' => 'This is Ac cleaning service Decription',
                'status' => 'denied',
                'admin_feedback' => 'ryetye',
                'user_id' => 32,
                'created_at' => '2025-09-28 12:42:46',
                'updated_at' => '2025-09-28 12:58:22',
                'type' => 'customer',
                'module_id' => 8,
            ),
            12 => 
            array (
                'id' => 13,
                'category_id' => 12,
                'service_name' => '897078',
                'service_description' => '78900789',
                'status' => 'approved',
                'admin_feedback' => '56745764567',
                'user_id' => 32,
                'created_at' => '2025-09-28 12:59:23',
                'updated_at' => '2025-09-28 12:59:34',
                'type' => 'customer',
                'module_id' => 8,
            ),
            13 => 
            array (
                'id' => 14,
                'category_id' => 1,
                'service_name' => 'tryertyer',
                'service_description' => 'ytreyertyer',
                'status' => 'denied',
                'admin_feedback' => '765856865865',
                'user_id' => 32,
                'created_at' => '2025-09-28 13:02:20',
                'updated_at' => '2025-09-28 13:02:40',
                'type' => 'customer',
                'module_id' => 8,
            ),
            14 => 
            array (
                'id' => 15,
                'category_id' => 12,
                'service_name' => 'fhfhfh',
                'service_description' => 'Gjjkg',
                'status' => 'pending',
                'admin_feedback' => NULL,
                'user_id' => 32,
                'created_at' => '2025-09-29 10:29:33',
                'updated_at' => '2025-09-29 10:29:33',
                'type' => 'customer',
                'module_id' => 8,
            ),
            15 => 
            array (
                'id' => 16,
                'category_id' => 1,
                'service_name' => 'Xbbs',
                'service_description' => 'Dydy',
                'status' => 'approved',
                'admin_feedback' => 'hfdgfhfg yrtyurtuyter tryrtue uj3',
                'user_id' => 33,
                'created_at' => '2025-09-30 16:29:05',
                'updated_at' => '2025-10-05 16:41:01',
                'type' => 'customer',
                'module_id' => 8,
            ),
            16 => 
            array (
                'id' => 17,
                'category_id' => 3,
                'service_name' => 'Tt',
                'service_description' => 'Yvyvu',
                'status' => 'approved',
                'admin_feedback' => '3213223321321',
                'user_id' => 14,
                'created_at' => '2025-10-05 12:15:48',
                'updated_at' => '2025-10-05 12:16:11',
                'type' => 'customer',
                'module_id' => 8,
            ),
            17 => 
            array (
                'id' => 18,
                'category_id' => 1,
                'service_name' => 'floor cleaning',
                'service_description' => 'we3r345t432',
                'status' => 'pending',
                'admin_feedback' => NULL,
                'user_id' => 33,
                'created_at' => '2025-10-05 16:41:43',
                'updated_at' => '2025-10-05 16:41:43',
                'type' => 'customer',
                'module_id' => 8,
            ),
            18 => 
            array (
                'id' => 19,
                'category_id' => 1,
                'service_name' => 'washing',
                'service_description' => '25423 ew4te4w5 rtwtr',
                'status' => 'approved',
                'admin_feedback' => '435543543453435534543',
                'user_id' => 33,
                'created_at' => '2025-10-05 16:42:12',
                'updated_at' => '2025-10-05 16:42:43',
                'type' => 'customer',
                'module_id' => 8,
            ),
        ));
        
        
    }
}