<?php

use App\Http\Controllers\DrawController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DrawController::class, 'user']);
Route::get('/admin', [DrawController::class, 'admin']);