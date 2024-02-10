<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostComment extends Model
{
    use HasFactory;
    protected $table = 'post_comments';
    protected $fillable = [
        'parent_id',
        'comment_text',
        'created_at',
        'commented_by',
    ];

    protected $hidden = [
        'updated_at',
        'postcommentable_id',
        'postcommentable_type',
    ];

    public function toArray()
    {
        $array = parent::toArray();

        // Modify the `created_at` timestamp to hours ago
        $array['created_at'] = Carbon::parse($this->attributes['created_at'])
                                    ->diffForHumans();

        return $array;
    }
    
    public function post()
    {
        return $this->belongsTo(Post::class, 'postcommentable_id', 'id')->where('postcommentable_type', Post::class);
    }

    public function replies()
    {
        return $this->hasMany(PostComment::class, 'parent_id');
    }

    public function postcommentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'commented_by')->select('id', 'first_name', 'last_name', 'user_type', 'profile_image', 'cover_image');
    }
}
