/*<?php*/
/**/
/*use App\Http\Middleware\TeamUserLimit;*/
/*use App\Models\Role;*/
/*use App\Models\Team;*/
/*use App\Models\User;*/
/*use Illuminate\Http\Request;*/
/**/
/*beforeEach(function () {*/
/*    $this->middleware = new TeamUserLimit();*/
/*    $this->request = new Request();*/
/**/
/*    $this->user = User::factory()->withProPlusPlan()->create();*/
/**/
/*    Team::factory()->create([*/
/*        'user_id' => $this->user->id,*/
/*    ]);*/
/**/
/*    $this->user->refresh();*/
/*    $this->role = Role::create([*/
/*        'name' => 'member',*/
/*        'permissions' => ['*'],*/
/*        'team_id' => $this->user->ownedTeams()->first()->id,*/
/*    ]);*/
/**/
/*    $this->members = User::factory()->withFreePlan()->count(29)->create();*/
/*    $this->members->each(function ($member) {*/
/*        $this->user->ownedTeams()->first()->members()->attach($member, ['role_id' => $this->role->id]);*/
/*    });*/
/*});*/
