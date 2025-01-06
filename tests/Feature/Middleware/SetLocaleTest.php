<?php

use App\Enums\Locale;
use App\Http\Middleware\SetLocale;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    Artisan::call('migrate:fresh', ['--env' => 'testing']);

    $this->seed();

    $this->user = User::factory()->create([
        'id' => 3,
        'email' => 'johndoe@test.com',
        'password' => bcrypt('password'),
    ]);
});

it('authenticated user selects different locale', function () {
    $this->actingAs($this->user);

    DB::shouldReceive('table')
        ->once()
        ->with('localizations')
        ->andReturnSelf();

    DB::shouldReceive('where')
        ->once()
        ->with('user_id', $this->user->id)
        ->andReturnSelf();

    DB::shouldReceive('where')
        ->once()
        ->with('selected', true)
        ->andReturnSelf();

    DB::shouldReceive('value')
        ->once()
        ->with('locale')
        ->andReturn('nl');

    $this->assertEquals('en', app()->getLocale());

    $middleware = new SetLocale;
    $middleware->handle(request(), function () {
        return response('OK');
    });

    $this->assertEquals('nl', app()->getLocale());
    $this->assertEquals(Locale::English->value, app()->getFallbackLocale());
});
