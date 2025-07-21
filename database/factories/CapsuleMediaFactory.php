<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CapsuleMedia>
 */
class CapsuleMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mediaFiles = array_merge(
            collect(range(1, 13))->map(fn($i) => "p{$i}.png")->toArray(),
            collect(range(1, 5))->map(fn($i) => "t{$i}.txt")->toArray(),
            collect(range(1, 3))->map(fn($i) => "v{$i}.mp4")->toArray()
        );

        return [
            "capsule_id" => rand(1,10),
            "file_path" => '/storage/uploads/' . $this->faker->randomElement($mediaFiles),
        ];
    }
}
