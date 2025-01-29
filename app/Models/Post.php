<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'topic_id',
        'title',
        'content',
        'views',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function likes()
    {
        return $this->hasMany(LikedPost::class);
    }

    public function saves()
    {
        return $this->hasMany(SavedPost::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reported');
    }

    public function activities()
    {
        return $this->hasMany(PostActivity::class);
    }


    public function scopeMostSharedCategory($query, $count = 1)
    {
        return $query->select('category_id')
            ->selectRaw('count(*) as count')
            ->groupBy('category_id')
            ->orderByDesc('count')
            ->limit($count)
            ->get();
    }

    public function scopeMostSharedTopic($query, $count = 1)
    {
        return $query->select('topic_id')
            ->selectRaw('count(*) as count')
            ->groupBy('topic_id')
            ->orderByDesc('count')
            ->limit($count)
            ->get();
    }
}
