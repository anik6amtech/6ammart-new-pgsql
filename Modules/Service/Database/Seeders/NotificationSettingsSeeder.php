<?php

namespace Modules\Service\Database\Seeders;

use App\Models\NotificationSetting;
use Illuminate\Database\Seeder;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\ProviderNotificationSetup;

class NotificationSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    //TODO: Need to add this seeder data in main database file
    public function run(): void
    {
        $array = [
            //user
            [
                'user_type' => 'user',
                'title' => 'Chatting',
                'sub_title' => 'Choose how the customer will get notified of message reply, attachment received',
                'key' => 'chatting',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'user',
                'title' => 'Privacy policy update',
                'sub_title' => 'Choose how the customer will get notified of Privacy policy updates by the admin',
                'key' => 'privacy_policy_update',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'user',
                'title' => 'Terms & Conditions',
                'sub_title' => 'Choose how the customer will get notified of Terms & Conditions Update by the admin',
                'key' => 'terms_&_conditions_update',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'user',
                'title' => 'Loyalty point',
                'sub_title' => 'Choose how the customer will get notified of earning loyalty points as a reward',
                'key' => 'loyality_point',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'user',
                'title' => 'Verification',
                'sub_title' => 'Choose how the customer will get notified of Email/Phone Verification and password recovery OTP sent via Email/Phone',
                'key' => 'verification',
                'value' => [
                    'email' => 1,
                    'notification' => null,
                    'sms' => 1,
                ],
            ],
            [
                'user_type' => 'user',
                'title' => 'Booking',
                'sub_title' => 'Choose how the customer will get notified of all the bookings they placed in the system',
                'key' => 'booking',
                'value' => [
                    'email' => 1,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'user',
                'title' => 'Wallet',
                'sub_title' => 'Choose how the customer will get notified of getting a bonus & Wallet balance from admin or add funds by himself',
                'key' => 'wallet',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'user',
                'title' => 'Refer & earn',
                'sub_title' => 'Choose how the customer will get notified of refer code use, first booking completion, and get cashback as a reward',
                'key' => 'refer_earn',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'user',
                'title' => 'Registration',
                'sub_title' => 'Choose how the customer will get notified when the admin registers the customer to the system',
                'key' => 'registration',
                'value' => [
                    'email' => 1,
                    'notification' => null,
                    'sms' => null,
                ],
            ],
            //provider
            [
                'user_type' => 'provider',
                'title' => 'Chatting',
                'sub_title' => 'Choose how the provider will get notified of message reply, attachment received',
                'key' => 'chatting',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'provider',
                'title' => 'Privacy policy update',
                'sub_title' => 'Choose how the provider will get notified of Privacy policy updates by the admin',
                'key' => 'privacy_policy_update',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'provider',
                'title' => 'Terms & Conditions',
                'sub_title' => 'Choose how the provider will get notified of Terms & Conditions Update by the admin',
                'key' => 'terms_&_conditions_update',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'provider',
                'title' => 'Verification',
                'sub_title' => 'Choose how the provider will get notified of Email/Phone Verification and password recovery OTP sent via Email/Phone',
                'key' => 'verification',
                'value' => [
                    'email' => 1,
                    'notification' => null,
                    'sms' => 1,
                ],
            ],
            [
                'user_type' => 'provider',
                'title' => 'Booking',
                'sub_title' => 'Choose how the providers will get notified of new bookings, Booking Edits, Booking Status updates, Schedule time changes, and withdrawal request',
                'key' => 'booking',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'provider',
                'title' => 'Advertisement',
                'sub_title' => 'Choose how the provider will get notified of advertisement requests accept, deny, run ads, expire ads, etc.',
                'key' => 'advertisement',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'provider',
                'title' => 'System Update',
                'sub_title' => 'Choose how the provider will get notified of System Updates by the admin',
                'key' => 'system_update',
                'value' => [
                    'email' => 1,
                    'notification' => null,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'provider',
                'title' => 'Transaction',
                'sub_title' => 'Choose how the provider will get notified of suspend on exceeding cash in hand balance',
                'key' => 'transaction',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'provider',
                'title' => 'Subscription',
                'sub_title' => 'Choose how the provider will get notified of the Subscription plan subscribe, shifted, renewed, canceled & updated.',
                'key' => 'subscription',
                'value' => [
                    'email' => 1,
                    'notification' => null,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'provider',
                'title' => 'Registration',
                'sub_title' => 'Choose how the provider will get notified of new registration approval or deny',
                'key' => 'registration',
                'value' => [
                    'email' => 1,
                    'notification' => null,
                    'sms' => null,
                ],
            ],

            //serviceman
            [
                'user_type' => 'serviceman',
                'title' => 'Verification',
                'sub_title' => 'Choose how the serviceman will get notified of password recovery OTP sent via Email/Phone',
                'key' => 'verification',
                'value' => [
                    'email' => 1,
                    'notification' => null,
                    'sms' => 1,
                ],
            ],
            [
                'user_type' => 'serviceman',
                'title' => 'Chatting',
                'sub_title' => 'Choose how the serviceman will get notified of message reply, attachment received',
                'key' => 'chatting',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'serviceman',
                'title' => 'Privacy policy update',
                'sub_title' => 'Choose how the serviceman  will get notified of Privacy policy updates by the admin',
                'key' => 'privacy_policy_update',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'serviceman',
                'title' => 'Terms & Conditions Update',
                'sub_title' => 'Choose how the serviceman will get notified of Terms & Conditions Update by the admin',
                'key' => 'terms_&_conditions_update',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
            [
                'user_type' => 'serviceman',
                'title' => 'Booking',
                'sub_title' => 'Choose how the serviceman will get notified of new booking assign, Booking Edits, Booking Status updates, Schedule time changes',
                'key' => 'booking',
                'value' => [
                    'email' => null,
                    'notification' => 1,
                    'sms' => null,
                ],
            ],
        ];

        $dataToInsert = [];

        foreach ($array as $data) {
            $dataToInsert[] = [
                'title' => $data['title'],
                'sub_title' => $data['sub_title'],
                'key' => $data['key'],
                'type' => $data['user_type'],
                'mail_status' => $data['value']['email'] === null ? 'disable' : ($data['value']['email'] == 1 ? 'active' : 'inactive'),
                'sms_status' => $data['value']['sms'] === null ? 'disable' : ($data['value']['sms'] == 1 ? 'active' : 'inactive'),
                'push_notification_status' => $data['value']['notification'] === null ? 'disable' : ($data['value']['notification'] == 1 ? 'active' : 'inactive'),
                'module_type' => 'service',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        NotificationSetting::insert($dataToInsert);

        $providerNotificationTypes = ['provider', 'serviceman'];

        $providers = Provider::all();

        foreach ($providers as $provider) {
            foreach ($array as $data) {
                if (in_array($data['user_type'], $providerNotificationTypes)) {
                    ProviderNotificationSetup::create([
                        'provider_id' => $provider->id,
                        'title' => $data['title'],
                        'sub_title' => $data['sub_title'],
                        'key' => $data['key'],
                        'type' => $data['user_type'],
                        'mail_status' => $data['value']['email'] === null ? 'disable' : ($data['value']['email'] == 1 ? 'active' : 'inactive'),
                        'sms_status' => $data['value']['sms'] === null ? 'disable' : ($data['value']['sms'] == 1 ? 'active' : 'inactive'),
                        'push_notification_status' => $data['value']['notification'] === null ? 'disable' : ($data['value']['notification'] == 1 ? 'active' : 'inactive'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
