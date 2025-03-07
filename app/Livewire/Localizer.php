<?php

namespace App\Livewire;

use App\Models\Localization;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Localizer extends Component
{
    public $locales;

    public $selectedLocale;

    public function mount()
    {
        $this->locales = Localization::where('user_id', Auth::id())->get();
        $this->selectedLocale = app()->getLocale();
    }

    public function render()
    {
        return view('livewire.localizer');
    }

    public function updateLocale()
    {
        if ($this->selectedLocale === app()->getLocale()) {
            return;
        }

        $this->validate([
            'selectedLocale' => 'required|string|in:nl,en',
        ]);

        Localization::where('user_id', Auth::id())
            ->update([
                'selected' => DB::raw("CASE WHEN locale = '{$this->selectedLocale}' THEN true ELSE false END"),
            ]);

        Notification::make()
            ->title(__('notification.settings.language'))
            ->icon('heroicon-o-check-circle')
            ->duration(2500)
            ->success()
            ->send();

        return redirect()->route('settings', auth()->user());
    }
}
