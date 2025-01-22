<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'activity_type',
        'target_id',
        'created_at',
    ];

    protected $dates = [
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
