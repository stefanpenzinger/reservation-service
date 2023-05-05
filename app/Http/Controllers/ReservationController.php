<?php

namespace App\Http\Controllers;

use App\Service\ReservationService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ReservationController extends Controller
{
    public function index() {
        $reservationService = new ReservationService();

        return $reservationService->getReservations();
    }

    public function getAllStatus() {
        $reservationService = new ReservationService();

        return $reservationService->getAllReservationStatus();
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function create(Request $request) {
        try {
            $data = $request->all();
            $reservationService = new ReservationService();

            $reservationService->createReservation(
                $data['customerId'],
                $data['status'],
                $data['startDate'],
                $data['endDate']
            );

            return response()->setStatusCode(ResponseAlias::HTTP_OK);
        } catch (ModelNotFoundException $mnfe) {
            return response()->setStatusCode(ResponseAlias::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->setStatusCode(ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(int $id) {

    }

    public function destroy(int $id) {

    }

    public function show(int $id) {
        try {
            $reservationService = new ReservationService();

            return $reservationService->getReservation($id);
        } catch (ModelNotFoundException $mnfe) {
            return response()->setStatusCode(ResponseAlias::HTTP_NOT_FOUND);
        }
    }
}
