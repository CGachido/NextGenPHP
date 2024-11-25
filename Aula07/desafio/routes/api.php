<?php

use App\Http\Controllers\CreateReservationController;
use App\Http\Controllers\GetReservationCostController;
use App\Http\Controllers\ReturnReservationController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UsersController::class, 'getAll']);

Route::post('/reservations', [CreateReservationController::class, 'create']);
Route::post('/reservations/return', [ReturnReservationController::class, 'saveReturn']);
Route::get('/reservations/cost', [GetReservationCostController::class, 'getCost']);
