<?php

use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\DjohanEffendiController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('beranda');
    Route::get('/berita-artikel', 'berita')->name('berita');
    Route::get('/berita-artikel/{$slug}', 'beritaDetail')->name('berita.detail');
    Route::get('/tentang-kami', 'tentang')->name('tentang');
    Route::get('/pendiri', 'pendiri')->name('pendiri');
    Route::get('/pengurus', 'pengurus')->name('pengurus');
    Route::get('/sahabat', 'sahabat')->name('sahabat');
    Route::get('/jaringan', 'jaringan')->name('jaringan');
    Route::get('/pustaka', 'pustaka')->name('pustaka');
    Route::get('/kontak', 'kontak')->name('kontak');
});

Route::domain('djohan-effendi.' . env('APP_URL'))->group(function () {
    Route::get('/', [DjohanEffendiController::class, 'index'])->name('djohan-effendi');
});

Route::middleware('auth')->group(function () {

    Route::view('/dashboard', 'dashboard.index')->name('dashboard');

    Route::prefix('dashboard')->name('dashboard.')->group(function (){

        Route::view('/article', 'dashboard.article')->name('articles');

        Route::view('/event', 'dashboard.event')->name('events');

        Route::view('/founder', 'dashboard.founder')->name('founders');

        Route::view('/management', 'dashboard.management')->name('managements');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});



require __DIR__.'/auth.php';
