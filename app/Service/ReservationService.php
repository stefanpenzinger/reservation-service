<?php

namespace App\Service;

use App\Models\Reservation;
use App\Models\ReservationStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReservationService
{
    /**
     * @return Collection
     */
    public function getReservations(): Collection
    {
        return Reservation::all();
    }

    /**
     * @param int $id
     * @throws ModelNotFoundException
     * @return Reservation
     */
    public function getReservation(int $id)
    {
        return Reservation::findOrfail($id);
    }

    /**
     * @return Collection
     */
    public function getAllReservationStatus() {
        return ReservationStatus::all();
    }

    /**
     * @param int $customerId
     * @param string $status
     * @param string $startDate
     * @param string $endDate
     * @return void
     */
    public function createReservation(int $customerId, string $status, string $startDate, string $endDate)
    {
        $customerService = new CustomerService();
        $customer = $customerService->getCustomer($customerId);

        $reservation = new Reservation();
        $reservation->customer()->save($customer);
    }
}
