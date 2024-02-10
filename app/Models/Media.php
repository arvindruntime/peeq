<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'types',
        'url',
        'archive',
        'added_by',
    ];

    protected $hidden = [
        'created_at', 
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public static function boot()
    {
        parent::boot();
        
        self::creating(function ($media) {

            if(Auth::check()) {
                $media->added_by = Auth::user()->id;
            }     
        });

        self::created(function ($media) {
            // ... code here     
        });

        self::updating(function ($media) {
            $media->updated_by = Auth::user()->id;
        });

        self::updated(function ($media) {
            // ... code here
        });

        self::deleting(function ($media) {
            $media->deleted_by = Auth::user()->id;
            $media->save();
        });

        self::deleted(function ($media) {
        });
    }
}
