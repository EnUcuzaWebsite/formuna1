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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function favorites()
    {
        return $this->hasMany(FavoriteTopic::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reported');
    }
}
