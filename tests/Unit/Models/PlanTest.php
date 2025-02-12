<?php

test('Plan model has many subscriptions', function () {
    $plan = new App\Models\Plan;
    $relation = $plan->subscriptions();

    expect($relation)->toBeInstanceOf(Illuminate\Database\Eloquent\Relations\HasMany::class);
    expect(get_class($relation->getRelated()))->toBe(App\Models\UserSubscription::class);
});
