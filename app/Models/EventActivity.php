<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventActivity extends Model
{
    use HasFactory;
    protected $table = 'event_activities';
    protected $fillable = [
        'event_id',
        'user_id',
        'is_save',
        'is_mute',
        'download_rsvps',
        'is_calendar',
        'is_attending',
        'mail_send_before_hour',
        'mail_send_before_day'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'first_name', 'last_name', 'profile_image', 'cover_image', 'location_id', 'step_verification', 'user_type');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
