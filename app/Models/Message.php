<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'conversation_id', 'message', 'read'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
}
