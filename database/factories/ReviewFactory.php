<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "dome_id" => $this->faker->numberBetween(35,40),
            "user_id" => $this->faker->numberBetween(3,16),
            "ratting" => $this->faker->numberBetween(1,5),
            "comment" => 'Very Good Experience',
        ];
    }
}
