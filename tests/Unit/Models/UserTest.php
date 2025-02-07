<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

beforeEach(function () {
    Artisan::call('migrate:fresh');
});

test('User model has casts', function () {
    $user = new User;
    $casts = $user->getCasts();

    expect($casts)->toBeArray();
    expect($casts)->toHaveKey('email_verified_at');
    expect($casts['email_verified_at'])->toBe('datetime');
    expect($casts)->toHaveKey('password');
    expect($casts['password'])->toBe('hashed');
});

it('returns a default avatar when no avatar is uploaded', function () {
    $user = User::factory()->create([
        'username' => 'JohnDoe',
    ]);

    $expectedUrl = 'https://ui-avatars.com/api/?name=' . urlencode('JohnDoe') . '&background=random&color=random?size=128';
    expect($user->defaultAvatar())->toBe($expectedUrl);
});

it('returns the uploaded avatar URL if it exists', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    $media = Media::create([
        'model_type' => User::class,
        'model_id' => $user->id,
        'collection_name' => 'user_avatar',
        'name' => 'avatar.jpg',
        'file_name' => 'avatar.jpg',
        'disk' => 'public',
        'size' => 1024,
        'manipulations' => [],
        'custom_properties' => [],
        'generated_conversions' => [],
        'responsive_images' => [],
        'order_column' => 1,
    ]);

    $media->update(['file_name' => 'avatar.jpg', 'disk' => 'public']);
    Storage::disk('public')->put('avatar.jpg', 'fake-content');

    expect($user->defaultAvatar())->toBe($media->getTemporaryUrl(
        Carbon::now()->addMinutes(5),
    ));
});

test('email is not shortened if it is within maxLength', function () {
    $user = User::factory()->create(['email' => 'short@email.com']);

    expect($user->getShortenedEmailAttribute())->toBe('short@email.com');
});

test('email is shortened if it exceeds maxLength without "@"', function () {
    $user = User::factory()->create(['email' => 'verylongemailwithoutatsymbol']);

    expect($user->getShortenedEmailAttribute(10))->toBe('verylongem...');
});

test('email is shortened if it exceeds maxLength and contains "@"', function () {
    $user = User::factory()->create(['email' => 'thisisalongemail@testingthis.com']);

    expect($user->getShortenedEmailAttribute(20))->toBe('t...@testingthis.com');
});

test('email is shortened when the domain leaves no room for username', function () {
    $user = User::factory()->create(['email' => 'username@longdomain.com']);

    expect($user->getShortenedEmailAttribute(10))->toBe('usernam...');
});

test('User has no teams', function () {
    $user = new \App\Models\User;
    $hasTeams = $user->hasTeams();

    expect($hasTeams)->toBeFalse();
});

test('User has teams that are sorted by owner', function () {
    $user = new \App\Models\User;
    $relation = $user->teamsSortedByOwner();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\Team::class);
});

test('User can create a team below count of maximum teams', function () {
    $user = User::factory()->create();

    $canCreateTeams = $user->canCreateTeams();

    expect($canCreateTeams)->toBeTrue();
});

test('User belongs to many teams with role_id pivot', function () {
    $user = new \App\Models\User;
    $relation = $user->teams();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\Team::class);
});

test('User model has many Localization models', function () {
    $user = new \App\Models\User;
    $relation = $user->localizations();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\Localization::class);
});
