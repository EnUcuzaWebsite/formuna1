<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Loggable;
use App\Reportable;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    use HasPanelShield;
    use HasRoles;
    use InteractsWithMedia;
    use Loggable;
    use Reportable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'status',
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

    public function suspensions(): HasMany
    {
        return $this->hasMany(UserSuspension::class);
    }

    public function forms(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likedForms(): HasMany
    {
        return $this->hasMany(LikedPost::class);
    }

    public function savedForms(): HasMany
    {
        return $this->hasMany(SavedPost::class);
    }

    public function favoriteTopics(): HasMany
    {
        return $this->hasMany(FavoriteTopic::class);
    }

    public function favoriteCategories(): HasMany
    {
        return $this->hasMany(FavoriteCategory::class);
    }

    public function followers(): HasMany
    {
        return $this->hasMany(Follow::class, 'followed_id');
    }

    public function following(): HasMany
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('super_admin') || $this->hasRole('Panel Admin');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function getFilamentAvatarUrl($conversion = 'preview'): string
    {

        $media = $this->getFirstMedia();
        if ($media) {
            return $media->getUrl($conversion);
        }

        return "https://ui-avatars.com/api/?name={$this->name}&background=E4E4E4";
    }

    public function isfollowed(): bool
    {
        return $this->followers()->where('follower_id', auth()->id())->exists();
    }

    public function follow(): void
    {
        $follow = Follow::createQuietly([
            'follower_id' => auth()->id(),
            'followed_id' => $this->id,
        ]);

        $follow->log([
            'type' => 'follow',
            'message' =>  '
                            <strong>
                                <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                    '.auth()->user()->name.'
                                </a>

                            </strong>
                            <small> Takip etti </small>
                            <strong>
                                <a href="'.route('filament.admin.resources.users.view', ['record' => $this]).'">
                                    '.$this->name.'
                                </a>
                            </strong>
                                ',
        ]);
    }

    public function isActive(): bool
    {
        return ! $this->suspensions()->where('expires_at', '>', now())->exists();
    }

    public function isSuspended(): bool
    {
        return $this->suspensions()->where('status', 'suspended')
            ->where('expires_at', '>', now())
            ->exists();
    }

    public function isBanned(): bool
    {
        return $this->suspensions()->where('status', 'suspended')
            ->where('expires_at', '>', now())
            ->exists();
    }

    public function user_logs()
    {
        return $this->hasMany(Log::class, 'user_id', 'id');
    }

    public function find_id(): void
    {
        dd($this->id);
    }
}
