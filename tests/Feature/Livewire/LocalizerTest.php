<?php

use App\Enums\Locale;
use App\Livewire\Localizer;
use App\Models\Localization;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;

beforeEach(function () {
    Artisan::call('migrate:fresh', ['--env' => 'testing']);

    $this->seed();

    $this->user = User::factory()->create([
        'email' => 'johndoe@test.com',
        'password' => bcrypt('password'),
    ]);

    $this->user->localizations()->create([
        'language' => 'English',
        'locale' => 'en',
        'selected' => true,
    ]);

    $this->user->localizations()->create([
        'language' => 'Dutch',
        'locale' => 'nl',
        'selected' => false,
    ]);
});

it('authenticated user selects different language in dropdown', function () {
    $this->actingAs($this->user);

    Livewire::test(Localizer::class)
        ->set('selectedLocale', Locale::Dutch)
        ->call('updateLocale');

    Localization::where('user_id', $this->user->id)
        ->update([
            'selected' => DB::raw("CASE WHEN locale = 'nl' THEN true ELSE false END"),
        ]);

    app()->setLocale(Locale::Dutch->value);

    $this->assertEquals(Locale::Dutch->value, app()->getLocale());

    Livewire::test(Localizer::class)
        ->set('selectedLocale', Locale::English)
        ->call('updateLocale');

    Localization::where('user_id', $this->user->id)
        ->update([
            'selected' => DB::raw("CASE WHEN locale = 'en' THEN true ELSE false END"),
        ]);

    app()->setLocale(Locale::English->value);

    $this->assertEquals(Locale::English->value, app()->getLocale());
});
