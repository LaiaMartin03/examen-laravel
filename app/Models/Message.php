<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'from',
        'to',
        'caption',
        'message',
        'state',
        'data',
    ];

    protected $casts = [
        'state' => 'boolean',
        'data' => 'datetime',
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to');
    }
}
