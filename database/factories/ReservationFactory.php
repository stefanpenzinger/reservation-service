<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => $this->faker->randomElement(Customer::pluck('id')),
            'status' => $this->faker->randomElement(ReservationStatus::pluck('status')),
            'start_time' => $this->faker->dateTimeThisYear,
            'end_time' => $this->faker->dateTimeThisMonth,
        ];
    }
}
