<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostActivity extends Model
{
    use HasFactory;
    protected $table = 'post_activities';
    protected $fillable = [
        'post_id',
        'user_id',
        'is_like',
        'is_save',
        'is_mute',
        'is_report',
        'is_block_member',
        'is_report_member',
        'is_hide_post',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'first_name', 'last_name', 'profile_image', 'cover_image', 'location_id', 'step_verification', 'user_type');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
