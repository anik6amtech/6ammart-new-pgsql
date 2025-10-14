<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionAnswersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('question_answers')->delete();
        
        \DB::table('question_answers')->insert(array (
            0 => 
            array (
                'id' => 3,
                'question' => 'How long is the refund validity?',
                'answer' => 'Admin can set the time period from business settings, during which customers can request a refund for their parcel after completing an order',
                'question_answer_for' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-10-11 17:31:57',
                'updated_at' => '2025-10-11 17:31:57',
            ),
            1 => 
            array (
                'id' => 4,
                'question' => 'How to setup Referral Earning?',
                'answer' => 'Setup Driver Referral Earning from business management.',
                'question_answer_for' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-10-11 17:32:07',
                'updated_at' => '2025-10-11 17:32:07',
            ),
            2 => 
            array (
                'id' => 5,
                'question' => 'When driver want to cancel a ongoing trip',
            'answer' => 'If you need to cancel an ongoing trip, please ensure the reason is valid (such as a safety concern, vehicle issue, or emergency). You can cancel the trip through the app by selecting the \'Cancel Ride\' option and choosing a reason.',
                'question_answer_for' => 'driver',
                'is_active' => 1,
                'created_at' => '2025-10-11 17:32:15',
                'updated_at' => '2025-10-11 17:32:15',
            ),
        ));
        
        
    }
}