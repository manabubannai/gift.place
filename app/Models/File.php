<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'file';

    protected $fillable = [
        'url',
        'title',
        'entity_type',
    ];

    // Relations
}
