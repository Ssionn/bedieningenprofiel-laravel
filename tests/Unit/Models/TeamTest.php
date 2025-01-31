<?php

test('Team model belongs to many members', function () {
    $team = new \App\Models\Team;
    $relation = $team->members();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\User::class);
});

test('Team model has many roles', function () {
    $team = new \App\Models\Team;
    $relation = $team->roles();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\Role::class);
});

test('Team model belongs to an owner', function () {
    $team = new \App\Models\Team;
    $relation = $team->owner();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\User::class);
});
