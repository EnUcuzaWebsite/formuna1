<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'detail',
        'slug',
        'icon',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function favorites()
    {
        return $this->hasMany(FavoriteCategory::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reported');
    }
}
