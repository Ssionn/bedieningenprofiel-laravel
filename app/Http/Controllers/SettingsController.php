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
}
