<?php

namespace App\Services;

use App\Models\Plan;

class PlanService
{
    public static function createUpdate($plan, $request)
    {
        if (isset($request->plan_title)) {
            $plan->plan_title = $request->plan_title;
        }
        if (isset($request->plan_description)) {
            $plan->plan_description = $request->plan_description;
        }
        if (isset($request->plan_type)) {
            $plan->plan_type = $request->plan_type;
        }
        if (isset($request->price_type)) {
            $plan->price_type = $request->price_type;
        }
        if (isset($request->plan_amount)) {
            $plan->plan_amount = (int)$request->plan_amount;
        }
        if (isset($request->plan_duration)) {
            $plan->plan_duration = (int)$request->plan_duration;
        }
        if (isset($request->plan_image)) {

            $imageName = md5(time()) . '.' . $request->plan_image->extension();
            $request->plan_image->storeAs('public/planImage', $imageName);
            $input['image'] = $imageName;
            $plan->plan_image = asset('/storage/planImage/'.$input['image']);
            $plan->plan_image = $plan->plan_image;
        }
        if (isset($request->currency_id)) {
            $plan->currency_id = (int)$request->currency_id;
        }
        if (isset($request->stripe_subscription_plan_id)) {
            $plan->stripe_subscription_plan_id = $request->stripe_subscription_plan_id;
        }
        if (isset($request->google_pay_id)) {
            $plan->google_pay_id = $request->google_pay_id;
        }
        if (isset($request->apple_pay_id)) {
            $plan->apple_pay_id = $request->apple_pay_id;
        }
        if (isset($request->status)) {
            $plan->status = $request->status;
        }    
        $plan->save();
        return $plan;
    }
}
