<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionCoachTransaction extends Model
{
    use HasFactory;
    protected $table = 'session_coach_transactions';

    protected $fillable = [
        'session_id',
        'coach_id'
    ];

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function coaches()
    {
        return $this->belongsTo(User::class);
    }
}
