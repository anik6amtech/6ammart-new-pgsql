<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehiclesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vehicles')->delete();
        
        \DB::table('vehicles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Toyota Corolla',
            'description' => 'Daily Commuting (Economical and Efficient)',
                'thumbnail' => '2025-02-05-67a34d27c5d53.png',
                'images' => '[{"img":"2025-02-05-67a34d27c9a81.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 67,
                'brand_id' => 1,
                'category_id' => 1,
                'model' => 'Toyota700',
                'type' => 'compact',
                'engine_capacity' => '1000',
                'engine_power' => '25000',
                'seating_capacity' => '4',
                'air_condition' => 1,
                'fuel_type' => 'octan',
                'transmission_type' => 'automatic',
                'multiple_vehicles' => 1,
                'trip_hourly' => 1,
                'trip_distance' => 1,
                'hourly_price' => '250.00000000',
                'distance_price' => '500.00000000',
                'discount_type' => 'percent',
                'discount_price' => '10.00000000',
                'tag' => '["new","car"]',
                'documents' => '[{"img":"2025-02-05-67a34d27cc374.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 3,
                'avg_rating' => '4.00',
                'rating' => '{"1":0,"2":0,"3":0,"4":1,"5":0}',
                'total_reviews' => 1,
                'slug' => 'toyota-corolla',
                'created_at' => '2025-02-05 17:36:07',
                'updated_at' => '2025-02-08 13:09:18',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Honda Civic',
            'description' => 'Daily Commuting (Economical and Efficient)',
                'thumbnail' => '2025-02-05-67a34ece54006.png',
                'images' => '[{"img":"2025-02-05-67a34ece564b5.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 67,
                'brand_id' => 2,
                'category_id' => 3,
                'model' => 'HondaCivic450',
                'type' => 'affordable',
                'engine_capacity' => '1000',
                'engine_power' => '10000',
                'seating_capacity' => '7',
                'air_condition' => 1,
                'fuel_type' => 'electric',
                'transmission_type' => 'dual_clutch',
                'multiple_vehicles' => 0,
                'trip_hourly' => 1,
                'trip_distance' => 0,
                'hourly_price' => '500.00000000',
                'distance_price' => '0.00000000',
                'discount_type' => 'amount',
                'discount_price' => '20.00000000',
                'tag' => '["new","car"]',
                'documents' => '[{"img":"2025-02-05-67a34ece5899b.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 2,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'honda-civic',
                'created_at' => '2025-02-05 17:43:10',
                'updated_at' => '2025-02-08 13:06:59',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Hyundai Elantra',
                'description' => 'The Hyundai Elantra Series is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-05-67a353291c9d7.png',
                'images' => '[{"img":"2025-02-05-67a353291ef42.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 66,
                'brand_id' => 9,
                'category_id' => 3,
                'model' => 'Hyundai40',
                'type' => 'executives',
                'engine_capacity' => '5000',
                'engine_power' => '10000',
                'seating_capacity' => '7',
                'air_condition' => 1,
                'fuel_type' => 'petrol',
                'transmission_type' => 'continuously_variable',
                'multiple_vehicles' => 1,
                'trip_hourly' => 0,
                'trip_distance' => 1,
                'hourly_price' => '0.00000000',
                'distance_price' => '360.00000000',
                'discount_type' => 'amount',
                'discount_price' => '60.00000000',
                'tag' => '["New","Sedan"]',
                'documents' => '[{"img":"2025-02-05-67a35329214dd.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 4,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'hyundai-elantra',
                'created_at' => '2025-02-05 18:01:45',
                'updated_at' => '2025-02-08 11:59:28',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Nissan Sentra',
            'description' => 'Daily Commuting (Economical and Efficient)',
                'thumbnail' => '2025-02-05-67a35474964ed.png',
                'images' => '[{"img":"2025-02-05-67a354749a270.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 66,
                'brand_id' => 8,
                'category_id' => 5,
                'model' => 'NissanSentra404',
                'type' => 'luxury',
                'engine_capacity' => '6000',
                'engine_power' => '6000',
                'seating_capacity' => '9',
                'air_condition' => 1,
                'fuel_type' => 'petrol',
                'transmission_type' => 'semi_automatic',
                'multiple_vehicles' => 0,
                'trip_hourly' => 1,
                'trip_distance' => 1,
                'hourly_price' => '120.00000000',
                'distance_price' => '350.00000000',
                'discount_type' => 'amount',
                'discount_price' => '30.00000000',
                'tag' => '["car"]',
                'documents' => '[{"img":"2025-02-05-67a354749de23.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 0,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'nissan-sentra',
                'created_at' => '2025-02-05 18:07:16',
                'updated_at' => '2025-02-06 16:57:40',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'BMW 3 Series',
                'description' => 'The BMW 3 Series is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.

Key Features:
1. Engine & Performance 
2. Transmission
3. Interior 
4. Technology 
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-05-67a3581f5e034.png',
                'images' => '[{"img":"2025-02-05-67a3581f60a14.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 60,
                'brand_id' => 3,
                'category_id' => 2,
                'model' => 'B-223432',
                'type' => 'full_size',
                'engine_capacity' => '1000',
                'engine_power' => '25000',
                'seating_capacity' => '8',
                'air_condition' => 1,
                'fuel_type' => 'octan',
                'transmission_type' => 'automatic',
                'multiple_vehicles' => 1,
                'trip_hourly' => 1,
                'trip_distance' => 0,
                'hourly_price' => '50.00000000',
                'distance_price' => '0.00000000',
                'discount_type' => 'percent',
                'discount_price' => '5.00000000',
                'tag' => 'null',
                'documents' => '[{"img":"2025-02-05-67a3581f63070.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 1,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'bmw-3-series',
                'created_at' => '2025-02-05 18:22:55',
                'updated_at' => '2025-02-08 12:40:23',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Mercedes-Benz E-Class',
                'description' => 'The Mercedes-Benz E-Class Series is a luxury sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-05-67a358dc24c20.png',
                'images' => '[{"img":"2025-02-05-67a358dc27ef6.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 60,
                'brand_id' => 4,
                'category_id' => 6,
                'model' => 'M-232445',
                'type' => 'executives',
                'engine_capacity' => '2000',
                'engine_power' => '500',
                'seating_capacity' => '7',
                'air_condition' => 1,
                'fuel_type' => 'octan',
                'transmission_type' => 'manual',
                'multiple_vehicles' => 1,
                'trip_hourly' => 1,
                'trip_distance' => 1,
                'hourly_price' => '50.00000000',
                'distance_price' => '20.00000000',
                'discount_type' => 'percent',
                'discount_price' => '10.00000000',
                'tag' => 'null',
                'documents' => '[{"img":"2025-02-05-67a358dc2ade4.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 2,
                'avg_rating' => '5.00',
                'rating' => '{"1":0,"2":0,"3":0,"4":0,"5":1}',
                'total_reviews' => 1,
                'slug' => 'mercedes-benz-e-class',
                'created_at' => '2025-02-05 18:26:04',
                'updated_at' => '2025-02-08 09:26:54',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Audi A6',
                'description' => 'The Audi A6 Series is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-05-67a359ac8681c.png',
                'images' => '[{"img":"2025-02-05-67a359ac88ea8.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 60,
                'brand_id' => 5,
                'category_id' => 2,
                'model' => 'AUDI-23243',
                'type' => 'family',
                'engine_capacity' => '6576',
                'engine_power' => '500',
                'seating_capacity' => '4',
                'air_condition' => 1,
                'fuel_type' => 'octan',
                'transmission_type' => 'automatic',
                'multiple_vehicles' => 1,
                'trip_hourly' => 1,
                'trip_distance' => 0,
                'hourly_price' => '5.00000000',
                'distance_price' => '0.00000000',
                'discount_type' => 'percent',
                'discount_price' => '5.00000000',
                'tag' => 'null',
                'documents' => '[{"img":"2025-02-05-67a359ac8b6e0.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 1,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'audi-a6',
                'created_at' => '2025-02-05 18:29:32',
                'updated_at' => '2025-02-06 17:56:40',
            ),
            7 => 
            array (
                'id' => 9,
                'name' => 'Porsche Cayenne',
                'description' => 'The Porsche Cayenne Series is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-06-67a452df1ffa6.png',
                'images' => '[{"img":"2025-02-06-67a452df227ba.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 66,
                'brand_id' => 12,
                'category_id' => 10,
                'model' => 'Porsche3A0D',
                'type' => 'affordable',
                'engine_capacity' => '1000',
                'engine_power' => '3000',
                'seating_capacity' => '6',
                'air_condition' => 1,
                'fuel_type' => 'CNG',
                'transmission_type' => 'continuously_variable',
                'multiple_vehicles' => 1,
                'trip_hourly' => 1,
                'trip_distance' => 1,
                'hourly_price' => '120.00000000',
                'distance_price' => '550.00000000',
                'discount_type' => 'percent',
                'discount_price' => '17.00000000',
                'tag' => '["NEW","CAR"]',
                'documents' => '[{"img":"2025-02-06-67a452df25086.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 4,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'porsche-cayenne',
                'created_at' => '2025-02-06 12:12:47',
                'updated_at' => '2025-02-06 17:10:37',
            ),
            8 => 
            array (
                'id' => 10,
                'name' => 'Toyota Sienna',
                'description' => 'TheToyota Sienna Series is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-06-67a456ab1d540.png',
                'images' => '[{"img":"2025-02-06-67a456ab219d1.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 64,
                'brand_id' => 1,
                'category_id' => 8,
                'model' => 'ToyotaSienna690',
                'type' => 'family',
                'engine_capacity' => '2500',
                'engine_power' => '3500',
                'seating_capacity' => '15',
                'air_condition' => 0,
                'fuel_type' => 'petrol',
                'transmission_type' => 'continuously_variable',
                'multiple_vehicles' => 0,
                'trip_hourly' => 1,
                'trip_distance' => 0,
                'hourly_price' => '250.00000000',
                'distance_price' => '0.00000000',
                'discount_type' => 'percent',
                'discount_price' => '5.00000000',
                'tag' => '["new","bus"]',
                'documents' => '[{"img":"2025-02-06-67a456ab25e8c.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 0,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'toyota-sienna',
                'created_at' => '2025-02-06 12:25:12',
                'updated_at' => '2025-02-06 12:28:59',
            ),
            9 => 
            array (
                'id' => 11,
                'name' => 'Toyota Highlander',
                'description' => 'The Toyota  Series is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-06-67a45affed93b.png',
                'images' => '[{"img":"2025-02-06-67a45afff0568.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 64,
                'brand_id' => 1,
                'category_id' => 4,
                'model' => 'Toyota7S0',
                'type' => 'family',
                'engine_capacity' => '5600',
                'engine_power' => '2455',
                'seating_capacity' => '14',
                'air_condition' => 1,
                'fuel_type' => 'petrol',
                'transmission_type' => 'dual_clutch',
                'multiple_vehicles' => 1,
                'trip_hourly' => 0,
                'trip_distance' => 1,
                'hourly_price' => '0.00000000',
                'distance_price' => '1200.00000000',
                'discount_type' => 'amount',
                'discount_price' => '200.00000000',
                'tag' => '["mini","bus","new"]',
                'documents' => '[{"img":"2025-02-06-67a45afff2ece.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 0,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'toyota-highlander',
                'created_at' => '2025-02-06 12:47:28',
                'updated_at' => '2025-02-06 12:47:28',
            ),
            10 => 
            array (
                'id' => 12,
                'name' => 'Chevrolet Traverse',
                'description' => 'The Chevrolet Traverse is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-06-67a45c4f5f7c1.png',
                'images' => '[{"img":"2025-02-06-67a45c4f61efa.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 65,
                'brand_id' => 7,
                'category_id' => 7,
                'model' => 'Traverse4T5',
                'type' => 'compact',
                'engine_capacity' => '7800',
                'engine_power' => '9088',
                'seating_capacity' => '5',
                'air_condition' => 1,
                'fuel_type' => 'CNG',
                'transmission_type' => 'semi_automatic',
                'multiple_vehicles' => 0,
                'trip_hourly' => 1,
                'trip_distance' => 1,
                'hourly_price' => '800.00000000',
                'distance_price' => '650.00000000',
                'discount_type' => 'percent',
                'discount_price' => '13.00000000',
                'tag' => '["new","mini"]',
                'documents' => '[{"img":"2025-02-06-67a45c4f64679.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 1,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'chevrolet-traverse',
                'created_at' => '2025-02-06 12:53:03',
                'updated_at' => '2025-02-08 12:11:08',
            ),
            11 => 
            array (
                'id' => 13,
                'name' => 'Honda Odyssey',
                'description' => 'The Honda Odyssey is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-06-67a45d6f38331.png',
                'images' => '[{"img":"2025-02-06-67a45d6f3ab70.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 61,
                'brand_id' => 9,
                'category_id' => 11,
                'model' => 'Odyssey55',
                'type' => 'executives',
                'engine_capacity' => '6000',
                'engine_power' => '9000',
                'seating_capacity' => '6',
                'air_condition' => 1,
                'fuel_type' => 'petrol',
                'transmission_type' => 'manual',
                'multiple_vehicles' => 1,
                'trip_hourly' => 1,
                'trip_distance' => 0,
                'hourly_price' => '5500.00000000',
                'distance_price' => '0.00000000',
                'discount_type' => 'amount',
                'discount_price' => '500.00000000',
                'tag' => '["minibus","new","car"]',
                'documents' => '[{"img":"2025-02-06-67a45d6f3d338.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 1,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'honda-odyssey',
                'created_at' => '2025-02-06 12:57:51',
                'updated_at' => '2025-02-08 12:10:24',
            ),
            12 => 
            array (
                'id' => 14,
                'name' => 'Land Rover Range Rover',
                'description' => 'The Honda Odyssey is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-06-67a45e3a3f844.png',
                'images' => '[{"img":"2025-02-06-67a45e3a421cc.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 66,
                'brand_id' => 2,
                'category_id' => 7,
                'model' => 'Rover Range',
                'type' => 'affordable',
                'engine_capacity' => '5000',
                'engine_power' => '6000',
                'seating_capacity' => '4',
                'air_condition' => 1,
                'fuel_type' => 'diesel',
                'transmission_type' => 'continuously_variable',
                'multiple_vehicles' => 0,
                'trip_hourly' => 1,
                'trip_distance' => 1,
                'hourly_price' => '500.00000000',
                'distance_price' => '300.00000000',
                'discount_type' => 'percent',
                'discount_price' => '25.00000000',
                'tag' => '["new","car"]',
                'documents' => '[{"img":"2025-02-06-67a45e3a4493a.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 0,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'land-rover-range-rover',
                'created_at' => '2025-02-06 13:01:14',
                'updated_at' => '2025-02-06 13:01:14',
            ),
            13 => 
            array (
                'id' => 15,
                'name' => 'Ford Bronco',
                'description' => 'The Ford Bronco is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-06-67a45faecdd9a.png',
                'images' => '[{"img":"2025-02-06-67a45faed064b.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 66,
                'brand_id' => 10,
                'category_id' => 7,
                'model' => 'Tesla 550',
                'type' => 'executives',
                'engine_capacity' => '900',
                'engine_power' => '500',
                'seating_capacity' => '4',
                'air_condition' => 1,
                'fuel_type' => 'jet_fuel',
                'transmission_type' => 'dual_clutch',
                'multiple_vehicles' => 1,
                'trip_hourly' => 1,
                'trip_distance' => 1,
                'hourly_price' => '1200.00000000',
                'distance_price' => '1500.00000000',
                'discount_type' => 'percent',
                'discount_price' => '12.00000000',
                'tag' => '["new"]',
                'documents' => '[{"img":"2025-02-06-67a45faed2c76.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 5,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'ford-bronco',
                'created_at' => '2025-02-06 13:07:26',
                'updated_at' => '2025-02-06 16:29:45',
            ),
            14 => 
            array (
                'id' => 16,
                'name' => 'Tesla Model 3',
                'description' => 'The Tesla Model 3 is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-06-67a470dfd1e20.png',
                'images' => '[{"img":"2025-02-06-67a470dfd4760.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 64,
                'brand_id' => 5,
                'category_id' => 5,
                'model' => 'Thar101',
                'type' => 'executives',
                'engine_capacity' => '5000',
                'engine_power' => '4500',
                'seating_capacity' => '12',
                'air_condition' => 1,
                'fuel_type' => 'jet_fuel',
                'transmission_type' => 'dual_clutch',
                'multiple_vehicles' => 0,
                'trip_hourly' => 1,
                'trip_distance' => 1,
                'hourly_price' => '500.00000000',
                'distance_price' => '850.00000000',
                'discount_type' => 'percent',
                'discount_price' => '50.00000000',
                'tag' => '["car","new"]',
                'documents' => '[{"img":"2025-02-06-67a470dfd6c3e.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 5,
                'avg_rating' => '5.00',
                'rating' => '{"1":0,"2":0,"3":0,"4":0,"5":4}',
                'total_reviews' => 4,
                'slug' => 'tesla-model-3',
                'created_at' => '2025-02-06 14:20:47',
                'updated_at' => '2025-02-06 17:54:59',
            ),
            15 => 
            array (
                'id' => 17,
                'name' => 'Nissan Leaf',
                'description' => 'The Nissan Leaf is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-06-67a471dbe29d9.png',
                'images' => '[{"img":"2025-02-06-67a471dbe527b.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 66,
                'brand_id' => 8,
                'category_id' => 9,
                'model' => 'NISGreen550',
                'type' => 'executives',
                'engine_capacity' => '55555',
                'engine_power' => '4544',
                'seating_capacity' => '6',
                'air_condition' => 1,
                'fuel_type' => 'CNG',
                'transmission_type' => 'dual_clutch',
                'multiple_vehicles' => 1,
                'trip_hourly' => 1,
                'trip_distance' => 0,
                'hourly_price' => '1990.00000000',
                'distance_price' => '0.00000000',
                'discount_type' => 'amount',
                'discount_price' => '90.00000000',
                'tag' => '["New","Car"]',
                'documents' => '[{"img":"2025-02-06-67a471dbe7a3d.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 6,
                'avg_rating' => '5.00',
                'rating' => '{"1":0,"2":0,"3":0,"4":0,"5":1}',
                'total_reviews' => 1,
                'slug' => 'nissan-leaf',
                'created_at' => '2025-02-06 14:24:59',
                'updated_at' => '2025-02-06 17:42:27',
            ),
            16 => 
            array (
                'id' => 18,
                'name' => 'Chevrolet Bolt EV',
                'description' => 'The Chevrolet Bolt EV is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-06-67a472a54bd16.png',
                'images' => '[{"img":"2025-02-06-67a472a54e305.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 66,
                'brand_id' => 8,
                'category_id' => 11,
                'model' => 'BoltEV50',
                'type' => 'affordable',
                'engine_capacity' => '5000',
                'engine_power' => '2500',
                'seating_capacity' => '6',
                'air_condition' => 1,
                'fuel_type' => 'petrol',
                'transmission_type' => 'semi_automatic',
                'multiple_vehicles' => 0,
                'trip_hourly' => 0,
                'trip_distance' => 1,
                'hourly_price' => '0.00000000',
                'distance_price' => '650.00000000',
                'discount_type' => 'amount',
                'discount_price' => '50.00000000',
                'tag' => '["car","new"]',
                'documents' => '[{"img":"2025-02-06-67a472a550aa7.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 6,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'chevrolet-bolt-ev',
                'created_at' => '2025-02-06 14:28:21',
                'updated_at' => '2025-02-06 17:10:37',
            ),
            17 => 
            array (
                'id' => 19,
                'name' => 'Hyundai Kona Electric',
                'description' => 'The Hyundai Kona Electric is a luxury sports sedan known for its dynamic performance, premium craftsmanship, and cutting-edge technology.
Key Features:
1. Engine & Performance
2. Transmission
3. Interior
4. Technology
5. Safety & Assistance
6. Driving Experience',
                'thumbnail' => '2025-02-06-67a4736f29011.png',
                'images' => '[{"img":"2025-02-06-67a4736f2c0fd.png","storage":"public"}]',
                'zone_id' => 1,
                'provider_id' => 66,
                'brand_id' => 10,
                'category_id' => 7,
                'model' => 'Hyundai-Electric-95',
                'type' => 'affordable',
                'engine_capacity' => '4500',
                'engine_power' => '4500',
                'seating_capacity' => '6',
                'air_condition' => 0,
                'fuel_type' => 'electric',
                'transmission_type' => 'semi_automatic',
                'multiple_vehicles' => 0,
                'trip_hourly' => 1,
                'trip_distance' => 1,
                'hourly_price' => '210.00000000',
                'distance_price' => '510.00000000',
                'discount_type' => 'percent',
                'discount_price' => '10.00000000',
                'tag' => '["new","car"]',
                'documents' => '[{"img":"2025-02-06-67a4736f2e9d5.webp","storage":"public"}]',
                'status' => 1,
                'new_tag' => 1,
                'total_trip' => 6,
                'avg_rating' => '0.00',
                'rating' => NULL,
                'total_reviews' => 0,
                'slug' => 'hyundai-kona-electric',
                'created_at' => '2025-02-06 14:31:43',
                'updated_at' => '2025-02-06 17:07:20',
            ),
        ));
        
        
    }
}