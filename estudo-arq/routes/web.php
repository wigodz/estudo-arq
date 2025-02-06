<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresencaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/presentes', [GiftController::class, 'show'])->name('presentes.index');
    Route::get('/presents/getGift', [GiftController::class, 'getGifts'])->name('presentes.get');
    Route::post('/gift/{id}', [GiftController::class, 'update'])->name('update.gift');
    Route::post('/create', [GiftController::class, 'store'])->name('create.gift');
    Route::delete('/delete/{id}', [GiftController::class, 'delete'])->name('delete.gift');
    Route::get('/home', [HomeController::class, 'show'])->name('home.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/presenca', [PresencaController::class, 'index'])->name('presenca.index');
    Route::post('/presenca/update-convidado', [PresencaController::class, 'updateConvidado'])->name('presenca.update-convidado');
    Route::post('/presenca/update-presenca', [PresencaController::class, 'updatepresenca'])->name('presenca.update-presenca');

});

require __DIR__.'/auth.php';
