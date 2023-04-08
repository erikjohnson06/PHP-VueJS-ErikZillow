<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {

        return [
            'listing_id' => 1,
            'bidder_id' => 1,
            'amount' => fake()->numberBetween(50000, 1000000),
            'accepted_at' => NULL,
            'rejected_at' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL
        ];
    }
}
