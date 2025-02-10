<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends Model
{
    protected $casts = [
        'permissions' => 'array',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function prettierRole(): string
    {
        $removedUnderscores = str_replace('_', '', $this->name);

        return ucfirst($removedUnderscores);
    }
}
