<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;
    protected $table = 'user_activities';
    protected $fillable = [
        'user_id',
        'block_user_id',
        'blocked_by',
        'report_user_id',
        'reported_by',
        'is_block_member',
        'is_report_member',
        'report_for',
        'report_type',
        'report_description',
        'is_follow',
        'followers',
        'following'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followerUser()
    {
        return $this->belongsTo(User::class, 'followers', 'id');
    }

    public function followingUser()
    {
        return $this->belongsTo(User::class, 'following', 'id');
    }
}
