<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Service\ReservationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class ReservationController extends Controller
{
    public function index()
    {
        $reservationService = new ReservationService();

        return $reservationService->getReservations();
    }

    public function indexStatus()
    {
        $reservationService = new ReservationService();

        return $reservationService->getAllReservationStatus();
    }

    /**
     * @return Response
     */
    public function create(CreateReservationRequest $request)
    {
        try {
            $request->validated($request->all());
            $reservationService = new ReservationService();

            $data = request()->all();

            $reservationService->createReservation(
                $data['user_id'],
                $data['status'],
                $data['end_time'],
                $data['start_time']
            );

            return \response([], ResponseAlias::HTTP_CREATED);
        } catch (ModelNotFoundException $mnfe) {
            Log::error($mnfe);
            return response("Invalid status", ResponseAlias::HTTP_NOT_FOUND);
        } catch (\Exception|Throwable $e) {
            Log::error($e);
            return response("Server Error", ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update()
    {
        try {
            $reservationService = new ReservationService();
            $data = request()->all();

            $reservationService->updateReservation(
                $data['reservation_id'],
                $data['status'],
                $data['end_time'],
                $data['start_time']
            );

            return \response();
        } catch (ModelNotFoundException $mnfe) {
            Log::error($mnfe);
            return response("Reservation not found.", ResponseAlias::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            Log::error($e);
            return response("Server Error.", ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $reservationService = new ReservationService();
            $reservationService->deleteReservation($id);

            return \response();
        } catch (ModelNotFoundException $mnfe) {
            Log::error($mnfe);
            return response("Reservation not found.", ResponseAlias::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            Log::error($e);
            return response("Server Error.", ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $reservationService = new ReservationService();

            return $reservationService->getReservationById($id);
        } catch (ModelNotFoundException $mnfe) {
            Log::error($mnfe);
            return response("Reservation not found.", ResponseAlias::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            Log::error($e);
            return response("Server Error.", ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function customerReservations(int $customerId)
    {
        try {
            $reservationService = new ReservationService();

            return $reservationService->getReservationsByCustomerId($customerId);
        } catch (Throwable $e) {
            Log::error($e);
            return response("Server Error.", ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
