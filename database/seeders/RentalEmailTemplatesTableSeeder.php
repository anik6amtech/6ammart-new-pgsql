<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RentalEmailTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rental_email_templates')->delete();
        
        \DB::table('rental_email_templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'New Provider Registration request',
                'body' => '<p><strong>Dear {providerName}</strong></p>

<p>We are pleased to inform you that your registration as a provider&nbsp;has been successfully completed.<br />
&nbsp;</p>

<p>&nbsp;</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => '2025-02-08-67a7256507289.png',
                'logo' => '2025-02-08-67a725652623f.png',
                'icon' => NULL,
                'button_name' => 'View',
                'button_url' => 'https://6ammart-admin.6amtech.com/',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'admin',
                'email_type' => 'provider_registration',
                'email_template' => '1',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:31:39',
                'updated_at' => '2025-02-08 09:35:33',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Provider Withdraw Request',
                'body' => '<p><strong>Dear {providerName}</strong></p>

<p>We are pleased to inform you that your withdrawal request as a provider&nbsp;has been successfully completed.</p>

<p>Please find below the details of the new withdrawal request.</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a725857fb1a.png',
                'button_name' => 'View',
                'button_url' => 'https://6ammart-admin.6amtech.com',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'admin',
                'email_type' => 'withdraw_request',
                'email_template' => '6',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 0,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:34:23',
                'updated_at' => '2025-02-08 09:36:05',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Your Registration is Submitted Successfully!',
                'body' => '<p>Dear User,</p>

<p>&nbsp;</p>

<p>We&rsquo;ve received your Registration Request.&nbsp;</p>

<p>&nbsp;</p>

<p>Soon you&rsquo;ll know if your store registration is accepted or declined by the Admin.&nbsp;</p>

<p>&nbsp;</p>

<p>Stay Tuned!</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a725e3ecf7d.png',
                'button_name' => '',
                'button_url' => '',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'registration',
                'email_template' => '5',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:35:50',
                'updated_at' => '2025-02-08 09:37:40',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Congratulations! Your Registration is Approved!',
                'body' => '<p>Dear User,</p>

<p>&nbsp;</p>

<p>Your registration is approved by the admin.&nbsp;</p>

<p>&nbsp;</p>

<p><strong>First</strong>, you need to log in to your panel.&nbsp;</p>

<p><strong>After that,</strong> please set up your data and start selling!&nbsp;</p>

<p><br />
&nbsp;</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a72607daae4.png',
                'button_name' => '',
                'button_url' => '',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'approve',
                'email_template' => '5',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:37:57',
                'updated_at' => '2025-02-08 09:38:15',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Your Registration is Rejected',
                'body' => '<p>Dear User,&nbsp;</p>

<p>&nbsp;</p>

<p>We&rsquo;re sorry to announce that your registration was rejected by the Admin.&nbsp;</p>

<p>&nbsp;</p>

<p>To find out more please contact us.</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a72627eb9fb.png',
                'button_name' => '',
                'button_url' => '',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'deny',
                'email_template' => '5',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:39:02',
                'updated_at' => '2025-02-08 09:38:48',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Account Blocked!',
                'body' => '<p>Hi&nbsp;</p>

<p>Your account has been blocked due to suspicious activity by admin. To resolve this issue, please contact with admin or support center . We apologize for any inconvenience caused.</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a72646b7b0c.png',
                'button_name' => '',
                'button_url' => '',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'suspend',
                'email_template' => '5',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:39:43',
                'updated_at' => '2025-02-08 09:39:18',
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'Account Unblocked!',
                'body' => '<p>Dear </p>

<p>Your account has been successfully unblocked. We appreciate your cooperation in resolving this issue. Thank you for your understanding and patience.</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a72665e331d.png',
                'button_name' => '',
                'button_url' => '',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'unsuspend',
                'email_template' => '5',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:41:46',
                'updated_at' => '2025-02-08 09:39:50',
            ),
            7 => 
            array (
                'id' => 8,
                'title' => 'Congratulations! Your Withdrawal is Approved!',
                'body' => '<p>Dear User,</p>

<p>The amount you requested to withdraw is approved by the Admin and transferred to you bank account.</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a72684b4904.png',
                'button_name' => 'View',
                'button_url' => 'https://6ammart-admin.6amtech.com',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'withdraw_approve',
                'email_template' => '6',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:42:45',
                'updated_at' => '2025-02-08 09:40:20',
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'Your Withdraw Request was Rejected.',
                'body' => '<p>Dear User,</p>

<p>The amount you requested to withdraw is rejected by the Admin.</p>

<p>Reason: Insufficient Balance. </p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a726a6dbac8.png',
                'button_name' => 'View',
                'button_url' => 'https://6ammart-admin.6amtech.com',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'withdraw_deny',
                'email_template' => '6',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:43:50',
                'updated_at' => '2025-02-08 09:40:54',
            ),
            9 => 
            array (
                'id' => 10,
                'title' => 'Subscription Plan Successfully Subscribed!',
                'body' => '<p>Hi {providerName}<br />
<br />
Congratulations! Your subscription plan has been successfully subscribed. You now have access to all the premium features included in your selected plan.<br />
<br />
<br />
Attached to this email, you will find your subscription invoice for your records.</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a726ee5e51a.png',
                'button_name' => '',
                'button_url' => '',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'subscription-successful',
                'email_template' => '5',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:45:59',
                'updated_at' => '2025-02-08 09:42:06',
            ),
            10 => 
            array (
                'id' => 11,
                'title' => 'Subscription Plan Renewed!',
                'body' => '<p>Hello,</p>

<p>We&#39;re excited to inform you that your subscription has been successfully renewed. You can continue to enjoy uninterrupted access to all premium features.</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a72708e1b94.png',
                'button_name' => '',
                'button_url' => '',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'subscription-renew',
                'email_template' => '5',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:56:17',
                'updated_at' => '2025-02-08 09:42:32',
            ),
            11 => 
            array (
                'id' => 12,
                'title' => 'Subscription Plan Shifted',
                'body' => '<p>Hi, </p>

<p>Your subscription has been shifted by admin from standard to Pro <br />
successfully!</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a7276fe92b6.png',
                'button_name' => '',
                'button_url' => '',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'subscription-shift',
                'email_template' => '5',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:57:46',
                'updated_at' => '2025-02-08 09:44:15',
            ),
            12 => 
            array (
                'id' => 13,
                'title' => 'Subscription Cancelled',
                'body' => '<p>Hi,</p>

<p>Your subscription has been cancelled as requested. Your access will remain active until the end of the current billing cycle.</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a72753bf403.png',
                'button_name' => '',
                'button_url' => '',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'subscription-cancel',
                'email_template' => '5',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 17:59:00',
                'updated_at' => '2025-02-08 09:43:47',
            ),
            13 => 
            array (
                'id' => 14,
                'title' => 'Your Subscription Plan Has Been Updated',
                'body' => '<p>HI,</p>

<p>We&#39;ve updated your subscription plan to offer enhanced features and benefits.<br />
Click here to visit your store and the update<br />
https://6ammart/store/login<br />
Please contact us for any queries, we&rsquo;re always happy to help.&nbsp;</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => NULL,
                'icon' => '2025-02-08-67a72797318eb.png',
                'button_name' => '',
                'button_url' => '',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'provider',
                'email_type' => 'subscription-plan_upadte',
                'email_template' => '5',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 18:00:02',
                'updated_at' => '2025-02-08 09:44:55',
            ),
            14 => 
            array (
                'id' => 15,
                'title' => 'Trip has been successfull.',
                'body' => '<p>Hi <strong>{userName}</strong>,</p>

<p>Your trip is successful. Please find your invoice below.</p>',
                'body_2' => NULL,
                'background_image' => NULL,
                'image' => NULL,
                'logo' => '2025-02-08-67a725af8d299.png',
                'icon' => NULL,
                'button_name' => 'View',
                'button_url' => 'https://6ammart-admin.6amtech.com',
                'footer_text' => 'Please contact us for any queries; we’re always happy to help. thanks',
                'copyright_text' => 'Copyright 2025 6amMart. All right reserved',
                'type' => 'user',
                'email_type' => 'new_order',
                'email_template' => '3',
                'privacy' => 1,
                'refund' => 1,
                'cancelation' => 1,
                'contact' => 1,
                'facebook' => 1,
                'instagram' => 1,
                'twitter' => 1,
                'linkedin' => 1,
                'pinterest' => 1,
                'status' => 1,
                'created_at' => '2025-02-05 18:01:30',
                'updated_at' => '2025-02-08 09:36:47',
            ),
        ));
        
        
    }
}