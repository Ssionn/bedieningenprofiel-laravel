<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('migrate:fresh', ['--env' => 'testing']);

    $this->seed();

    $this->user = User::factory()->create([
        'email' => 'johndoe@test.com',
        'password' => bcrypt('password'),
    ]);
});

it('can show the dashboard', function () {
    $response = $this->actingAs($this->user)->get(route('dashboard'));

    $response->assertStatus(200);
});
