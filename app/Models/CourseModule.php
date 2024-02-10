<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseModule extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'course_id',
        'title',
        'thumbnail_image',
        'introduction',
        'video_lesson',
        'audio_recording_description',
        'audio_recording',
        'task',
        'quiz_description',
        'reflection_questions',
        'reference_link_description',
        'reference_title',
        'reference_link',
        'closure_video_description',
        'closure_video'
    ];

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($course) {
            $course->deleted_by = Auth::user()->id;
            $course->save();
        });

    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'course_module_id');
    }
    public function userCourseActivities()
    {
        return $this->hasMany(UserCourseActivity::class, 'course_module_id');
    }
    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }
}
