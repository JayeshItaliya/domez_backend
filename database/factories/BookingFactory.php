<?php

namespace Database\Factories;

use Carbon\Carbon;
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
        $randomDate = Carbon::now()->subDays(rand(1, 365));
        // For Domes Booking Only
        // return [
        //     "type" => 1,
        //     "vendor_id" => 2,
        //     "dome_id" => $this->faker->numberBetween(35,39),
        //     "user_id" => $this->faker->numberBetween(3,13),
        //     "sport_id" => $this->faker->numberBetween(6,10),
        //     "field_id" => $this->faker->numberBetween(1,5),
        //     "booking_id" => $this->faker->numberBetween(111111,999999),
        //     "customer_name" => $this->faker->name(),
        //     "customer_email" => $this->faker->safeEmail,
        //     "customer_mobile" => $this->faker->phoneNumber,
        //     "payment_mode" => $this->faker->numberBetween(1,2),
        //     "players" => $this->faker->numberBetween(11,28),
        //     "booking_date" => $this->faker->date('Y-m-d'),
        //     "slots" => '06:30 AM - 07:30 AM',
        //     "start_time" => $this->faker->time('g:i A'),
        //     "end_time" => $this->faker->time('g:i A'),
        //     "total_amount" => $this->faker->numberBetween(9,99),
        //     "paid_amount" => $this->faker->numberBetween(9,49),
        //     "due_amount" => $this->faker->numberBetween(9,29),
        //     "payment_type" => $this->faker->numberBetween(1,2),
        //     "payment_status" => $this->faker->numberBetween(1,2),
        //     "booking_status" => $this->faker->numberBetween(1,2),
        // ];

        // For Leagues Booking Only
        return [
            "type" => 2,
            "vendor_id" => 2,
            "dome_id" => 37,
            "league_id" => 2,
            "user_id" => $this->faker->numberBetween(3, 13),
            "sport_id" => 7,
            "field_id" => 5,
            "booking_id" => $this->faker->numberBetween(111111, 999999),
            "booking_date" => $this->faker->dateTimeBetween($randomDate, 'now')->format('Y-m-d'),
            "customer_name" => $this->faker->name(),
            "customer_email" => $this->faker->safeEmail,
            "customer_mobile" => $this->faker->phoneNumber,
            "team_name" => 'Regular Old Football League',
            "players" => $this->faker->numberBetween(13,17),
            "players" => $this->faker->numberBetween(11, 28),
            "start_date" => '2023-03-10',
            "end_date" => '2023-04-10',
            "start_time" => '09:00 AM',
            "end_time" => '05:00 PM',
            "total_amount" => '1848',
            "payment_mode" => 1,
            "payment_type" => 1,
            "payment_status" => 1,
            "booking_status" => 1,
        ];
    }
}
