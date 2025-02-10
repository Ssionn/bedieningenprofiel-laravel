<?php

use App\Conversions\CastJson;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('migrate:fresh', ['--env' => 'testing']);

    $this->seed();

    $this->user = User::factory()->create();

    Team::factory()->create(['user_id' => $this->user->id]);
});

test('can visit create team page', function () {
    $response = $this->actingAs($this->user)->get(route('teams.create'));

    $response->assertStatus(200);
});

test('can create a team', function () {
    $response = $this->actingAs($this->user)->post(route('teams.store'), [
        'name' => 'Team Name',
        'description' => 'Team Description',
    ]);

    $response->assertRedirect();

    $team = $this->user->ownedTeams()->where('name', 'Team Name')->first();

    $this->assertNotNull($team);

    $teamLeaderRole = $team->roles()->where('team_id', $team->id)->first();

    $this->assertDatabaseHas('roles', [
        'team_id' => $teamLeaderRole->team_id,
        'name' => $teamLeaderRole->name,
        'permissions' => CastJson::convert(['*']),
    ]);

    $this->assertDatabaseHas('team_user', [
        'user_id' => $this->user->id,
        'team_id' => $team->id,
    ]);

    $this->assertEquals($this->user->current_team_id, $team->id);
});

test('can switch team', function () {
    $initialTeam = $this->user->ownedTeams()->first();
    $initialTeamRole = $initialTeam->roles()->where('team_id', $initialTeam->id)->first();
    $this->user->update(['current_team_id' => $initialTeam->id]);

    $newTeam = Team::factory()->create(['user_id' => $this->user->id]);
    $newTeamRole = $newTeam->roles()->create([
        'name' => 'Team Leader',
        'permissions' => ['*'],
    ]);

    $this->user->teams()->attach($newTeam, ['role_id' => $newTeamRole->id]);

    $this->assertTrue($this->user->teamsWithoutCurrent()->get()->contains($newTeam));

    $response = $this->actingAs($this->user)->post(route('teams.switch', $newTeam->id));
    $response->assertRedirect(route('dashboard'));

    $this->user->refresh();

    $this->assertEquals($this->user->current_team_id, $newTeam->id);
});

test('can visit team page', function () {
    $this->actingAs($this->user);

    $team = $this->user->ownedTeams()->first();

    $response = $this->actingAs($this->user)->get(route('teams.show', $team->id));

    $response->assertStatus(200);
});
