<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VersionControl extends Model
{
    use HasFactory;
    protected $table = 'version_controls';
    protected $fillable = [
        'android_version',
        'android_is_force_update',
        'android_message',
        'ios_version',
        'ios_is_force_update',
        'ios_message'
    ];
    protected $hidden = [
        'created_at', 
        'updated_at'
    ];
}
