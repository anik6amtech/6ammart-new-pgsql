<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DataSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_settings')->delete();
        
        \DB::table('data_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'admin_login_url',
                'value' => 'admin',
                'type' => 'login_admin',
                'created_at' => '2023-06-11 14:34:59',
                'updated_at' => '2023-06-11 14:34:59',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'admin_employee_login_url',
                'value' => 'admin-employee',
                'type' => 'login_admin_employee',
                'created_at' => '2023-06-11 14:34:59',
                'updated_at' => '2023-06-11 14:34:59',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'store_login_url',
                'value' => 'vendor',
                'type' => 'login_store',
                'created_at' => '2023-06-11 14:34:59',
                'updated_at' => '2023-06-11 14:34:59',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'store_employee_login_url',
                'value' => 'vendor-employee',
                'type' => 'login_store_employee',
                'created_at' => '2023-06-11 14:34:59',
                'updated_at' => '2023-06-11 14:34:59',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'fixed_header_title',
                'value' => 'Manage Your  Daily Life in one platform',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:06:27',
                'updated_at' => '2023-06-11 15:06:27',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'fixed_header_sub_title',
                'value' => 'More than just a reliable  eCommerce platform',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:06:27',
                'updated_at' => '2023-06-11 15:06:27',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'fixed_module_title',
                'value' => 'Your eCommerce venture starts here !',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:06:27',
                'updated_at' => '2023-06-11 15:06:27',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'fixed_module_sub_title',
                'value' => 'Enjoy all services in one platform',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:06:27',
                'updated_at' => '2023-06-11 15:06:27',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'fixed_referal_title',
                'value' => 'Earn point by Referral',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:06:27',
                'updated_at' => '2024-11-16 09:47:44',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'fixed_referal_sub_title',
                'value' => 'Refer Your Friend',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:06:27',
                'updated_at' => '2023-06-11 15:06:27',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'fixed_newsletter_title',
                'value' => 'Sign Up to Our Newsletter',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:06:27',
                'updated_at' => '2023-06-11 15:06:27',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'fixed_newsletter_sub_title',
                'value' => 'Receive Latest News, Updates and Many Other News Every Week',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:06:27',
                'updated_at' => '2023-06-11 15:06:27',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'fixed_footer_article_title',
                'value' => '6amMart is a complete package!  It\'s time to empower your multivendor online business with  powerful features!',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:06:27',
                'updated_at' => '2023-06-11 15:06:27',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'feature_title',
                'value' => 'Remarkable Features that You Can Count!',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:14:25',
                'updated_at' => '2023-06-11 15:14:25',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'feature_short_description',
                'value' => 'Jam-packed with outstanding features to elevate your online ordering and delivery easier, and smarter than ever before. It\'s time to empower your multivendor online business with 6amMart\'s powerful features!',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:14:25',
                'updated_at' => '2023-06-11 15:14:25',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'earning_title',
                'value' => 'Earn Effortlessly with Seller & Delivery',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:26:01',
                'updated_at' => '2024-11-16 14:14:44',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'earning_sub_title',
                'value' => 'Maximize Your Earnings with Seamless Platform Integration',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:26:01',
                'updated_at' => '2024-11-16 14:14:44',
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'earning_seller_image',
                'value' => '2024-11-16-673854071aa4e.png',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:27:29',
                'updated_at' => '2024-11-16 14:12:55',
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'seller_app_earning_links',
                'value' => '{"playstore_url_status":"1","playstore_url":"https:\\/\\/6ammart.app\\/multi-vendor-marketplace-software-project-live-demo\\/","apple_store_url_status":"1","apple_store_url":"https:\\/\\/6ammart.app\\/multi-vendor-marketplace-software-project-live-demo\\/"}',
                'type' => 'admin_landing_page',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'earning_delivery_image',
                'value' => '2024-11-16-6738540ead926.png',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:28:48',
                'updated_at' => '2024-11-16 14:13:02',
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'dm_app_earning_links',
                'value' => '{"playstore_url_status":"1","playstore_url":"https:\\/\\/6ammart.app\\/multi-vendor-marketplace-software-project-live-demo\\/","apple_store_url_status":"1","apple_store_url":"https:\\/\\/www.apple.com\\/"}',
                'type' => 'admin_landing_page',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'why_choose_title',
                'value' => 'What so Special About 6amMart ?',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:30:30',
                'updated_at' => '2023-06-11 15:32:08',
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'counter_section',
                'value' => '{"app_download_count_numbers":"300","seller_count_numbers":"85","deliveryman_count_numbers":"150","customer_count_numbers":"10000","status":"1"}',
                'type' => 'admin_landing_page',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'download_user_app_title',
                'value' => 'Let’s  Manage',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:38:17',
                'updated_at' => '2023-06-11 15:38:17',
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'download_user_app_sub_title',
                'value' => 'Your business  Smartly or Earn.',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:38:17',
                'updated_at' => '2023-06-11 15:38:17',
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'download_user_app_image',
                'value' => '2024-11-16-6738571ccdd09.png',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:38:17',
                'updated_at' => '2024-11-16 14:26:04',
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'download_user_app_links',
                'value' => '{"playstore_url_status":"1","playstore_url":"https:\\/\\/play.google.com\\/store\\/apps","apple_store_url_status":"1","apple_store_url":"https:\\/\\/www.apple.com\\/app-store"}',
                'type' => 'admin_landing_page',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'testimonial_title',
                'value' => 'People Who Shared Love with us?',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:42:04',
                'updated_at' => '2023-06-11 15:42:04',
            ),
            28 => 
            array (
                'id' => 29,
                'key' => 'contact_us_title',
                'value' => 'Contact Us',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:53:22',
                'updated_at' => '2023-06-11 15:53:22',
            ),
            29 => 
            array (
                'id' => 30,
                'key' => 'contact_us_sub_title',
                'value' => 'Any question or remarks? Just write us a message!',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:53:22',
                'updated_at' => '2023-06-11 15:53:22',
            ),
            30 => 
            array (
                'id' => 31,
                'key' => 'contact_us_image',
                'value' => '2024-11-16-673887e9f2d23.png',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 15:53:23',
                'updated_at' => '2024-11-16 17:54:17',
            ),
            31 => 
            array (
                'id' => 32,
                'key' => 'refund_policy_status',
                'value' => '0',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 20:10:58',
                'updated_at' => '2025-09-25 10:46:37',
            ),
            32 => 
            array (
                'id' => 33,
                'key' => 'refund_policy',
                'value' => '<p>6amMart is a complete Multi-vendor Food, Grocery, eCommerce, Parcel, Pharmacy, or any kind of products delivery system developed with powerful admin panel will help you to control your business smartly.</p>

<p>Praesent fermentum finibus lacus. Nulla tincidunt lectus sed purus facilisis hendrerit. Maecenas volutpat elementum orci, tincidunt euismod ante facilisis ac. Integer dignissim iaculis varius. Mauris iaculis elit vel posuere pellentesque. Praesent a mi sed neque ullamcorper dignissim sed ut nibh. Sed purus dui, sodales in varius in, accumsan at libero. Vestibulum posuere dui et orci tincidunt, ac consequat felis venenatis.</p>

<p>Morbi sodales, nisl iaculis fringilla imperdiet, metus tortor semper quam, a fringilla nulla dui nec dolor. Phasellus lacinia aliquam ligula sed porttitor. Cras feugiat eros ut arcu commodo dictum. Integer tincidunt nisl id nisl consequat molestie. Integer elit tortor, ultrices sit amet nunc vitae, feugiat tempus mauris. Morbi volutpat consectetur felis sed porttitor. Praesent in urna erat.</p>

<p>Aenean mollis luctus dolor, eu interdum velit faucibus eu. Suspendisse vitae efficitur erat. In facilisis nisi id arcu scelerisque bibendum. Nunc a placerat enim. Donec pharetra, velit quis facilisis tempus, lectus est imperdiet nisl, in tempus tortor dolor iaculis dolor. Nunc vitae molestie turpis. Nam vitae lobortis massa. Nam pharetra non felis in porta.</p>

<p>Vivamus pulvinar diam vel felis dignissim tincidunt. Donec hendrerit non est sed volutpat. In egestas ex tortor, at convallis nunc porttitor at. Fusce sed cursus risus. Nam metus sapien, viverra eget felis id, maximus convallis lacus. Donec nec lacus vitae ex hendrerit ultricies non vel risus. Morbi malesuada ipsum iaculis augue convallis vehicula. Proin eget dolor dignissim, volutpat purus ac, ultricies risus. Pellentesque semper, mauris et pharetra accumsan, ante velit faucibus ex, a mattis metus odio vel ligula. Pellentesque elementum suscipit laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer a turpis sed massa blandit iaculis. Sed aliquet, justo vestibulum euismod rhoncus, nisi dui fringilla sapien, non tempor nunc lectus vitae dolor. Suspendisse potenti.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum massa et dolor porta, rhoncus faucibus magna elementum. Sed porta mattis mollis. Donec ut est pretium, pretium nibh porttitor, suscipit metus. Sed viverra felis sed elit vehicula sodales. Nullam ante ante, tristique vel tincidunt ac, egestas eget sem. Sed lorem nunc, pellentesque vel ipsum venenatis, pellentesque interdum orci. Suspendisse mauris dui, accumsan at dapibus sed, volutpat quis erat. Nam fringilla nisl eu nunc lobortis, feugiat posuere libero venenatis. Nunc risus lorem, ornare eget congue in, pretium quis enim. Pellentesque elit elit, pharetra eget nunc at, maximus pellentesque diam.</p>

<p>Praesent fermentum finibus lacus. Nulla tincidunt lectus sed purus facilisis hendrerit. Maecenas volutpat elementum orci, tincidunt euismod ante facilisis ac. Integer dignissim iaculis varius. Mauris iaculis elit vel posuere pellentesque. Praesent a mi sed neque ullamcorper dignissim sed ut nibh. Sed purus dui, sodales in varius in, accumsan at libero. Vestibulum posuere dui et orci tincidunt, ac consequat felis venenatis.</p>

<p>Morbi sodales, nisl iaculis fringilla imperdiet, metus tortor semper quam, a fringilla nulla dui nec dolor. Phasellus lacinia aliquam ligula sed porttitor. Cras feugiat eros ut arcu commodo dictum. Integer tincidunt nisl id nisl consequat molestie. Integer elit tortor, ultrices sit amet nunc vitae, feugiat tempus mauris. Morbi volutpat consectetur felis sed porttitor. Praesent in urna erat.</p>

<p>Aenean mollis luctus dolor, eu interdum velit faucibus eu. Suspendisse vitae efficitur erat. In facilisis nisi id arcu scelerisque bibendum. Nunc a placerat enim. Donec pharetra, velit quis facilisis tempus, lectus est imperdiet nisl, in tempus tortor dolor iaculis dolor. Nunc vitae molestie turpis. Nam vitae lobortis massa. Nam pharetra non felis in porta.</p>

<p>Vivamus pulvinar diam vel felis dignissim tincidunt. Donec hendrerit non est sed volutpat. In egestas ex tortor, at convallis nunc porttitor at. Fusce sed cursus risus. Nam metus sapien, viverra eget felis id, maximus convallis lacus. Donec nec lacus vitae ex hendrerit ultricies non vel risus. Morbi malesuada ipsum iaculis augue convallis vehicula. Proin eget dolor dignissim, volutpat purus ac, ultricies risus. Pellentesque semper, mauris et pharetra accumsan, ante velit faucibus ex, a mattis metus odio vel ligula. Pellentesque elementum suscipit laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer a turpis sed massa blandit iaculis. Sed aliquet, justo vestibulum euismod rhoncus, nisi dui fringilla sapien, non tempor nunc lectus vitae dolor. Suspendisse potenti.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum massa et dolor porta, rhoncus faucibus magna elementum. Sed porta mattis mollis. Donec ut est pretium, pretium nibh porttitor, suscipit metus. Sed viverra felis sed elit vehicula sodales. Nullam ante ante, tristique vel tincidunt ac, egestas eget sem. Sed lorem nunc, pellentesque vel ipsum venenatis, pellentesque interdum orci. Suspendisse mauris dui, accumsan at dapibus sed, volutpat quis erat. Nam fringilla nisl eu nunc lobortis, feugiat posuere libero venenatis. Nunc risus lorem, ornare eget congue in, pretium quis enim. Pellentesque elit elit, pharetra eget nunc at, maximus pellentesque diam.</p>

<p>Praesent fermentum finibus lacus. Nulla tincidunt lectus sed purus facilisis hendrerit. Maecenas volutpat elementum orci, tincidunt euismod ante facilisis ac. Integer dignissim iaculis varius. Mauris iaculis elit vel posuere pellentesque. Praesent a mi sed neque ullamcorper dignissim sed ut nibh. Sed purus dui, sodales in varius in, accumsan at libero. Vestibulum posuere dui et orci tincidunt, ac consequat felis venenatis.</p>

<p>Morbi sodales, nisl iaculis fringilla imperdiet, metus tortor semper quam, a fringilla nulla dui nec dolor. Phasellus lacinia aliquam ligula sed porttitor. Cras feugiat eros ut arcu commodo dictum. Integer tincidunt nisl id nisl consequat molestie. Integer elit tortor, ultrices sit amet nunc vitae, feugiat tempus mauris. Morbi volutpat consectetur felis sed porttitor. Praesent in urna erat.</p>

<p>Aenean mollis luctus dolor, eu interdum velit faucibus eu. Suspendisse vitae efficitur erat. In facilisis nisi id arcu scelerisque bibendum. Nunc a placerat enim. Donec pharetra, velit quis facilisis tempus, lectus est imperdiet nisl, in tempus tortor dolor iaculis dolor. Nunc vitae molestie turpis. Nam vitae lobortis massa. Nam pharetra non felis in porta.</p>

<p>Vivamus pulvinar diam vel felis dignissim tincidunt. Donec hendrerit non est sed volutpat. In egestas ex tortor, at convallis nunc porttitor at. Fusce sed cursus risus. Nam metus sapien, viverra eget felis id, maximus convallis lacus. Donec nec lacus vitae ex hendrerit ultricies non vel risus. Morbi malesuada ipsum iaculis augue convallis vehicula. Proin eget dolor dignissim, volutpat purus ac, ultricies risus. Pellentesque semper, mauris et pharetra accumsan, ante velit faucibus ex, a mattis metus odio vel ligula. Pellentesque elementum suscipit laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer a turpis sed massa blandit iaculis. Sed aliquet, justo vestibulum euismod rhoncus, nisi dui fringilla sapien, non tempor nunc lectus vitae dolor. Suspendisse potenti.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum massa et dolor porta, rhoncus faucibus magna elementum. Sed porta mattis mollis. Donec ut est pretium, pretium nibh porttitor, suscipit metus. Sed viverra felis sed elit vehicula sodales. Nullam ante ante, tristique vel tincidunt ac, egestas eget sem. Sed lorem nunc, pellentesque vel ipsum venenatis, pellentesque interdum orci. Suspendisse mauris dui, accumsan at dapibus sed, volutpat quis erat. Nam fringilla nisl eu nunc lobortis, feugiat posuere libero venenatis. Nunc risus lorem, ornare eget congue in, pretium quis enim. Pellentesque elit elit, pharetra eget nunc at, maximus pellentesque diam.</p>

<p>Praesent fermentum finibus lacus. Nulla tincidunt lectus sed purus facilisis hendrerit. Maecenas volutpat elementum orci, tincidunt euismod ante facilisis ac. Integer dignissim iaculis varius. Mauris iaculis elit vel posuere pellentesque. Praesent a mi sed neque ullamcorper dignissim sed ut nibh. Sed purus dui, sodales in varius in, accumsan at libero. Vestibulum posuere dui et orci tincidunt, ac consequat felis venenatis.</p>

<p>Morbi sodales, nisl iaculis fringilla imperdiet, metus tortor semper quam, a fringilla nulla dui nec dolor. Phasellus lacinia aliquam ligula sed porttitor. Cras feugiat eros ut arcu commodo dictum. Integer tincidunt nisl id nisl consequat molestie. Integer elit tortor, ultrices sit amet nunc vitae, feugiat tempus mauris. Morbi volutpat consectetur felis sed porttitor. Praesent in urna erat.</p>

<p>Aenean mollis luctus dolor, eu interdum velit faucibus eu. Suspendisse vitae efficitur erat. In facilisis nisi id arcu scelerisque bibendum. Nunc a placerat enim. Donec pharetra, velit quis facilisis tempus, lectus est imperdiet nisl, in tempus tortor dolor iaculis dolor. Nunc vitae molestie turpis. Nam vitae lobortis massa. Nam pharetra non felis in porta.</p>

<p>Vivamus pulvinar diam vel felis dignissim tincidunt. Donec hendrerit non est sed volutpat. In egestas ex tortor, at convallis nunc porttitor at. Fusce sed cursus risus. Nam metus sapien, viverra eget felis id, maximus convallis lacus. Donec nec lacus vitae ex hendrerit ultricies non vel risus. Morbi malesuada ipsum iaculis augue convallis vehicula. Proin eget dolor dignissim, volutpat purus ac, ultricies risus. Pellentesque semper, mauris et pharetra accumsan, ante velit faucibus ex, a mattis metus odio vel ligula. Pellentesque elementum suscipit laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer a turpis sed massa blandit iaculis. Sed aliquet, justo vestibulum euismod rhoncus, nisi dui fringilla sapien, non tempor nunc lectus vitae dolor. Suspendisse potenti.</p>',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-11 20:10:59',
                'updated_at' => '2023-06-13 16:54:15',
            ),
            33 => 
            array (
                'id' => 34,
                'key' => 'header_title',
                'value' => '$Your e-Commerce!$',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:30:53',
                'updated_at' => '2023-06-12 19:41:19',
            ),
            34 => 
            array (
                'id' => 35,
                'key' => 'header_sub_title',
                'value' => 'Venture Starts Here',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:30:53',
                'updated_at' => '2023-06-12 17:55:14',
            ),
            35 => 
            array (
                'id' => 36,
                'key' => 'header_tag_line',
                'value' => 'More than just a reliable $eCommerce$ platform',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:30:53',
                'updated_at' => '2023-06-12 17:45:24',
            ),
            36 => 
            array (
                'id' => 37,
                'key' => 'header_icon',
                'value' => '2024-11-19-673c8d305ab2b.png',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:30:53',
                'updated_at' => '2024-11-19 13:05:52',
            ),
            37 => 
            array (
                'id' => 38,
                'key' => 'header_banner',
                'value' => '2024-11-19-673c8d30838ca.png',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:30:53',
                'updated_at' => '2024-11-19 13:05:52',
            ),
            38 => 
            array (
                'id' => 39,
                'key' => 'company_title',
                'value' => '$6amMart$',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:35:07',
                'updated_at' => '2023-06-12 17:46:19',
            ),
            39 => 
            array (
                'id' => 40,
                'key' => 'company_sub_title',
                'value' => 'is Best Delivery Service Near You',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:35:07',
                'updated_at' => '2023-06-12 16:35:07',
            ),
            40 => 
            array (
                'id' => 41,
                'key' => 'company_description',
                'value' => '6amMart is a one-stop shop for all your daily necessities. You can shop for groceries, and pharmacy items, order food, and send important parcels from one place to another from the comfort of your home.',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:35:07',
                'updated_at' => '2023-06-12 16:35:07',
            ),
            41 => 
            array (
                'id' => 42,
                'key' => 'company_button_name',
                'value' => 'Order Now',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:35:07',
                'updated_at' => '2023-06-12 17:46:52',
            ),
            42 => 
            array (
                'id' => 43,
                'key' => 'company_button_url',
                'value' => 'https://6ammart-react.6amtech.com/',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:35:07',
                'updated_at' => '2023-06-12 16:35:07',
            ),
            43 => 
            array (
                'id' => 44,
                'key' => 'download_user_app_title',
                'value' => 'Complete Multipurpose eBusiness Solution',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:40:30',
                'updated_at' => '2023-06-12 16:40:30',
            ),
            44 => 
            array (
                'id' => 45,
                'key' => 'download_user_app_sub_title',
                'value' => '6amMart is a Laravel and Flutter Framework-based multi-vendor food, grocery, eCommerce, parcel, and pharmacy delivery system. It has six modules to cover all your business function',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:40:30',
                'updated_at' => '2023-06-12 16:40:30',
            ),
            45 => 
            array (
                'id' => 46,
                'key' => 'download_user_app_image',
                'value' => NULL,
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:40:30',
                'updated_at' => '2023-06-12 16:40:30',
            ),
            46 => 
            array (
                'id' => 47,
                'key' => 'download_user_app_links',
                'value' => '{"playstore_url_status":"1","playstore_url":"https:\\/\\/play.google.com\\/store\\/","apple_store_url_status":"1","apple_store_url":"https:\\/\\/www.apple.com\\/app-store\\/"}',
                'type' => 'react_landing_page',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'key' => 'earning_title',
                'value' => 'Let’s Start Earning with $6amMart$',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:43:22',
                'updated_at' => '2023-06-12 16:43:22',
            ),
            48 => 
            array (
                'id' => 49,
                'key' => 'earning_sub_title',
                'value' => 'Join our online marketplace revolution and boost your income.',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:43:22',
                'updated_at' => '2023-06-12 16:43:22',
            ),
            49 => 
            array (
                'id' => 50,
                'key' => 'earning_seller_title',
                'value' => 'Become a Seller',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:45:07',
                'updated_at' => '2023-06-12 16:45:07',
            ),
            50 => 
            array (
                'id' => 51,
                'key' => 'earning_seller_sub_title',
                'value' => 'Register as seller & open shop in 6amMart to start your business',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:45:07',
                'updated_at' => '2023-06-12 16:45:07',
            ),
            51 => 
            array (
                'id' => 52,
                'key' => 'earning_seller_button_name',
                'value' => 'Register',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:45:07',
                'updated_at' => '2023-06-12 16:45:07',
            ),
            52 => 
            array (
                'id' => 53,
                'key' => 'earning_seller_button_url',
                'value' => 'https://6ammart-admin.6amtech.com/store/apply',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:45:07',
                'updated_at' => '2023-06-12 16:45:07',
            ),
            53 => 
            array (
                'id' => 54,
                'key' => 'earning_dm_title',
                'value' => 'Become a $Delivery Man$',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:45:55',
                'updated_at' => '2023-06-12 17:53:01',
            ),
            54 => 
            array (
                'id' => 55,
                'key' => 'earning_dm_sub_title',
                'value' => 'Register as delivery man and earn money',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:45:55',
                'updated_at' => '2023-06-12 16:45:55',
            ),
            55 => 
            array (
                'id' => 56,
                'key' => 'earning_dm_button_name',
                'value' => 'Register',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:45:55',
                'updated_at' => '2023-06-12 16:45:55',
            ),
            56 => 
            array (
                'id' => 57,
                'key' => 'earning_dm_button_url',
                'value' => 'https://6ammart-admin.6amtech.com/deliveryman/apply',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:45:55',
                'updated_at' => '2023-06-12 16:45:55',
            ),
            57 => 
            array (
                'id' => 58,
                'key' => 'promotion_banner',
                'value' => '[{"img":"2024-11-19-673ca76e2ec53.png","storage":"public"},{"img":"2024-11-19-673ca77790e24.png","storage":"public"},{"img":"2024-11-19-673ca783ae5b6.png","storage":"public"}]',
                'type' => 'react_landing_page',
                'created_at' => NULL,
                'updated_at' => '2024-11-19 14:58:11',
            ),
            58 => 
            array (
                'id' => 59,
                'key' => 'business_title',
                'value' => '$Let’s$',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:52:29',
                'updated_at' => '2023-06-12 16:52:29',
            ),
            59 => 
            array (
                'id' => 60,
                'key' => 'business_sub_title',
                'value' => 'Manage your business  Smartly',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:52:29',
                'updated_at' => '2023-06-12 17:54:18',
            ),
            60 => 
            array (
                'id' => 61,
                'key' => 'business_image',
                'value' => '2024-11-19-673c98d84c119.png',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:52:29',
                'updated_at' => '2024-11-19 13:55:36',
            ),
            61 => 
            array (
                'id' => 62,
                'key' => 'download_business_app_links',
                'value' => '{"seller_playstore_url_status":"1","seller_playstore_url":"https:\\/\\/play.google.com\\/store","seller_appstore_url_status":"1","seller_appstore_url":"https:\\/\\/www.apple.com\\/app-store\\/","dm_playstore_url_status":"1","dm_playstore_url":"https:\\/\\/play.google.com\\/store","dm_appstore_url_status":"1","dm_appstore_url":"https:\\/\\/www.apple.com\\/app-store\\/"}',
                'type' => 'react_landing_page',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'key' => 'testimonial_title',
                'value' => 'We $satisfied$ some Customer & Restaurant Owners',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 16:53:04',
                'updated_at' => '2023-06-12 16:53:04',
            ),
            63 => 
            array (
                'id' => 64,
                'key' => 'fixed_promotional_banner',
                'value' => '2024-11-19-673c98f0c8f44.png',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 17:18:24',
                'updated_at' => '2024-11-19 13:56:00',
            ),
            64 => 
            array (
                'id' => 65,
                'key' => 'fixed_footer_description',
                'value' => 'Connect with our social media and other sites to keep up to date',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 17:21:12',
                'updated_at' => '2023-06-12 17:21:12',
            ),
            65 => 
            array (
                'id' => 66,
                'key' => 'fixed_newsletter_title',
                'value' => 'Join Us!',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 17:23:45',
                'updated_at' => '2023-06-12 17:23:45',
            ),
            66 => 
            array (
                'id' => 67,
                'key' => 'fixed_newsletter_sub_title',
                'value' => 'Subscribe to our weekly newsletter and be a part of our journey to self discovery and love.',
                'type' => 'react_landing_page',
                'created_at' => '2023-06-12 17:23:45',
                'updated_at' => '2023-06-12 17:23:45',
            ),
            67 => 
            array (
                'id' => 68,
                'key' => 'fixed_header_title',
                'value' => '6amMart',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 17:31:35',
                'updated_at' => '2023-06-12 17:31:35',
            ),
            68 => 
            array (
                'id' => 69,
                'key' => 'fixed_header_sub_title',
                'value' => 'More than just reliable eCommerce platform',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 17:31:35',
                'updated_at' => '2023-06-12 17:32:30',
            ),
            69 => 
            array (
                'id' => 70,
                'key' => 'fixed_header_image',
                'value' => '2024-11-19-673c96772c531.png',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 17:31:35',
                'updated_at' => '2024-11-19 13:45:27',
            ),
            70 => 
            array (
                'id' => 71,
                'key' => 'fixed_location_title',
                'value' => 'Choose your location',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 17:35:02',
                'updated_at' => '2023-06-12 17:35:02',
            ),
            71 => 
            array (
                'id' => 72,
                'key' => 'fixed_module_title',
                'value' => 'Your eCommerce venture starts here !',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 17:37:29',
                'updated_at' => '2023-06-12 17:37:29',
            ),
            72 => 
            array (
                'id' => 73,
                'key' => 'fixed_module_sub_title',
                'value' => 'Enjoy all services in one platform',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 17:37:29',
                'updated_at' => '2023-06-12 17:37:29',
            ),
            73 => 
            array (
                'id' => 74,
                'key' => 'join_seller_title',
                'value' => 'Become a Seller',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 18:12:56',
                'updated_at' => '2023-06-12 18:12:56',
            ),
            74 => 
            array (
                'id' => 75,
                'key' => 'join_seller_sub_title',
                'value' => 'Registered as a seller and open shop for start your business',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 18:12:56',
                'updated_at' => '2023-06-12 18:12:56',
            ),
            75 => 
            array (
                'id' => 76,
                'key' => 'join_seller_button_name',
                'value' => 'Register',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 18:12:56',
                'updated_at' => '2023-06-12 18:12:56',
            ),
            76 => 
            array (
                'id' => 77,
                'key' => 'join_seller_button_url',
                'value' => 'https://6ammart-admin.6amtech.com/store/apply',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 18:12:56',
                'updated_at' => '2023-06-12 18:12:56',
            ),
            77 => 
            array (
                'id' => 78,
                'key' => 'join_delivery_man_title',
                'value' => 'Join as  Deliveryman',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 18:16:03',
                'updated_at' => '2023-06-12 18:16:03',
            ),
            78 => 
            array (
                'id' => 79,
                'key' => 'join_delivery_man_sub_title',
                'value' => 'Registered as a deliveryman and earn money',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 18:16:03',
                'updated_at' => '2023-06-12 18:16:03',
            ),
            79 => 
            array (
                'id' => 80,
                'key' => 'join_delivery_man_button_name',
                'value' => 'Register',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 18:16:03',
                'updated_at' => '2023-06-12 18:16:03',
            ),
            80 => 
            array (
                'id' => 81,
                'key' => 'join_delivery_man_button_url',
                'value' => 'https://6ammart-admin.6amtech.com/deliveryman/apply',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 18:16:03',
                'updated_at' => '2023-06-12 18:16:03',
            ),
            81 => 
            array (
                'id' => 82,
                'key' => 'download_user_app_title',
                'value' => 'Download app and enjoy more!',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 18:17:56',
                'updated_at' => '2023-06-12 18:17:56',
            ),
            82 => 
            array (
                'id' => 83,
                'key' => 'download_user_app_sub_title',
                'value' => 'Download app from',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 18:17:56',
                'updated_at' => '2023-06-12 18:17:56',
            ),
            83 => 
            array (
                'id' => 84,
                'key' => 'download_user_app_image',
                'value' => '2024-11-19-673c9886d7049.png',
                'type' => 'flutter_landing_page',
                'created_at' => '2023-06-12 18:17:56',
                'updated_at' => '2024-11-19 13:54:14',
            ),
            84 => 
            array (
                'id' => 85,
                'key' => 'download_user_app_links',
                'value' => '{"playstore_url_status":"1","playstore_url":"https:\\/\\/play.google.com\\/store\\/","apple_store_url_status":"1","apple_store_url":"https:\\/\\/www.apple.com\\/app-store\\/"}',
                'type' => 'flutter_landing_page',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'key' => 'terms_and_conditions',
                'value' => '<h1>This is a test Teams &amp; Conditions</h1>

<p>These terms of use (the &quot;Terms of Use&quot;) govern your use of our website www.6ammart,6amtech.com (the &quot;Website&quot;) and our &quot;6amMart&quot; application for mobile and handheld devices (the &quot;App&quot;). The Website and the App are jointly referred to as the &quot;Platform&quot;. Please read these Terms of Use carefully before you use the services. If you do not agree to these Terms of Use, you may not use the services on the Platform, and we request you to uninstall the App. By installing, downloading and/or even merely using the Platform, you shall be contracting with 6amMart and you provide your acceptance to the Terms of Use and other 6amMart policies (including but not limited to the Cancellation &amp; Refund Policy, Privacy Policy etc.) as posted on the Platform from time to time, which takes effect on the date on which you download, install or use the Services, and create a legally binding arrangement to abide by the same. The Platforms will be used by (i) natural persons who have reached 18 years of age and (ii) corporate legal entities, e.g companies. Where applicable, these Terms shall be subject to country-specific provisions as set out herein.</p>

<h3><strong>USE OF PLATFORM AND SERVICES</strong></h3>

<p>All commercial/contractual terms are offered by and agreed to between Buyers and Merchants alone. The commercial/contractual terms include without limitation to price, taxes, shipping costs, payment methods, payment terms, date, period and mode of delivery, warranties related to products and services and after sales services related to products and services. 6amMart does not have any kind of control or does not determine or advise or in any way involve itself in the offering or acceptance of such commercial/contractual terms between the Buyers and Merchants. 6amMart may, however, offer support services to Merchants in respect to order fulfilment, payment collection, call centre, and other services, pursuant to independent contracts executed by it with the Merchants. eFood is not responsible for any non-performance or breach of any contract entered into between Buyers and Merchants on the Platform. eFood cannot and does not guarantee that the concerned Buyers and/or Merchants shall perform any transaction concluded on the Platform. eFood is not responsible for unsatisfactory services or non-performance of services or damages or delays as a result of products which are out of stock, unavailable or back ordered.</p>

<p>6amMart is operating an e-commerce platform and assumes and operates the role of facilitator, and does not at any point of time during any transaction between Buyer and Merchant on the Platform come into or take possession of any of the products or services offered by Merchant. At no time shall 6amMart hold any right, title or interest over the products nor shall 6amMart have any obligations or liabilities in respect of such contract entered into between Buyer and Merchant. You agree and acknowledge that we shall not be responsible for:</p>

<ul>
<li>The goods provided by the shops or restaurants including, but not limited, serving of food orders suiting your requirements and needs;</li>
<li>The Merchant&quot;s goods not being up to your expectations or leading to any loss, harm or damage to you;</li>
<li>The availability or unavailability of certain items on the menu;</li>
<li>The Merchant serving the incorrect orders.</li>
</ul>

<p>The details of the menu and price list available on the Platform are based on the information provided by the Merchants and we shall not be responsible for any change or cancellation or unavailability. All Menu &amp; Food Images used on our platforms are only representative and shall/might not match with the actual Menu/Food Ordered, 6amMart shall not be responsible or Liable for any discrepancies or variations on this aspect.</p>

<h3><strong>Personal Information that you provide</strong></h3>

<p>If you want to use our service, you must create an account on our Site. To establish your account, we will ask for personally identifiable information that can be used to contact or identify you, which may include your name, phone number, and e-mail address. We may also collect demographic information about you, such as your zip code, and allow you to submit additional information that will be part of your profile. Other than basic information that we need to establish your account, it will be up to you to decide how much information to share as part of your profile. We encourage you to think carefully about the information that you share and we recommend that you guard your identity and your sensitive information. Of course, you can review and revise your profile at any time.</p>

<p>You understand that delivery periods quoted to you at the time of confirming the order is an approximate estimate and may vary. We shall not be responsible for any delay in the delivery of your order due to the delay at seller/merchant end for order processing or any other unavoidable circumstances.</p>

<p>Your order shall be only delivered to the address designated by you at the time of placing the order on the Platform. We reserve the right to cancel the order, in our sole discretion, in the event of any change to the place of delivery and you shall not be entitled to any refund for the same. Delivery in the event of change of the delivery location shall be at our sole discretion and reserve the right to charge with additional delivery fee if required.</p>

<p>You shall undertake to provide adequate directions, information and authorizations to accept delivery. In the event of any failure to accept delivery, failure to deliver within the estimated time due to your failure to provide appropriate instructions, or authorizations, then such goods shall be deemed to have been delivered to you and all risk and responsibility in relation to such goods shall pass to you and you shall not be entitled to any refund for the same. Our decision in relation to this shall be final and binding. You understand that our liability ends once your order has been delivered to you.</p>

<p>You might be required to provide your credit or debit card details to the approved payment gateways while making the payment. In this regard, you agree to provide correct and accurate credit/ debit card details to the approved payment gateways for availing the Services. You shall not use the credit/ debit card which is not lawfully owned by you, i.e. in any transaction, you must use your own credit/ debit card. The information provided by you shall not be utilized or shared with any third party unless required in relation to fraud verifications or by law, regulation or court order. You shall be solely responsible for the security and confidentiality of your credit/ debit card details. We expressly disclaim all liabilities that may arise as a consequence of any unauthorized use of your credit/ debit card. You agree that the Services shall be provided by us only during the working hours of the relevant Merchants.</p>

<h3><strong>ACTIVITIES PROHIBITED ON THE PLATFORM</strong></h3>

<p>The following is a partial list of the kinds of conduct that are illegal or prohibited on the Websites. 6amMart reserves the right to investigate and take appropriate legal action/s against anyone who, in 6amMart sole discretion, engages in any of the prohibited activities. Prohibited activities include &mdash; but are not limited to &mdash; the following:</p>

<ul>
<li>Using the Websites for any purpose in violation of laws or regulations;</li>
<li>Posting Content that infringes the intellectual property rights, privacy rights, publicity rights, trade secret rights, or any other rights of any party;</li>
<li>Posting Content that is unlawful, obscene, defamatory, threatening, harassing, abusive, slanderous, hateful, or embarrassing to any other person or entity as determined by 6amMart in its sole discretion or pursuant to local community standards;</li>
<li>Posting Content that constitutes cyber-bullying, as determined by 6amMart in its sole discretion;</li>
<li>Posting Content that depicts any dangerous, life-threatening, or otherwise risky behavior;</li>
<li>Posting telephone numbers, street addresses, or last names of any person;</li>
<li>Posting URLs to external websites or any form of HTML or programming code;</li>
<li>Posting anything that may be &quot;spam,&quot; as determined by 6amMart in its sole discretion;</li>
<li>Impersonating another person when posting Content;</li>
<li>Harvesting or otherwise collecting information about others, including email addresses, without their consent;</li>
<li>Allowing any other person or entity to use your identification for posting or viewing comments;</li>
<li>Harassing, threatening, stalking, or abusing any person;</li>
<li>Engaging in any other conduct that restricts or inhibits any other person from using or enjoying the Websites, or which, in the sole discretion of 6amMart , exposes eFood or any of its customers, suppliers, or any other parties to any liability or detriment of any type; or</li>
<li>Encouraging other people to engage in any prohibited activities as described herein.</li>
</ul>

<p>6amMart reserves the right but is not obligated to do any or all of the following:</p>

<ul>
<li>Investigate an allegation that any Content posted on the Websites does not conform to these Terms of Use and determine in its sole discretion to remove or request the removal of the Content;</li>
<li>Remove Content which is abusive, illegal, or disruptive, or that otherwise fails to conform with these Terms of Use;</li>
<li>Terminate a user&#39;s access to the Websites upon any breach of these Terms of Use;</li>
<li>Monitor, edit, or disclose any Content on the Websites; and</li>
<li>Edit or delete any Content posted on the Websites, regardless of whether such Content violates these standards.</li>
</ul>

<h3><strong>AMENDMENTS</strong></h3>

<p>6amMart reserves the right to change or modify these Terms (including our policies which are incorporated into these Terms) at any time by posting changes on the Platform. You are strongly recommended to read these Terms regularly. You will be deemed to have agreed to the amended Terms by your continued use of the Platforms following the date on which the amended Terms are posted.</p>

<h3><strong>PAYMENT</strong></h3>

<p>6amMart reserves the right to offer additional payment methods and/or remove existing payment methods at any time in its sole discretion. If you choose to pay using an online payment method, the payment shall be processed by our third party payment service provider(s). With your consent, your credit card / payment information will be stored with our third party payment service provider(s) for future orders. 6amMart does not store your credit card or payment information. You must ensure that you have sufficient funds on your credit and debit card to fulfil payment of an Order. Insofar as required, 6amMart takes responsibility for payments made on our Platforms including refunds, chargebacks, cancellations and dispute resolution, provided if reasonable and justifiable and in accordance with these Terms.</p>

<h3><strong>CANCELLATION</strong></h3>

<p>6amMart can cancel any order anytime due to the foods/products unavailability, out of coverage area and any other unavoidable circumstances.</p>',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-13 16:53:33',
                'updated_at' => '2023-06-13 16:53:33',
            ),
            86 => 
            array (
                'id' => 87,
                'key' => 'privacy_policy',
                'value' => '<h2>This is a Demo Privacy Policy</h2>

<p>This policy explains how 6amMart&nbsp;website and related applications (the &ldquo;Site&rdquo;, &ldquo;we&rdquo; or &ldquo;us&rdquo;) collects, uses, shares and protects the personal information that we collect through this site or different channels. 6amMart has established the site to link up the users who need foods or grocery items to be shipped or delivered by the riders from the affiliated restaurants or shops to the desired location. This policy also applies to any mobile applications that we develop for use with our services on the Site, and references to this &ldquo;Site&rdquo;, &ldquo;we&rdquo; or &ldquo;us&rdquo; is intended to also include these mobile applications. Please read below to learn more about our information policies. By using this Site, you agree to these policies.</p>

<h2>How the Information is collected</h2>

<h3>Information provided by web browser</h3>

<p>You have to provide us with personal information like your name, contact no, mailing address and email id, our app will also fetch your location information in order to give you the best service. Like many other websites, we may record information that your web browser routinely shares, such as your browser type, browser language, software and hardware attributes, the date and time of your visit, the web page from which you came, your Internet Protocol address and the geographic location associated with that address, the pages on this Site that you visit and the time you spent on those pages. This will generally be anonymous data that we collect on an aggregate basis.</p>

<h3>Personal Information that you provide</h3>

<p>If you want to use our service, you must create an account on our Site. To establish your account, we will ask for personally identifiable information that can be used to contact or identify you, which may include your name, phone number, and e-mail address. We may also collect demographic information about you, such as your zip code, and allow you to submit additional information that will be part of your profile. Other than basic information that we need to establish your account, it will be up to you to decide how much information to share as part of your profile. We encourage you to think carefully about the information that you share and we recommend that you guard your identity and your sensitive information. Of course, you can review and revise your profile at any time.</p>

<h3>Payment Information</h3>

<p>To make the payment online for availing our services, you have to provide the bank account, mobile financial service (MFS), debit card, credit card information to the 6amMart platform.</p>

<h2>How the Information is collected</h2>

<h3>Session and Persistent Cookies</h3>

<p>Cookies are small text files that are placed on your computer by websites that you visit. They are widely used in order to make websites work, or work more efficiently, as well as to provide information to the owners of the site. As is commonly done on websites, we may use cookies and similar technology to keep track of our users and the services they have elected. We use both &ldquo;session&rdquo; and &ldquo;persistent&rdquo; cookies. Session cookies are deleted after you leave our website and when you close your browser. We use data collected with session cookies to enable certain features on our Site, to help us understand how users interact with our Site, and to monitor at an aggregate level Site usage and web traffic routing. We may allow business partners who provide services to our Site to place cookies on your computer that assist us in analyzing usage data. We do not allow these business partners to collect your personal information from our website except as may be necessary for the services that they provide.</p>

<h3>Web Beacons</h3>

<p>We may also use web beacons or similar technology to help us track the effectiveness of our communications.</p>

<h3>Advertising Cookies</h3>

<p>We may use third parties, such as Google, to serve ads about our website over the internet. These third parties may use cookies to identify ads that may be relevant to your interest (for example, based on your recent visit to our website), to limit the number of times that you see an ad, and to measure the effectiveness of the ads.</p>

<h3>Google Analytics</h3>

<p>We may also use Google Analytics or a similar service to gather statistical information about the visitors to this Site and how they use the Site. This, also, is done on an anonymous basis. We will not try to associate anonymous data with your personally identifiable data. If you would like to learn more about Google Analytics, please click here.</p>',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-13 16:53:54',
                'updated_at' => '2023-06-13 16:53:54',
            ),
            87 => 
            array (
                'id' => 88,
                'key' => 'cancellation_policy',
                'value' => '<h1>This is a demo cancelation policy</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis nunc tortor, non malesuada nunc tincidunt id. Sed porta ex nec sapien convallis hendrerit. Pellentesque auctor dapibus eleifend. Cras tempus, sapien sed dignissim consequat, dolor nunc volutpat urna, at hendrerit dui dolor dapibus odio. Sed dolor purus, luctus in dui non, fermentum imperdiet nibh. Aenean at libero ut libero auctor finibus. Vivamus eu nulla vel risus dapibus tincidunt eget non orci. Sed lorem velit, sollicitudin eu mi vitae, rutrum congue orci. Phasellus sit amet ex accumsan, semper magna in, lobortis nibh. Maecenas ut iaculis ex, eget pellentesque sapien. Praesent tristique eros mauris.</p>

<p>Nam in blandit dui, venenatis sodales ante. Aenean pulvinar feugiat eros non convallis. Integer vel posuere lacus. Fusce eget leo in erat venenatis vehicula. Praesent congue lorem sed neque porta hendrerit. Curabitur sollicitudin tincidunt sapien eu venenatis. In at mattis odio. Aenean gravida enim eget ipsum congue gravida. Proin dapibus non ante sed ultrices.</p>

<p>Suspendisse at quam et sapien rutrum consequat at accumsan dolor. Cras nisl nibh, auctor ut vestibulum sit amet, pretium vitae ligula. Vestibulum id maximus sapien, sit amet laoreet velit. Mauris dui eros, vehicula vel dolor id, lobortis aliquet quam. Cras quis turpis sit amet urna finibus consequat ac pellentesque lorem. Maecenas rutrum eu nulla non tincidunt. Suspendisse pulvinar pellentesque purus, sit amet porttitor lorem feugiat et. Sed ac nisl vel felis ultricies placerat sit amet ac enim. Duis ex justo, bibendum et tortor sit amet, tincidunt ornare dolor. Suspendisse potenti. Suspendisse augue nulla, fringilla id cursus laoreet, scelerisque id mauris. Suspendisse in libero ac nibh lobortis pretium. Quisque quis orci in felis venenatis varius. Ut lacinia faucibus pellentesque.</p>

<p>Aenean condimentum justo orci, at rutrum ipsum scelerisque nec. Phasellus quis vestibulum justo. Proin lacus ligula, viverra eget aliquet quis, sagittis sed augue. Sed aliquet eleifend massa sit amet iaculis. Vestibulum commodo bibendum lorem quis accumsan. Cras et dolor at risus vestibulum imperdiet. Integer velit massa, egestas ac sapien sed, blandit lobortis metus. Donec sit amet elementum nisl. Ut lorem ex, luctus ac laoreet nec, semper eget erat. Quisque eu efficitur nunc. Nullam scelerisque laoreet pharetra. Nunc consectetur congue lacus, et gravida felis. Mauris eu justo pharetra, aliquet velit et, auctor sem. Nulla ut tortor lectus.</p>

<p>Donec efficitur molestie elementum. Quisque nec nisl in erat tincidunt consequat. Vivamus non risus a augue viverra pharetra. Suspendisse viverra semper velit nec rhoncus. Aliquam feugiat nec lectus ac tempor. Vivamus nunc neque, vulputate sit amet facilisis tempor, placerat sit amet enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam sollicitudin odio lorem, vitae rhoncus felis imperdiet non. Pellentesque consectetur, ante at iaculis dictum, mi felis hendrerit massa, ut efficitur mauris turpis vitae dolor. Etiam facilisis commodo lacus, in venenatis ex molestie nec. Curabitur pellentesque sem id velit vehicula tristique. Phasellus molestie luctus elit vitae iaculis.</p>',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-13 16:54:28',
                'updated_at' => '2023-06-13 16:54:28',
            ),
            88 => 
            array (
                'id' => 89,
                'key' => 'shipping_policy',
                'value' => '<h1>This is a demo shipping policy</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis nunc tortor, non malesuada nunc tincidunt id. Sed porta ex nec sapien convallis hendrerit. Pellentesque auctor dapibus eleifend. Cras tempus, sapien sed dignissim consequat, dolor nunc volutpat urna, at hendrerit dui dolor dapibus odio. Sed dolor purus, luctus in dui non, fermentum imperdiet nibh. Aenean at libero ut libero auctor finibus. Vivamus eu nulla vel risus dapibus tincidunt eget non orci. Sed lorem velit, sollicitudin eu mi vitae, rutrum congue orci. Phasellus sit amet ex accumsan, semper magna in, lobortis nibh. Maecenas ut iaculis ex, eget pellentesque sapien. Praesent tristique eros mauris.</p>

<p>Nam in blandit dui, venenatis sodales ante. Aenean pulvinar feugiat eros non convallis. Integer vel posuere lacus. Fusce eget leo in erat venenatis vehicula. Praesent congue lorem sed neque porta hendrerit. Curabitur sollicitudin tincidunt sapien eu venenatis. In at mattis odio. Aenean gravida enim eget ipsum congue gravida. Proin dapibus non ante sed ultrices.</p>

<p>Suspendisse at quam et sapien rutrum consequat at accumsan dolor. Cras nisl nibh, auctor ut vestibulum sit amet, pretium vitae ligula. Vestibulum id maximus sapien, sit amet laoreet velit. Mauris dui eros, vehicula vel dolor id, lobortis aliquet quam. Cras quis turpis sit amet urna finibus consequat ac pellentesque lorem. Maecenas rutrum eu nulla non tincidunt. Suspendisse pulvinar pellentesque purus, sit amet porttitor lorem feugiat et. Sed ac nisl vel felis ultricies placerat sit amet ac enim. Duis ex justo, bibendum et tortor sit amet, tincidunt ornare dolor. Suspendisse potenti. Suspendisse augue nulla, fringilla id cursus laoreet, scelerisque id mauris. Suspendisse in libero ac nibh lobortis pretium. Quisque quis orci in felis venenatis varius. Ut lacinia faucibus pellentesque.</p>

<p>Aenean condimentum justo orci, at rutrum ipsum scelerisque nec. Phasellus quis vestibulum justo. Proin lacus ligula, viverra eget aliquet quis, sagittis sed augue. Sed aliquet eleifend massa sit amet iaculis. Vestibulum commodo bibendum lorem quis accumsan. Cras et dolor at risus vestibulum imperdiet. Integer velit massa, egestas ac sapien sed, blandit lobortis metus. Donec sit amet elementum nisl. Ut lorem ex, luctus ac laoreet nec, semper eget erat. Quisque eu efficitur nunc. Nullam scelerisque laoreet pharetra. Nunc consectetur congue lacus, et gravida felis. Mauris eu justo pharetra, aliquet velit et, auctor sem. Nulla ut tortor lectus.</p>

<p>Donec efficitur molestie elementum. Quisque nec nisl in erat tincidunt consequat. Vivamus non risus a augue viverra pharetra. Suspendisse viverra semper velit nec rhoncus. Aliquam feugiat nec lectus ac tempor. Vivamus nunc neque, vulputate sit amet facilisis tempor, placerat sit amet enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam sollicitudin odio lorem, vitae rhoncus felis imperdiet non. Pellentesque consectetur, ante at iaculis dictum, mi felis hendrerit massa, ut efficitur mauris turpis vitae dolor. Etiam facilisis commodo lacus, in venenatis ex molestie nec. Curabitur pellentesque sem id velit vehicula tristique. Phasellus molestie luctus elit vitae iaculis.</p>',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-13 16:54:41',
                'updated_at' => '2023-06-13 16:54:41',
            ),
            89 => 
            array (
                'id' => 90,
                'key' => 'about_us',
                'value' => '<p>6amMart is a complete Multi-vendor Food, Grocery, eCommerce, Parcel, Pharmacy, or any kind of products delivery system developed with powerful admin panel will help you to control your business smartly.</p>

<p>Praesent fermentum finibus lacus. Nulla tincidunt lectus sed purus facilisis hendrerit. Maecenas volutpat elementum orci, tincidunt euismod ante facilisis ac. Integer dignissim iaculis varius. Mauris iaculis elit vel posuere pellentesque. Praesent a mi sed neque ullamcorper dignissim sed ut nibh. Sed purus dui, sodales in varius in, accumsan at libero. Vestibulum posuere dui et orci tincidunt, ac consequat felis venenatis.</p>

<p>Morbi sodales, nisl iaculis fringilla imperdiet, metus tortor semper quam, a fringilla nulla dui nec dolor. Phasellus lacinia aliquam ligula sed porttitor. Cras feugiat eros ut arcu commodo dictum. Integer tincidunt nisl id nisl consequat molestie. Integer elit tortor, ultrices sit amet nunc vitae, feugiat tempus mauris. Morbi volutpat consectetur felis sed porttitor. Praesent in urna erat.</p>

<p>Aenean mollis luctus dolor, eu interdum velit faucibus eu. Suspendisse vitae efficitur erat. In facilisis nisi id arcu scelerisque bibendum. Nunc a placerat enim. Donec pharetra, velit quis facilisis tempus, lectus est imperdiet nisl, in tempus tortor dolor iaculis dolor. Nunc vitae molestie turpis. Nam vitae lobortis massa. Nam pharetra non felis in porta.</p>

<p>Vivamus pulvinar diam vel felis dignissim tincidunt. Donec hendrerit non est sed volutpat. In egestas ex tortor, at convallis nunc porttitor at. Fusce sed cursus risus. Nam metus sapien, viverra eget felis id, maximus convallis lacus. Donec nec lacus vitae ex hendrerit ultricies non vel risus. Morbi malesuada ipsum iaculis augue convallis vehicula. Proin eget dolor dignissim, volutpat purus ac, ultricies risus. Pellentesque semper, mauris et pharetra accumsan, ante velit faucibus ex, a mattis metus odio vel ligula. Pellentesque elementum suscipit laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer a turpis sed massa blandit iaculis. Sed aliquet, justo vestibulum euismod rhoncus, nisi dui fringilla sapien, non tempor nunc lectus vitae dolor. Suspendisse potenti.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum massa et dolor porta, rhoncus faucibus magna elementum. Sed porta mattis mollis. Donec ut est pretium, pretium nibh porttitor, suscipit metus. Sed viverra felis sed elit vehicula sodales. Nullam ante ante, tristique vel tincidunt ac, egestas eget sem. Sed lorem nunc, pellentesque vel ipsum venenatis, pellentesque interdum orci. Suspendisse mauris dui, accumsan at dapibus sed, volutpat quis erat. Nam fringilla nisl eu nunc lobortis, feugiat posuere libero venenatis. Nunc risus lorem, ornare eget congue in, pretium quis enim. Pellentesque elit elit, pharetra eget nunc at, maximus pellentesque diam.</p>

<p>Praesent fermentum finibus lacus. Nulla tincidunt lectus sed purus facilisis hendrerit. Maecenas volutpat elementum orci, tincidunt euismod ante facilisis ac. Integer dignissim iaculis varius. Mauris iaculis elit vel posuere pellentesque. Praesent a mi sed neque ullamcorper dignissim sed ut nibh. Sed purus dui, sodales in varius in, accumsan at libero. Vestibulum posuere dui et orci tincidunt, ac consequat felis venenatis.</p>

<p>Morbi sodales, nisl iaculis fringilla imperdiet, metus tortor semper quam, a fringilla nulla dui nec dolor. Phasellus lacinia aliquam ligula sed porttitor. Cras feugiat eros ut arcu commodo dictum. Integer tincidunt nisl id nisl consequat molestie. Integer elit tortor, ultrices sit amet nunc vitae, feugiat tempus mauris. Morbi volutpat consectetur felis sed porttitor. Praesent in urna erat.</p>

<p>Aenean mollis luctus dolor, eu interdum velit faucibus eu. Suspendisse vitae efficitur erat. In facilisis nisi id arcu scelerisque bibendum. Nunc a placerat enim. Donec pharetra, velit quis facilisis tempus, lectus est imperdiet nisl, in tempus tortor dolor iaculis dolor. Nunc vitae molestie turpis. Nam vitae lobortis massa. Nam pharetra non felis in porta.</p>

<p>Vivamus pulvinar diam vel felis dignissim tincidunt. Donec hendrerit non est sed volutpat. In egestas ex tortor, at convallis nunc porttitor at. Fusce sed cursus risus. Nam metus sapien, viverra eget felis id, maximus convallis lacus. Donec nec lacus vitae ex hendrerit ultricies non vel risus. Morbi malesuada ipsum iaculis augue convallis vehicula. Proin eget dolor dignissim, volutpat purus ac, ultricies risus. Pellentesque semper, mauris et pharetra accumsan, ante velit faucibus ex, a mattis metus odio vel ligula. Pellentesque elementum suscipit laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer a turpis sed massa blandit iaculis. Sed aliquet, justo vestibulum euismod rhoncus, nisi dui fringilla sapien, non tempor nunc lectus vitae dolor. Suspendisse potenti.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum massa et dolor porta, rhoncus faucibus magna elementum. Sed porta mattis mollis. Donec ut est pretium, pretium nibh porttitor, suscipit metus. Sed viverra felis sed elit vehicula sodales. Nullam ante ante, tristique vel tincidunt ac, egestas eget sem. Sed lorem nunc, pellentesque vel ipsum venenatis, pellentesque interdum orci. Suspendisse mauris dui, accumsan at dapibus sed, volutpat quis erat. Nam fringilla nisl eu nunc lobortis, feugiat posuere libero venenatis. Nunc risus lorem, ornare eget congue in, pretium quis enim. Pellentesque elit elit, pharetra eget nunc at, maximus pellentesque diam.</p>

<p>Praesent fermentum finibus lacus. Nulla tincidunt lectus sed purus facilisis hendrerit. Maecenas volutpat elementum orci, tincidunt euismod ante facilisis ac. Integer dignissim iaculis varius. Mauris iaculis elit vel posuere pellentesque. Praesent a mi sed neque ullamcorper dignissim sed ut nibh. Sed purus dui, sodales in varius in, accumsan at libero. Vestibulum posuere dui et orci tincidunt, ac consequat felis venenatis.</p>

<p>Morbi sodales, nisl iaculis fringilla imperdiet, metus tortor semper quam, a fringilla nulla dui nec dolor. Phasellus lacinia aliquam ligula sed porttitor. Cras feugiat eros ut arcu commodo dictum. Integer tincidunt nisl id nisl consequat molestie. Integer elit tortor, ultrices sit amet nunc vitae, feugiat tempus mauris. Morbi volutpat consectetur felis sed porttitor. Praesent in urna erat.</p>

<p>Aenean mollis luctus dolor, eu interdum velit faucibus eu. Suspendisse vitae efficitur erat. In facilisis nisi id arcu scelerisque bibendum. Nunc a placerat enim. Donec pharetra, velit quis facilisis tempus, lectus est imperdiet nisl, in tempus tortor dolor iaculis dolor. Nunc vitae molestie turpis. Nam vitae lobortis massa. Nam pharetra non felis in porta.</p>

<p>Vivamus pulvinar diam vel felis dignissim tincidunt. Donec hendrerit non est sed volutpat. In egestas ex tortor, at convallis nunc porttitor at. Fusce sed cursus risus. Nam metus sapien, viverra eget felis id, maximus convallis lacus. Donec nec lacus vitae ex hendrerit ultricies non vel risus. Morbi malesuada ipsum iaculis augue convallis vehicula. Proin eget dolor dignissim, volutpat purus ac, ultricies risus. Pellentesque semper, mauris et pharetra accumsan, ante velit faucibus ex, a mattis metus odio vel ligula. Pellentesque elementum suscipit laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer a turpis sed massa blandit iaculis. Sed aliquet, justo vestibulum euismod rhoncus, nisi dui fringilla sapien, non tempor nunc lectus vitae dolor. Suspendisse potenti.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum massa et dolor porta, rhoncus faucibus magna elementum. Sed porta mattis mollis. Donec ut est pretium, pretium nibh porttitor, suscipit metus. Sed viverra felis sed elit vehicula sodales. Nullam ante ante, tristique vel tincidunt ac, egestas eget sem. Sed lorem nunc, pellentesque vel ipsum venenatis, pellentesque interdum orci. Suspendisse mauris dui, accumsan at dapibus sed, volutpat quis erat. Nam fringilla nisl eu nunc lobortis, feugiat posuere libero venenatis. Nunc risus lorem, ornare eget congue in, pretium quis enim. Pellentesque elit elit, pharetra eget nunc at, maximus pellentesque diam.</p>

<p>Praesent fermentum finibus lacus. Nulla tincidunt lectus sed purus facilisis hendrerit. Maecenas volutpat elementum orci, tincidunt euismod ante facilisis ac. Integer dignissim iaculis varius. Mauris iaculis elit vel posuere pellentesque. Praesent a mi sed neque ullamcorper dignissim sed ut nibh. Sed purus dui, sodales in varius in, accumsan at libero. Vestibulum posuere dui et orci tincidunt, ac consequat felis venenatis.</p>

<p>Morbi sodales, nisl iaculis fringilla imperdiet, metus tortor semper quam, a fringilla nulla dui nec dolor. Phasellus lacinia aliquam ligula sed porttitor. Cras feugiat eros ut arcu commodo dictum. Integer tincidunt nisl id nisl consequat molestie. Integer elit tortor, ultrices sit amet nunc vitae, feugiat tempus mauris. Morbi volutpat consectetur felis sed porttitor. Praesent in urna erat.</p>

<p>Aenean mollis luctus dolor, eu interdum velit faucibus eu. Suspendisse vitae efficitur erat. In facilisis nisi id arcu scelerisque bibendum. Nunc a placerat enim. Donec pharetra, velit quis facilisis tempus, lectus est imperdiet nisl, in tempus tortor dolor iaculis dolor. Nunc vitae molestie turpis. Nam vitae lobortis massa. Nam pharetra non felis in porta.</p>

<p>Vivamus pulvinar diam vel felis dignissim tincidunt. Donec hendrerit non est sed volutpat. In egestas ex tortor, at convallis nunc porttitor at. Fusce sed cursus risus. Nam metus sapien, viverra eget felis id, maximus convallis lacus. Donec nec lacus vitae ex hendrerit ultricies non vel risus. Morbi malesuada ipsum iaculis augue convallis vehicula. Proin eget dolor dignissim, volutpat purus ac, ultricies risus. Pellentesque semper, mauris et pharetra accumsan, ante velit faucibus ex, a mattis metus odio vel ligula. Pellentesque elementum suscipit laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer a turpis sed massa blandit iaculis. Sed aliquet, justo vestibulum euismod rhoncus, nisi dui fringilla sapien, non tempor nunc lectus vitae dolor. Suspendisse potenti.</p>',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-13 16:55:05',
                'updated_at' => '2023-06-13 16:55:05',
            ),
            90 => 
            array (
                'id' => 91,
                'key' => 'cancellation_policy_status',
                'value' => '1',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-13 17:12:06',
                'updated_at' => '2025-09-25 10:45:15',
            ),
            91 => 
            array (
                'id' => 92,
                'key' => 'shipping_policy_status',
                'value' => '1',
                'type' => 'admin_landing_page',
                'created_at' => '2023-06-13 17:12:11',
                'updated_at' => '2023-06-13 17:12:11',
            ),
            92 => 
            array (
                'id' => 93,
                'key' => 'available_zone_title',
                'value' => 'Available delivery areas / Zone',
                'type' => 'admin_landing_page',
                'created_at' => '2024-09-24 10:36:51',
                'updated_at' => '2024-09-24 10:36:51',
            ),
            93 => 
            array (
                'id' => 94,
                'key' => 'available_zone_short_description',
                'value' => 'We offer delivery services across a wide range of regions. To see if we deliver to your area, check our list of available delivery zones or use our delivery',
                'type' => 'admin_landing_page',
                'created_at' => '2024-09-24 10:36:51',
                'updated_at' => '2024-09-24 10:36:51',
            ),
            94 => 
            array (
                'id' => 95,
                'key' => 'available_zone_image',
                'value' => '2024-11-16-6738811f2b5f0.png',
                'type' => 'admin_landing_page',
                'created_at' => '2024-09-24 10:36:51',
                'updated_at' => '2024-11-16 17:25:19',
            ),
            95 => 
            array (
                'id' => 96,
                'key' => 'available_zone_status',
                'value' => '1',
                'type' => 'admin_landing_page',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'key' => 'available_zone_title',
                'value' => 'Available delivery areas / Zone',
                'type' => 'flutter_landing_page',
                'created_at' => '2024-09-24 10:38:26',
                'updated_at' => '2024-09-24 10:38:26',
            ),
            97 => 
            array (
                'id' => 98,
                'key' => 'available_zone_short_description',
                'value' => 'We offer delivery services across a wide range of regions. To see if we deliver to your area, check our list of available delivery zones or use our delivery',
                'type' => 'flutter_landing_page',
                'created_at' => '2024-09-24 10:38:26',
                'updated_at' => '2024-09-24 10:38:26',
            ),
            98 => 
            array (
                'id' => 99,
                'key' => 'available_zone_image',
                'value' => '2024-11-20-673dd4528cf9e.png',
                'type' => 'flutter_landing_page',
                'created_at' => '2024-09-24 10:38:26',
                'updated_at' => '2024-11-20 12:21:38',
            ),
            99 => 
            array (
                'id' => 100,
                'key' => 'available_zone_status',
                'value' => '1',
                'type' => 'flutter_landing_page',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'key' => 'available_zone_title',
                'value' => 'Available delivery areas / Zone',
                'type' => 'react_landing_page',
                'created_at' => '2024-09-24 10:38:35',
                'updated_at' => '2024-09-24 10:38:35',
            ),
            101 => 
            array (
                'id' => 102,
                'key' => 'available_zone_short_description',
                'value' => 'We offer delivery services across a wide range of regions. To see if we deliver to your area, check our list of available delivery zones or use our delivery',
                'type' => 'react_landing_page',
                'created_at' => '2024-09-24 10:38:35',
                'updated_at' => '2024-09-24 10:38:35',
            ),
            102 => 
            array (
                'id' => 103,
                'key' => 'available_zone_image',
                'value' => '2024-11-20-673dd438ec43c.png',
                'type' => 'react_landing_page',
                'created_at' => '2024-09-24 10:38:35',
                'updated_at' => '2024-11-20 12:21:13',
            ),
            103 => 
            array (
                'id' => 104,
                'key' => 'available_zone_status',
                'value' => '1',
                'type' => 'react_landing_page',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'key' => 'fixed_link',
                'value' => '{"web_app_url_status":null,"web_app_url":null}',
                'type' => 'admin_landing_page',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'id' => 106,
                'key' => 'join_seller_flutter_status',
                'value' => '1',
                'type' => 'flutter_landing_page',
                'created_at' => '2024-11-20 04:57:03',
                'updated_at' => '2024-11-20 04:57:03',
            ),
            106 => 
            array (
                'id' => 107,
                'key' => 'join_DM_flutter_status',
                'value' => '1',
                'type' => 'flutter_landing_page',
                'created_at' => '2024-11-20 04:57:18',
                'updated_at' => '2024-11-20 04:57:18',
            ),
            107 => 
            array (
                'id' => 108,
                'key' => 'join_seller_react_status',
                'value' => '1',
                'type' => 'react_landing_page',
                'created_at' => '2024-11-20 04:58:02',
                'updated_at' => '2024-11-20 04:58:02',
            ),
            108 => 
            array (
                'id' => 109,
                'key' => 'join_DM_react_status',
                'value' => '1',
                'type' => 'react_landing_page',
                'created_at' => '2024-11-20 04:58:13',
                'updated_at' => '2024-11-20 04:58:13',
            ),
            109 => 
            array (
                'id' => 110,
                'key' => 'module_home_page_data_title',
                'value' => 'It’s much easier From Apps',
                'type' => 'module_home_page_data',
                'created_at' => '2025-02-06 10:33:27',
                'updated_at' => '2025-02-06 10:33:27',
            ),
            110 => 
            array (
                'id' => 111,
                'key' => 'module_home_page_data_sub_title',
                'value' => 'Enjoy Your Ride ! & travel  your destination  everyday.',
                'type' => 'module_home_page_data',
                'created_at' => '2025-02-06 10:33:27',
                'updated_at' => '2025-02-06 10:33:27',
            ),
            111 => 
            array (
                'id' => 112,
                'key' => 'module_home_page_data_image',
                'value' => '2025-02-06-67a43d7758199.png',
                'type' => 'module_home_page_data',
                'created_at' => '2025-02-06 10:33:27',
                'updated_at' => '2025-02-06 10:41:27',
            ),
            112 => 
            array (
                'id' => 113,
                'key' => 'module_vendor_registration_data_title',
                'value' => 'Earn Money with 6amMart',
                'type' => 'module_vendor_registration_data',
                'created_at' => '2025-02-06 10:34:58',
                'updated_at' => '2025-02-06 10:34:58',
            ),
            113 => 
            array (
                'id' => 114,
                'key' => 'module_vendor_registration_data_sub_title',
                'value' => 'Country’s best all in one service platform',
                'type' => 'module_vendor_registration_data',
                'created_at' => '2025-02-06 10:34:58',
                'updated_at' => '2025-02-06 10:34:58',
            ),
            114 => 
            array (
                'id' => 115,
                'key' => 'module_vendor_registration_data_button_title',
                'value' => 'Register as Vendor',
                'type' => 'module_vendor_registration_data',
                'created_at' => '2025-02-06 10:34:58',
                'updated_at' => '2025-02-06 10:34:58',
            ),
            115 => 
            array (
                'id' => 116,
                'key' => 'module_vendor_registration_data_image',
                'value' => '2025-02-06-67a43bf290e7b.png',
                'type' => 'module_vendor_registration_data',
                'created_at' => '2025-02-06 10:34:58',
                'updated_at' => '2025-02-06 10:34:58',
            ),
            116 => 
            array (
                'id' => 117,
                'key' => 'provider_login_url',
                'value' => 'provider',
                'type' => 'login_provider',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            117 => 
            array (
                'id' => 118,
                'key' => 'provider_employee_login_url',
                'value' => 'provider-employee',
                'type' => 'login_provider_employee',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            118 => 
            array (
                'id' => 119,
                'key' => 'type',
                'value' => 'trip_settings',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:30:49',
                'updated_at' => '2025-09-28 13:06:19',
            ),
            119 => 
            array (
                'id' => 120,
                'key' => 'min_idle_fee_time',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:30:49',
                'updated_at' => '2025-09-28 13:05:05',
            ),
            120 => 
            array (
                'id' => 121,
                'key' => 'min_delay_fee_time',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:30:49',
                'updated_at' => '2025-09-28 13:05:05',
            ),
            121 => 
            array (
                'id' => 122,
                'key' => 'ride_otp_confirmation',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:30:49',
                'updated_at' => '2025-10-12 14:26:39',
            ),
            122 => 
            array (
                'id' => 123,
                'key' => 'customer_route_preference',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:31:57',
                'updated_at' => '2025-09-04 03:31:57',
            ),
            123 => 
            array (
                'id' => 124,
                'key' => 'ride_request_active_time',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:31:57',
                'updated_at' => '2025-10-13 15:06:04',
            ),
            124 => 
            array (
                'id' => 125,
                'key' => 'bidding_push_notification',
                'value' => '0',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:31:57',
                'updated_at' => '2025-09-04 03:31:57',
            ),
            125 => 
            array (
                'id' => 126,
                'key' => 'trip_push_notification',
                'value' => '0',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:31:57',
                'updated_at' => '2025-09-04 03:31:57',
            ),
            126 => 
            array (
                'id' => 127,
                'key' => 'ride_commission',
                'value' => '20',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:39:30',
                'updated_at' => '2025-09-04 03:39:30',
            ),
            127 => 
            array (
                'id' => 128,
                'key' => 'ride_vat',
                'value' => '10',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:39:30',
                'updated_at' => '2025-09-04 03:39:30',
            ),
            128 => 
            array (
                'id' => 129,
                'key' => 'search_radius',
                'value' => '2',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:39:30',
                'updated_at' => '2025-10-12 17:17:15',
            ),
            129 => 
            array (
                'id' => 130,
                'key' => 'rider_completion_radius',
                'value' => '100',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:39:30',
                'updated_at' => '2025-10-05 12:34:31',
            ),
            130 => 
            array (
                'id' => 131,
                'key' => 'bid_on_fare',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:39:30',
                'updated_at' => '2025-09-04 03:39:30',
            ),
            131 => 
            array (
                'id' => 132,
                'key' => 'safety_feature_status',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:40:25',
                'updated_at' => '2025-09-04 03:40:25',
            ),
            132 => 
            array (
                'id' => 133,
                'key' => 'ride_safety_delay_time',
                'value' => '5',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:40:54',
                'updated_at' => '2025-10-08 15:58:55',
            ),
            133 => 
            array (
                'id' => 134,
                'key' => 'ride_safety_delay_time_format',
                'value' => 'minute',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:40:54',
                'updated_at' => '2025-09-17 11:23:56',
            ),
            134 => 
            array (
                'id' => 135,
                'key' => 'safety_feature_after_ride_complete_status',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:40:54',
                'updated_at' => '2025-09-04 03:40:54',
            ),
            135 => 
            array (
                'id' => 136,
                'key' => 'safety_feature_after_ride_complete_time',
                'value' => '2',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:40:54',
                'updated_at' => '2025-10-12 11:37:46',
            ),
            136 => 
            array (
                'id' => 137,
                'key' => 'safety_feature_after_ride_complete_time_format',
                'value' => 'minute',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:40:54',
                'updated_at' => '2025-09-04 03:40:54',
            ),
            137 => 
            array (
                'id' => 138,
                'key' => 'emergency_call_status',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:42:25',
                'updated_at' => '2025-09-04 03:42:25',
            ),
            138 => 
            array (
                'id' => 139,
                'key' => 'emergency_govt_number',
                'value' => '999',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:43:15',
                'updated_at' => '2025-09-04 03:43:15',
            ),
            139 => 
            array (
                'id' => 140,
                'key' => 'emergency_number_type',
                'value' => 'hotline',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:43:15',
                'updated_at' => '2025-09-04 03:43:15',
            ),
            140 => 
            array (
                'id' => 141,
                'key' => 'emergency_other_number',
                'value' => '[{"title":"Medical","number":"+8801700000000"},{"title":"Medical 23","number":"+8801700000001"}]',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:43:15',
                'updated_at' => '2025-09-18 12:59:11',
            ),
            141 => 
            array (
                'id' => 142,
                'key' => 'safety_alert_reason_status',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-04 03:43:25',
                'updated_at' => '2025-09-04 03:43:25',
            ),
            142 => 
            array (
                'id' => 143,
                'key' => 'bidding_system',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            143 => 
            array (
                'id' => 144,
                'key' => 'otp_for_complete_service',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-25 16:38:35',
            ),
            144 => 
            array (
                'id' => 145,
                'key' => 'see_other_providers_offers',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-28 16:15:28',
            ),
            145 => 
            array (
                'id' => 146,
                'key' => 'post_validation_days',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            146 => 
            array (
                'id' => 147,
                'key' => 'maximum_booking_amount',
                'value' => '50000',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            147 => 
            array (
                'id' => 148,
                'key' => 'default_commission',
                'value' => '20',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            148 => 
            array (
                'id' => 149,
                'key' => 'minimum_booking_amount',
                'value' => '5',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-11 11:55:34',
            ),
            149 => 
            array (
                'id' => 150,
                'key' => 'service_complete_photo_evidence',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            150 => 
            array (
                'id' => 151,
                'key' => 'direct_provider_booking',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            151 => 
            array (
                'id' => 152,
                'key' => 'instant_booking',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            152 => 
            array (
                'id' => 153,
                'key' => 'repeat_booking',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            153 => 
            array (
                'id' => 154,
                'key' => 'schedule_booking',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            154 => 
            array (
                'id' => 155,
                'key' => 'time_restriction_on_schedule_booking',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            155 => 
            array (
                'id' => 156,
                'key' => 'time_restriction_on_schedule_booking_value',
                'value' => '3',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            156 => 
            array (
                'id' => 157,
                'key' => 'time_restriction_on_schedule_booking_value_type',
                'value' => 'hours',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            157 => 
            array (
                'id' => 158,
                'key' => 'booking_notification',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            158 => 
            array (
                'id' => 159,
                'key' => 'booking_notification_type',
                'value' => 'firebase',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:49:47',
                'updated_at' => '2025-09-04 03:49:47',
            ),
            159 => 
            array (
                'id' => 160,
                'key' => 'provider_can_cancel_booking',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:14',
                'updated_at' => '2025-09-22 12:04:04',
            ),
            160 => 
            array (
                'id' => 161,
                'key' => 'provider_can_edit_booking',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:14',
                'updated_at' => '2025-09-30 09:23:10',
            ),
            161 => 
            array (
                'id' => 162,
                'key' => 'provider_suspend_on_exceed_cash_limit',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:14',
                'updated_at' => '2025-10-11 10:36:49',
            ),
            162 => 
            array (
                'id' => 163,
                'key' => 'provider_self_registration',
                'value' => '0',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:14',
                'updated_at' => '2025-10-10 17:18:14',
            ),
            163 => 
            array (
                'id' => 164,
                'key' => 'provider_self_delete',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:14',
                'updated_at' => '2025-09-25 10:43:42',
            ),
            164 => 
            array (
                'id' => 165,
                'key' => 'provider_commission_base',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:14',
                'updated_at' => '2025-09-04 03:54:14',
            ),
            165 => 
            array (
                'id' => 166,
                'key' => 'provider_subscription_base',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:14',
                'updated_at' => '2025-09-04 03:54:14',
            ),
            166 => 
            array (
                'id' => 167,
                'key' => 'provider_can_reply_review',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:14',
                'updated_at' => '2025-09-22 12:41:24',
            ),
            167 => 
            array (
                'id' => 168,
                'key' => 'service_at_provider_place',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:14',
                'updated_at' => '2025-09-04 03:54:14',
            ),
            168 => 
            array (
                'id' => 169,
                'key' => 'provider_maximum_booking_amount',
                'value' => '5000',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:14',
                'updated_at' => '2025-09-22 12:39:18',
            ),
            169 => 
            array (
                'id' => 170,
                'key' => 'provider_minimum_payable_amount',
                'value' => '10',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:14',
                'updated_at' => '2025-10-10 17:18:14',
            ),
            170 => 
            array (
                'id' => 171,
                'key' => 'serviceman_can_cancel_booking',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:21',
                'updated_at' => '2025-10-08 10:12:34',
            ),
            171 => 
            array (
                'id' => 172,
                'key' => 'serviceman_edit_booking',
                'value' => '1',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:54:21',
                'updated_at' => '2025-10-08 10:12:34',
            ),
            172 => 
            array (
                'id' => 173,
                'key' => 'service_coupon_cost_bearer',
                'value' => '{"bearer":"both","admin_percentage":"50","provider_percentage":"50"}',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:55:58',
                'updated_at' => '2025-09-04 03:55:58',
            ),
            173 => 
            array (
                'id' => 174,
                'key' => 'service_discount_cost_bearer',
                'value' => '{"bearer":"provider","admin_percentage":0,"provider_percentage":100}',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:55:58',
                'updated_at' => '2025-09-04 03:55:58',
            ),
            174 => 
            array (
                'id' => 175,
                'key' => 'service_campaign_cost_bearer',
                'value' => '{"bearer":"admin","admin_percentage":100,"provider_percentage":0}',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-04 03:55:58',
                'updated_at' => '2025-09-04 03:55:58',
            ),
            175 => 
            array (
                'id' => 176,
                'key' => 'driver_can_review_customer',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-16 10:28:47',
                'updated_at' => '2025-10-11 13:07:31',
            ),
            176 => 
            array (
                'id' => 177,
                'key' => 'rider_level_feature_status',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-16 10:28:47',
                'updated_at' => '2025-09-28 12:14:22',
            ),
            177 => 
            array (
                'id' => 178,
                'key' => 'update_vehicle_approval_status',
                'value' => NULL,
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-16 10:28:47',
                'updated_at' => '2025-10-06 14:59:43',
            ),
            178 => 
            array (
                'id' => 179,
                'key' => 'driver_referral_earning_status',
                'value' => '1',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-16 10:28:47',
                'updated_at' => '2025-09-28 11:10:14',
            ),
            179 => 
            array (
                'id' => 180,
                'key' => 'driver_share_code_earning',
                'value' => '20',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-16 10:28:47',
                'updated_at' => '2025-09-16 13:10:30',
            ),
            180 => 
            array (
                'id' => 181,
                'key' => 'driver_use_code_earning',
                'value' => '50',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-16 10:28:47',
                'updated_at' => '2025-09-16 13:10:30',
            ),
            181 => 
            array (
                'id' => 182,
                'key' => 'update_vehicle_approval',
                'value' => 'null',
                'type' => 'ride_share_business_settings',
                'created_at' => '2025-09-16 10:28:47',
                'updated_at' => '2025-10-06 14:59:43',
            ),
            182 => 
            array (
                'id' => 183,
                'key' => 'provider_max_cash_in_hand_limit',
                'value' => '500000',
                'type' => 'service_business_settings',
                'created_at' => '2025-09-25 10:03:39',
                'updated_at' => '2025-10-11 11:39:06',
            ),
        ));
        
        
    }
}