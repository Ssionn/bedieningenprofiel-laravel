<?php

namespace App\Repositories;

use App\Enums\Locale;
use App\Models\User;
use Filament\Notifications\Notification;

class AuthRepository
{
    private User $user;

    public function createUser(
        string $username,
        string $name,
        string $email,
        string $password
    ): self {
        $this->user = User::create([
            'username' => $username,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role_id' => 1,
        ]);

        if (! $this->user) {
            Notification::make()
                ->title('An error occurred while creating your account')
                ->icon('heroicon-o-x-circle')
                ->duration(2500)
                ->danger()
                ->send();
        }

        return $this;
    }

    public function initLocalization(): User
    {
        $this->user->localizations()->createMany(
            collect(Locale::cases())->map(function (Locale $locale) {
                return [
                    'language' => $locale->name,
                    'locale' => $locale->value,
                    'selected' => false,
                ];
            })->toArray()
        );

        $this->user->localizations()
            ->where('locale', Locale::English->value)
            ->update(['selected' => true]);

        return $this->user;
    }
}
