<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PharmacyItemDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pharmacy_item_details')->delete();
        
        \DB::table('pharmacy_item_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'item_id' => 160,
                'common_condition_id' => 1,
                'is_basic' => 1,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'item_id' => 158,
                'common_condition_id' => 1,
                'is_basic' => 1,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'item_id' => 154,
                'common_condition_id' => 1,
                'is_basic' => 1,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'item_id' => 91,
                'common_condition_id' => NULL,
                'is_basic' => 1,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'item_id' => 88,
                'common_condition_id' => 13,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'item_id' => 156,
                'common_condition_id' => 3,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'item_id' => 155,
                'common_condition_id' => 3,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'item_id' => 152,
                'common_condition_id' => 3,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'item_id' => 149,
                'common_condition_id' => 3,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'item_id' => 89,
                'common_condition_id' => 13,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'item_id' => 76,
                'common_condition_id' => 2,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'item_id' => 74,
                'common_condition_id' => 3,
                'is_basic' => 1,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            12 => 
            array (
                'id' => 13,
                'item_id' => 69,
                'common_condition_id' => 12,
                'is_basic' => 1,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            13 => 
            array (
                'id' => 14,
                'item_id' => 68,
                'common_condition_id' => 1,
                'is_basic' => 1,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            14 => 
            array (
                'id' => 15,
                'item_id' => 66,
                'common_condition_id' => 8,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'item_id' => 64,
                'common_condition_id' => 12,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            16 => 
            array (
                'id' => 17,
                'item_id' => 62,
                'common_condition_id' => 1,
                'is_basic' => 1,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            17 => 
            array (
                'id' => 18,
                'item_id' => 61,
                'common_condition_id' => 4,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            18 => 
            array (
                'id' => 19,
                'item_id' => 59,
                'common_condition_id' => 4,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            19 => 
            array (
                'id' => 20,
                'item_id' => 41,
                'common_condition_id' => 12,
                'is_basic' => 1,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            20 => 
            array (
                'id' => 21,
                'item_id' => 40,
                'common_condition_id' => 12,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            21 => 
            array (
                'id' => 22,
                'item_id' => 37,
                'common_condition_id' => 12,
                'is_basic' => 1,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            22 => 
            array (
                'id' => 23,
                'item_id' => 86,
                'common_condition_id' => 13,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            23 => 
            array (
                'id' => 24,
                'item_id' => 84,
                'common_condition_id' => 13,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            24 => 
            array (
                'id' => 25,
                'item_id' => 77,
                'common_condition_id' => 2,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            25 => 
            array (
                'id' => 26,
                'item_id' => 56,
                'common_condition_id' => 4,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            26 => 
            array (
                'id' => 27,
                'item_id' => 51,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            27 => 
            array (
                'id' => 28,
                'item_id' => 27,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            28 => 
            array (
                'id' => 29,
                'item_id' => 25,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            29 => 
            array (
                'id' => 30,
                'item_id' => 19,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            30 => 
            array (
                'id' => 31,
                'item_id' => 16,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'item_id' => 148,
                'common_condition_id' => 8,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            32 => 
            array (
                'id' => 33,
                'item_id' => 9,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            33 => 
            array (
                'id' => 34,
                'item_id' => 70,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            34 => 
            array (
                'id' => 35,
                'item_id' => 3,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            35 => 
            array (
                'id' => 36,
                'item_id' => 151,
                'common_condition_id' => 8,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            36 => 
            array (
                'id' => 37,
                'item_id' => 93,
                'common_condition_id' => 8,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            37 => 
            array (
                'id' => 38,
                'item_id' => 83,
                'common_condition_id' => 13,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            38 => 
            array (
                'id' => 39,
                'item_id' => 80,
                'common_condition_id' => 2,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            39 => 
            array (
                'id' => 40,
                'item_id' => 79,
                'common_condition_id' => 2,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            40 => 
            array (
                'id' => 41,
                'item_id' => 75,
                'common_condition_id' => 2,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            41 => 
            array (
                'id' => 42,
                'item_id' => 54,
                'common_condition_id' => 4,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            42 => 
            array (
                'id' => 43,
                'item_id' => 50,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            43 => 
            array (
                'id' => 44,
                'item_id' => 47,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            44 => 
            array (
                'id' => 45,
                'item_id' => 44,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            45 => 
            array (
                'id' => 46,
                'item_id' => 35,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            46 => 
            array (
                'id' => 47,
                'item_id' => 32,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            47 => 
            array (
                'id' => 48,
                'item_id' => 30,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            48 => 
            array (
                'id' => 49,
                'item_id' => 26,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            49 => 
            array (
                'id' => 50,
                'item_id' => 23,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            50 => 
            array (
                'id' => 51,
                'item_id' => 20,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'is_prescription_required' => 0,
            ),
            51 => 
            array (
                'id' => 52,
                'item_id' => 363,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => '2024-11-06 11:12:20',
                'updated_at' => '2024-11-06 11:12:20',
                'is_prescription_required' => 0,
            ),
            52 => 
            array (
                'id' => 53,
                'item_id' => 364,
                'common_condition_id' => NULL,
                'is_basic' => 0,
                'temp_product_id' => NULL,
                'created_at' => '2024-11-06 11:13:46',
                'updated_at' => '2024-11-06 11:13:46',
                'is_prescription_required' => 0,
            ),
        ));
        
        
    }
}