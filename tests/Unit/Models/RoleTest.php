<?php

test('Role model belongs to Team model', function () {
    $role = new \App\Models\Role;
    $relation = $role->team();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\Team::class);
});

test('Role model has many User models', function () {
    $role = new \App\Models\Role;
    $relation = $role->users();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\User::class);
});
