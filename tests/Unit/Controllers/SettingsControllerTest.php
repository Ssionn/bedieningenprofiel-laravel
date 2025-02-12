<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('migrate:fresh', ['--env' => 'testing']);

    $this->seed();

    $this->user = User::factory()->withProPlusPlan()->create();
});

it('can show the settings', function () {
    $response = $this->actingAs($this->user)->get(route('settings'));

    $response->assertStatus(200);
});
