<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
    /** @use HasFactory<\Database\Factories\PlanFactory> */
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
