<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TeamServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('create_teams', fn (User $user) => $user->canCreateTeams());
        Gate::define('view_current_team', fn (User $user) => $user->currentTeam()->exists());
        Gate::define('view_any_attached_team', fn (User $user) => $user->teams()->count() >= 0);
        Gate::define('edit_team', fn (User $user, Team $team) => $user->isOwnerOfTeam($team));
        Gate::define('add_team_member', fn (User $user, Team $team) => $user->isOwnerOfTeam($team) && $team->remainingUsers() > 0);

        View::composer('layouts.navigation', function ($view) {
            if (auth()->check()) {
                $user = auth()->user();
                $user->load('teams');

                $view->with([
                    'userTeams' => $user->teams,
                    'currentTeam' => $user->teams->find($user->current_team_id),
                ]);
            }
        });
    }
}
