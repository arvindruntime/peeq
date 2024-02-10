<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizOption extends Model
{
    use HasFactory;
    protected $table = 'quiz_options';
    protected $fillable = [
        'quiz_id',
        'option',
        'option_image',
        'admin_answer',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
