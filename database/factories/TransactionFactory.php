<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "vendor_id" => $this->faker->numberBetween(2,2),
            "dome_id" => $this->faker->numberBetween(1,4),
            "user_id" => $this->faker->numberBetween(3,3),
            "field_id" => $this->faker->numberBetween(1,3),
            "booking_id" => $this->faker->numberBetween(111111,999999),
            "payment_method" => $this->faker->numberBetween(1,3),
            "transaction_id" => Str::random(10),
            "amount" => $this->faker->numberBetween(9,99),
        ];
    }
}
