<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->activePlan()->exists()) {
            return $next($request);
        }

        Notification::make()
            ->title(__('notifcation.plan.upgrade'))
            ->info()
            ->duration(2500)
            ->send();

        return redirect()->route('settings');
    }
}
