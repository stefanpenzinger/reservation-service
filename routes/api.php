<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::controller(ReservationController::class)->group(function () {
    Route::prefix('v1/reservations')->group(function () {
        Route::get('/','index');
        Route::post('/', 'create');
        Route::get('/status', 'getAllStatus');
        Route::prefix('{id}')->group(function () {
            Route::get('/', 'show');
            Route::patch('/', 'edit');
            Route::delete('/', 'destroy');
        });
    });
});

