<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleOverview extends Model
{
    use HasFactory;
    protected $table = 'module_overviews';
    protected  $fillable = [
        'user_id',
        'course_id',
        'module_overviewed',
    ];
}
