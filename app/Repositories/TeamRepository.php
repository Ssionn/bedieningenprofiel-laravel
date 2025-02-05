<?php

namespace App\Repositories;

class TeamRepository
{
    public function createTeam(
        array $data
    ): self {
        $team = auth()->user()->ownedTeams()->create($data);

        $teamLeaderRole = $team->roles()->firstOrCreate([
            'name' => 'team_leader',
            'permissions' => ['*'],
        ]);

        $team->members()->attach(auth()->user(), ['role_id' => $teamLeaderRole->id]);

        auth()->user()->update(['current_team_id' => $team->id]);

        return $this;
    }

    public function switchTeamId(
        $teamId
    ): void {
        auth()->user()->update([
            'current_team_id' => $teamId,
        ]);
    }
}
