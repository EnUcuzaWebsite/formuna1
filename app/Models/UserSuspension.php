<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSuspension extends Model
{
    /** @use HasFactory<\Database\Factories\UserSuspensionFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'reason',
        'starts_at',
        'expires_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        // Prevent creating a new suspension if one already exists
        static::creating(function ($suspension) {
            if (
                self::where('user_id', $suspension->user_id)
                    ->where(function (Builder $query) {
                        $query->whereNull('expires_at') // Still active
                            ->orWhere('expires_at', '>', now()); // Future expiration
                    })->exists()
            ) {
                throw new \Exception('This user already has an active suspension.');
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
