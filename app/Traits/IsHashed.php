<?php

namespace App\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait IsHashed
{
    public function connectedSalt(string $connection): self
    {
        Hashids::connection(
            $connection
        );

        return $this;
    }

    public function getRouteKeyForModel(): string
    {
        return Hashids::encode($this->getKey());
    }

    public function resolveRouteKey(string $hash): string
    {
        if (! array_key_exists(0, Hashids::decode($hash))) {
            abort(404);
        }

        return Hashids::decode($hash)[0];
    }

    public function resolveRouteBinding($value, $field = null): self
    {
        return $this->where($field ?? $this->getKeyName(), $this->resolveRouteKey($value))->firstOrFail();
    }
}
