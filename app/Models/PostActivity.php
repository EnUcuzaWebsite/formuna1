<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostActivity extends Model
{
    /** @use HasFactory<\Database\Factories\PostActivityFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_type',
        'target_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'target_id');
    }
}
