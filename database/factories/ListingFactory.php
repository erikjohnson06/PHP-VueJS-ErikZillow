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
            'beds' => fake()->numberBetween(1,7),
            'baths' => fake()->numberBetween(1,7),
            'area' => fake()->numberBetween(100,500),
            'city' => fake()->city(),
            'zip' => fake()->postcode(),
            'address_1' => fake()->numberBetween(10,200),
            'address_2' => fake()->streetName(),
            'price' => fake()->numberBetween(50000,2000000)
        ];
    }
}
