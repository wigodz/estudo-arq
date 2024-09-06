<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/presentes', [GiftController::class, 'show'])->name('presentes.index');
Route::post('/gift/{id}', [GiftController::class, 'update'])->name('update.gift');
Route::post('/create', [GiftController::class, 'store'])->name('create.gift');
Route::delete('/delete/{id}', [GiftController::class, 'delete'])->name('delete.gift');

Route::get('/home', [HomeController::class, 'show'])->name('home.index');



