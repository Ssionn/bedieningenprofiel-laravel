<?php

test('Localization model belongs to User model', function () {
    $localization = new \App\Models\Localization();
    $relation = $localization->user();

    expect($relation)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    expect(get_class($relation->getRelated()))->toBe(\App\Models\User::class);
});
