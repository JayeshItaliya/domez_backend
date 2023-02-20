<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
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
            "user_id" => $this->faker->numberBetween(3,13),
            "sport_id" => $this->faker->numberBetween(6,10),
            "field_id" => $this->faker->numberBetween(1,5),
            "booking_id" => $this->faker->numberBetween(111111,999999),
            "customer_name" => $this->faker->name(),
            "customer_email" => $this->faker->safeEmail,
            "customer_mobile" => $this->faker->phoneNumber,
            "payment_mode" => $this->faker->numberBetween(1,2),
            "players" => $this->faker->numberBetween(11,28),
            "booking_date" => $this->faker->date('Y-m-d'),
            "slots" => '06:30 AM - 07:30 AM',
            "start_time" => $this->faker->time('g:i A'),
            "end_time" => $this->faker->time('g:i A'),
            "total_amount" => $this->faker->numberBetween(9,99),
            "paid_amount" => $this->faker->numberBetween(9,49),
            "due_amount" => $this->faker->numberBetween(9,29),
            "payment_type" => $this->faker->numberBetween(1,2),
            "payment_status" => $this->faker->numberBetween(1,2),
            "booking_status" => $this->faker->numberBetween(1,2),
        ];
    }
}
