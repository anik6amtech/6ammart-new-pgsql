<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BusinessSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('business_settings')->delete();
        
        \DB::table('business_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'cash_on_delivery',
                'value' => '{"status":"1"}',
                'created_at' => '2021-07-01 15:51:17',
                'updated_at' => '2021-07-01 15:51:17',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'stripe',
                'value' => '{"status":"1","api_key":"sk_test_4eC39HqLyjWDarjtT1zdp7dc","published_key":"pk_test_TYooMQauvdEDq54NiTphI7jx"}',
                'created_at' => '2021-05-11 03:57:02',
                'updated_at' => '2021-09-08 11:28:06',
            ),
            2 => 
            array (
                'id' => 4,
                'key' => 'mail_config',
                'value' => '{"status":"1","name":"6amMart","host":"sandbox.smtp.mailtrap.io","driver":"smtp","port":"2525","username":"cb7de8b41fdde7","email_id":"demo@6ammart.com","encryption":"tls","password":"1110f480dd91e9"}',
                'created_at' => NULL,
                'updated_at' => '2025-10-10 17:30:01',
            ),
            3 => 
            array (
                'id' => 5,
                'key' => 'fcm_project_id',
                'value' => 'ammart-test-85433',
                'created_at' => NULL,
                'updated_at' => '2025-09-17 10:36:50',
            ),
            4 => 
            array (
                'id' => 6,
                'key' => 'push_notification_key',
                'value' => 'AAAA6N5elcI:APA91bFC9lbROK20x0X0wsG9IvvTm8hcZ-jytYtfgrIctVxmxve_Hdm3rX-HprzSvBD_rkXRYmXk4mHjviG3auBTQttcsRYJrvdkR1A-RVJcAW-zpVDYCkznjbM89UYCPkXxkw7LI1Rs',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'key' => 'order_pending_message',
                'value' => '{"status":1,"message":"Your order is successfully placed"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'key' => 'order_confirmation_msg',
                'value' => '{"status":1,"message":"Your order is confirmed"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'key' => 'order_processing_message',
                'value' => '{"status":1,"message":"Your order is started for cooking"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'key' => 'out_for_delivery_message',
                'value' => '{"status":1,"message":"Your food is ready for delivery"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'key' => 'order_delivered_message',
                'value' => '{"status":1,"message":"Your order is delivered"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'key' => 'delivery_boy_assign_message',
                'value' => '{"status":1,"message":"Your order has been assigned to a delivery man"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 13,
                'key' => 'delivery_boy_start_message',
                'value' => '{"status":1,"message":"Your order is picked up by delivery man"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 14,
                'key' => 'delivery_boy_delivered_message',
                'value' => '{"status":1,"message":"Order delivered successfully"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 15,
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

<p>6amMart can cancel any order anytime due to the foods/products unavailability, out of coverage area and any other unavoidable circumstances.</p>

<p>&nbsp;</p>',
                'created_at' => NULL,
                'updated_at' => '2022-12-12 12:45:19',
            ),
            14 => 
            array (
                'id' => 16,
                'key' => 'business_name',
                'value' => 'AMINE',
                'created_at' => NULL,
                'updated_at' => '2025-09-12 02:11:19',
            ),
            15 => 
            array (
                'id' => 17,
                'key' => 'currency',
                'value' => 'BDT',
                'created_at' => NULL,
                'updated_at' => '2025-09-30 10:58:13',
            ),
            16 => 
            array (
                'id' => 18,
                'key' => 'logo',
                'value' => '2025-09-12-68c32cc2132c2.png',
                'created_at' => NULL,
                'updated_at' => '2025-09-12 02:10:42',
            ),
            17 => 
            array (
                'id' => 19,
                'key' => 'phone',
                'value' => '+880699075368',
                'created_at' => NULL,
                'updated_at' => '2025-10-05 10:38:09',
            ),
            18 => 
            array (
                'id' => 20,
                'key' => 'email_address',
                'value' => 'support@amine.com',
                'created_at' => NULL,
                'updated_at' => '2025-09-12 02:11:19',
            ),
            19 => 
            array (
                'id' => 21,
                'key' => 'address',
                'value' => 'CCC4+44 Agadir, Morocco',
                'created_at' => NULL,
                'updated_at' => '2025-09-29 18:56:10',
            ),
            20 => 
            array (
                'id' => 22,
                'key' => 'footer_text',
                'value' => '2025 AMINE.',
                'created_at' => NULL,
                'updated_at' => '2025-09-12 02:11:33',
            ),
            21 => 
            array (
                'id' => 23,
                'key' => 'customer_verification',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 24,
                'key' => 'map_api_key',
                'value' => 'AIzaSyBYHwgNDQMvanyfPkNybdcb_7pfVA4FGio',
                'created_at' => NULL,
                'updated_at' => '2025-09-04 05:00:24',
            ),
            23 => 
            array (
                'id' => 25,
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
                'created_at' => NULL,
                'updated_at' => '2022-05-11 23:33:33',
            ),
            24 => 
            array (
                'id' => 26,
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
                'created_at' => NULL,
                'updated_at' => '2022-12-12 12:47:14',
            ),
            25 => 
            array (
                'id' => 27,
                'key' => 'minimum_shipping_charge',
                'value' => '10',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 28,
                'key' => 'per_km_shipping_charge',
                'value' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 29,
                'key' => 'digital_payment',
                'value' => '{"status":"1"}',
                'created_at' => '2021-07-01 14:27:38',
                'updated_at' => '2021-08-22 00:47:42',
            ),
            28 => 
            array (
                'id' => 30,
                'key' => 'ssl_commerz_payment',
                'value' => '{"status":"1","store_id":"custo5cc042f7abf4c","store_password":"custo5cc042f7abf4c@ssl"}',
                'created_at' => '2021-07-04 15:41:24',
                'updated_at' => '2021-07-04 16:13:54',
            ),
            29 => 
            array (
                'id' => 31,
                'key' => 'razor_pay',
                'value' => '{"status":"1","razor_key":"rzp_test_Vio27YvAonerHa","razor_secret":"92BIuLdPAkDYx7Bbc9IzqSES"}',
                'created_at' => '2021-07-04 15:41:28',
                'updated_at' => '2021-07-04 16:14:37',
            ),
            30 => 
            array (
                'id' => 32,
                'key' => 'paypal',
                'value' => '{"status":"1","paypal_client_id":"AabIbRZ97J0GHt0xf_DJj3u1dp6MU9boJGwnRY7OZ6fqBJVsrxd7PaBqqi6OGTYe2e4N4dWkYOkFSNtM","paypal_secret":"EIeb5GszxCqanj964p4HYBQ5HMx6TwUGedqY6zdfJqlV-TQMF-cgIP2kZP6d_ZgbS3qjiVJxQH1X6wPt"}',
                'created_at' => '2021-07-04 15:41:34',
                'updated_at' => '2021-07-04 16:14:58',
            ),
            31 => 
            array (
                'id' => 33,
                'key' => 'paystack',
                'value' => '{"status":"1","publicKey":"sk_test_6eec6c4373b17e031388e60c43153426f15b560e","secretKey":"pk_test_9a51c1e76338a611666c2439924b5c21976d7548","paymentUrl":"https:\\/\\/api.paystack.co","merchantEmail":"showrov2185@gmail.com"}',
                'created_at' => '2021-07-04 15:41:42',
                'updated_at' => '2021-07-04 16:16:04',
            ),
            32 => 
            array (
                'id' => 34,
                'key' => 'senang_pay',
                'value' => '{"status":"1","secret_key":"3464-669","published_key":null,"merchant_id":"635161855028588"}',
                'created_at' => '2021-07-04 15:41:48',
                'updated_at' => '2021-07-04 16:15:37',
            ),
            33 => 
            array (
                'id' => 35,
                'key' => 'order_handover_message',
                'value' => '{"status":1,"message":"Delivery man is on the way"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 36,
                'key' => 'order_cancled_message',
                'value' => '{"status":1,"message":"Order is canceled by your request"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 37,
                'key' => 'timezone',
                'value' => 'Asia/Dhaka',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 38,
                'key' => 'order_delivery_verification',
                'value' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 39,
                'key' => 'currency_symbol_position',
                'value' => 'right',
                'created_at' => NULL,
                'updated_at' => '2025-09-15 14:58:38',
            ),
            38 => 
            array (
                'id' => 40,
                'key' => 'schedule_order',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 41,
                'key' => 'app_minimum_version',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 42,
                'key' => 'tax',
                'value' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 43,
                'key' => 'admin_commission',
                'value' => '10',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 44,
                'key' => 'country',
                'value' => 'BD',
                'created_at' => NULL,
                'updated_at' => '2025-10-05 10:38:09',
            ),
            43 => 
            array (
                'id' => 45,
                'key' => 'app_url',
                'value' => 'https://www.google.com',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 46,
                'key' => 'default_location',
                'value' => '{"lat":"30.42031516337496","lng":"-9.59473907762868"}',
                'created_at' => NULL,
                'updated_at' => '2025-09-29 18:56:10',
            ),
            45 => 
            array (
                'id' => 47,
                'key' => 'twilio_sms',
                'value' => '{"status":"0","sid":"ACbf855229b8b2e5d02cad58e116365164","messaging_service_id":null,"token":"46b9779af3aa3e10a3d2fea800cb3b15","from":"+12312992176","otp_template":"Your otp is #OTP#."}',
                'created_at' => '2023-09-20 10:57:29',
                'updated_at' => '2023-09-20 10:57:29',
            ),
            46 => 
            array (
                'id' => 48,
                'key' => 'nexmo_sms',
                'value' => '{"status":0,"api_key":"5923ec09","api_secret":"lkryf6xhyBzhftmj","signature_secret":"","private_key":"","application_id":"","from":"+8801723019985","otp_template":"Your otp is #OTP#."}',
                'created_at' => '2023-09-20 10:57:19',
                'updated_at' => '2023-09-20 10:57:19',
            ),
            47 => 
            array (
                'id' => 49,
                'key' => '2factor_sms',
                'value' => '{"status":0,"api_key":"aabf4e9c-f55f-11eb-85d5-0200cd936042"}',
                'created_at' => '2023-09-20 10:57:19',
                'updated_at' => '2023-09-20 10:57:19',
            ),
            48 => 
            array (
                'id' => 50,
                'key' => 'msg91_sms',
                'value' => '{"status":0,"template_id":"611e267a897b2022f5561052","authkey":"365307AW0mawSKCda610b8e5aP1"}',
                'created_at' => '2023-09-20 10:57:19',
                'updated_at' => '2023-09-20 10:57:19',
            ),
            49 => 
            array (
                'id' => 51,
                'key' => 'free_delivery_over',
                'value' => '5000',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 52,
                'key' => 'maintenance_mode',
                'value' => '0',
                'created_at' => '2021-09-08 15:44:28',
                'updated_at' => '2021-09-08 15:44:28',
            ),
            51 => 
            array (
                'id' => 53,
                'key' => 'app_minimum_version_ios',
                'value' => NULL,
                'created_at' => '2021-09-21 22:54:10',
                'updated_at' => '2021-09-21 22:54:10',
            ),
            52 => 
            array (
                'id' => 54,
                'key' => 'app_minimum_version_android',
                'value' => NULL,
                'created_at' => '2021-09-21 22:54:10',
                'updated_at' => '2021-09-21 22:54:10',
            ),
            53 => 
            array (
                'id' => 55,
                'key' => 'app_url_ios',
                'value' => NULL,
                'created_at' => '2021-09-21 22:54:10',
                'updated_at' => '2021-09-21 22:54:10',
            ),
            54 => 
            array (
                'id' => 56,
                'key' => 'app_url_android',
                'value' => NULL,
                'created_at' => '2021-09-21 22:54:10',
                'updated_at' => '2021-09-21 22:54:10',
            ),
            55 => 
            array (
                'id' => 57,
                'key' => 'flutterwave',
                'value' => '{"status":1,"public_key":"FLWPUBK_TEST-3f6a0b6c3d621c4ecbb9beeff516c92b-X","secret_key":"FLWSECK_TEST-ec27426eb062491500a9eb95723b5436-X","hash":"FLWSECK_TEST951e36220f66"}',
                'created_at' => '2021-09-21 22:54:10',
                'updated_at' => '2021-09-21 22:54:10',
            ),
            56 => 
            array (
                'id' => 58,
                'key' => 'dm_maximum_orders',
                'value' => '5',
                'created_at' => '2021-09-24 17:46:13',
                'updated_at' => '2021-09-24 17:46:13',
            ),
            57 => 
            array (
                'id' => 59,
                'key' => 'order_confirmation_model',
                'value' => 'deliveryman',
                'created_at' => '2021-10-17 00:05:08',
                'updated_at' => '2025-10-12 15:48:56',
            ),
            58 => 
            array (
                'id' => 60,
                'key' => 'popular_food',
                'value' => '1',
                'created_at' => '2021-10-17 00:05:08',
                'updated_at' => '2021-10-17 00:05:08',
            ),
            59 => 
            array (
                'id' => 61,
                'key' => 'popular_restaurant',
                'value' => '1',
                'created_at' => '2021-10-17 00:05:08',
                'updated_at' => '2021-10-17 00:05:08',
            ),
            60 => 
            array (
                'id' => 62,
                'key' => 'new_restaurant',
                'value' => '1',
                'created_at' => '2021-10-17 00:05:08',
                'updated_at' => '2021-10-17 00:05:08',
            ),
            61 => 
            array (
                'id' => 63,
                'key' => 'mercadopago',
                'value' => '{"status":1,"public_key":"","access_token":""}',
                'created_at' => '2021-10-17 00:05:08',
                'updated_at' => '2021-10-17 00:05:08',
            ),
            62 => 
            array (
                'id' => 64,
                'key' => 'map_api_key_server',
                'value' => 'AIzaSyBYHwgNDQMvanyfPkNybdcb_7pfVA4FGio',
                'created_at' => NULL,
                'updated_at' => '2025-09-04 05:00:24',
            ),
            63 => 
            array (
                'id' => 66,
                'key' => 'most_reviewed_foods',
                'value' => '1',
                'created_at' => '2021-11-15 15:55:37',
                'updated_at' => '2021-11-15 15:55:37',
            ),
            64 => 
            array (
                'id' => 67,
                'key' => 'landing_page_text',
                'value' => '{"header_title_1":"Manage Your  Daily Life in one platform","header_title_2":"More than just a reliable  ecommerce platform","header_title_3":null,"about_title":"Who We Are","why_choose_us":null,"why_choose_us_title":"What is so Special About 6amMart?","module_section_title":"Your e-commerce venture starts here !","module_section_sub_title":"Enjoy all services in one platform","refer_section_title":"Earn","refer_section_sub_title":"point","refer_section_description":"By Refer Your Friend","joinus_section_title":"Earn Money","joinus_section_sub_title":"Earn money  by using different platform","download_app_section_title":"Let\\u2019s Manage","download_app_section_sub_title":"your business  Smartly or Earn.","testimonial_title":"People Who Shared Love with us ?","mobile_app_section_heading":"Earn Money","mobile_app_section_text":"Earn money  by using different platform","feature_section_description":"Jam-packed with outstanding features to elevate your online ordering and delivery easier, and smarter than ever before. It\'s time to empower your multivendor online business with 6amMart\'s powerful features!","feature_section_title":"Remarkable Features that You Can Count!","newsletter_title":"Sign Up to Our Newsletter","newsletter_sub_title":"Receive Latest News, Updates and Many Other\\r\\nNews Every Week","contact_us_title":"Contact Us","contact_us_sub_title":"Any question or remarks? Just write us a message!","footer_article":"6amMart is a complete package!  It\'s time to empower your multivendor online business with  powerful features!"}',
                'created_at' => '2021-11-15 15:55:37',
                'updated_at' => '2021-11-15 15:55:37',
            ),
            65 => 
            array (
                'id' => 68,
                'key' => 'landing_page_links',
                'value' => '{"app_url_android_status":"1","app_url_android":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=com.sixamtech.sixam_mart_user","app_url_ios_status":"1","app_url_ios":"https:\\/\\/www.apple.com\\/app-store","web_app_url_status":"1","web_app_url":"https:\\/\\/6ammart-web.6amtech.com\\/","seller_app_url_status":"1","seller_app_url":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=com.sixamtech.sixam_mart_store_app","deliveryman_app_url_status":"1","deliveryman_app_url":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=com.sixamtech.sixam_mart_delivery_app"}',
                'created_at' => '2021-11-15 15:55:37',
                'updated_at' => '2021-11-15 15:55:37',
            ),
            66 => 
            array (
                'id' => 69,
                'key' => 'speciality',
                'value' => '[{"img":"2022-11-21-637b0983c3c17.png","title":"Easy to Manage Multiple Store"},{"img":"2022-11-21-637b099138696.png","title":"Easy to Manage E-Commerce"},{"img":"2022-11-21-637b09a17fe01.png","title":"Easy to Manage Parcel Delivery"},{"img":"2022-11-21-637b09b0d7d41.png","title":"Easy to Manage Location Tracking"},{"img":"2022-11-21-637b09c30fe2a.png","title":"Easy to Manage Grocery Business"},{"img":"2022-11-21-637b09d4ccbdc.png","title":"Easy to Get  Help & Support"}]',
                'created_at' => '2021-11-15 15:55:37',
                'updated_at' => '2022-11-21 11:15:30',
            ),
            67 => 
            array (
                'id' => 70,
                'key' => 'testimonial',
            'value' => '[{"img":"2022-11-21-637b1182b5632.png","brand_image":"2022-11-21-637b1182b57b2.png","name":"Jane Cooper","position":"President of Sales","detail":"This application is well organized and I think they have listened to their customer\'s wishes. Layout very well, easy to use. This application saves a lot of time because it is comprehensive and everything you need to set it up as a multi-vendor system is there."},{"img":"2022-11-21-637b11ac3eef0.png","brand_image":"2022-11-21-637b11ac3f070.png","name":"Ronald Richards","position":"Dog Trainer","detail":"Wonderful experience with 6amTech. What actually i was looking for multivendor app for my delivery project. You made it everything with your well organized app and quality of the code, in customer service, support and Admin Panel which is perfect to me. As per my research on code canyon 6amMart Excellent in all aspects all in one App, even in the slightest details."},{"img":"2022-11-21-637b11dedb042.png","brand_image":"2022-11-21-637b11dedb2c5.png","name":"Devon Lane","position":"Nursing Assistant","detail":"The best in the business. With 6amMart, I\'ve just reinvented the way of online ordering and delivery system. The readymade & highly responsive mobile apps helps me to manage my business effectively. Long live 6amTech and Prosper!"},{"img":"2022-11-21-637b120bd653e.png","brand_image":null,"name":"Darrell Steward","position":"President of Sales","detail":"This is a complete package! I\'m running a multivendor (food, grocery) online ordering and delivery business with it very smoothly. Seeing the revenue that I never thought of! Thank you 6amTech, keep doing the good work!"}]',
                'created_at' => '2021-11-15 15:55:37',
                'updated_at' => '2022-11-21 11:49:03',
            ),
            68 => 
            array (
                'id' => 71,
                'key' => 'landing_page_images',
                'value' => '{"top_content_image":"double_screen_image.png","about_us_image":"about_us_image.png","contact_us_image":"2022-11-21-637b192bd1cdc.png"}',
                'created_at' => '2021-11-15 15:55:37',
                'updated_at' => '2021-11-15 15:55:37',
            ),
            69 => 
            array (
                'id' => 72,
                'key' => 'paymob_accept',
                'value' => '{"status":"0","api_key":null,"iframe_id":null,"integration_id":null,"hmac":null}',
                'created_at' => '2021-11-15 15:55:37',
                'updated_at' => '2021-11-15 15:55:37',
            ),
            70 => 
            array (
                'id' => 73,
                'key' => 'admin_order_notification',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 74,
                'key' => 'swish_payment',
                'value' => '{"status":"1"}',
                'created_at' => NULL,
                'updated_at' => '2021-12-28 12:02:40',
            ),
            72 => 
            array (
                'id' => 76,
                'key' => 'service_charge',
                'value' => '12',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 77,
                'key' => 'social_login',
                'value' => '[{"login_medium":"google","client_id":"491987943015-agln6biv84krpnngdphj87jkko7r9lb8.apps.googleusercontent.com","client_secret":"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","status":"1"},{"login_medium":"facebook","client_id":"380903914182154","client_secret":"58a3b348c1812666d8a79dd423ddf00b","status":"1"}]',
                'created_at' => NULL,
                'updated_at' => '2024-10-02 07:48:48',
            ),
            74 => 
            array (
                'id' => 78,
                'key' => 'language',
                'value' => '["en","ar"]',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id' => 79,
                'key' => 'timeformat',
                'value' => '12',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id' => 80,
                'key' => 'canceled_by_restaurant',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id' => 81,
                'key' => 'canceled_by_deliveryman',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2025-09-28 12:34:16',
            ),
            78 => 
            array (
                'id' => 82,
                'key' => 'show_dm_earning',
                'value' => NULL,
                'created_at' => NULL,
                'updated_at' => '2025-09-28 12:14:21',
            ),
            79 => 
            array (
                'id' => 83,
                'key' => 'recaptcha',
                'value' => '{"status":"1","site_key":"6LeGbeslAAAAAKcyn9uQiSSgY_Q1zxlDVmIOW9PF","secret_key":"6LeGbeslAAAAAJ6ad-txz_ClTvrmS2IZhnj6eIaY"}',
                'created_at' => '2024-09-24 10:20:24',
                'updated_at' => '2024-09-24 10:20:24',
            ),
            80 => 
            array (
                'id' => 84,
                'key' => 'toggle_veg_non_veg',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id' => 85,
                'key' => 'toggle_dm_registration',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id' => 86,
                'key' => 'toggle_restaurant_registration',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id' => 87,
                'key' => 'order_refunded_message',
                'value' => '{"status":1,"message":"asdfasdfasd"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id' => 88,
                'key' => 'liqpay',
                'value' => '{"status":"1","public_key":null,"private_key":null}',
                'created_at' => NULL,
                'updated_at' => '2022-02-27 05:15:40',
            ),
            85 => 
            array (
                'id' => 89,
                'key' => 'klarna',
                'value' => '{"status":"1","region":"america","username":"PN06804_1a368db08f6d","password":"6ljrP6BDJNKT6F2y"}',
                'created_at' => NULL,
                'updated_at' => '2022-01-26 08:30:51',
            ),
            86 => 
            array (
                'id' => 90,
                'key' => 'fatoorah',
                'value' => '{"status":"1","api_key":"rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL"}',
                'created_at' => NULL,
                'updated_at' => '2022-02-20 11:05:26',
            ),
            87 => 
            array (
                'id' => 91,
                'key' => 'bkash',
                'value' => '{"status":"1","api_key":"5tunt4masn6pv2hnvte1sb5n3j","api_secret":"1vggbqd4hqk9g96o9rrrp2jftvek578v7d2bnerim12a87dbrrka","username":"sandboxTestUser","password":"hWD@8vtzw0"}',
                'created_at' => NULL,
                'updated_at' => '2022-02-27 04:37:26',
            ),
            88 => 
            array (
                'id' => 92,
                'key' => 'paytabs',
                'value' => '{"status":"1","profile_id":null,"server_key":null,"base_url":null}',
                'created_at' => NULL,
                'updated_at' => '2022-02-27 06:06:19',
            ),
            89 => 
            array (
                'id' => 93,
                'key' => 'paytm',
                'value' => '{"status":"1","paytm_merchant_key":null,"paytm_merchant_mid":null,"paytm_merchant_website":null,"paytm_refund_url":null}',
                'created_at' => NULL,
                'updated_at' => '2022-02-27 06:06:37',
            ),
            90 => 
            array (
                'id' => 94,
                'key' => 'schedule_order_slot_duration',
                'value' => '30',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'id' => 95,
                'key' => 'digit_after_decimal_point',
                'value' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'id' => 96,
                'key' => 'icon',
                'value' => '2025-09-12-68c32cd12b5c1.png',
                'created_at' => NULL,
                'updated_at' => '2025-09-12 02:10:57',
            ),
            93 => 
            array (
                'id' => 97,
                'key' => 'toggle_store_registration',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => '2025-10-13 11:50:22',
            ),
            94 => 
            array (
                'id' => 98,
                'key' => 'canceled_by_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'id' => 99,
                'key' => 'parcel_per_km_shipping_charge',
                'value' => '5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'id' => 100,
                'key' => 'parcel_minimum_shipping_charge',
                'value' => '20',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'id' => 101,
                'key' => 'parcel_commission_dm',
                'value' => '80',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'id' => 102,
                'key' => 'web_app_landing_page_settings',
                'value' => '{"top_content_image":"2022-11-21-637b583c82a32.png","mobile_app_section_image":"2022-11-21-637b58464fb5f.png"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'id' => 103,
                'key' => 'feature',
                'value' => '[{"img":"2022-11-21-637b020ba3ac7.png","title":"Trusted","feature_description":"Trusted by customers\\r\\nand store owners"},{"img":"2022-11-21-637b0245dff92.png","title":"Shopping","feature_description":"Best shopping \\r\\nexperience"},{"img":"2022-11-21-637b025ae8b6d.png","title":"Payment","feature_description":"Total secured\\r\\npayment system"},{"img":"2022-11-21-637b027718a8b.png","title":"Delivery","feature_description":"Flexible delivery\\r\\nsystem"},{"img":"2022-11-21-637b028ed22b4.png","title":"Location","feature_description":"Location tracking \\r\\nsystem"}]',
                'created_at' => NULL,
                'updated_at' => '2022-11-21 10:44:02',
            ),
            100 => 
            array (
                'id' => 104,
                'key' => 'wallet_status',
                'value' => '1',
                'created_at' => '2022-07-05 14:51:13',
                'updated_at' => '2022-07-05 14:51:13',
            ),
            101 => 
            array (
                'id' => 105,
                'key' => 'loyalty_point_status',
                'value' => '1',
                'created_at' => '2022-07-05 14:51:13',
                'updated_at' => '2022-07-05 14:51:13',
            ),
            102 => 
            array (
                'id' => 106,
                'key' => 'ref_earning_status',
                'value' => '1',
                'created_at' => '2022-07-05 14:51:13',
                'updated_at' => '2022-07-05 14:51:13',
            ),
            103 => 
            array (
                'id' => 107,
                'key' => 'wallet_add_refund',
                'value' => '1',
                'created_at' => '2022-07-05 14:51:13',
                'updated_at' => '2022-07-05 14:51:13',
            ),
            104 => 
            array (
                'id' => 108,
                'key' => 'loyalty_point_exchange_rate',
                'value' => '10',
                'created_at' => '2022-07-05 14:51:13',
                'updated_at' => '2022-07-05 14:51:13',
            ),
            105 => 
            array (
                'id' => 109,
                'key' => 'ref_earning_exchange_rate',
                'value' => '5',
                'created_at' => '2022-07-05 14:51:13',
                'updated_at' => '2022-07-05 14:51:13',
            ),
            106 => 
            array (
                'id' => 110,
                'key' => 'loyalty_point_item_purchase_point',
                'value' => '2',
                'created_at' => '2022-07-05 14:51:13',
                'updated_at' => '2022-07-05 14:51:13',
            ),
            107 => 
            array (
                'id' => 111,
                'key' => 'loyalty_point_minimum_point',
                'value' => '20',
                'created_at' => '2022-07-05 14:51:13',
                'updated_at' => '2022-07-05 14:51:13',
            ),
            108 => 
            array (
                'id' => 112,
                'key' => 'dm_tips_status',
                'value' => '1',
                'created_at' => '2022-07-05 14:51:13',
                'updated_at' => '2022-07-05 14:51:13',
            ),
            109 => 
            array (
                'id' => 113,
                'key' => 'fcm_credentials',
                'value' => '{"apiKey":"AIzaSyB6SaAO8pfZaqLCqvAQ6T1_dCXMG16q_Sc","authDomain":"ammart-test-85433.firebaseapp.com","projectId":"ammart-test-85433","storageBucket":"ammart-test-85433.firebasestorage.app","messagingSenderId":"924571058618","appId":"1:924571058618:web:68284aff1eae35b90e1d83","measurementId":null}',
                'created_at' => NULL,
                'updated_at' => '2025-09-17 10:36:50',
            ),
            110 => 
            array (
                'id' => 114,
                'key' => 'free_delivery_over_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'id' => 115,
                'key' => 'counter_section',
                'value' => '{"app_download_count_numbers":"300","seller_count_numbers":"50","deliveryman_count_numbers":"70"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'id' => 116,
                'key' => 'delivery_charge_comission',
                'value' => '5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            113 => 
            array (
                'id' => 117,
                'key' => 'opening_time',
                'value' => '06:00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            114 => 
            array (
                'id' => 118,
                'key' => 'closing_time',
                'value' => '23:59',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            115 => 
            array (
                'id' => 119,
                'key' => 'module_section',
                'value' => '{"grocery":{"description":"We make grocery shopping more interesting.\\r\\nFind the greatest deals from the grocery stores near you.  \\r\\n\\r\\nNature & Organic Products\\r\\nBring Nature into your home.\\r\\n\\r\\nStay home & get your daily needs from our shop\\r\\nStart You\'r Daily Shopping with 6amMart","img":"2022-11-20-637a20bdc42f5.png"},"pharmacy":{"description":"We make your regular Medi-Life more interesting.\\r\\nFind the greatest deals from the pharmacy stores near you.  \\r\\n\\r\\nFind Quality & Authentic Medichine \\r\\nBring easy life for your health.\\r\\n\\r\\nStay home & get your daily needs from our shop\\r\\nStart You\'r Daily Shopping with 6amMart","img":"2022-11-20-637a1f6769296.png"},"parcel":{"description":"We make your parcel delivery more easier.\\r\\nJust request a rider to pick your parcel to delivery. \\r\\nyour parcel to your loved once.\\r\\n\\r\\nFind Quality & Authentic Items\\r\\nSend gift and enjoy happiness.\\r\\n\\r\\nStay home & get your daily needs from our shop\\r\\nStart You\'r Daily Shopping with 6amMart","img":"2022-11-20-637a1f93d95c2.png"},"food":{"description":"We make your Food order more easier.\\r\\n\\r\\nJust request for a food to location your rider to delivery \\r\\nyour food to your loved once.\\r\\n\\r\\nFind Quality & Authentic Items Food\\r\\nBe foody and make easier for your dinner.\\r\\n\\r\\nStay home & get your daily needs from our shop\\r\\nStart You\'r Daily Shopping with 6amMart","img":"2022-11-20-637a1fc3a616d.png"},"ecommerce":{"description":"We make your regular shopping more interesting.\\r\\nFind the greatest deals from the shop stores near you.  \\r\\n\\r\\nFind Quality & Authentic Product\\r\\nMake easier to your daily life\\r\\n\\r\\nStay home & get your daily needs from our shop\\r\\nStart You\'r Daily Shopping with 6amMart","img":"2022-11-20-637a2022621e8.png"}}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            116 => 
            array (
                'id' => 120,
                'key' => 'promotion_banner',
                'value' => '[{"img":"2022-11-20-637a209125e1d.png","title":"Find","sub_title":"your daily grocery item"},{"img":"2022-11-21-637b0ab99286f.png","title":"Find","sub_title":"your daily shopping items"},{"img":"2022-11-21-637b0ae3b7ebf.png","title":"Find","sub_title":"your daily medicines"},{"img":"2022-11-21-637b0bf6da72f.png","title":"Find","sub_title":"your parcel service"}]',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            117 => 
            array (
                'id' => 121,
                'key' => 'join_as_images',
                'value' => '{"seller_banner_bg":"2022-11-21-637b03ef1c957.png","deliveryman_banner_bg":"2022-11-21-637b0406d5dfe.png"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            118 => 
            array (
                'id' => 122,
                'key' => 'download_app_section',
                'value' => '{"img":"2022-11-20-637a235a03290.png","description":"Let\\u2019s \\r\\nManage your business \\r\\nSmartly or Earn."}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            119 => 
            array (
                'id' => 123,
                'key' => 'backgroundChange',
                'value' => '{"primary_1_hex":"#00be65","primary_1_rgb":"0, 190, 101","primary_2_hex":"#02da75","primary_2_rgb":"2, 218, 117"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            120 => 
            array (
                'id' => 124,
                'key' => 'opening_day',
                'value' => 'sunday',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            121 => 
            array (
                'id' => 125,
                'key' => 'closing_day',
                'value' => 'saturday',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            122 => 
            array (
                'id' => 126,
                'key' => 'refund',
                'value' => '{"status":"1","value":"<h1>This is a demo refund policy<\\/h1>\\r\\n\\r\\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis nunc tortor, non malesuada nunc tincidunt id. Sed porta ex nec sapien convallis hendrerit. Pellentesque auctor dapibus eleifend. Cras tempus, sapien sed dignissim consequat, dolor nunc volutpat urna, at hendrerit dui dolor dapibus odio. Sed dolor purus, luctus in dui non, fermentum imperdiet nibh. Aenean at libero ut libero auctor finibus. Vivamus eu nulla vel risus dapibus tincidunt eget non orci. Sed lorem velit, sollicitudin eu mi vitae, rutrum congue orci. Phasellus sit amet ex accumsan, semper magna in, lobortis nibh. Maecenas ut iaculis ex, eget pellentesque sapien. Praesent tristique eros mauris.<\\/p>\\r\\n\\r\\n<p>Nam in blandit dui, venenatis sodales ante. Aenean pulvinar feugiat eros non convallis. Integer vel posuere lacus. Fusce eget leo in erat venenatis vehicula. Praesent congue lorem sed neque porta hendrerit. Curabitur sollicitudin tincidunt sapien eu venenatis. In at mattis odio. Aenean gravida enim eget ipsum congue gravida. Proin dapibus non ante sed ultrices.<\\/p>\\r\\n\\r\\n<p>Suspendisse at quam et sapien rutrum consequat at accumsan dolor. Cras nisl nibh, auctor ut vestibulum sit amet, pretium vitae ligula. Vestibulum id maximus sapien, sit amet laoreet velit. Mauris dui eros, vehicula vel dolor id, lobortis aliquet quam. Cras quis turpis sit amet urna finibus consequat ac pellentesque lorem. Maecenas rutrum eu nulla non tincidunt. Suspendisse pulvinar pellentesque purus, sit amet porttitor lorem feugiat et. Sed ac nisl vel felis ultricies placerat sit amet ac enim. Duis ex justo, bibendum et tortor sit amet, tincidunt ornare dolor. Suspendisse potenti. Suspendisse augue nulla, fringilla id cursus laoreet, scelerisque id mauris. Suspendisse in libero ac nibh lobortis pretium. Quisque quis orci in felis venenatis varius. Ut lacinia faucibus pellentesque.<\\/p>\\r\\n\\r\\n<p>Aenean condimentum justo orci, at rutrum ipsum scelerisque nec. Phasellus quis vestibulum justo. Proin lacus ligula, viverra eget aliquet quis, sagittis sed augue. Sed aliquet eleifend massa sit amet iaculis. Vestibulum commodo bibendum lorem quis accumsan. Cras et dolor at risus vestibulum imperdiet. Integer velit massa, egestas ac sapien sed, blandit lobortis metus. Donec sit amet elementum nisl. Ut lorem ex, luctus ac laoreet nec, semper eget erat. Quisque eu efficitur nunc. Nullam scelerisque laoreet pharetra. Nunc consectetur congue lacus, et gravida felis. Mauris eu justo pharetra, aliquet velit et, auctor sem. Nulla ut tortor lectus.<\\/p>\\r\\n\\r\\n<p>Donec efficitur molestie elementum. Quisque nec nisl in erat tincidunt consequat. Vivamus non risus a augue viverra pharetra. Suspendisse viverra semper velit nec rhoncus. Aliquam feugiat nec lectus ac tempor. Vivamus nunc neque, vulputate sit amet facilisis tempor, placerat sit amet enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam sollicitudin odio lorem, vitae rhoncus felis imperdiet non. Pellentesque consectetur, ante at iaculis dictum, mi felis hendrerit massa, ut efficitur mauris turpis vitae dolor. Etiam facilisis commodo lacus, in venenatis ex molestie nec. Curabitur pellentesque sem id velit vehicula tristique. Phasellus molestie luctus elit vitae iaculis.<\\/p>"}',
                'created_at' => NULL,
                'updated_at' => '2022-12-12 12:41:43',
            ),
            123 => 
            array (
                'id' => 127,
                'key' => 'cancelation',
                'value' => '{"status":"1","value":"<h1>This is a demo cancelation policy<\\/h1>\\r\\n\\r\\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis nunc tortor, non malesuada nunc tincidunt id. Sed porta ex nec sapien convallis hendrerit. Pellentesque auctor dapibus eleifend. Cras tempus, sapien sed dignissim consequat, dolor nunc volutpat urna, at hendrerit dui dolor dapibus odio. Sed dolor purus, luctus in dui non, fermentum imperdiet nibh. Aenean at libero ut libero auctor finibus. Vivamus eu nulla vel risus dapibus tincidunt eget non orci. Sed lorem velit, sollicitudin eu mi vitae, rutrum congue orci. Phasellus sit amet ex accumsan, semper magna in, lobortis nibh. Maecenas ut iaculis ex, eget pellentesque sapien. Praesent tristique eros mauris.<\\/p>\\r\\n\\r\\n<p>Nam in blandit dui, venenatis sodales ante. Aenean pulvinar feugiat eros non convallis. Integer vel posuere lacus. Fusce eget leo in erat venenatis vehicula. Praesent congue lorem sed neque porta hendrerit. Curabitur sollicitudin tincidunt sapien eu venenatis. In at mattis odio. Aenean gravida enim eget ipsum congue gravida. Proin dapibus non ante sed ultrices.<\\/p>\\r\\n\\r\\n<p>Suspendisse at quam et sapien rutrum consequat at accumsan dolor. Cras nisl nibh, auctor ut vestibulum sit amet, pretium vitae ligula. Vestibulum id maximus sapien, sit amet laoreet velit. Mauris dui eros, vehicula vel dolor id, lobortis aliquet quam. Cras quis turpis sit amet urna finibus consequat ac pellentesque lorem. Maecenas rutrum eu nulla non tincidunt. Suspendisse pulvinar pellentesque purus, sit amet porttitor lorem feugiat et. Sed ac nisl vel felis ultricies placerat sit amet ac enim. Duis ex justo, bibendum et tortor sit amet, tincidunt ornare dolor. Suspendisse potenti. Suspendisse augue nulla, fringilla id cursus laoreet, scelerisque id mauris. Suspendisse in libero ac nibh lobortis pretium. Quisque quis orci in felis venenatis varius. Ut lacinia faucibus pellentesque.<\\/p>\\r\\n\\r\\n<p>Aenean condimentum justo orci, at rutrum ipsum scelerisque nec. Phasellus quis vestibulum justo. Proin lacus ligula, viverra eget aliquet quis, sagittis sed augue. Sed aliquet eleifend massa sit amet iaculis. Vestibulum commodo bibendum lorem quis accumsan. Cras et dolor at risus vestibulum imperdiet. Integer velit massa, egestas ac sapien sed, blandit lobortis metus. Donec sit amet elementum nisl. Ut lorem ex, luctus ac laoreet nec, semper eget erat. Quisque eu efficitur nunc. Nullam scelerisque laoreet pharetra. Nunc consectetur congue lacus, et gravida felis. Mauris eu justo pharetra, aliquet velit et, auctor sem. Nulla ut tortor lectus.<\\/p>\\r\\n\\r\\n<p>Donec efficitur molestie elementum. Quisque nec nisl in erat tincidunt consequat. Vivamus non risus a augue viverra pharetra. Suspendisse viverra semper velit nec rhoncus. Aliquam feugiat nec lectus ac tempor. Vivamus nunc neque, vulputate sit amet facilisis tempor, placerat sit amet enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam sollicitudin odio lorem, vitae rhoncus felis imperdiet non. Pellentesque consectetur, ante at iaculis dictum, mi felis hendrerit massa, ut efficitur mauris turpis vitae dolor. Etiam facilisis commodo lacus, in venenatis ex molestie nec. Curabitur pellentesque sem id velit vehicula tristique. Phasellus molestie luctus elit vitae iaculis.<\\/p>"}',
                'created_at' => NULL,
                'updated_at' => '2022-12-12 12:41:28',
            ),
            124 => 
            array (
                'id' => 128,
                'key' => 'shipping_policy',
                'value' => '{"status":"1","value":"<h1>This is a demo shipping policy<\\/h1>\\r\\n\\r\\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis nunc tortor, non malesuada nunc tincidunt id. Sed porta ex nec sapien convallis hendrerit. Pellentesque auctor dapibus eleifend. Cras tempus, sapien sed dignissim consequat, dolor nunc volutpat urna, at hendrerit dui dolor dapibus odio. Sed dolor purus, luctus in dui non, fermentum imperdiet nibh. Aenean at libero ut libero auctor finibus. Vivamus eu nulla vel risus dapibus tincidunt eget non orci. Sed lorem velit, sollicitudin eu mi vitae, rutrum congue orci. Phasellus sit amet ex accumsan, semper magna in, lobortis nibh. Maecenas ut iaculis ex, eget pellentesque sapien. Praesent tristique eros mauris.<\\/p>\\r\\n\\r\\n<p>Nam in blandit dui, venenatis sodales ante. Aenean pulvinar feugiat eros non convallis. Integer vel posuere lacus. Fusce eget leo in erat venenatis vehicula. Praesent congue lorem sed neque porta hendrerit. Curabitur sollicitudin tincidunt sapien eu venenatis. In at mattis odio. Aenean gravida enim eget ipsum congue gravida. Proin dapibus non ante sed ultrices.<\\/p>\\r\\n\\r\\n<p>Suspendisse at quam et sapien rutrum consequat at accumsan dolor. Cras nisl nibh, auctor ut vestibulum sit amet, pretium vitae ligula. Vestibulum id maximus sapien, sit amet laoreet velit. Mauris dui eros, vehicula vel dolor id, lobortis aliquet quam. Cras quis turpis sit amet urna finibus consequat ac pellentesque lorem. Maecenas rutrum eu nulla non tincidunt. Suspendisse pulvinar pellentesque purus, sit amet porttitor lorem feugiat et. Sed ac nisl vel felis ultricies placerat sit amet ac enim. Duis ex justo, bibendum et tortor sit amet, tincidunt ornare dolor. Suspendisse potenti. Suspendisse augue nulla, fringilla id cursus laoreet, scelerisque id mauris. Suspendisse in libero ac nibh lobortis pretium. Quisque quis orci in felis venenatis varius. Ut lacinia faucibus pellentesque.<\\/p>\\r\\n\\r\\n<p>Aenean condimentum justo orci, at rutrum ipsum scelerisque nec. Phasellus quis vestibulum justo. Proin lacus ligula, viverra eget aliquet quis, sagittis sed augue. Sed aliquet eleifend massa sit amet iaculis. Vestibulum commodo bibendum lorem quis accumsan. Cras et dolor at risus vestibulum imperdiet. Integer velit massa, egestas ac sapien sed, blandit lobortis metus. Donec sit amet elementum nisl. Ut lorem ex, luctus ac laoreet nec, semper eget erat. Quisque eu efficitur nunc. Nullam scelerisque laoreet pharetra. Nunc consectetur congue lacus, et gravida felis. Mauris eu justo pharetra, aliquet velit et, auctor sem. Nulla ut tortor lectus.<\\/p>\\r\\n\\r\\n<p>Donec efficitur molestie elementum. Quisque nec nisl in erat tincidunt consequat. Vivamus non risus a augue viverra pharetra. Suspendisse viverra semper velit nec rhoncus. Aliquam feugiat nec lectus ac tempor. Vivamus nunc neque, vulputate sit amet facilisis tempor, placerat sit amet enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam sollicitudin odio lorem, vitae rhoncus felis imperdiet non. Pellentesque consectetur, ante at iaculis dictum, mi felis hendrerit massa, ut efficitur mauris turpis vitae dolor. Etiam facilisis commodo lacus, in venenatis ex molestie nec. Curabitur pellentesque sem id velit vehicula tristique. Phasellus molestie luctus elit vitae iaculis.<\\/p>"}',
                'created_at' => NULL,
                'updated_at' => '2022-12-12 12:40:55',
            ),
            125 => 
            array (
                'id' => 129,
                'key' => 'refund_active_status',
                'value' => '1',
                'created_at' => '2022-11-21 18:48:18',
                'updated_at' => '2022-11-21 18:48:18',
            ),
            126 => 
            array (
                'id' => 130,
                'key' => 'prescription_order_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            127 => 
            array (
                'id' => 131,
                'key' => 'system_language',
                'value' => '[{"id":1,"direction":"ltr","code":"en","status":1,"default":true},{"id":2,"direction":"rtl","code":"ar","status":1,"default":false}]',
                'created_at' => '2023-02-13 11:31:51',
                'updated_at' => '2023-02-13 11:48:11',
            ),
            128 => 
            array (
                'id' => 132,
                'key' => 'site_direction',
                'value' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            129 => 
            array (
                'id' => 133,
                'key' => 'apple_login',
                'value' => '[{"login_medium":"apple","client_id":"com.sixamtech.sixamMartApp","client_id_app":"com.sixamtech.6amMart","client_secret":null,"status":"1","team_id":"7WSYLQ8Y87","key_id":"FCAQNUX57U","service_file":"2024-11-19-673ca40fa1a89.p8","redirect_url_flutter":"https:\\/\\/6ammart-test-web.6amdev.xyz\\/?from-splash=false","redirect_url_react":"https:\\/\\/6ammart-test-react.6amdev.xyz"}]',
                'created_at' => '2023-03-15 14:08:49',
                'updated_at' => '2024-11-19 14:43:27',
            ),
            130 => 
            array (
                'id' => 134,
                'key' => 'hero_section',
                'value' => '{"hero_section_heading":"Your e-Commerce !","hero_section_slogan":"Venture Starts Here","hero_section_short_description":"Enjoy All Services on One Platform"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            131 => 
            array (
                'id' => 135,
                'key' => 'delivery_service_section',
                'value' => '{"delivery_service_section_image":"2023-05-03-6451daccadb0f.png","delivery_service_section_title":"is Best Delivery Service Near You test","delivery_service_section_description":"6amMart is a one-stop shop for all your daily necessities. You can shop for groceries, and pharmacy items, order food, and send important parcels from one place to another from the comfort of your home."}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            132 => 
            array (
                'id' => 136,
                'key' => 'app_section_image',
                'value' => '2023-05-03-6451dae9a6f63.png',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            133 => 
            array (
                'id' => 137,
                'key' => 'app_download_button',
                'value' => '[{"button_text":"Download the Seller App","link":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=com.sixamtech.sixam_mart_store_app"},{"button_text":"Download the Deliveryman App","link":"https:\\/\\/play.google.com\\/store\\/apps\\/details?id=com.sixamtech.sixam_mart_delivery_app"}]',
                'created_at' => NULL,
                'updated_at' => '2023-05-03 10:03:04',
            ),
            134 => 
            array (
                'id' => 138,
                'key' => 'home_delivery_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            135 => 
            array (
                'id' => 139,
                'key' => 'takeaway_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            136 => 
            array (
                'id' => 140,
                'key' => 'schedule_order_slot_duration_time_format',
                'value' => 'min',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            137 => 
            array (
                'id' => 141,
                'key' => 'forget_password_mail_status_admin',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            138 => 
            array (
                'id' => 142,
                'key' => 'store_registration_mail_status_admin',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            139 => 
            array (
                'id' => 143,
                'key' => 'dm_registration_mail_status_admin',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            140 => 
            array (
                'id' => 144,
                'key' => 'withdraw_request_mail_status_admin',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            141 => 
            array (
                'id' => 145,
                'key' => 'campaign_request_mail_status_admin',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            142 => 
            array (
                'id' => 146,
                'key' => 'refund_request_mail_status_admin',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            143 => 
            array (
                'id' => 147,
                'key' => 'login_mail_status_admin',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            144 => 
            array (
                'id' => 148,
                'key' => 'registration_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            145 => 
            array (
                'id' => 149,
                'key' => 'approve_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            146 => 
            array (
                'id' => 150,
                'key' => 'deny_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            147 => 
            array (
                'id' => 151,
                'key' => 'withdraw_approve_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            148 => 
            array (
                'id' => 152,
                'key' => 'withdraw_deny_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            149 => 
            array (
                'id' => 153,
                'key' => 'campaign_request_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            150 => 
            array (
                'id' => 154,
                'key' => 'campaign_approve_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            151 => 
            array (
                'id' => 155,
                'key' => 'campaign_deny_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            152 => 
            array (
                'id' => 156,
                'key' => 'forget_password_mail_status_dm',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            153 => 
            array (
                'id' => 157,
                'key' => 'cash_collect_mail_status_dm',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            154 => 
            array (
                'id' => 158,
                'key' => 'suspend_mail_status_dm',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            155 => 
            array (
                'id' => 159,
                'key' => 'deny_mail_status_dm',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            156 => 
            array (
                'id' => 160,
                'key' => 'approve_mail_status_dm',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            157 => 
            array (
                'id' => 161,
                'key' => 'registration_mail_status_dm',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            158 => 
            array (
                'id' => 162,
                'key' => 'registration_otp_mail_status_user',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            159 => 
            array (
                'id' => 163,
                'key' => 'login_otp_mail_status_user',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            160 => 
            array (
                'id' => 164,
                'key' => 'add_fund_mail_status_user',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            161 => 
            array (
                'id' => 165,
                'key' => 'refund_request_deny_mail_status_user',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            162 => 
            array (
                'id' => 166,
                'key' => 'forget_password_mail_status_user',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            163 => 
            array (
                'id' => 167,
                'key' => 'refund_order_mail_status_user',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            164 => 
            array (
                'id' => 168,
                'key' => 'place_order_mail_status_user',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            165 => 
            array (
                'id' => 169,
                'key' => 'order_verification_mail_status_user',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            166 => 
            array (
                'id' => 170,
                'key' => 'cookies_text',
                'value' => 'We use cookies and similar technologies on our website to enhance your browsing experience and provide you with personalized content. By clicking \'Acc',
                'created_at' => NULL,
                'updated_at' => '2025-09-12 02:00:08',
            ),
            167 => 
            array (
                'id' => 171,
                'key' => 'tax_included',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            168 => 
            array (
                'id' => 172,
                'key' => 'partial_payment_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            169 => 
            array (
                'id' => 173,
                'key' => 'partial_payment_method',
                'value' => 'both',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            170 => 
            array (
                'id' => 174,
                'key' => 'order_notification_type',
                'value' => 'firebase',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            171 => 
            array (
                'id' => 175,
                'key' => 'additional_charge_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            172 => 
            array (
                'id' => 176,
                'key' => 'additional_charge_name',
                'value' => 'TEST  Charge',
                'created_at' => NULL,
                'updated_at' => '2025-10-12 15:52:46',
            ),
            173 => 
            array (
                'id' => 177,
                'key' => 'additional_charge',
                'value' => '10',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            174 => 
            array (
                'id' => 178,
                'key' => 'landing_page',
                'value' => '1',
                'created_at' => '2023-08-17 01:16:40',
                'updated_at' => '2023-08-17 01:16:40',
            ),
            175 => 
            array (
                'id' => 179,
                'key' => 'landing_integration_type',
                'value' => 'none',
                'created_at' => '2023-08-17 01:16:40',
                'updated_at' => '2023-08-17 01:16:40',
            ),
            176 => 
            array (
                'id' => 180,
                'key' => 'dm_picture_upload_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            177 => 
            array (
                'id' => 181,
                'key' => 'add_fund_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            178 => 
            array (
                'id' => 182,
                'key' => 'guest_checkout_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            179 => 
            array (
                'id' => 183,
                'key' => 'product_approval',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            180 => 
            array (
                'id' => 184,
                'key' => 'product_approval_datas',
                'value' => '{"Update_product_price":"1","Add_new_product":"1","Update_product_variation":"1","Update_anything_in_product_details":"1"}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            181 => 
            array (
                'id' => 185,
                'key' => 'access_all_products',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            182 => 
            array (
                'id' => 186,
                'key' => 'product_gallery',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            183 => 
            array (
                'id' => 187,
                'key' => 'offline_payment_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => '2023-10-19 13:37:10',
            ),
            184 => 
            array (
                'id' => 188,
                'key' => 'disbursement_type',
                'value' => 'manual',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            185 => 
            array (
                'id' => 189,
                'key' => 'store_disbursement_time_period',
                'value' => 'daily',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            186 => 
            array (
                'id' => 190,
                'key' => 'store_disbursement_week_start',
                'value' => 'saturday',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            187 => 
            array (
                'id' => 191,
                'key' => 'store_disbursement_waiting_time',
                'value' => '3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            188 => 
            array (
                'id' => 192,
                'key' => 'store_disbursement_create_time',
                'value' => '18:43',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            189 => 
            array (
                'id' => 193,
                'key' => 'store_disbursement_min_amount',
                'value' => '100',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            190 => 
            array (
                'id' => 194,
                'key' => 'dm_disbursement_time_period',
                'value' => 'daily',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            191 => 
            array (
                'id' => 195,
                'key' => 'dm_disbursement_week_start',
                'value' => 'saturday',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            192 => 
            array (
                'id' => 196,
                'key' => 'dm_disbursement_waiting_time',
                'value' => '3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            193 => 
            array (
                'id' => 197,
                'key' => 'dm_disbursement_create_time',
                'value' => '18:44',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            194 => 
            array (
                'id' => 198,
                'key' => 'dm_disbursement_min_amount',
                'value' => '100',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            195 => 
            array (
                'id' => 199,
                'key' => 'system_php_path',
                'value' => '/usr/bin/php',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            196 => 
            array (
                'id' => 200,
                'key' => 'store_disbursement_command',
                'value' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            197 => 
            array (
                'id' => 201,
                'key' => 'dm_disbursement_command',
                'value' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            198 => 
            array (
                'id' => 202,
                'key' => 'cash_in_hand_overflow_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            199 => 
            array (
                'id' => 203,
                'key' => 'cash_in_hand_overflow_store_amount',
                'value' => '10000',
                'created_at' => NULL,
                'updated_at' => '2025-09-23 14:36:02',
            ),
            200 => 
            array (
                'id' => 204,
                'key' => 'min_amount_to_pay_store',
                'value' => '50',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            201 => 
            array (
                'id' => 205,
                'key' => 'min_amount_to_pay_dm',
                'value' => '50',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            202 => 
            array (
                'id' => 206,
                'key' => 'cash_in_hand_overflow_delivery_man',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            203 => 
            array (
                'id' => 207,
                'key' => 'dm_max_cash_in_hand',
                'value' => '22221.998',
                'created_at' => NULL,
                'updated_at' => '2025-10-10 09:48:45',
            ),
            204 => 
            array (
                'id' => 208,
                'key' => 'unsuspend_mail_status_user',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            205 => 
            array (
                'id' => 209,
                'key' => 'suspend_mail_status_user',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            206 => 
            array (
                'id' => 210,
                'key' => 'unsuspend_mail_status_dm',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            207 => 
            array (
                'id' => 211,
                'key' => 'suspend_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            208 => 
            array (
                'id' => 212,
                'key' => 'unsuspend_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            209 => 
            array (
                'id' => 213,
                'key' => 'extra_packaging_data',
                'value' => '{"grocery":"1","food":"1","pharmacy":"1","ecommerce":"1","parcel":0}',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            210 => 
            array (
                'id' => 214,
                'key' => 'new_customer_discount_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            211 => 
            array (
                'id' => 215,
                'key' => 'new_customer_discount_amount',
                'value' => '5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            212 => 
            array (
                'id' => 216,
                'key' => 'new_customer_discount_amount_type',
                'value' => 'percentage',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            213 => 
            array (
                'id' => 217,
                'key' => 'new_customer_discount_amount_validity',
                'value' => '3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            214 => 
            array (
                'id' => 218,
                'key' => 'new_customer_discount_validity_type',
                'value' => 'day',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            215 => 
            array (
                'id' => 219,
                'key' => 'push_notification_service_file_content',
                'value' => '{"type":"service_account","project_id":"ammart-test-85433","private_key_id":"2b7397f12fed04ea4b1d9c068808cd2c0dd7b0c7","private_key":"-----BEGIN PRIVATE KEY-----\\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCxOH2BMSspOdRq\\nsNtsTrdzmuLLqc\\/bnlzdzy7Wf71H+4pegg4CdmBzKhNz3MQowjgIv9z+SmG4w4Ek\\nbu60LcZDp1iHW0xQFhTTyYPvOHASolVN7tiOrytrlvQgvxQmownbCkd5hHLUr3Ng\\ny8P9kk8XCxWnkbTWHOwhCQ6MRFOy00yWbdqqkDdB5YdTj+TzusdhkoS92QajCZqC\\nThK95ssFSRDSM1\\/7v6j7PpuxlCJrhdF9z4jNobRpBbe1Rx60QSNSHhB7\\/dMPc8Mm\\n5PCdUPbU16GDRdrgquDMGz1Wo4GGIpOJiwEyySMqcb2xVWu8eXOx1ah14Bmu\\/mok\\nq4CBqePHAgMBAAECggEABE2HwEfojLlXFZ4SYl0I6fS4sa5\\/dUQe\\/q2zdjbLoVvc\\novuCZW1WggVRJypeHlLwTqM4NXnPAAbumEaBh+pCmrroy5JAsbn0GICXaPiUVAd+\\n1t9aXEUXPickoGvFjI0tRbm2GGjcWS01FU2kGICGHzebnA+7iBMKaYTs2Lbdaan\\/\\nNgyFSrMNe8+zGB21RFxxV7F5sQUED61pP5hWLIG5CNG51tDEm6Llc4PYfA8JdEYS\\nkU66EtMZRVu9LrbteEEi9YabiGQcbXkfIej8i94P\\/mkzpJFQ6QUjttmfw+0vsVnN\\nv964Xev2hxoKtnOb5q3Ws5ZAfQgMDD2XW7B+ACoc8QKBgQDc8cEJEPFKMshIiPSD\\nUGrsZNc0lGJZ5uPBAbX9KVGe3LLssd+F1AEFBk7OhY74oxuae0BXVeKiHwYc3flI\\nhjy9EhihvsYGbyLEw2UHeDOzS9QQrmIzjU7z+K150TvWVOWpJZRtA4OoFCWWWDQP\\nbePA53MQXj7VUGeBjWrkp2D0NwKBgQDNVsgdNt\\/5Uc4vr8J+sHKYsWAoIDPQjtFR\\nO6oyqBPlYtSSqHPA\\/g1eCGD7pe6OmGX9DcYYuroC38eB5mu+J+XjnwAr5G1qBo+1\\nsuBg+wx8PUltLPHw+qiJb6NalR8xzMFdLQPQSUgNNG3O5dcOXrzqbBeKlwhM1qql\\nmF4\\/7bXk8QKBgH9njJeMxIazt9hT2SNrmOyNzacNNZV\\/1a9zLB062U0RGL\\/yZeFG\\n+fuKwqDGVUY8z+sJzXVPGivAVgcJXPkcJyQjrj5+wrPtHBB4V+axwqZOQJAJ7qip\\ngHCg4m\\/PXoDeXbxm5irijuW6EF6cqBCJnn6bODelEPhyr+z9vjjx56+LAoGAKlES\\nGIMwkS78sPMlv\\/oZA8K6MErCot5r4LPNFXdx8jn12OuCP2mb058ibXn6ucRKcGYg\\nRwRkRSdc9DZKSfvq8ofX\\/zOqIMmNYEKm3xWdsxTmRuuWSLU\\/emNZZNeKgDbUOqGG\\nQax4ftApORRAx6Nah20TROpvOXab4FiQQ9h3PeECgYAcFElOD2tscb+YTFFwgRj4\\naSVyl0uBYD1cDv5BfOjZ9t6AWBz4sRGPtV\\/YidshTBtwDt4xc7tTzKpdN7dcpchW\\ntIql8kX+jGTOwLeUOPwdrkcbQBsitJ+otLKEcZIu29Q\\/Abi6zNAirI9weol5N4nq\\ni2jN3Ryg7jAzNVmqBgDqpQ==\\n-----END PRIVATE KEY-----\\n","client_email":"firebase-adminsdk-6h6bu@ammart-test-85433.iam.gserviceaccount.com","client_id":"112422520829507042832","auth_uri":"https:\\/\\/accounts.google.com\\/o\\/oauth2\\/auth","token_uri":"https:\\/\\/oauth2.googleapis.com\\/token","auth_provider_x509_cert_url":"https:\\/\\/www.googleapis.com\\/oauth2\\/v1\\/certs","client_x509_cert_url":"https:\\/\\/www.googleapis.com\\/robot\\/v1\\/metadata\\/x509\\/firebase-adminsdk-6h6bu%40ammart-test-85433.iam.gserviceaccount.com","universe_domain":"googleapis.com"}',
                'created_at' => NULL,
                'updated_at' => '2025-09-17 10:36:50',
            ),
            216 => 
            array (
                'id' => 220,
                'key' => 'check_daily_subscription_validity_check',
                'value' => '2025-10-14',
                'created_at' => '2024-06-06 12:40:32',
                'updated_at' => '2025-10-14 09:16:10',
            ),
            217 => 
            array (
                'id' => 221,
                'key' => 'commission_business_model',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            218 => 
            array (
                'id' => 222,
                'key' => 'subscription_business_model',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            219 => 
            array (
                'id' => 223,
                'key' => 'subscription_free_trial_days',
                'value' => '7',
                'created_at' => '2024-06-06 12:42:24',
                'updated_at' => '2024-06-06 12:42:24',
            ),
            220 => 
            array (
                'id' => 224,
                'key' => 'subscription_free_trial_type',
                'value' => 'day',
                'created_at' => '2024-06-06 12:42:24',
                'updated_at' => '2024-06-06 12:42:24',
            ),
            221 => 
            array (
                'id' => 225,
                'key' => 'subscription_free_trial_status',
                'value' => '1',
                'created_at' => '2024-06-06 12:42:36',
                'updated_at' => '2024-06-06 12:42:36',
            ),
            222 => 
            array (
                'id' => 226,
                'key' => 'subscription_deadline_warning_days',
                'value' => '7',
                'created_at' => '2024-06-06 12:43:09',
                'updated_at' => '2024-06-06 12:43:09',
            ),
            223 => 
            array (
                'id' => 227,
                'key' => 'subscription_deadline_warning_message',
                'value' => 'Your subscription ending soon. Please renew to continue access.',
                'created_at' => '2024-06-06 12:43:09',
                'updated_at' => '2024-06-06 12:43:09',
            ),
            224 => 
            array (
                'id' => 228,
                'key' => 'subscription_usage_max_time',
                'value' => '80',
                'created_at' => '2024-06-06 12:43:15',
                'updated_at' => '2024-06-06 12:43:15',
            ),
            225 => 
            array (
                'id' => 229,
                'key' => 'store_review_reply',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            226 => 
            array (
                'id' => 230,
                'key' => 'subscription_renew_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            227 => 
            array (
                'id' => 231,
                'key' => 'subscription_plan_upadte_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            228 => 
            array (
                'id' => 232,
                'key' => 'subscription_cancel_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            229 => 
            array (
                'id' => 233,
                'key' => 'subscription_shift_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            230 => 
            array (
                'id' => 234,
                'key' => 'subscription_successful_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            231 => 
            array (
                'id' => 235,
                'key' => 'new_advertisement_mail_status_admin',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            232 => 
            array (
                'id' => 236,
                'key' => 'update_advertisement_mail_status_admin',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            233 => 
            array (
                'id' => 237,
                'key' => 'advertisement_create_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            234 => 
            array (
                'id' => 238,
                'key' => 'advertisement_approved_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            235 => 
            array (
                'id' => 239,
                'key' => 'advertisement_deny_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            236 => 
            array (
                'id' => 240,
                'key' => 'advertisement_resume_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            237 => 
            array (
                'id' => 241,
                'key' => 'advertisement_pause_mail_status_store',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            238 => 
            array (
                'id' => 242,
                'key' => 'country_picker_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            239 => 
            array (
                'id' => 243,
                'key' => 'category_list_default_status',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            240 => 
            array (
                'id' => 244,
                'key' => 'popular_store_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            241 => 
            array (
                'id' => 245,
                'key' => 'recommended_store_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            242 => 
            array (
                'id' => 246,
                'key' => 'special_offer_default_status',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            243 => 
            array (
                'id' => 247,
                'key' => 'popular_item_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            244 => 
            array (
                'id' => 248,
                'key' => 'best_reviewed_item_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            245 => 
            array (
                'id' => 249,
                'key' => 'item_campaign_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            246 => 
            array (
                'id' => 250,
                'key' => 'latest_items_default_status',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            247 => 
            array (
                'id' => 251,
                'key' => 'all_stores_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            248 => 
            array (
                'id' => 252,
                'key' => 'category_sub_category_item_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            249 => 
            array (
                'id' => 253,
                'key' => 'product_search_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            250 => 
            array (
                'id' => 254,
                'key' => 'basic_medicine_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            251 => 
            array (
                'id' => 255,
                'key' => 'common_condition_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            252 => 
            array (
                'id' => 256,
                'key' => 'brand_default_status',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            253 => 
            array (
                'id' => 257,
                'key' => 'brand_item_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            254 => 
            array (
                'id' => 258,
                'key' => 'latest_stores_default_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            255 => 
            array (
                'id' => 259,
                'key' => 'firebase_otp_verification',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            256 => 
            array (
                'id' => 260,
                'key' => 'firebase_web_api_key',
                'value' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            257 => 
            array (
                'id' => 261,
                'key' => 'manual_login_status',
                'value' => '1',
                'created_at' => '2024-11-19 14:03:45',
                'updated_at' => '2024-11-19 14:03:45',
            ),
            258 => 
            array (
                'id' => 262,
                'key' => 'otp_login_status',
                'value' => '1',
                'created_at' => '2024-11-19 14:03:45',
                'updated_at' => '2024-11-19 14:03:45',
            ),
            259 => 
            array (
                'id' => 263,
                'key' => 'social_login_status',
                'value' => '1',
                'created_at' => '2024-11-19 14:03:45',
                'updated_at' => '2024-11-19 14:03:45',
            ),
            260 => 
            array (
                'id' => 264,
                'key' => 'google_login_status',
                'value' => '1',
                'created_at' => '2024-11-19 14:03:46',
                'updated_at' => '2024-11-19 14:03:46',
            ),
            261 => 
            array (
                'id' => 265,
                'key' => 'facebook_login_status',
                'value' => '0',
                'created_at' => '2024-11-19 14:03:46',
                'updated_at' => '2024-11-19 14:12:36',
            ),
            262 => 
            array (
                'id' => 266,
                'key' => 'apple_login_status',
                'value' => '1',
                'created_at' => '2024-11-19 14:03:46',
                'updated_at' => '2024-11-19 14:03:46',
            ),
            263 => 
            array (
                'id' => 267,
                'key' => 'email_verification_status',
                'value' => '0',
                'created_at' => '2024-11-19 14:03:46',
                'updated_at' => '2025-02-05 15:04:40',
            ),
            264 => 
            array (
                'id' => 268,
                'key' => 'phone_verification_status',
                'value' => '0',
                'created_at' => '2024-11-19 14:03:46',
                'updated_at' => '2025-02-05 15:04:40',
            ),
            265 => 
            array (
                'id' => 269,
                'key' => 'rental_provider_registration_mail_status_admin',
                'value' => '1',
                'created_at' => '2025-02-05 17:21:10',
                'updated_at' => '2025-02-05 17:21:10',
            ),
            266 => 
            array (
                'id' => 270,
                'key' => 'rental_withdraw_request_mail_status_admin',
                'value' => '1',
                'created_at' => '2025-02-05 17:32:04',
                'updated_at' => '2025-02-05 17:32:04',
            ),
            267 => 
            array (
                'id' => 271,
                'key' => 'rental_registration_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-05 17:34:43',
                'updated_at' => '2025-02-05 17:34:43',
            ),
            268 => 
            array (
                'id' => 272,
                'key' => 'rental_approve_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-05 17:35:58',
                'updated_at' => '2025-02-05 17:35:58',
            ),
            269 => 
            array (
                'id' => 273,
                'key' => 'rental_deny_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-05 17:38:15',
                'updated_at' => '2025-02-05 17:38:15',
            ),
            270 => 
            array (
                'id' => 274,
                'key' => 'rental_suspend_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-05 17:39:12',
                'updated_at' => '2025-02-05 17:39:12',
            ),
            271 => 
            array (
                'id' => 275,
                'key' => 'rental_unsuspend_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-05 17:39:57',
                'updated_at' => '2025-02-05 17:39:57',
            ),
            272 => 
            array (
                'id' => 276,
                'key' => 'rental_withdraw_deny_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-05 17:42:58',
                'updated_at' => '2025-02-05 17:42:58',
            ),
            273 => 
            array (
                'id' => 277,
                'key' => 'rental_subscription_successful_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-05 17:46:15',
                'updated_at' => '2025-02-05 17:46:15',
            ),
            274 => 
            array (
                'id' => 278,
                'key' => 'rental_subscription_renew_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-05 17:55:11',
                'updated_at' => '2025-02-05 17:55:11',
            ),
            275 => 
            array (
                'id' => 279,
                'key' => 'rental_subscription_shift_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-05 17:56:58',
                'updated_at' => '2025-02-05 17:56:58',
            ),
            276 => 
            array (
                'id' => 280,
                'key' => 'rental_subscription_cancel_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-05 17:58:12',
                'updated_at' => '2025-02-05 17:58:12',
            ),
            277 => 
            array (
                'id' => 281,
                'key' => 'rental_subscription_plan_upadte_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-05 17:59:14',
                'updated_at' => '2025-02-05 17:59:14',
            ),
            278 => 
            array (
                'id' => 282,
                'key' => 'rental_place_order_mail_status_user',
                'value' => '1',
                'created_at' => '2025-02-05 18:01:37',
                'updated_at' => '2025-02-05 18:01:37',
            ),
            279 => 
            array (
                'id' => 283,
                'key' => 'rental_withdraw_approve_mail_status_provider',
                'value' => '1',
                'created_at' => '2025-02-08 09:46:25',
                'updated_at' => '2025-02-08 09:46:25',
            ),
            280 => 
            array (
                'id' => 284,
                'key' => 'admin_free_delivery_status',
                'value' => '1',
                'created_at' => '2025-04-20 18:21:14',
                'updated_at' => '2025-04-20 18:21:14',
            ),
            281 => 
            array (
                'id' => 285,
                'key' => 'admin_free_delivery_option',
                'value' => 'free_delivery_by_order_amount',
                'created_at' => '2025-04-20 18:21:14',
                'updated_at' => '2025-04-20 18:21:14',
            ),
            282 => 
            array (
                'id' => 286,
                'key' => 'dm_loyalty_point_status',
                'value' => NULL,
                'created_at' => '2025-09-16 10:28:47',
                'updated_at' => '2025-10-09 11:11:48',
            ),
            283 => 
            array (
                'id' => 287,
                'key' => 'dm_loyalty_point_exchange_rate',
                'value' => '10',
                'created_at' => '2025-09-16 10:28:47',
                'updated_at' => '2025-09-16 13:09:51',
            ),
            284 => 
            array (
                'id' => 288,
                'key' => '3rd_party_storage',
                'value' => '0',
                'created_at' => '2025-09-24 17:41:32',
                'updated_at' => '2025-10-11 13:59:16',
            ),
            285 => 
            array (
                'id' => 289,
                'key' => 'local_storage',
                'value' => '1',
                'created_at' => '2025-09-24 17:41:32',
                'updated_at' => '2025-10-11 13:59:16',
            ),
            286 => 
            array (
                'id' => 290,
                'key' => 'websocket_status',
                'value' => '1',
                'created_at' => '2025-10-09 14:16:19',
                'updated_at' => '2025-10-12 15:00:38',
            ),
            287 => 
            array (
                'id' => 291,
                'key' => 'websocket_url',
                'value' => '6ammart-derragh-wss.6amdev.xyz',
                'created_at' => '2025-10-09 14:16:19',
                'updated_at' => '2025-10-09 14:16:19',
            ),
            288 => 
            array (
                'id' => 292,
                'key' => 'websocket_port',
                'value' => '443',
                'created_at' => '2025-10-09 14:16:19',
                'updated_at' => '2025-10-09 14:16:19',
            ),
        ));
        
        
    }
}