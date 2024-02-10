<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'session_id' => $this->session_id,
                'type' => $this->type,
                'device_type' => $this->device_type,
                'session_price_type' => $this->session_price_type,
                'transaction_id' => $this->transaction_id,
                'session_duration' => (int)$this->session_duration,
                'session_price' => (int)$this->session_price,
                'calendly_description' => $this->calendly_description,
                'payment_token' => $this->payment_token,
                'final_amount' => (int)$this->final_amount,
                'payment_status' => $this->payment_status,
            ];
    }
}
