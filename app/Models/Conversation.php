<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Chats()
    {
        return $this->hasMany(Chat::class, "conversation_id", "id");
    }

    public function Users()
    {
        return $this->belongsToMany(User::class, "user_conversation", "conversation_id", "user_id");
    }
}
