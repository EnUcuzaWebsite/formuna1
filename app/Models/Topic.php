<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'detail',
        'slug',
        'category_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('created_at', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function favorites()
    {
        return $this->hasMany(FavoriteTopic::class);
    }

    public function latest_posts()
    {
        return $this->hasMany(Post::class)->latest()->limit(3);
    }
}
