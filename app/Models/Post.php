<?php

namespace App\Models;

use App\Loggable;
use App\Reportable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    use Loggable;
    use Reportable;

    protected $fillable = [
        'user_id',
        'category_id',
        'topic_id',
        'title',
        'content',
        'views',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('created_at', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }

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


    public function isliked(): bool
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function issaved(): bool
    {
        return $this->saves()->where('user_id', auth()->id())->exists();
    }

    public function savepost(): void
    {
        $saved_post = SavedPost::createQuietly([
            'user_id' => auth()->id(),
            'post_id' => $this->id,
        ]);

        $saved_post->log([
            'type' => 'save',
            'message' => '
                        <strong>
                             <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                '.auth()->user()->name.'
                            </a>
                        </strong>
                        <small> Kaydetti </small>
                        <strong>
                            <a href="'.route('filament.admin.resources.posts.view', ['record' => $this]).'">
                                '.$this->id.' -> post
                            </a>
                        </strong>
                       ',
        ]);

    }

    public function likepost(): void
    {
        $liked_post = LikedPost::createQuietly([
            'user_id' => auth()->id(),
            'post_id' => $this->id,
        ]);

        $liked_post->log([
            'type' => 'like',
            'message' => '
                        <strong>
                             <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                '.auth()->user()->name.'
                            </a>
                        </strong>
                        <small> Beğendi </small>
                        <strong>
                            <a href="'.route('filament.admin.resources.posts.view', ['record' => $this]).'">
                                '.$this->id.' -> post
                            </a>
                        </strong>
                       ',
        ]);

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
