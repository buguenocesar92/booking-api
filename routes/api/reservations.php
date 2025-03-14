<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::group(['prefix' => 'reservations'], function () {
/*     Route::get('/', [ReservationController::class, 'index'])->name('reservations.index'); */
    Route::post('/', [ReservationController::class, 'store'])->name('reservations.store');
/*     Route::get('/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::put('/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy'); */
    Route::get('/professionals/{id}/available-slots', [ReservationController::class, 'availableSlots'])
    ->name('reservations.available-slots');

    Route::middleware(['auth:api', 'check_route_permission'])
    ->get('/professional', [ReservationController::class, 'professionalReservations'])
    ->name('reservations.professional');

});
