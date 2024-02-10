<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quizzes';
    protected $fillable = [
        'course_id',
        'course_module_id',
        'question',
        'question_image',
        'question_type',
    ];

    public function quizOptions()
    {
        return $this->hasMany(QuizOption::class, 'quiz_id');
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
