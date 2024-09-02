<?php

use App\Http\Controllers\TransportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/calculate-route-price', [TransportController::class, 'calculateRoutePrice']);
