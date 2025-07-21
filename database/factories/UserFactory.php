<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $mediaFiles = array_merge(
            collect(range(1, 13))->map(fn($i) => "p{$i}.png")->toArray(),
        );
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => '' . $this->faker->numberBetween(100000000, 999999999),
            'password' => static::$password ??= Hash::make('password'),
            'img_path' => 'storage/uploads/' . $this->faker->randomElement($mediaFiles),
        ];
    }
}
