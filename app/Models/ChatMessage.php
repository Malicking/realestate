<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function senders () {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receivers () {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function users () {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}
