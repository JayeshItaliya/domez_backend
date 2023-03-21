<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        $randomDate = Carbon::now()->subDays(rand(1, 365));
        return [
            "type" => 1,
            "vendor_id" => 1,
            "dome_id" => 51,
            "user_id" => $this->faker->numberBetween(3,16),
            "field_id" => 25,
            "booking_id" => $this->faker->numberBetween(111111,999999),
            "payment_method" => $this->faker->numberBetween(1,3),
            "transaction_id" => Str::random(10),
            "amount" => $this->faker->numberBetween(999,1999),
            "created_at" => $this->faker->dateTimeBetween($randomDate, 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
