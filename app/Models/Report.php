<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'reportable_id',
        'reportable_type',
        'report',
    ];

    protected $casts = [
        'report' => 'json',
    ];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('created_at', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }

    public function reportable(): MorphTo
    {
        return $this->morphTo('reportable', 'reportable_type', 'reportable_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
