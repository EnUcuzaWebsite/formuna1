<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Log extends Model
{
    protected $fillable = [
        'user_id',
        'loggable_id',
        'loggable_type',
        'log',
    ];

    protected $casts = [
        'log' => 'json',
    ];

    public function loggable(): MorphTo
    {
        return $this->morphTo('loggable', 'loggable_type', 'loggable_id');
    }
}
