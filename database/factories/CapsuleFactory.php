<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Capsule>
 */
class CapsuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => rand(0,10),
            "name" => $this->faker->name(),
            "create_date" => $this->faker->date(),
            "open_date" => $this->faker->date(),
            "privacy" => rand(0,1) ? 'private' : 'public',
            "surprise" => rand(0,1)<.5
        ];
    }
}
