<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteractiveDetail extends Model
{
    use HasFactory;
    protected $table = 'interactive_details';
    protected $fillable = [
        'interactive_workbook_id',
        'user_id',
        'content',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function interactiveWorkbook()
    {
        return $this->belongsTo(InteractiveWorkbook::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
