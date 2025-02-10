<?php

namespace App\Repositories;

use App\Models\Team;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;

class TeamRepository
{
    public function createTeam(
        array $data
    ): Team|RedirectResponse {
        if ($this->teamExists($data['name'])) {
            Notification::make()
                ->title(__('notification.teams.team_already_exists'))
                ->duration(2500)
                ->danger()
                ->send();

            return redirect()->route('teams.create');
        }

        $team = auth()->user()->ownedTeams()->create($data);

        $teamLeaderRole = $team->roles()->create([
            'name' => 'team_leader',
            'permissions' => ['*'],
        ]);

        $team->members()->attach(auth()->user(), ['role_id' => $teamLeaderRole->id]);

        auth()->user()->update(['current_team_id' => $team->id]);

        return $team;
    }

    public function switchTeamId(
        int $teamId
    ): void {
        auth()->user()->update(['current_team_id' => $teamId]);

        auth()->user()->refresh();
    }

    public function teamExists(
        string $teamName
    ): bool {
        return Team::where('name', $teamName)->exists();
    }

    public function updateRemainingInvitations(
        Team $team
    ): void {
        $team->update([
            'remaining_invitations' => $team->remaining_invitations - 1,
        ]);
    }
}
