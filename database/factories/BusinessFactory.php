<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'score' => fake()->numberBetween(0,5),
            'user_id' => fake()->numberBetween(1,20),
            'category_id' => fake()->numberBetween(1,21),
            'keywords' => fake()->words(4, true),
            'email' => fake()->email(),
            'email_2' => fake()->email(),
            'description' => fake()->realText(200, 2),
            'address' => fake()->streetAddress(),
            'phone' => fake()->e164PhoneNumber(),
            'phone_2' => fake()->e164PhoneNumber(),
            'web' => fake()->url(),
            'facebook' => fake()->url(),
            'instagram' => fake()->url(),
            'twitter' => fake()->url(),
            'tiktok' => fake()->url(),
            'mercadolibre' => fake()->url(),
            'yapo' => fake()->url(),
            'latitude' => fake()->latitude(-40.216944, -44.050278),
            'longitude' => fake()->longitude(-74.816944, -71.566944),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
