<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/presentes', [GiftController::class, 'show'])->name('presentes.index');
    Route::post('/gift/{id}', [GiftController::class, 'update'])->name('update.gift');
    Route::post('/create', [GiftController::class, 'store'])->name('create.gift');
    Route::delete('/delete/{id}', [GiftController::class, 'delete'])->name('delete.gift');
    Route::get('/home', [HomeController::class, 'show'])->name('home.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
