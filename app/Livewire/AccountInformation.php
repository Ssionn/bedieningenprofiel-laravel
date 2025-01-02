<?php

namespace App\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccountInformation extends Component
{
    use WithFileUploads;

    public $avatarDropzone;
    public $username;
    public $name;
    public $email;

    public function render()
    {
        return view('livewire.account-information');
    }

    public function updateAccountInformation()
    {
        $this->validate([
            'avatarDropzone' => 'nullable|image|max:2048',
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = Auth::user();

        if ($user->getMedia('user_avatar')->count() > 0) {
            $user->getMedia('user_avatar')->first()->delete();
        }

        if ($this->avatarDropzone) {
            $user->addMedia($this->avatarDropzone->getRealPath())
                ->toMediaCollection('user_avatar');
        }

        $user->update([
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
        ]);

        Notification::make()
            ->title(__('settings/index.notifications.success'))
            ->icon('heroicon-o-check-circle')
            ->duration(2500)
            ->success()
            ->send();

        return redirect()->route('settings');
    }
}
