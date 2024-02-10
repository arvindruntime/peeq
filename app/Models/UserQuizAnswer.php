<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuizAnswer extends Model
{
    use HasFactory;
    protected $table = 'user_quiz_answers';
    protected $fillable = [
        'user_id',
        'quiz_id',
        'quiz_option_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function quizOptions()
    {
        return $this->belongsTo(Quiz::class, 'quiz_option_id');
    }
}
