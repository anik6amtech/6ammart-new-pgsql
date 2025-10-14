<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleIdentitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vehicle_identities')->delete();
        
        \DB::table('vehicle_identities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'vehicle_id' => 1,
                'provider_id' => 67,
                'vin_number' => 'Toyota589',
                'license_plate_number' => 'A-786_AHL',
                'created_at' => '2025-02-05 17:36:07',
                'updated_at' => '2025-02-05 17:36:07',
            ),
            1 => 
            array (
                'id' => 2,
                'vehicle_id' => 1,
                'provider_id' => 67,
                'vin_number' => 'Toyota765',
                'license_plate_number' => 'B-786_AHY',
                'created_at' => '2025-02-05 17:36:07',
                'updated_at' => '2025-02-05 17:36:07',
            ),
            2 => 
            array (
                'id' => 3,
                'vehicle_id' => 1,
                'provider_id' => 67,
                'vin_number' => 'Toyota7090',
                'license_plate_number' => 'A-786_AHY',
                'created_at' => '2025-02-05 17:36:07',
                'updated_at' => '2025-02-05 17:36:07',
            ),
            3 => 
            array (
                'id' => 4,
                'vehicle_id' => 2,
                'provider_id' => 67,
                'vin_number' => 'Honda8o9',
                'license_plate_number' => 'A-879-78',
                'created_at' => '2025-02-05 17:43:10',
                'updated_at' => '2025-02-05 17:43:10',
            ),
            4 => 
            array (
                'id' => 5,
                'vehicle_id' => 3,
                'provider_id' => 66,
                'vin_number' => 'Hundai966',
                'license_plate_number' => 'TK-HUN-9087',
                'created_at' => '2025-02-05 18:01:45',
                'updated_at' => '2025-02-05 18:01:45',
            ),
            5 => 
            array (
                'id' => 6,
                'vehicle_id' => 3,
                'provider_id' => 66,
                'vin_number' => 'Hundai9A',
                'license_plate_number' => 'TK-HUN-9086',
                'created_at' => '2025-02-05 18:01:45',
                'updated_at' => '2025-02-05 18:01:45',
            ),
            6 => 
            array (
                'id' => 7,
                'vehicle_id' => 3,
                'provider_id' => 66,
                'vin_number' => 'Hundai93',
                'license_plate_number' => 'TK-HUN-9078',
                'created_at' => '2025-02-05 18:01:45',
                'updated_at' => '2025-02-05 18:01:45',
            ),
            7 => 
            array (
                'id' => 8,
                'vehicle_id' => 3,
                'provider_id' => 66,
                'vin_number' => 'Hundai937',
                'license_plate_number' => 'TK-HUN-9077',
                'created_at' => '2025-02-05 18:01:45',
                'updated_at' => '2025-02-05 18:01:45',
            ),
            8 => 
            array (
                'id' => 9,
                'vehicle_id' => 3,
                'provider_id' => 66,
                'vin_number' => 'HundaiD0A',
                'license_plate_number' => 'TK-HUN-9000',
                'created_at' => '2025-02-05 18:01:45',
                'updated_at' => '2025-02-05 18:01:45',
            ),
            9 => 
            array (
                'id' => 10,
                'vehicle_id' => 3,
                'provider_id' => 66,
                'vin_number' => 'Hundai9D7A',
                'license_plate_number' => 'TK-HUN-1022',
                'created_at' => '2025-02-05 18:01:45',
                'updated_at' => '2025-02-05 18:01:45',
            ),
            10 => 
            array (
                'id' => 11,
                'vehicle_id' => 3,
                'provider_id' => 66,
                'vin_number' => 'Hundai90U',
                'license_plate_number' => 'TK-HUN-9699',
                'created_at' => '2025-02-05 18:01:45',
                'updated_at' => '2025-02-05 18:01:45',
            ),
            11 => 
            array (
                'id' => 12,
                'vehicle_id' => 3,
                'provider_id' => 66,
                'vin_number' => 'Hundai90P',
                'license_plate_number' => 'TK-HUN-9089',
                'created_at' => '2025-02-05 18:01:45',
                'updated_at' => '2025-02-05 18:01:45',
            ),
            12 => 
            array (
                'id' => 13,
                'vehicle_id' => 4,
                'provider_id' => 66,
                'vin_number' => 'NissanS01',
                'license_plate_number' => 'S01-4578-02',
                'created_at' => '2025-02-05 18:07:16',
                'updated_at' => '2025-02-05 18:07:16',
            ),
            13 => 
            array (
                'id' => 14,
                'vehicle_id' => 5,
                'provider_id' => 60,
                'vin_number' => 'BMW-16700',
                'license_plate_number' => 'BMW-16711',
                'created_at' => '2025-02-05 18:22:55',
                'updated_at' => '2025-02-05 18:22:55',
            ),
            14 => 
            array (
                'id' => 15,
                'vehicle_id' => 5,
                'provider_id' => 60,
                'vin_number' => 'BMW-16755',
                'license_plate_number' => 'BMW-16744',
                'created_at' => '2025-02-05 18:22:55',
                'updated_at' => '2025-02-05 18:22:55',
            ),
            15 => 
            array (
                'id' => 16,
                'vehicle_id' => 5,
                'provider_id' => 60,
                'vin_number' => 'BMW-16789',
                'license_plate_number' => 'BMW-19009',
                'created_at' => '2025-02-05 18:22:55',
                'updated_at' => '2025-02-05 18:22:55',
            ),
            16 => 
            array (
                'id' => 17,
                'vehicle_id' => 6,
                'provider_id' => 60,
                'vin_number' => 'Mercedes-56',
                'license_plate_number' => 'Mer-23265',
                'created_at' => '2025-02-05 18:26:04',
                'updated_at' => '2025-02-05 18:26:04',
            ),
            17 => 
            array (
                'id' => 18,
                'vehicle_id' => 6,
                'provider_id' => 60,
                'vin_number' => 'Mercedes-89',
                'license_plate_number' => 'Mer-23254',
                'created_at' => '2025-02-05 18:26:04',
                'updated_at' => '2025-02-05 18:26:04',
            ),
            18 => 
            array (
                'id' => 19,
                'vehicle_id' => 7,
                'provider_id' => 60,
                'vin_number' => 'Audi A6-r65',
                'license_plate_number' => 'Audi A6-4555',
                'created_at' => '2025-02-05 18:29:32',
                'updated_at' => '2025-02-05 18:29:32',
            ),
            19 => 
            array (
                'id' => 21,
                'vehicle_id' => 9,
                'provider_id' => 66,
                'vin_number' => 'Por-987-Sche-50',
                'license_plate_number' => 'Caye-AE-856',
                'created_at' => '2025-02-06 12:12:47',
                'updated_at' => '2025-02-06 12:12:47',
            ),
            20 => 
            array (
                'id' => 22,
                'vehicle_id' => 9,
                'provider_id' => 66,
                'vin_number' => 'Por-987-Sche-51',
                'license_plate_number' => 'Caye-RE-856',
                'created_at' => '2025-02-06 12:12:47',
                'updated_at' => '2025-02-06 12:12:47',
            ),
            21 => 
            array (
                'id' => 23,
                'vehicle_id' => 9,
                'provider_id' => 66,
                'vin_number' => 'Por-987-Sche-52',
                'license_plate_number' => 'Caye-FOE-856',
                'created_at' => '2025-02-06 12:12:47',
                'updated_at' => '2025-02-06 12:12:47',
            ),
            22 => 
            array (
                'id' => 24,
                'vehicle_id' => 9,
                'provider_id' => 66,
                'vin_number' => 'Por-987-Sche-53',
                'license_plate_number' => 'Caye-FUE-856',
                'created_at' => '2025-02-06 12:12:47',
                'updated_at' => '2025-02-06 12:12:47',
            ),
            23 => 
            array (
                'id' => 25,
                'vehicle_id' => 9,
                'provider_id' => 66,
                'vin_number' => 'Por-987-Sche-54',
                'license_plate_number' => 'Caye-FET-856',
                'created_at' => '2025-02-06 12:12:47',
                'updated_at' => '2025-02-06 12:12:47',
            ),
            24 => 
            array (
                'id' => 26,
                'vehicle_id' => 9,
                'provider_id' => 66,
                'vin_number' => 'Por-987-Sche-55',
                'license_plate_number' => 'Caye-RE-856',
                'created_at' => '2025-02-06 12:12:47',
                'updated_at' => '2025-02-06 12:12:47',
            ),
            25 => 
            array (
                'id' => 27,
                'vehicle_id' => 9,
                'provider_id' => 66,
                'vin_number' => 'Por-987-Sche-56',
                'license_plate_number' => 'Caye-FRE-856',
                'created_at' => '2025-02-06 12:12:47',
                'updated_at' => '2025-02-06 12:12:47',
            ),
            26 => 
            array (
                'id' => 28,
                'vehicle_id' => 9,
                'provider_id' => 66,
                'vin_number' => 'Por-987-Sche-57',
                'license_plate_number' => 'Caye-FE-856',
                'created_at' => '2025-02-06 12:12:47',
                'updated_at' => '2025-02-06 12:12:47',
            ),
            27 => 
            array (
                'id' => 29,
                'vehicle_id' => 9,
                'provider_id' => 66,
                'vin_number' => 'Por-987-Sche-58',
                'license_plate_number' => 'Caye-FEE-856',
                'created_at' => '2025-02-06 12:12:47',
                'updated_at' => '2025-02-06 12:12:47',
            ),
            28 => 
            array (
                'id' => 30,
                'vehicle_id' => 9,
                'provider_id' => 66,
                'vin_number' => 'Por-987-Sche-59',
                'license_plate_number' => 'Caye-FE-856',
                'created_at' => '2025-02-06 12:12:47',
                'updated_at' => '2025-02-06 12:12:47',
            ),
            29 => 
            array (
                'id' => 32,
                'vehicle_id' => 10,
                'provider_id' => 64,
                'vin_number' => 'Por-987-Sche',
                'license_plate_number' => 'S51-4578-02',
                'created_at' => '2025-02-06 12:28:59',
                'updated_at' => '2025-02-06 12:28:59',
            ),
            30 => 
            array (
                'id' => 33,
                'vehicle_id' => 11,
                'provider_id' => 64,
                'vin_number' => 'Mini-987-Toyo-563',
                'license_plate_number' => 'MI7-HUN-9087',
                'created_at' => '2025-02-06 12:47:28',
                'updated_at' => '2025-02-06 12:47:28',
            ),
            31 => 
            array (
                'id' => 34,
                'vehicle_id' => 11,
                'provider_id' => 64,
                'vin_number' => 'Mini-987-Toyo-45',
                'license_plate_number' => 'MI7-HUN-9087',
                'created_at' => '2025-02-06 12:47:28',
                'updated_at' => '2025-02-06 12:47:28',
            ),
            32 => 
            array (
                'id' => 35,
                'vehicle_id' => 11,
                'provider_id' => 64,
                'vin_number' => 'Mini-907-Toyo-50',
                'license_plate_number' => 'MI7-HUN-9087',
                'created_at' => '2025-02-06 12:47:28',
                'updated_at' => '2025-02-06 12:47:28',
            ),
            33 => 
            array (
                'id' => 36,
                'vehicle_id' => 11,
                'provider_id' => 64,
                'vin_number' => 'Mini-917-Toyo-50',
                'license_plate_number' => 'MI6-HUN-9087',
                'created_at' => '2025-02-06 12:47:28',
                'updated_at' => '2025-02-06 12:47:28',
            ),
            34 => 
            array (
                'id' => 37,
                'vehicle_id' => 11,
                'provider_id' => 64,
                'vin_number' => 'Mini-287-Toyo-50',
                'license_plate_number' => 'MI8-HUN-9087',
                'created_at' => '2025-02-06 12:47:28',
                'updated_at' => '2025-02-06 12:47:28',
            ),
            35 => 
            array (
                'id' => 38,
                'vehicle_id' => 11,
                'provider_id' => 64,
                'vin_number' => 'Mini-987-Toyo-55',
                'license_plate_number' => 'MI7-HUN-9085',
                'created_at' => '2025-02-06 12:47:28',
                'updated_at' => '2025-02-06 12:47:28',
            ),
            36 => 
            array (
                'id' => 39,
                'vehicle_id' => 12,
                'provider_id' => 66,
                'vin_number' => 'Traverse75TY6',
                'license_plate_number' => 'TK-Y5T-9087',
                'created_at' => '2025-02-06 12:53:03',
                'updated_at' => '2025-02-06 12:53:03',
            ),
            37 => 
            array (
                'id' => 40,
                'vehicle_id' => 13,
                'provider_id' => 66,
                'vin_number' => 'Odyssey-987',
                'license_plate_number' => 'Caye-FE-Odyssey',
                'created_at' => '2025-02-06 12:57:51',
                'updated_at' => '2025-02-06 12:57:51',
            ),
            38 => 
            array (
                'id' => 41,
                'vehicle_id' => 13,
                'provider_id' => 66,
                'vin_number' => 'Odyssey-630',
                'license_plate_number' => 'Caye-SE-Odyssey',
                'created_at' => '2025-02-06 12:57:51',
                'updated_at' => '2025-02-06 12:57:51',
            ),
            39 => 
            array (
                'id' => 42,
                'vehicle_id' => 14,
                'provider_id' => 66,
                'vin_number' => 'Rover-987-Range',
                'license_plate_number' => 'Range-AE-856',
                'created_at' => '2025-02-06 13:01:14',
                'updated_at' => '2025-02-06 13:01:14',
            ),
            40 => 
            array (
                'id' => 43,
                'vehicle_id' => 15,
                'provider_id' => 66,
                'vin_number' => 'sallon-987-Sche-75',
                'license_plate_number' => 'Caye-SL-81',
                'created_at' => '2025-02-06 13:07:26',
                'updated_at' => '2025-02-06 13:07:26',
            ),
            41 => 
            array (
                'id' => 44,
                'vehicle_id' => 15,
                'provider_id' => 66,
                'vin_number' => 'sallon-987-Sche-50',
                'license_plate_number' => 'Caye-SL-856',
                'created_at' => '2025-02-06 13:07:26',
                'updated_at' => '2025-02-06 13:07:26',
            ),
            42 => 
            array (
                'id' => 45,
                'vehicle_id' => 16,
                'provider_id' => 64,
                'vin_number' => 'op897Yt6',
                'license_plate_number' => '459-LK89I-764',
                'created_at' => '2025-02-06 14:20:47',
                'updated_at' => '2025-02-06 14:20:47',
            ),
            43 => 
            array (
                'id' => 46,
                'vehicle_id' => 17,
                'provider_id' => 66,
                'vin_number' => 'NissanS054',
                'license_plate_number' => 'TK-NIS-9087',
                'created_at' => '2025-02-06 14:24:59',
                'updated_at' => '2025-02-06 14:24:59',
            ),
            44 => 
            array (
                'id' => 47,
                'vehicle_id' => 17,
                'provider_id' => 66,
                'vin_number' => 'NissanGreenS0',
                'license_plate_number' => 'S01-Green-02',
                'created_at' => '2025-02-06 14:24:59',
                'updated_at' => '2025-02-06 14:24:59',
            ),
            45 => 
            array (
                'id' => 48,
                'vehicle_id' => 18,
                'provider_id' => 66,
                'vin_number' => 'Bolt-EV-50',
                'license_plate_number' => 'BOLT-HUN-9087',
                'created_at' => '2025-02-06 14:28:21',
                'updated_at' => '2025-02-06 14:28:21',
            ),
            46 => 
            array (
                'id' => 49,
                'vehicle_id' => 19,
                'provider_id' => 66,
                'vin_number' => 'Por-987',
                'license_plate_number' => 'TK-RVEV-9087',
                'created_at' => '2025-02-06 14:31:43',
                'updated_at' => '2025-02-06 14:31:43',
            ),
        ));
        
        
    }
}