<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionPriceTransaction extends Model
{
    use HasFactory;
    protected $table = 'session_price_transactions';

    protected $fillable = [
        'session_id',
        'session_duration',
        'session_price',
        'currency_id',
        'calendly_description'
    ];

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
