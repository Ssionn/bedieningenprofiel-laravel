<?php

namespace App\Livewire;

use App\Services\ImagePreperationService;
use Filament\Notifications\Notification;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccountInformation extends Component
{
    use WithFileUploads;

    public $user;

    public $avatarDropzone;

    public $username;

    public $name;

    public $email;

    public function mount(): void
    {
        $this->username = $this->user->username;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateAccountInformation()
    {
        $this->validate([
            'avatarDropzone' => 'nullable|image|max:2048',
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        if ($this->user->getMedia('user_avatar')->count() > 0 && $this->avatarDropzone !== null) {
            $this->user->getMedia('user_avatar')->first()->delete();
        }

        if ($this->avatarDropzone !== null) {
            $path = 'avatars/' . $user->id;
            $imagePrep = ImagePreperationService::temporarilyStoreFileUsingPath($path, $this->avatarDropzone);

            $this->user->addMedia(storage_path('app/public/' . $path . '/' . $imagePrep))
                ->toMediaCollection('user_avatar', 'spaces');

            ImagePreperationService::removeRecordAndFile($imagePrep);
        }

        $this->user->update([
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
        ]);

        Notification::make()
            ->title(__('notification.settings.saved'))
            ->icon('heroicon-o-check-circle')
            ->duration(2500)
            ->success()
            ->send();

        return redirect()->route('settings', $this->user);
    }

    public function render(): View
    {
        return view('livewire.account-information');
    }
}
