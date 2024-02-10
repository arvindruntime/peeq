<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteMember extends Model
{
    use HasFactory;
    protected $table = 'invite_members';
    protected $fillable = [
        'email',
        'subject',
        'message',
        'user_type',
        'invite_type',
        'invite_by',
        'status'
    ];
}
