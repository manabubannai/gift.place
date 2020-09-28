<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'message_id',
    ];

    // relation
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function message()
    {
        return $this->belongsTo('App\Models\Message', 'message_id', 'id');
    }
}
