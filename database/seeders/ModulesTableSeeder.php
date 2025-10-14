<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('modules')->delete();
        
        \DB::table('modules')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_name' => 'Grocery',
                'module_type' => 'grocery',
                'thumbnail' => '2024-11-16-673828326867d.png',
                'status' => 1,
                'stores_count' => 15,
                'created_at' => '2022-03-16 13:24:16',
                'updated_at' => '2025-02-06 10:19:18',
                'icon' => '2025-02-06-67a438465d27f.png',
                'theme_id' => 1,
                'description' => '<p><strong>We make grocery shopping more interesting.</strong><br />
Find the greatest deals from the grocery stores near you.</p>

<p><br />
<strong>Nature &amp; Organic Products</strong><br />
Bring Nature into your home.<br />
<br />
<strong>Stay home &amp; get your daily needs from our shop</strong><br />
Start You&#39;r Daily Shopping with 6amMart</p>',
                'all_zone_service' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'module_name' => 'Pharmacy',
                'module_type' => 'pharmacy',
                'thumbnail' => '2025-02-06-67a438f6144e6.png',
                'status' => 1,
                'stores_count' => 15,
                'created_at' => '2022-03-16 13:24:49',
                'updated_at' => '2025-02-06 10:22:14',
                'icon' => '2025-02-06-67a43835dac63.png',
                'theme_id' => 1,
                'description' => '<p><strong>We make buying medicine even more easier</strong><br />
Find the greatest deals from the phamacy stores near you.</p>

<p><br />
<strong>Best Quality Medicines</strong><br />
No need to go out for medicine at mid night<br />
<br />
<strong>Stay home &amp; get your daily needs from our shop</strong><br />
Start You&#39;r Daily Shopping with 6amMart</p>',
                'all_zone_service' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'module_name' => 'Shop',
                'module_type' => 'ecommerce',
                'thumbnail' => '2025-02-06-67a438bedce86.png',
                'status' => 1,
                'stores_count' => 14,
                'created_at' => '2022-03-22 10:46:05',
                'updated_at' => '2025-02-06 10:21:18',
                'icon' => '2025-02-06-67a4382715e23.png',
                'theme_id' => 1,
                'description' => '<p><strong>We make your regular shopping more interesting.</strong><br />
Find the greatest deals from the items &amp; stores near you. &nbsp;</p>

<p><strong>Find Quality &amp; Authentic Items</strong><br />
Bring Quality into your home.</p>

<p><strong>Stay home &amp; get your daily needs from our shop</strong><br />
Start You&#39;r Daily Shopping with 6amMart</p>',
                'all_zone_service' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'module_name' => 'Food',
                'module_type' => 'food',
                'thumbnail' => '2025-02-06-67a438a145c18.png',
                'status' => 1,
                'stores_count' => 15,
                'created_at' => '2022-03-22 11:54:01',
                'updated_at' => '2025-02-06 10:20:49',
                'icon' => '2025-02-06-67a43817c6cc0.png',
                'theme_id' => 1,
                'description' => '<p><strong>We make food delivery&nbsp;&nbsp;more interesting.</strong><br />
Find the greatest deals from the restaurants near you.</p>

<p><br />
<strong>Testy &amp; healthy dishes&nbsp;</strong><br />
Bring restaurant into your home.<br />
<br />
<strong>Stay home &amp; enjoy your favourite dishes from our restaurant&nbsp;</strong><br />
Experience delicious dishes&nbsp;with 6amMart</p>',
                'all_zone_service' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'module_name' => 'Parcel',
                'module_type' => 'parcel',
                'thumbnail' => '2025-02-06-67a4388844f3d.png',
                'status' => 1,
                'stores_count' => 0,
                'created_at' => '2022-03-22 14:57:19',
                'updated_at' => '2025-09-09 12:39:34',
                'icon' => '2025-09-09-68bfcba661896.png',
                'theme_id' => 1,
                'description' => '<p><strong>We make your parcel delivery more easier.</strong><br />
Just request a rider to pick your rider to delivery your parcel to your loved once.</p>

<p><br />
<strong>Stay home &amp; send love to friends &amp; familiy</strong>&nbsp;<br />
Start You&#39;r parcel delivery with &nbsp;6amMart</p>',
                'all_zone_service' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'module_name' => 'Rental',
                'module_type' => 'rental',
                'thumbnail' => '2025-02-06-67a437d57f96c.png',
                'status' => 1,
                'stores_count' => 0,
                'created_at' => '2025-02-05 06:46:06',
                'updated_at' => '2025-09-09 12:40:04',
                'icon' => '2025-09-09-68bfcbc4984c9.png',
                'theme_id' => 1,
                'description' => '<p><strong>Your Car, Delivered to Your Doorstep!</strong><br />
Choose from a wide range of vehicles, from compact cars to SUVs and luxury vehicles.<br />
<br />
<strong>Rent a Car, Anytime, Anywhere</strong><br />
Rent by the hour, day, or week&mdash;whatever suits your needs.<br />
<br />
<strong>Drive Without the Hassle&mdash;We Deliver the Car!</strong><br />
Schedule a driver to deliver the rental car to your location at your preferred time.</p>',
                'all_zone_service' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'module_name' => 'Ride Share',
                'module_type' => 'ride-share',
                'thumbnail' => '2025-02-06-67a4388844f3d.png',
                'status' => 1,
                'stores_count' => 0,
                'created_at' => '2022-03-22 14:57:19',
                'updated_at' => '2025-09-09 11:19:45',
                'icon' => '2025-09-09-68bfb8f1c5272.png',
                'theme_id' => 1,
                'description' => '<p><strong>We make your parcel delivery more easier.</strong><br />
Just request a rider to pick your rider to delivery your parcel to your loved once.</p>

<p><br />
<strong>Stay home &amp; send love to friends &amp; familiy</strong>&nbsp;<br />
Start You&#39;r parcel delivery with &nbsp;6amMart</p>',
                'all_zone_service' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'module_name' => 'Service',
                'module_type' => 'service',
                'thumbnail' => '2025-02-06-67a437d57f96c.png',
                'status' => 1,
                'stores_count' => 0,
                'created_at' => '2025-02-05 06:46:06',
                'updated_at' => '2025-09-09 12:00:55',
                'icon' => '2025-09-09-68bfc297d9eaf.png',
                'theme_id' => 1,
                'description' => '<p><strong>Your Car, Delivered to Your Doorstep!</strong><br />
Choose from a wide range of vehicles, from compact cars to SUVs and luxury vehicles.<br />
<br />
<strong>Rent a Car, Anytime, Anywhere</strong><br />
Rent by the hour, day, or week&mdash;whatever suits your needs.<br />
<br />
<strong>Drive Without the Hassle&mdash;We Deliver the Car!</strong><br />
Schedule a driver to deliver the rental car to your location at your preferred time.</p>',
                'all_zone_service' => 0,
            ),
        ));
        
        
    }
}