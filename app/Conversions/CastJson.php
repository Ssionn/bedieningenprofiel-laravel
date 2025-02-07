<?php

namespace App\Conversions;

use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CastJson
{
    public static function convert($json): Expression
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception('A valid JSON string was not provided.');
        }

        return DB::raw("CAST('{$json}' AS JSON)");
    }
}
