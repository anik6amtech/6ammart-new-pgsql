<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TempProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('temp_products')->delete();
        
        \DB::table('temp_products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Nivea Refreshing Wash Gel',
                'description' => '1. Cleanses deeply for sensational fresh skin
2. Invigorates the skin with its refreshing formula with vitamin E & lotus flower
3. The mild yet effective formula deeply cleanses your skin
4. Maintains skin\'s natural moisture balance
5. Best suited for normal skin',
                'image' => '2024-10-27-671e290222541.png',
                'images' => '[]',
                'store_id' => 30,
                'module_id' => 1,
                'unit_id' => 3,
                'item_id' => 138,
                'category_id' => 60,
                'category_ids' => '[{"id":"10","position":1},{"id":"60","position":2}]',
                'tag_ids' => '[]',
                'slug' => 'nivea-refreshing-wash-gel138',
                'variations' => '[{"type":"100ml","price":0,"stock":0},{"type":"250ml","price":0,"stock":0}]',
                'food_variations' => '[]',
                'add_ons' => '[]',
                'attributes' => '["1"]',
                'choice_options' => '[{"name":"choice_1","title":"Size","options":["100ml"," 250ml"]}]',
                'price' => '300.00',
                'tax' => '0.00',
                'tax_type' => 'percent',
                'discount' => '0.00',
                'discount_type' => 'percent',
                'veg' => 0,
                'recommended' => 0,
                'organic' => 1,
                'common_condition_id' => NULL,
                'basic' => 0,
                'status' => 1,
                'stock' => 99,
                'maximum_cart_quantity' => NULL,
                'note' => NULL,
                'is_rejected' => 0,
                'available_time_ends' => '23:59:59',
                'available_time_starts' => '00:00:00',
                'created_at' => '2024-10-27 17:50:26',
                'updated_at' => '2024-10-27 17:50:26',
                'is_halal' => 0,
                'brand_id' => 0,
                'is_prescription_required' => 0,
                'nutrition_ids' => '[]',
                'allergy_ids' => '[]',
                'generic_ids' => '[]',
            ),
        ));
        
        
    }
}