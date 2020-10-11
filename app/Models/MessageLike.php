<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageLike extends Model
{
    protected $table = 'message_likes';

    protected $fillable = [
        'id',
        'user_id',
        'message_id',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function message()
    {
        return $this->belongsTo(\App\Models\Message::class, 'message_id', 'id');
    }
}
