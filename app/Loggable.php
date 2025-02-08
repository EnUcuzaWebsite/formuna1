<?php

namespace App;

use App\Models\Log;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Loggable
{
    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'loggable');
    }

    public function log($log, array $changes = []): void
    {
        $this->logs()->create([
            'user_id' => auth()->id(),
            'log' => $log,
            'changes' => $changes,
        ]);
    }

    public static function bootLoggable(): void
    {
        $user = auth()->user()?->name ?? 'Sistem';
        static::created(function ($model) use ($user) {
            $model->log([
                'type' => 'created',
                'message' => trans(':User tarafından oluşturuldu', ['user' => $user]),
            ]);
        });

        static::updating(function ($model) use ($user): void {
            $model->log([
                'type' => 'updated',
                'message' => trans(':User tarafından güncellendi', ['user' => $user]),
            ], $model->getDirty());
        });

        static::deleted(function ($model) use ($user): void {
            $model->log([
                'type' => 'deleted',
                'message' => trans(':User tarafından silindi', ['user' => $user]),
            ]);
        });
    }
}
