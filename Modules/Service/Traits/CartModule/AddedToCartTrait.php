<?php

namespace Modules\Service\Traits\CartModule;

use Modules\Service\Entities\CartModule\AddedToCart;

trait AddedToCartTrait
{
    /**
     * @param $user_id
     * @param $service_id
     * @param $is_guest
     * @return void
     */
    protected function addedToCartUpdate($user_id, $service_id, $is_guest, $module_id): void
    {
        $addedToCart = AddedToCart::where(['user_id' => $user_id, 'module_id' => $module_id, 'service_id' => $service_id])->first();

        if (!isset($addedToCart)) {
            $addedToCart = new AddedToCart();
            $addedToCart->module_id = $module_id;
            $addedToCart->user_id = $user_id;
            $addedToCart->service_id = $service_id;
            $addedToCart->count = 1;
            $addedToCart->is_guest = $is_guest;
            $addedToCart->save();
        } else {
            $addedToCart->increment('count');
        }
    }
}
