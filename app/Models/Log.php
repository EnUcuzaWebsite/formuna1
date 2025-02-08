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
        'changes',
    ];

    protected $casts = [
        'log' => 'json',
        'changes' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('created_at', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }

    public function loggable(): MorphTo
    {
        return $this->morphTo('loggable', 'loggable_type', 'loggable_id');
    }
}
