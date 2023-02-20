<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Field>
 */
class FieldFactory extends Factory
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
            "name" => $this->faker->name(),
            "area" => $this->faker->numberBetween(100,500),
            "min_person" => $this->faker->numberBetween(4,10),
            "max_person" => $this->faker->numberBetween(18,30),
            "image" => 'field-1135.jpg',
        ];
    }
}
