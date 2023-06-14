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
    public function getReservationById(int $id)
    {
        return Reservation::findOrfail($id);
    }

    /**
     * @param int $userId
     * @return Reservation
     * @throws ModelNotFoundException
     */
    public function getReservationsByCustomerId(int $userId)
    {
        return Reservation::where('user_id', $userId)->get();
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

    /**
     * @param int $reservationId
     * @param string $status
     * @param string $startTime
     * @param string $endTime
     * @return void
     */
    public function updateReservation(int $reservationId, string $status, string $startTime, string $endTime)
    {
        $reservation = Reservation::findOrFail($reservationId);

        $reservation->status = $status;
        $reservation->start_time = $startTime;
        $reservation->end_time = $endTime;

        $reservation->saveOrFail();
    }

    /**
     * @param int $reservationId
     * @return void
     * @throws Throwable
     */
    public function deleteReservation(int $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        $reservation->deleteOrFail();
    }
}
