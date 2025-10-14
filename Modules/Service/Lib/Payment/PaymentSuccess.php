<?php

use Modules\Service\Lib\Payment\PaymentResponse;

if (!function_exists('digital_payment_success')) {
    /**
     * @param $data
     * @return void
     */
    function digital_payment_success($data): void
    {
        PaymentResponse::success($data);
    }
}

if (!function_exists('digital_payment_fail')) {
    /**
     * @param $data
     * @return void
     */
    function digital_payment_fail($data): void
    {
        //
    }
}
if (!function_exists('repeat_booking_payment_success')) {
    /**
     * @param $data
     * @return void
     */
    function repeat_booking_payment_success($data): void
    {
        PaymentResponse::repeatBookingPaymentSuccess($data);
    }
}

if (!function_exists('switch_offline_to_digital_payment_success')) {
    /**
     * @param $data
     * @return void
     */
    function switch_offline_to_digital_payment_success($data): void
    {
        PaymentResponse::switchOfflineToDigitalPaymentSuccess($data);
    }
}

if (!function_exists('switch_offline_to_digital_payment_fail')) {
    /**
     * @param $data
     * @return void
     */
    function switch_offline_to_digital_payment_fail($data): void
    {
        //
    }
}

if (!function_exists('subscription_success')) {
    /**
     * @param $data
     * @return void
     */
    function subscription_success($data): void
    {
        $additional_data = json_decode($data['additional_data'], true);
        $packageStatus = collect([
            'package_status' => $additional_data['package_status'] ?? null,
        ]);

        if ($packageStatus['package_status'] == 'subscription_purchase'){
            PaymentResponse::purchaseSubscriptionSuccess($data);
        }elseif ($packageStatus['package_status'] == 'subscription_renew'){
            PaymentResponse::renewSubscriptionSuccess($data);
        }elseif ($packageStatus['package_status'] == 'subscription_shift'){
            PaymentResponse::shiftSubscriptionSuccess($data);
        }elseif ($packageStatus['package_status'] == 'business_plan_change'){
            PaymentResponse::businessPlanChangeSuccess($data);
        }
    }
}

if (!function_exists('subscription_fail')) {
    /**
     * @param $data
     * @return void
     */
    function subscription_fail($data): void
    {
        $additional_data = json_decode($data['additional_data'], true);
        $packageStatus = collect([
            'package_status' => $additional_data['package_status'] ?? null,
        ]);

        if ($packageStatus['package_status'] == 'subscription_purchase') {
            PaymentResponse::purchaseSubscriptionFailed($data);
        }
    }
}

