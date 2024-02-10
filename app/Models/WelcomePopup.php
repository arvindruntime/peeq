<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelcomePopup extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'video_url',
        'description'
    ];
    protected $hidden = [
        'id',
        'created_at', 
        'updated_at'
    ];
}
