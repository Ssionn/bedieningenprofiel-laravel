<?php

namespace App\Http\Controllers;

use App\Enums\Locale;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $locales = Locale::cases();

        return view('settings.index', compact('locales'));
    }
}
