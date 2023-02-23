<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favourite>
 */
class FavouriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // For Domes
            // "user_id" => $this->faker->numberBetween(3,13),
            // "dome_id" => $this->faker->numberBetween(35,40),


            // For League
            "user_id" => $this->faker->numberBetween(3,13),
            "league_id" => $this->faker->numberBetween(1,5),
        ];
    }
}
