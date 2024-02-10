<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PushNotification extends Model
{
    use HasFactory;
    protected $table = 'push_notifications';
    protected $fillable = [
        'post_id',
        'sender_id',
        'receiver_id',
        'title',
        'description',
        'status'
    ];

    protected $hidden = [
        'updated_at', 
    ];

    public function toArray()
    {
        $array = parent::toArray();

        // Modify the `created_at` timestamp to hours ago
        $array['created_at'] = Carbon::parse($this->attributes['created_at'])
                                    ->diffForHumans();

        return $array;
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id')->select('id', 'first_name', 'last_name', 'profile_image', 'cover_image', 'location_id', 'step_verification', 'user_type', 'fcm_token');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id')->select('id', 'first_name', 'last_name', 'profile_image', 'cover_image', 'location_id', 'step_verification', 'user_type', 'fcm_token');
    }
}
