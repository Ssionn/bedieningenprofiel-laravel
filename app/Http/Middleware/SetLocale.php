<?php

namespace App\Http\Middleware;

use App\Enums\Locale;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $selectedLocale = DB::table('localizations')
                ->where('user_id', Auth::id())
                ->where('selected', true)
                ->value('locale');

            if ($selectedLocale) {
                app()->setLocale($selectedLocale);
            }
        }

        app()->setFallbackLocale(Locale::English->value);

        return $next($request);
    }
}
