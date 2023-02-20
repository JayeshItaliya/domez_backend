<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Domes>
 */
class DomesFactory extends Factory
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
            "sport_id" => $this->faker->numberBetween(1,5),
            "name" => 'Geodesic Dome Playground',
            "price" => $this->faker->numberBetween(50,99),
            "address" => '511 Notre Dame St, Summerside, PE, Canada',
            "pin_code" => 'C1N 1T2',
            "city" => 'Summerside',
            "state" => 'Prince Edward Island',
            "country" => 'Canada',
            "hst" => '5',
            "start_time" => $this->faker->time('g:i A'),
            "end_time" => $this->faker->time('g:i A'),
            "description" => 'DESCRIPTION',
            "lat" => '21.5821851121',
            "lng" => '22.11112845454',
            "benefits" => $this->faker->name(),
            "benefits_description" => 'benefits-DESCRIPTION',
        ];
    }
}
