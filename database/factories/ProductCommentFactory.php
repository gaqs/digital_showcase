<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => fake()->numberBetween(1,3),
            'user_id' => fake()->numberBetween(1, 20),
            'comment' => fake()->text(300),
            'parent_comment' => fake()->numberBetween(1,100),
            'score' => fake()->randomFloat(1,0,5),
            'like_count' => fake()->numberBetween(0, 30),
            'dislike_count' => fake()->numberBetween(0, 30),
            'photos' => 0,
            'created_at' => fake()->dateTimeThisYear('+2 months'),
        ];
    }
}
