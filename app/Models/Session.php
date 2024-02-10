<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use HasFactory;
    protected $table = 'sessions';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'thumbnail_img',
        'thumbnail_video',
        'session_name',
        'short_description',
        'description',
        'status',
    ];

    public function coaches()
    {
        return $this->belongsTo(User::class);
    }

    public function sessionTransactions()
    {
        return $this->hasMany(PlanTransaction::class, 'session_id');
    }

    public function transactions()
    {
        return $this->hasMany(PlanTransaction::class, 'session_id');
    }

}
