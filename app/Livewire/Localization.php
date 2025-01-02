<?php

namespace App\Livewire;

use App\Models\Localization as ModelsLocalization;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class Localization extends Component
{
    public $locales;

    public $selectedLocale;

    public function mount()
    {
        $this->locales = ModelsLocalization::where('user_id', Auth::id())->get();
        $this->selectedLocale = app()->getLocale();
    }

    public function render()
    {
        return view('livewire.localization');
    }

    public function updateLocale(): RedirectResponse
    {
        $this->validate([
            'selectedLocale' => 'required|string|in:nl,en',
        ]);

        ModelsLocalization::where('user_id', Auth::id())
            ->update([
                'selected' => DB::raw("CASE WHEN locale = '{$this->selectedLocale}' THEN true ELSE false END"),
            ]);

        Notification::make()
            ->title(__('settings/index.notifications.language'))
            ->icon('heroicon-o-check-circle')
            ->duration(2500)
            ->success()
            ->send();

        return redirect()->route('settings');
    }
}
