<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

        return $this->getMedia('user_avatar')->first()->getTemporaryUrl(
            Carbon::now()->addMinutes(5),
        );
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

    public function hasTeams(): bool
    {
        return $this->teams()->count() > 0;
    }

    public function ownedTeams(): HasMany
    {
        return $this->hasMany(Team::class, 'user_id');
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)
            ->using(TeamUser::class)
            ->withPivot('role_id');
    }

    public function teamsSortedByOwner(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)
            ->using(TeamUser::class)
            ->withPivot('role_id')
            ->orderBy('user_id', 'asc');
    }

    public function teamsWithoutCurrent(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)
            ->using(TeamUser::class)
            ->withPivot('role_id')
            ->wherePivot('team_id', '!=', $this->current_team_id);
    }

    public function currentTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'current_team_id');
    }

    public function canCreateTeam(): bool
    {
        return $this->teams()->count() <= $this->max_teams;
    }

    public function localizations(): HasMany
    {
        return $this->hasMany(Localization::class);
    }
}
