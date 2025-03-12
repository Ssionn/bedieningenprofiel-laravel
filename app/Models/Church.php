<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Church extends Model
{
    /** @use HasFactory<\Database\Factories\ChurchFactory> */
    use HasFactory;

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
