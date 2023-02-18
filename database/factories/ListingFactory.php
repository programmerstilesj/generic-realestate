<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'beds' => fake()->numberBetween(1, 6),
            'baths' => fake()->numberBetween(1, 6),
            'area' => fake()->numberBetween(300, 9000),
            'city' => fake()->city(),
            'code' => fake()->postcode(),
            'street' => fake()->streetName(),
            'street_num' => fake()->numberBetween(1000, 9999),
            'price' => fake()->numberBetween(100000, 10000000)
        ];
    }
}
