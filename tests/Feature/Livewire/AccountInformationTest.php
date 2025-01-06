<?php

use App\Livewire\AccountInformation;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function () {
    Artisan::call('migrate:fresh', ['--env' => 'testing']);

    $this->seed();
});

it('can update user information without image', function () {
    $this->actingAs($user = User::factory()->create());

    $this->get(route('settings'))
        ->assertSeeLivewire('account-information');

    Livewire::test(AccountInformation::class)
        ->set('avatarDropzone', null)
        ->set('username', 'johndoe69')
        ->set('name', 'John Doe')
        ->set('email', 'johndoe69@example.com')
        ->call('updateAccountInformation')
        ->assertHasNoErrors()
        ->assertRedirect(route('settings'));

    $this->assertTrue(
        User::where('username', $user->username)
            ->doesntHave('media')
            ->exists()
    );
});

it('can update user information with image', function () {
    $this->actingAs($user = User::factory()->create());

    Storage::fake('public');
    $file = UploadedFile::fake()->image('avatar.jpg');

    $this->get(route('settings'))
        ->assertSeeLivewire('account-information');

    Livewire::test(AccountInformation::class)
        ->set('avatarDropzone', $file)
        ->set('username', 'johndoe69')
        ->set('name', 'John Doe')
        ->set('email', 'johndoe69@example.com')
        ->call('updateAccountInformation')
        ->assertHasNoErrors()
        ->assertRedirect(route('settings'));

    $this->assertTrue(
        User::where('username', $user->username)
            ->has('media')
            ->exists()
    );
});
