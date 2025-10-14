<?php

use App\CentralLogics\Helpers;
use App\Models\User;

if (!function_exists('add_fund_success')) {
    /**
     * @param $data
     * @return void
     */
    function add_fund_success($data): void
    {
        $customer_user_id = $data['payer_id'];
        $amount = $data['payment_amount'];
        addFundTransactions($customer_user_id, $amount);

        //send notification
        $user = User::find($customer_user_id);
        $title =  Helpers::format_currency($amount) . ' ' . get_push_notification_message('user_add_fund_wallet', $user?->current_language_key);
        $permission = isNotificationActive(null, 'wallet', 'notification', 'user');
        $data_info = [
            'user_name' => $user?->f_name . ' '. $user->l_name
        ];
        if ($user->cm_firebase_token && $title && $permission) {
            device_notification($user->cm_firebase_token, $title, null, null, null, NOTIFICATION_TYPE['wallet'], null, $customer_user_id, $data_info);
        }
    }
}

if (!function_exists('add_fund_fail')) {
    /**
     * @param $data
     * @return void
     */
    function add_fund_fail($data): void
    {
        //
    }
}
