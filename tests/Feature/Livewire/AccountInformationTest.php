<?php

use App\Livewire\AccountInformation;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;

beforeEach(function () {
    Artisan::call('migrate:fresh', ['--env' => 'testing']);

    $this->seed();

    $this->user = User::factory()->create();
});

it('can update user information without image', function () {
    $this->actingAs($this->user);

    Livewire::test(AccountInformation::class)
        ->set('avatarDropzone', null)
        ->set('username', 'johndoe69')
        ->set('name', 'John Doe')
        ->set('email', 'johndoe69@example.com')
        ->call('updateAccountInformation')
        ->assertHasNoErrors()
        ->assertRedirect(route('settings'));

    $this->assertTrue(
        User::where('username', $this->user->username)
            ->doesntHave('media')
            ->exists()
    );
});

it('can update user information with image', function () {
    $this->actingAs($this->user);

    $file = UploadedFile::fake()->image('avatar.jpg', 128, 128);

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
        User::where('username', $this->user->username)
            ->has('media')
            ->exists()
    );
})->skip(
    fn () => ! config('filesystems.disks.spaces.region'),
    'Spaces is not configured (env.testing). DO NOT PUSH REAL CREDS TO GITHUB!'
);
