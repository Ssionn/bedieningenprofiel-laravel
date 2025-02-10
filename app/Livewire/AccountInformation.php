<?php

namespace App\Livewire;

use App\Services\ImagePreperationService;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccountInformation extends Component
{
    use WithFileUploads;

    public $avatarDropzone;

    public $username;

    public $name;

    public $email;

    public function mount(): void
    {
        $this->username = Auth::user()->username;
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
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

        if ($user->getMedia('user_avatar')->count() > 0 && $this->avatarDropzone !== null) {
            $user->getMedia('user_avatar')->first()->delete();
        }

        if ($this->avatarDropzone !== null) {
            $path = 'avatars/' . $user->id;
            $imagePrep = ImagePreperationService::temporarilyStoreFileUsingPath($path, $this->avatarDropzone);

            $user->addMedia(storage_path('app/public/' . $path . '/' . $imagePrep))
                ->toMediaCollection('user_avatar', 'spaces');

            ImagePreperationService::removeRecordAndFile($imagePrep);
        }

        $user->update([
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

        return redirect()->route('settings');
    }

    public function render(): View
    {
        return view('livewire.account-information');
    }
}
