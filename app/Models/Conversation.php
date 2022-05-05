<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory;

    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id', 'id');
    }

    public function hasUnread()
    {
        return count($this->messages->where("sender_id", '!=', Auth::id())->where('read', false));
    }
}
