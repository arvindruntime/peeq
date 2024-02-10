<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Calculate the plan end date by adding 1 year to the start date
        $planEndDate = $this->created_at ? $this->created_at->copy()->addYear() : null;
        return
            [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'course_id' => $this->course_id,
                'type' => $this->type,
                'device_type' => $this->device_type,
                'course_price_type' => $this->course_price_type,
                'transaction_id' => $this->transaction_id,
                'payment_token' => $this->payment_token,
                'final_amount' => $this->final_amount,
                'payment_status' => $this->payment_status,
            ];
    }
}
