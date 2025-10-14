<?php

namespace Modules\RideShare\Http\Resources\TransactionManagement;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\RideShare\Http\Resources\UserManagement\DriverResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'attribute' => $this->attribute,
            'attribute_id' => $this->attribute_id,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'balance' => $this->balance,
            'wallet_balance' => $this->wallet_balance,
            'pending_balance' => $this->pending_balance,
            'user_id' => $this->user_id,
            'user' => DriverResource::make($this->user),
            'account' => translate($this->account),
            'trx_ref_id' => $this->trx_ref_id,
            'created_at' => $this->created_at,
        ];
    }
}
