<?php
namespace App\Models;

use Carbon\Carbon;
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

    protected $appends = [
        'created_at_jst',
    ];

    public function getCreatedAtJstAttribute()
    {
        $dt   = new Carbon($this->created_at);
        $dt->timezone('Asia/Tokyo');

        return $dt->toDateTimeString();
    }

    // relation
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
