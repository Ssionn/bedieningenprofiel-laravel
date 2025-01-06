<?php

namespace App\Repositories;

use App\Enums\Locale;
use App\Models\User;

class AuthRepository
{
    public function createUser(
        string $username,
        string $name,
        string $email,
        string $password
    ): User {
        return User::create([
            'username' => $username,
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'role_id' => 1,
        ]);
    }

    public function createUserLocalizations(User $user): void
    {
        $user->localizations()->createMany(
            collect(Locale::cases())->map(function (Locale $locale) {
                return [
                    'language' => $locale->name,
                    'locale' => $locale->value,
                    'selected' => false,
                ];
            })->toArray()
        );

        $user->localizations()->where('locale', Locale::English->value)->update(['selected' => true]);
    }
}
