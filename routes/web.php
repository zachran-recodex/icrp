<?php

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

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
