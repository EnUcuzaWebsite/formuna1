<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'name',
        'bio',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function forms()
    {
        return $this->hasMany(Post::class);
    }

    public function activities()
    {
        return $this->hasMany(UserActivity::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    public function likedForms()
    {
        return $this->hasMany(LikedPost::class);
    }

    public function savedForms()
    {
        return $this->hasMany(SavedPost::class);
    }

    public function favoriteTopics()
    {
        return $this->hasMany(FavoriteTopic::class);
    }

    public function favoriteCategories()
    {
        return $this->hasMany(FavoriteCategory::class);
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'followed_id');
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->email === 'zafer@bilen.dev';
    }

}

