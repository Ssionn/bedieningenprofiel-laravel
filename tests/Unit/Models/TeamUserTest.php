<?php

test('team user has a role attached', function () {
    $teamUser = new \App\Models\TeamUser;
    $relation = $teamUser->role();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\Role::class);
});
