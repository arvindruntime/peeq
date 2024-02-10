<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_title',
        'plan_description',
        'plan_type',
        'price_type',
        'plan_amount',
        'plan_duration', 
        'plan_image',
        'currency_id',
        'stripe_subscription_plan_id',
        'google_pay_id',
        'apple_pay_id',
        'status',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

}
