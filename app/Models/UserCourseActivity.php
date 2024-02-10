<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseActivity extends Model
{
    use HasFactory;
    protected $table = 'user_course_activities';
    protected $fillable = [
        'user_id',
        'course_id',
        'course_module_id',
        'introduction',
        'video_lesson',
        'audio_recording',
        'task',
        'quiz',
        'reflection_questions',
        'reference_link',
        'closure_video',
        'mark_as_complete',
        'course_completed'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function courseModule()
    {
        return $this->belongsTo(CourseModule::class, 'course_module_id');
    }

}
