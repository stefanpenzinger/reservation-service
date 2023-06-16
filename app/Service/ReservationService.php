<?php

namespace App\Service;

use App\Models\Reservation;
use App\Models\ReservationStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class ReservationService
{
    /**
     * Return all reservations
     *
     * @return Collection
     */
    public function getReservations(): Collection
    {
        return Reservation::all();
    }

    /**
     * Return reservation by its id
     *
     * @param int $id
     * @return Builder|Model
     * @throws ModelNotFoundException
     */
    public function getReservationById(int $id): Model|Builder
    {
        return Reservation::query()->findOrfail($id);
    }

    /**
     * @param int $userId
     * @return Collection|Builder[]
     * @throws ModelNotFoundException
     */
    public function getReservationsByUserId(int $userId): Collection|array
    {
        return Reservation::query()->where('user_id', $userId)->get();
    }

    /**
     * Return all ReservationStatus
     *
     * @return Collection
     */
    public function getAllReservationStatus(): Collection
    {
        return ReservationStatus::all();
    }

    /**
     * Returns the created reservation
     *
     * @param int $userId
     * @param string $status
     * @param string $startTime
     * @param string $endTime
     * @return Reservation
     * @throws Throwable
     */
    public function createReservation(int $userId, string $status, string $startTime, string $endTime): Reservation
    {
        $reservation = new Reservation();

        $reservation->user_id = $userId;
        $reservation->status = $status;
        $reservation->start_time = $startTime;
        $reservation->end_time = $endTime;

        $reservation->saveOrFail();

        return $reservation;
    }

    /**
     * Updates the reservation by its id and the data given
     *
     * @param int $id
     * @param string $status
     * @param string $startTime
     * @param string $endTime
     * @return void
     * @throws Throwable
     */
    public function updateReservation(int $id, string $status, string $startTime, string $endTime): void
    {
        $reservation = Reservation::query()->findOrFail($id);

        $reservation->status = $status;
        $reservation->start_time = $startTime;
        $reservation->end_time = $endTime;

        $reservation->saveOrFail();
    }

    /**
     * Deletes the reservation by its id
     *
     * @param int $id
     * @return void
     * @throws Throwable
     */
    public function deleteReservation(int $id): void
    {
        $reservation = Reservation::query()->findOrFail($id);
        $reservation->deleteOrFail();
    }
}
