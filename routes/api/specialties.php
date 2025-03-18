<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecialtyController;

Route::get('/specialties', [SpecialtyController::class, 'index'])->name('specialties.index');
