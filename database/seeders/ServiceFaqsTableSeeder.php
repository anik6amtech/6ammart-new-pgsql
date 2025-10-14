<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceFaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_faqs')->delete();
        
        \DB::table('service_faqs')->insert(array (
            0 => 
            array (
                'id' => 2,
                'module_id' => 8,
                'question' => 'How do I book a service?',
                'answer' => 'You can browse categories, choose a provider, select a serviceman, and confirm your booking through the app.',
                'service_id' => 1,
                'is_active' => 1,
                'created_at' => '2025-09-04 06:24:51',
                'updated_at' => '2025-09-04 06:24:51',
            ),
            1 => 
            array (
                'id' => 3,
                'module_id' => 8,
                'question' => 'Can I reschedule or cancel my booking?',
                'answer' => 'Yes, bookings can be rescheduled or canceled up to 24 hours before the scheduled time.',
                'service_id' => 1,
                'is_active' => 1,
                'created_at' => '2025-09-04 06:25:02',
                'updated_at' => '2025-09-04 06:25:02',
            ),
            2 => 
            array (
                'id' => 4,
                'module_id' => 8,
                'question' => 'How to Keep Your Washing Machine Clean - Laundry Basics?',
                'answer' => 'Step 1 – Run a full cycle with vinegar

A common kitchen ingredient, white vinegar has natural disinfectant properties, making it highly useful for cleaning your washing machine. Instead of detergent, pour two cups of white vinegar into the detergent dispenser and run an empty, hot cycle. 

Don’t worry about the vinegar harming your machine or the clothes.',
                'service_id' => 9,
                'is_active' => 1,
                'created_at' => '2025-09-22 17:50:07',
                'updated_at' => '2025-09-22 17:50:07',
            ),
            3 => 
            array (
                'id' => 5,
                'module_id' => 8,
                'question' => 'When should you clean your Washing Machine?',
                'answer' => 'The ideal cleaning cycle of your washing machine depends on your usage. However, it is better to give your washing machine a thorough cleaning once or twice a month. Regular cleaning helps in keeping the machine functioning in good condition, and the subsequent washes are of optimum quality.',
                'service_id' => 9,
                'is_active' => 1,
                'created_at' => '2025-09-22 17:50:48',
                'updated_at' => '2025-09-22 17:50:48',
            ),
            4 => 
            array (
                'id' => 6,
                'module_id' => 8,
                'question' => 'Washing Machines with Self Clean Technology?',
                'answer' => 'While you can clean the drum manually and ensure 100% clean wash, you can purchase a machine equipped with Self Clean technology. The feature prevents dirt and bacteria accumulation inside the machine by using smart balls that are germ-free and anti-bacterial, ensuring a healthy and clean inner drum.',
                'service_id' => 9,
                'is_active' => 1,
                'created_at' => '2025-09-22 17:51:31',
                'updated_at' => '2025-09-22 17:51:31',
            ),
            5 => 
            array (
                'id' => 7,
                'module_id' => 8,
                'question' => 'Test',
                'answer' => 'qqq',
                'service_id' => 9,
                'is_active' => 1,
                'created_at' => '2025-09-24 11:00:49',
                'updated_at' => '2025-09-24 11:00:49',
            ),
            6 => 
            array (
                'id' => 8,
                'module_id' => 8,
                'question' => 'Check FAQ',
                'answer' => 'eqqewwqe',
                'service_id' => 1,
                'is_active' => 1,
                'created_at' => '2025-09-24 11:13:07',
                'updated_at' => '2025-09-24 11:13:07',
            ),
            7 => 
            array (
                'id' => 9,
                'module_id' => 8,
                'question' => 'qewqwe',
                'answer' => 'qweqweqwe',
                'service_id' => 1,
                'is_active' => 0,
                'created_at' => '2025-09-24 11:13:17',
                'updated_at' => '2025-09-24 11:25:51',
            ),
            8 => 
            array (
                'id' => 10,
                'module_id' => 8,
                'question' => 'retew',
                'answer' => 'rytryr',
                'service_id' => 10,
                'is_active' => 1,
                'created_at' => '2025-10-06 15:50:43',
                'updated_at' => '2025-10-06 15:50:43',
            ),
        ));
        
        
    }
}