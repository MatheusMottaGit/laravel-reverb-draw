<?php

use App\Http\Controllers\DrawController;
use Illuminate\Support\Facades\Route;

Route::post('/enter', [DrawController::class, 'enter']);
Route::post('/start', [DrawController::class, 'start']);