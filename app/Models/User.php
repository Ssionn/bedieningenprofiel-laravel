<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use InteractsWithMedia;
    use Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function defaultAvatar(): string
    {
        if (! $this->getMedia('user_avatar')->count()) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->username) . '&background=random&color=random?size=128';
        }

        return $this->getMedia('user_avatar')->first()->getUrl();
    }

    public function getShortenedEmailAttribute($maxLength = 20): string
    {
        $email = $this->email;

        if (strlen($email) <= $maxLength) {
            return $email;
        }

        $atPosition = strpos($email, '@');
        if ($atPosition === false) {
            return substr($email, 0, $maxLength) . '...';
        }

        $username = substr($email, 0, $atPosition);
        $domain = substr($email, $atPosition);

        $availableLength = $maxLength - strlen($domain) - 3;
        if ($availableLength < 1) {
            return substr($email, 0, $maxLength - 3) . '...';
        }

        return substr($username, 0, $availableLength) . '...' . $domain;
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function localizations(): HasMany
    {
        return $this->hasMany(Localization::class);
    }
}
