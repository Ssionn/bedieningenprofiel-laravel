<?php

namespace App\Livewire;

use App\Models\Localization as ModelsLocalization;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Localization extends Component
{
    public $locales;

    public function render()
    {
        return view('livewire.localization');
    }

    public function updateLocale(Request $request)
    {
        $request->validate([
            'locale' => 'required|string|in:nl,en',
        ]);

        ModelsLocalization::where('user_id', Auth::id())
            ->update([
                'selected' => DB::raw("CASE WHEN locale = '{$request->locale}' THEN true ELSE false END")
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
