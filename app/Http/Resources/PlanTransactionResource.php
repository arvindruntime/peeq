<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanTransactionResource extends JsonResource
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
                'user' => new UserResource($this->user),
                'plan' => new PlanResource($this->plan),
                // 'course' => new CourseResource($this->course),
                // 'type' => $this->type,
                // 'title' => $this->course->course_name,
                // 'currency' => $this->course->currency,
                // 'stripe_subscription_plan_id' => '',
                // 'google_pay_id' => '',
                // 'apple_pay_id' => '',
                // 'status' => '',
                'plan_active_till' => $this->plan_active_till ? date('D, M j, Y', strtotime($this->plan_active_till)) : null,
                'promo_code' => $this->promo_code,
                'promo_code_dis' => $this->promo_code_dis,
                'device_type' => $this->device_type,
                'course_price_type' => $this->course_price_type,
                'session_price_type' => $this->session_price_type,
                'transaction_id' => $this->transaction_id,
                'payment_token' => $this->payment_token,
                'final_amount' => $this->final_amount,
                'plan_start_date' => $this->created_at ? $this->created_at->format('D, M j, Y') : null,
                'plan_end_date' => $planEndDate ? $planEndDate->format('D, M j, Y') : null,
                'payment_status' => $this->payment_status,
            ];
    }
}
