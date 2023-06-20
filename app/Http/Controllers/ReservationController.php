<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Service\ReservationService;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class ReservationController extends Controller
{
    use HttpResponses;

    /**
     * Retrieve all reservations
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $reservationService = new ReservationService();
            return $this->success($reservationService->getReservations());
        } catch (Throwable $exception) {
            Log::error($exception);
            return $this->error([], 500, "Internal Server Error");
        }
    }

    /**
     * Retrieve all reservation status
     *
     * @return JsonResponse
     */
    public function indexStatus(): JsonResponse
    {
        try {
            $reservationService = new ReservationService();
            return $this->success($reservationService->getAllReservationStatus());
        } catch (Throwable $exception) {
            Log::error($exception);
            return $this->error([], 500, "Internal Server Error");
        }
    }

    /**
     * Create a reservation
     *
     * @param CreateReservationRequest $request the request with reservation data
     * @return JsonResponse
     */
    public function create(CreateReservationRequest $request): JsonResponse
    {
        try {
            $reservationData = request()->all();

            $request->validated($reservationData);
            $reservationService = new ReservationService();

            $reservation = $reservationService->createReservation(
                $reservationData['user_id'],
                $reservationData['status'],
                $reservationData['start_time'],
                $reservationData['end_time'],
                $reservationData['location'],
            );

            return $this->success($reservation, ResponseAlias::HTTP_CREATED, "Reservation created.");
        } catch (ModelNotFoundException $mnfe) {
            Log::error($mnfe);
            return $this->error([], ResponseAlias::HTTP_NOT_FOUND, "Invalid status");
        } catch (Exception|Throwable $e) {
            Log::error($e);
            return $this->error([], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, "Internal server error");
        }
    }

    /**
     * Update a reservation
     *
     * @param UpdateReservationRequest $request The request with the updated reservation data
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateReservationRequest $request, int $id): JsonResponse
    {
        try {
            $reservationData = request()->all();
            $request->validated($reservationData);

            $reservationService = new ReservationService();

            $reservationService->updateReservation(
                $id,
                $reservationData['status'],
                $reservationData['start_time'],
                $reservationData['end_time']
            );

            return $this->success([], ResponseAlias::HTTP_NO_CONTENT, "Reservation was updated");
        } catch (ModelNotFoundException $mnfe) {
            Log::error($mnfe);
            return $this->error([], ResponseAlias::HTTP_NOT_FOUND, "Reservation not found");
        } catch (Throwable $e) {
            Log::error($e);
            return $this->error([], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, "Internal server error");
        }
    }

    /**
     * Delete a reservation by its ID
     *
     * @param int $id the ID of the reservation
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $reservationService = new ReservationService();
            $reservationService->deleteReservation($id);

            return $this->success([], ResponseAlias::HTTP_NO_CONTENT, "Reservation was deleted");
        } catch (ModelNotFoundException $mnfe) {
            Log::error($mnfe);
            return $this->error([], ResponseAlias::HTTP_NOT_FOUND, "Reservation not found");
        } catch (Throwable $e) {
            Log::error($e);
            return $this->error([], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, "Internal server error");
        }
    }

    /**
     * Get a reservation by its id
     *
     * @param int $id the ID of the reservation
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $reservationService = new ReservationService();

            return $this->success($reservationService->getReservationById($id));
        } catch (ModelNotFoundException $mnfe) {
            Log::error($mnfe);
            return $this->error([], ResponseAlias::HTTP_NOT_FOUND, "Reservation not found");
        } catch (Throwable $e) {
            Log::error($e);
            return $this->error([], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, "Internal server error");
        }
    }

    /**
     * @param int $userId
     * @return JsonResponse
     */
    public function indexByUser(int $userId): JsonResponse
    {
        try {
            $reservationService = new ReservationService();

            return $this->success($reservationService->getReservationsByUserId($userId));
        } catch (Throwable $e) {
            Log::error($e);
            return $this->error([], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, "Internal server error");
        }
    }
}
