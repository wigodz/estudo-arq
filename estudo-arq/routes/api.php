<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/user', [UserController::class, 'store']);

Route::post('/create-gift', [GiftController::class, 'store']);