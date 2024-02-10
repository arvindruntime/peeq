<?php

namespace App\Models;

use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InteractiveWorkbook extends Model
{
    use HasFactory;
    protected $table = 'interactiveworkbook';
    protected $fillable = [
        'course_id',
        'course_module_id',
        'page_no',
        'pdf_content',
        'interactive_content',
        'audio_file',
        'start_page',
        'end_page',
        'status',
    ];

        public function course()
        {
            return $this->belongsTo(Course::class, 'course_id');
        }
        
        public function courseModule()
        {
            return $this->belongsTo(CourseModule::class, 'course_module_id');
        }

        public function interactiveDetail()
        {
            return $this->hasMany(InteractiveDetail::class, 'interactive_workbook_id');
        }
}
