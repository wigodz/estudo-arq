<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', ['middleware' => 'auth:sanctum', 'uses' => 'App\Http\Controllers\LoginController@logout']);

Route::post('/user', [LoginController::class, 'register']);

Route::post('/create-gift', [GiftController::class, 'store']);
Route::post('/update-gift/{id}', [GiftController::class, 'update']);
Route::delete('/delete-gift/{id}', [GiftController::class, 'delete']);
Route::get('/show', [GiftController::class, 'show']);

Route::get('/home', [HomeController::class, 'show'])->name('home.index');
