<?php

namespace App\Http\Controllers;

use App\Enums\Locale;
use App\Models\Localization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $locales = Locale::cases();

        return view('settings.index', compact('locales'));
    }

    public function updateLocale(Request $request)
    {
        $request->validate([
            'locale' => 'required',
        ]);

        Localization::where('user_id', Auth::id())
            ->update([
                'selected' => DB::raw("CASE WHEN locale = '{$request->locale}' THEN true ELSE false END")
            ]);

        return redirect()->route('settings');
    }
}
