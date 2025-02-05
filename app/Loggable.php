<?php

namespace App;

use App\Models\Log;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use phpDocumentor\Reflection\Types\Void_;

trait Loggable
{



    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'loggable');
    }


    public function log($log)
    {
        $this->logs()->create([
            'user_id' => auth()->id(),
            'log' => $log,
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

        static::updated(function ($model) use ($user): void {
            $model->log([
                'type' => 'updated',
                'message' => trans(':User tarafından güncellendi', ['user' => $user]),
                'changes' => $model->getDirty(),
            ]);
        });

        static::deleted(function ($model) use ($user): void {
            $model->log([
                'type' => 'deleted',
                'message' => trans(':User tarafından silindi', ['user' => $user]),
                'changes' => $model->getOriginal(),
            ]);
        });
    }
}
