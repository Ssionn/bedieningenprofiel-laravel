<?php

namespace Database\Seeders;

use App\Enums\Locale;
use App\Models\Localization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class LocalesSeeder extends Seeder
{
    private readonly array $locales;

    public function __construct()
    {
        $this->locales = Locale::cases();
    }

    public function run(): void
    {
        foreach ($this->locales as $locale) {
            Localization::create([
                'language' => $locale->name,
                'locale' => $locale->value,
                'selected' => $locale->value === App::getLocale(),
                'user_id' => null,
            ]);
        }
    }
}
