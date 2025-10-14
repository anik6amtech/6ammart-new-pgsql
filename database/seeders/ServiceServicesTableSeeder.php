<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_services')->delete();
        
        \DB::table('service_services')->insert(array (
            0 => 
            array (
                'id' => 1,
                'module_id' => 8,
                'name' => 'Full house cleaning',
            'short_description' => 'Full house cleaning (bedrooms, living room, kitchen, bathroom)
Note To Customer:

If Any Delay Happens By Customer (30 Mints +) Then There Will Be An Extra Charge Add With The Service Price
After Delivering The Service, The Customer Must Cross Check The Service Before The Service Person Leaves The Place After That No Complaint Will Be Accepted
Make Sure To Keep The Expensive Belongings In A Safe Place
Customer Need To Provide Fresh Water And Electricity To Support The Service Person
The Service price might be change, if the working area is in very poor Condition.
If The Work Area Increases Then Extra Price Will Be Added
Make Sure No Other Work Is Going On When The Cleaning Service Is Being Delivered.',
            'description' => '<p>Full house cleaning (bedrooms, living room, kitchen, bathroom)</p>

<h4>Note To Customer:</h4>

<p>&nbsp;</p>

<ul>
<li>If Any Delay Happens By Customer (30 Mints +) Then There Will Be An Extra Charge Add With The Service Price</li>
<li>After Delivering The Service, The Customer Must Cross Check The Service Before The Service Person Leaves The Place After That No Complaint Will Be Accepted</li>
<li>Make Sure To Keep The Expensive Belongings In A Safe Place</li>
<li>Customer Need To Provide Fresh Water And Electricity To Support The Service Person</li>
<li>The Service price might be change, if the working area is in very poor Condition.</li>
<li>If The Work Area Increases Then Extra Price Will Be Added</li>
<li>Make Sure No Other Work Is Going On When The Cleaning Service Is Being Delivered.</li>
</ul>',
                'cover_image' => '2025-09-04-68b929bb98e0d.png',
                'thumbnail' => '2025-09-04-68b929bb99549.png',
                'category_id' => 1,
                'sub_category_id' => 4,
                'tax' => '10.000',
                'order_count' => 0,
                'is_active' => 1,
                'rating_count' => 6,
                'avg_rating' => 4.67,
                'min_bidding_price' => '300.000',
                'deleted_at' => NULL,
                'created_at' => '2025-09-04 05:28:08',
                'updated_at' => '2025-10-11 12:11:39',
            ),
            1 => 
            array (
                'id' => 2,
                'module_id' => 8,
                'name' => 'Floor scrubbing & polishing',
                'short_description' => 'Floor scrubbing & polishing',
                'description' => '<p>Floor scrubbing &amp; polishing</p>',
                'cover_image' => '2025-09-04-68b929a6f3b21.png',
                'thumbnail' => '2025-09-04-68b929a700116.png',
                'category_id' => 1,
                'sub_category_id' => 4,
                'tax' => '10.000',
                'order_count' => 0,
                'is_active' => 1,
                'rating_count' => 0,
                'avg_rating' => 0.0,
                'min_bidding_price' => '100.000',
                'deleted_at' => NULL,
                'created_at' => '2025-09-04 05:30:18',
                'updated_at' => '2025-09-04 05:54:47',
            ),
            2 => 
            array (
                'id' => 3,
                'module_id' => 8,
                'name' => 'Carpet deep shampooing',
                'short_description' => 'Carpet deep shampooing',
                'description' => '<p>Carpet deep shampooing</p>',
                'cover_image' => '2025-09-04-68b9298d0e52e.png',
                'thumbnail' => '2025-09-04-68b9298d0efd0.png',
                'category_id' => 1,
                'sub_category_id' => 5,
                'tax' => '10.000',
                'order_count' => 0,
                'is_active' => 1,
                'rating_count' => 2,
                'avg_rating' => 5.0,
                'min_bidding_price' => '100.000',
                'deleted_at' => NULL,
                'created_at' => '2025-09-04 05:33:41',
                'updated_at' => '2025-10-12 12:43:30',
            ),
            3 => 
            array (
                'id' => 4,
                'module_id' => 8,
                'name' => 'Glass Cleaning',
                'short_description' => 'House glass clean',
                'description' => '<p>Your home&#39;s glass will be clean like new.</p>',
                'cover_image' => '2025-09-09-68bfb55a436a8.png',
                'thumbnail' => '2025-09-09-68bfb55a77e05.png',
                'category_id' => 1,
                'sub_category_id' => 4,
                'tax' => '5.000',
                'order_count' => 0,
                'is_active' => 1,
                'rating_count' => 0,
                'avg_rating' => 0.0,
                'min_bidding_price' => '100.000',
                'deleted_at' => NULL,
                'created_at' => '2025-09-09 11:04:26',
                'updated_at' => '2025-09-09 11:04:26',
            ),
            4 => 
            array (
                'id' => 5,
                'module_id' => 8,
                'name' => 'office clean',
                'short_description' => 'Office clean properly with our best service',
                'description' => '<p>Office clean properly with our best service</p>',
                'cover_image' => '2025-09-09-68bfb8b54967c.png',
                'thumbnail' => '2025-09-09-68bfb8b56ebd1.png',
                'category_id' => 1,
                'sub_category_id' => 4,
                'tax' => '10.000',
                'order_count' => 0,
                'is_active' => 1,
                'rating_count' => 0,
                'avg_rating' => 0.0,
                'min_bidding_price' => '100.000',
                'deleted_at' => NULL,
                'created_at' => '2025-09-09 11:18:45',
                'updated_at' => '2025-09-09 11:18:45',
            ),
            5 => 
            array (
                'id' => 6,
                'module_id' => 8,
                'name' => 'Fan Service',
                'short_description' => 'I can do your fan any kind of issue.',
                'description' => '<p>I can do your fan any kind of issue.</p>',
                'cover_image' => '2025-09-09-68bfbb12a8f98.png',
                'thumbnail' => '2025-09-09-68bfbb12aa9d1.png',
                'category_id' => 3,
                'sub_category_id' => 10,
                'tax' => '5.000',
                'order_count' => 0,
                'is_active' => 1,
                'rating_count' => 1,
                'avg_rating' => 5.0,
                'min_bidding_price' => '100.000',
                'deleted_at' => NULL,
                'created_at' => '2025-09-09 11:28:50',
                'updated_at' => '2025-09-23 17:54:26',
            ),
            6 => 
            array (
                'id' => 7,
                'module_id' => 8,
                'name' => 'Electric Service for house',
                'short_description' => 'We provide Electric Service for house with properly. We build our team with trust.',
                'description' => '<p>We provide Electric Service for house with properly. We build our team with trust.</p>',
                'cover_image' => '2025-09-09-68bfbbe560636.png',
                'thumbnail' => '2025-09-09-68bfbbe5621a0.png',
                'category_id' => 3,
                'sub_category_id' => 9,
                'tax' => '3.000',
                'order_count' => 0,
                'is_active' => 1,
                'rating_count' => 0,
                'avg_rating' => 0.0,
                'min_bidding_price' => '100.000',
                'deleted_at' => NULL,
                'created_at' => '2025-09-09 11:32:21',
                'updated_at' => '2025-09-09 11:32:21',
            ),
            7 => 
            array (
                'id' => 8,
                'module_id' => 8,
                'name' => 'Jolie Bradshaw',
                'short_description' => 'Aut rerum iste enim',
                'description' => '<p>asdasd</p>',
                'cover_image' => '2025-09-17-68ca3e2c65064.png',
                'thumbnail' => '2025-09-17-68ca3e2c66813.png',
                'category_id' => 3,
                'sub_category_id' => 10,
                'tax' => '10.000',
                'order_count' => 0,
                'is_active' => 1,
                'rating_count' => 0,
                'avg_rating' => 0.0,
                'min_bidding_price' => '909.000',
                'deleted_at' => NULL,
                'created_at' => '2025-09-17 10:50:52',
                'updated_at' => '2025-09-17 10:50:52',
            ),
            8 => 
            array (
                'id' => 9,
                'module_id' => 8,
                'name' => 'Washing Machine cleaning',
                'short_description' => 'A common kitchen ingredient, white vinegar has natural disinfectant properties, making it highly useful for cleaning your washing machine. Instead of detergent, pour two cups of white vinegar into the detergent dispenser and run an empty, hot cycle. Don\'t worry about the vinegar harming your machine or the clothes.',
                'description' => '<p>dasfds fgrgqer</p>',
                'cover_image' => '2025-09-22-68d130aa128c3.png',
                'thumbnail' => '2025-09-22-68d130aa13a0c.png',
                'category_id' => 1,
                'sub_category_id' => 4,
                'tax' => '5.000',
                'order_count' => 0,
                'is_active' => 1,
                'rating_count' => 0,
                'avg_rating' => 0.0,
                'min_bidding_price' => '50.000',
                'deleted_at' => NULL,
                'created_at' => '2025-09-22 17:19:06',
                'updated_at' => '2025-09-22 17:19:06',
            ),
            9 => 
            array (
                'id' => 10,
                'module_id' => 8,
                'name' => 'Urielle Horne',
                'short_description' => 'Cillum voluptatem ild',
                'description' => '<p>231321321asdas</p>',
                'cover_image' => '2025-09-28-68d8c22680409.png',
                'thumbnail' => '2025-09-28-68d8c22682611.png',
                'category_id' => 3,
                'sub_category_id' => 10,
                'tax' => '48.000',
                'order_count' => 0,
                'is_active' => 0,
                'rating_count' => 1,
                'avg_rating' => 5.0,
                'min_bidding_price' => '18.000',
                'deleted_at' => NULL,
                'created_at' => '2025-09-28 11:05:42',
                'updated_at' => '2025-10-06 15:49:39',
            ),
        ));
        
        
    }
}