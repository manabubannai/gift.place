<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'description',
    ];

    // relation
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
