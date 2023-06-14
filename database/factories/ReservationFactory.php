<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
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
            'user_id' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(ReservationStatus::pluck('status')),
            'start_time' => $this->faker->dateTimeThisYear,
            'end_time' => $this->faker->dateTimeThisMonth,
        ];
    }
}
