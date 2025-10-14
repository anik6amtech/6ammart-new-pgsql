<?php

use Modules\Service\Entities\ProviderManagement\Provider;

if (!function_exists('pay_to_admin_success')) {
    /**
     * @param $data
     * @return void
     */
    function pay_to_admin_success($data): void
    {
        $additional = json_decode($data['additional_data']);
        $provider_id = $additional->provider_id;
        $user = Provider::where('id', $provider_id)->with('account')->first();
        $account = $user->account;
        $receivable = $account->receivable_balance;
        $payable = $account->payable_balance;

        $amount = $data['payment_amount'];


        if ($payable > $receivable && $receivable != 0) {
            //adjust
            withdrawRequestAcceptForAdjustTransaction($user?->id, $receivable);
            collectCashTransaction($provider_id, $receivable);
        }

        //pay to admin
        collectCashTransaction($provider_id, $amount);

        //send notification
        $user = Provider::where('id', $provider_id)->first();
        if ($user){
            $user->is_suspended = 0;
            $user->save();

            $title = get_push_notification_message('provider_provider_suspension_remove', $user?->current_language_key);
            if ($user?->fcm_token && $title){
                device_notification($user?->fcm_token, $title, null, null, $user->id, 'suspend');
            }
        }
        $data_info = [
            'provider_name' => $user?->company_name
        ];
        $title =  \App\CentralLogics\Helpers::format_currency($amount) . ' ' . get_push_notification_message('provider_admin_payable', $user?->current_language_key);
        if ($user?->fcm_token && $title) {
            device_notification($user->fcm_token, $title, null, null, null, 'admin_pay', null, $user->id, $data_info);
        }
    }
}

if (!function_exists('pay_to_admin_fail')) {
    /**
     * @param $data
     * @return void
     */
    function pay_to_admin_fail($data): void
    {
        //
    }
}
