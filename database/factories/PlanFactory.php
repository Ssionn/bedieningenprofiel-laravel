<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'free',
            'pro',
            'pro_plus',
        ]);

        return [
            'name' => $name,
            'price' => match ($name) {
                'free' => 0,
                'pro' => 4999,
                'pro_plus' => 9999,
            },
            'max_teams' => match ($name) {
                'free' => 1,
                'pro' => 5,
                'pro_plus' => 10,
            },
            'max_users_per_team' => match ($name) {
                'free' => 5,
                'pro' => 15,
                'pro_plus' => 30,
            },
        ];
    }
}
