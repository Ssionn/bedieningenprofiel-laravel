<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Plan::factory(3)->create();

        User::factory(5)->create()->each(function (User $user): void {
            $user->plans()->attach(Plan::inRandomOrder()->first());
        });
    }
}
