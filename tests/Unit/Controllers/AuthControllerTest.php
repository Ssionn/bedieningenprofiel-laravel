<?php

use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('migrate:fresh', ['--env' => 'testing']);

    $this->seed();

    $this->user = \App\Models\User::factory()->create([
        'username' => 'johndoe69',
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => bcrypt('password'),
    ]);
});

test('that it can visit the login page', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
});

test('that the user can login', function () {
    $response = $this->post(route('login'), [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect('/dashboard');
});


test('that the user can\'t login', function () {
    $response = $this->post(route('login'), [
        'email' => 'johndoe69@examdmd.com',
        'password' => 'password',
    ]);

    $response->assertRedirect()
        ->assertSessionHasErrors('email');
});

test('that the user can logout', function () {
    $response = $this->actingAs($this->user)->post('/panel/logout');

    $response->assertRedirect('/');
});
