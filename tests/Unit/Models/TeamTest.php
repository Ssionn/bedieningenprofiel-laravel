<?php

test('Team model has many User models', function () {
    $team = new \App\Models\Team;
    $relation = $team->users();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\User::class);
});

test('Team model has many Role models', function () {
    $team = new \App\Models\Team;
    $relation = $team->roles();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\Role::class);
});
