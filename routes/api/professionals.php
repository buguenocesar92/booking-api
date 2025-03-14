<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionalController;

Route::group(['prefix' => 'professionals'], function () {
    Route::get('/', [ProfessionalController::class, 'index'])->name('professionals.index');
/*     Route::post('/', [ProfessionalController::class, 'store'])->name('professionals.store'); */
    Route::get('/{professional}', [ProfessionalController::class, 'show'])->name('professionals.show');
/*     Route::put('/{professional}', [ProfessionalController::class, 'update'])->name('professionals.update');
    Route::delete('/{professional}', [ProfessionalController::class, 'destroy'])->name('professionals.destroy'); */
});
