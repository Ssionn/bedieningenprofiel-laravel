<?php

namespace App\Http\Controllers;

use App\Enums\Locale;
use App\Models\User;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(User $user): View
    {
        $locales = Locale::cases();

        return view('settings.index', [
            'locales' => $locales,
            'user' => $user,
        ]);
    }
}
