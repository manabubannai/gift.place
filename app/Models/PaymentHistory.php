<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    const TYPE_SUBSCRIPTION = 1;
    const TYPE_SINGLE       = 2;

    const STATUS_UNKNOWN   = 0;
    const STATUS_SUCCEEDED = 1;
    const STATUS_FAILED    = 2;
    const STATUS_RESOLVED  = 3;

    protected $fillable = [
        'user_id',
        'provider',
        'event',
        'status',
        'type',
        'amount',
        'payload',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Fan::class)->withTrashed(true);
    }

    public function isSucceeded()
    {
        return $this->status == self::STATUS_SUCCEEDED;
    }
}
