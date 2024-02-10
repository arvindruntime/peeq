<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\PlanTransaction;
use Illuminate\Support\Facades\Auth;

class PlanTransactionService
{
    public static function createUpdate($plantransaction, $request)
    {
        if (isset($request->user_id)) {
            $plantransaction->user_id = $request->user_id;
        } else {
            $plantransaction->user_id = Auth::user()->id;
        }
        if (isset($request->plan_id)) {
            $plan = Plan::find($request->plan_id);
            if ($plan) {
                $plantransaction->plan_id = $plan->id;
                $plantransaction->final_amount = $plan->plan_amount;
                
                if ($request->payment_status == 1) {
                    $user = Auth::user();
                    if($user) {
                        $user->is_plan_activated = 1;
                        $user->save();
                    }
                    if ($plan->plan_type === 'monthly') {
                        $plantransaction->plan_active_till = date('Y-m-d H:i:s', strtotime('+30 days'));
                    } elseif ($plan->plan_type === 'yearly') {
                        $plantransaction->plan_active_till = date('Y-m-d H:i:s', strtotime('+365 days'));
                    }
                }
            }
        }
        if (isset($request->promo_code)) {
            $plantransaction->promo_code = $request->promo_code;
        }
        if (isset($request->promo_code_dis)) {
            $plantransaction->promo_code_dis = $request->promo_code_dis;
        }
        if (isset($request->device_type)) {
            $plantransaction->device_type = $request->device_type;
        }
        if (isset($request->course_price_type)) {
            $plantransaction->course_price_type = $request->course_price_type;
        }
        if (isset($request->session_price_type)) {
            $plantransaction->session_price_type = $request->session_price_type;
        }
        if (isset($request->transaction_id)) {
            $plantransaction->transaction_id = $request->transaction_id;
        }
        if (isset($request->payment_token)) {
            $plantransaction->payment_token = $request->payment_token;
        }
        if (isset($request->final_amount)) {
            $plantransaction->final_amount = $request->final_amount;
        }
        if (isset($request->payment_status)) {
            $plantransaction->payment_status = (int)$request->payment_status;
        }
        $plantransaction->save();
        return $plantransaction;
    }
}
