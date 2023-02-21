<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\League>
 */
class LeagueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "vendor_id" => 2,
            "dome_id" => $this->faker->numberBetween(35,39),
            "sport_id" => $this->faker->numberBetween(6,10),
            "field_id" => $this->faker->numberBetween(1,5),
            "name" => 'Regular Old Football League',
            "start_date" => '2023-03-10',
            "end_date" => '2023-04-10',
            "start_time" => '09:00 AM',
            "end_time" => '05:00 PM',
            "end_time" => '05:00 PM',
            "from_age" => $this->faker->numberBetween(12,20),
            "to_age" => $this->faker->numberBetween(21,30),
            "gender" => $this->faker->numberBetween(1,3),
            "min_player" => $this->faker->numberBetween(11,15),
            "max_player" => $this->faker->numberBetween(16,25),
            "team_limit" => $this->faker->numberBetween(11,15),
            "price" => $this->faker->numberBetween(999,1999),
        ];
    }
}
