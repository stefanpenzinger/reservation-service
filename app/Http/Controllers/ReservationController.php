<?php

namespace App\Http\Controllers;

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

    public function getAllStatus()
    {
        $reservationService = new ReservationService();

        return $reservationService->getAllReservationStatus();
    }

    /**
     * @return Response
     */
    public function create()
    {
        try {
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
            return response("", ResponseAlias::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            Log::error($e);
            return response($e, ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(int $id)
    {

    }

    public function destroy(int $id)
    {

    }

    public function show(int $id)
    {
        try {
            $reservationService = new ReservationService();

            return $reservationService->getReservation($id);
        } catch (ModelNotFoundException $mnfe) {
            return response()->setStatusCode(ResponseAlias::HTTP_NOT_FOUND);
        }
    }
}
