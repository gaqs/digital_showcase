<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'descripton' => fake()->text(),
            'price' => fake()->randomNumber(5, true),
            'score' => fake()->randomFloat(1,0,5),
            'mercadolibre' => fake()->url(),
            'facebook' => fake()->url(),
            'yapo' => fake()->url(),
            'web' => fake()->url(),
            'others' => json_encode('{"facebook":"'.fake()->url().'","instagram":"'.fake()->url().'","mercadolibre":"'.fake()->url().'"}'),
            'stock' => fake()->randomNumber(2, true),
        ];
    }
}
