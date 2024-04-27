<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\schedulepickupController;
use App\Http\Middleware\AuthenticatingMiddleware;

Route::middleware(AuthenticatingMiddleware::class)->group(function () {
    Route::get('/', [AuthController::class, 'login']);
    Route::post('/', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registration']);
});

Route::get('logout', [AuthController::class, 'logout']);

Route::get('home', [UserController::class, 'getHome']);
Route::get('dashboard', [AdminController::class, 'getDashboard']);

Route::get('order', [UserController::class, 'createOrder']);
Route::post('order', [UserController::class, 'submitOrder'])->name('order');

Route::get('history', [UserController::class, 'getHistory']);
Route::get('history', [schedulepickupController::class, 'getHistory']);

Route::get('redeemspoints', [UserController::class, 'getRedeemspoints']);