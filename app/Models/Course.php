<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'course_thumbnail',
        'course_preview_video',
        'course_name',
        'course_tagline',
        'coaches',
        'description',
        'module_overview_description',
        'course_price_type',
        'course_price',
        'is_featured',
        'member_add_reviews_on_this',
        'upload_pdf',
        'currency_id',
        'stripe_subscription_course_id',
        'google_pay_id',
        'apple_pay_id',
        'course_completed_image',
        'status',
        'deleted_by',
    ];

    protected $casts = [
        'is_featured' => 'integer',
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

    public function courseModules()
    {
        return $this->hasMany(CourseModule::class, 'course_id');
    }
    
    public function coaches()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function transactions()
    {
        return $this->hasMany(PlanTransaction::class, 'course_id');
    }
    
    public function interactiveWorkBooks()
    {
        return $this->hasMany(InteractiveWorkBook::class, 'course_id');
    }

    public function userCourseActivities()
    {
        return $this->hasMany(UserCourseActivity::class);
    }
}
