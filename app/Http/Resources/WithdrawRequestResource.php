<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawRequestResource extends JsonResource
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
            'method' => WithdrawMethodResource::make($this->method),
            'method_fields' => $this->withdrawal_method_fields,
            'amount' => $this->amount,
            'transaction_note' =>  $this->transaction_note,
            'user_note' =>  $this->user_note,
            'status' =>  $this->approved == 1 ? 'Approved' : ($this->approved == 2 ? 'Denied' : 'Pending'),
            'created_at' =>  $this->created_at,
        ];
    }
}
