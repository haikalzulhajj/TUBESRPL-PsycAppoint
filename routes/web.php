<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'login']);
Route::post('/', [AuthController::class, 'authenticating']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'registration']);
