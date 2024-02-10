<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $currencyCode = $this->currency ? $this->currency->code : 'AUD';
        return
            [
                'id' => $this->id,
                'plan_title' => $this->plan_title,
                'plan_description' => $this->plan_description,
                'plan_type' => $this->plan_type,
                'price_type' => $this->price_type,
                'plan_amount' => $this->plan_amount,
                'plan_duration' => $this->plan_duration,
                'plan_image' => $this->plan_image,
                'currency' => $currencyCode,
                'stripe_subscription_plan_id' => $this->stripe_subscription_plan_id,
                'google_pay_id' => $this->google_pay_id,
                'apple_pay_id' => $this->apple_pay_id,
                'status' => $this->status,
            ];
    }
}
