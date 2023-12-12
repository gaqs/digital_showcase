<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BusinessCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'business_id' => 1,
            'user_id' => 15,
            'comment' => fake()->text(500),
            'parent_comment' => fake()->randomNumber(2, true),
            'score' => fake()->randomFloat(1,0,5),
            'like_count' => fake()->randomNumber(2, true),
            'dislike_count' => fake()->randomNumber(2, true),
            'photos' => 0,
        ];
    }
}
