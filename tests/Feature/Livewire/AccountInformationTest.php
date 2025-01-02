<?php

use App\Livewire\AccountInformation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    Artisan::call('migrate:fresh', ['--env' => 'testing']);

    $this->seed();

    $this->user = \App\Models\User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
    ]);
});

it('can update user information without image', function () {
    actingAs($this->user);

    Livewire::test(AccountInformation::class)
        ->set('avatarDropzone', null)
        ->set('username', 'johndoe69')
        ->set('name', 'John Doe')
        ->set('email', 'johndoe69@example.com')
        ->call('updateAccountInformation');

    assertDatabaseHas('users', [
        'username' => 'johndoe69',
        'name' => 'John Doe',
        'email' => 'johndoe69@example.com',
    ]);
});

it('can update user information with image', function () {
    actingAs($this->user);

    Storage::fake('public');

    $file = UploadedFile::fake()->image('avatar.jpg');

    Livewire::test(AccountInformation::class)
        ->set('avatarDropzone', $file)
        ->set('username', 'johndoe69')
        ->set('name', 'John Doe')
        ->set('email', 'johndoe69@example.com')
        ->call('updateAccountInformation');

    assertDatabaseHas('users', [
        'username' => 'johndoe69',
        'name' => 'John Doe',
        'email' => 'johndoe69@example.com',
    ]);

    assertDatabaseHas('media', [
        'model_type' => \App\Models\User::class,
        'model_id' => $this->user->id,
        'collection_name' => 'user_avatar',
    ]);
});
