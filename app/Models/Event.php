<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected  $fillable = [
        'user_id',
        'event_title',
        'is_also_post_in_feed',
        'start_date',
        'end_date',
        'meeting_id',
        'meeting_start_url',
        'meeting_join_url',
        'timezone_id',
        'is_repeat_event',
        'is_rsvps',
        'is_restrick_event_link',
        'is_close_rsvps',
        'is_header_image_or_video',
        'upload_header_image_or_video',
        'is_thumbnail_image',
        'upload_thumbnail',
        'is_description',
        'description',
        'is_save_to_draft',
        'schedule_type',
        'schedule_datetime',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'integer',
    ];

    public function eventActivities()
    {
        return $this->hasMany(EventActivity::class, 'event_id');
    }

    protected $hidden = [
        'updated_at'
    ];
    
    public function toArray()
    {
        $array = parent::toArray();

        // Modify the `created_at` timestamp to hours ago
        $array['created_at'] = Carbon::parse($this->attributes['created_at'])
                                    ->diffForHumans();
        $array['start_date'] = Carbon::parse($this->attributes['start_date'])
        ->diffForHumans();

        return $array;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'first_name', 'last_name', 'profile_image', 'cover_image', 'location_id', 'step_verification', 'user_type', 'fcm_token');
    }

    public function timezone()
    {
        return $this->belongsTo(TimeZone::class);
    }
}
