<?php

use App\Http\Controllers\DuvidasController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MensagensController;
use App\Http\Controllers\PresencaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    Route::post('/escolhe-presente', [GiftController::class, 'choseGift'])->name('chose.gift');
    Route::delete('/delete/{id}', [GiftController::class, 'deleteGift'])->name('delete.gift');
    Route::get('/presents/getCategoresGift', [GiftController::class, 'categoriesGift'])->name('categories.get');

    Route::get('/home', [HomeController::class, 'show'])->name('home.index');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/presenca', [PresencaController::class, 'index'])->name('presenca.index');
    Route::post('/presenca/update-convidado', [PresencaController::class, 'updateConvidado'])->name('presenca.update-convidado');
    Route::post('/presenca/update-presenca', [PresencaController::class, 'updatepresenca'])->name('presenca.update-presenca');

    Route::get('/duvidas', [DuvidasController::class, 'index']);

    Route::get('/admin', [UserController::class, 'adminView'])->name('admin.index');
    Route::post('/create-user', [UserController::class, 'store'])->name('admin.store');

    Route::get('/whatsapp-qr', function () {
        return view('whatsapp.qr');
    })->name('wpp.index');

    Route::get('/qr-proxy', function () {
        $qr = file_get_contents('http://67.205.128.65:3000/qr');
        return response($qr)->header('Content-Type', 'image/png');
    });
    Route::post('/envia-mensagens', [MensagensController::class, 'enviaMensagens'])->name('enviar.mensagem.massa');
});

require __DIR__.'/auth.php';
