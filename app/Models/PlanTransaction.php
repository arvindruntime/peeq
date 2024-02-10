<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanTransaction extends Model
{
    use HasFactory;

    protected $table = 'plan_transactions';
    protected $fillables = [
        'user_id',
        'plan_id',
        'course_id',
        'session_id',
        'type',
        'plan_active_till',
        'promo_code',
        'promo_code_dis',
        'device_type',
        'course_price_type',
        'session_price_type',
        'transaction_id',
        'session_duration',
        'session_price',
        'calendly_description',
        'payment_token',
        'final_amount',
        'payment_status'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function sessionPrice()
    {
        return $this->belongsTo(SessionPriceTransaction::class, 'session_price_transaction_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
