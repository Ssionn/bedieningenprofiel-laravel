<?php

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('migrate:fresh', ['--env' => 'testing']);

    $this->seed();
});

test('that it can create a user', function () {
    $authRepository = new AuthRepository;

    $user = $authRepository->createUser(
        'test',
        'Test User',
        'test@test.com',
        'password'
    )->initLocalization();

    $this->assertDatabaseHas('users', [
        'username' => 'test',
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => $user->password,
    ]);
});
