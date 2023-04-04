<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {

        $states = ['TN', 'KY', 'GA', 'SC', 'NC'];

        shuffle($states);

        return [
            'beds' => fake()->numberBetween(1, 7),
            'baths' => fake()->numberBetween(1, 7),
            'area' => fake()->numberBetween(2000, 5000),
            'address' => fake()->numberBetween(10, 200) . ' ' . fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode(),
            'state' => $states[0],
            'price' => fake()->numberBetween(50000, 1000000),
            'status_id' => 1,
            'comments' => ''
        ];
    }
}
