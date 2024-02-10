<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeZone extends Model
{
    use HasFactory;
    protected $table = 'time_zones';

    protected $fillable = [
        'country_id',
        'timezone',
        'gmt_offset',
    ];
}
