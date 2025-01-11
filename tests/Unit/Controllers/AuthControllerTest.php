<?php

use App\Models\User;
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

test('that it can visit the sign up page', function () {
    $response = $this->get(route('register'));

    $response->assertStatus(200);
});

test('that the user can login', function () {
    $response = $this->post(route('login'), [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect('/dashboard');

    $this->assertAuthenticatedAs($this->user);
});

test('that the user can\'t login', function () {
    $response = $this->post(route('login'), [
        'email' => 'johndoe69@examdmd.com',
        'password' => 'password',
    ]);

    $response->assertRedirect()
        ->assertSessionHasErrors('email');
});

test('that the user can register', function () {
    $response = $this->post(route('register'), [
        'username' => 'janedoe69',
        'name' => 'Jane Doe',
        'email' => 'janedoe69@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $user = User::where('email', 'janedoe69@example.com')->first();
    expect($user)->not->toBeNull();

    $response->assertRedirect();

    $this->assertAuthenticatedAs($user);
});

test('that the user can\'t register', function () {
    $response = $this->post(route('register'), [
        'username' => 'johndoe69',
        'name' => 'John Doe',
        'email' => 'johndoe69@example.com',
        'password' => bcrypt('password'),
        'password_confirmation' => bcrypt('password'),
        'role_id' => 1,
    ]);

    expect(User::where('email', 'johndoe69@example.com')->first())
        ->toBeNull();

    $response->assertRedirect();
});

test('that the user can logout', function () {
    $response = $this->actingAs($this->user)->post(route('logout'));

    $response->assertRedirect(route('login'));
});
