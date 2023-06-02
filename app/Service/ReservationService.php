<?php

namespace App\Service;

use App\Models\Reservation;
use App\Models\ReservationStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class ReservationService
{
    /**
     * @return Collection
     */
    public function getReservations(): Collection
    {
        //return Reservation::inRandomOrder()->limit(100)->get();
        return Reservation::all();
    }

    /**
     * @param int $id
     * @return Reservation
     * @throws ModelNotFoundException
     */
    public function getReservation(int $id)
    {
        return Reservation::findOrfail($id);
    }

    /**
     * @return Collection
     */
    public function getAllReservationStatus()
    {
        return ReservationStatus::all();
    }

    /**
     * @param int $userId
     * @param string $status
     * @param string $startTime
     * @param string $endTime
     * @return void
     * @throws Throwable
     */
    public function createReservation(int $userId, string $status, string $startTime, string $endTime)
    {
        $reservation = new Reservation();

        $reservation->user_id = $userId;
        $reservation->status = $status;
        $reservation->start_time = $startTime;
        $reservation->end_time = $endTime;

        $reservation->saveOrFail();
    }
}
