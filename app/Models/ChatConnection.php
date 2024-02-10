<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatConnection extends Model
{
    use HasFactory;
    protected $table = 'chat_connections';
    protected $fillable = [
        'user_id',
        'socket_id'
    ];
}
