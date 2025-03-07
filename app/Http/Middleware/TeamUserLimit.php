<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamUserLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->ownedTeams()->count() < auth()->user()->activePlan()->max_users_per_team) {
            return $next($request);
        }

        $team = auth()->user()->currentTeam()->first();

        Notification::make()
            ->title(__('notification.team.team_user_limit'))
            ->icon('heroicon-o-x-circle')
            ->info()
            ->duration(2500)
            ->send();

        return redirect()->route('teams.show', $team);
    }
}
