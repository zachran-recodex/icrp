<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Livewire\Volt\Volt;

Route::get('/', [MainController::class, 'index'])->name('beranda');

// Main pages routes
Route::get('/tentang', [MainController::class, 'tentang'])->name('tentang');
Route::get('/berita', [MainController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [MainController::class, 'beritaDetail'])->name('berita.detail');
Route::get('/pustaka', [MainController::class, 'pustaka'])->name('pustaka');
Route::get('/pustaka/{slug}', [MainController::class, 'pustakaDetail'])->name('pustaka.detail');
Route::get('/advokasi', [MainController::class, 'advokasi'])->name('advokasi');
Route::get('/advokasi/{slug}', [MainController::class, 'advokasiDetail'])->name('advokasi.detail');
Route::get('/pendiri', [MainController::class, 'pendiri'])->name('pendiri');
Route::get('/pendiri/{slug}', [MainController::class, 'pendiriDetail'])->name('pendiri.detail');
Route::get('/pengurus', [MainController::class, 'pengurus'])->name('pengurus');
Route::get('/pengurus/{slug}', [MainController::class, 'pengurusDetail'])->name('pengurus.detail');
Route::get('/jaringan', [MainController::class, 'jaringan'])->name('jaringan');
Route::get('/sahabat', [MainController::class, 'sahabat'])->name('sahabat');
Route::get('/kontak', [MainController::class, 'kontak'])->name('kontak');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('dashboard/manage-hero', \App\Livewire\Dashboard\ManageHero::class)->name('dashboard.manage-hero');
    Route::get('dashboard/manage-articles', \App\Livewire\Dashboard\ManageArticles::class)->name('dashboard.manage-articles');
    Route::get('dashboard/manage-events', \App\Livewire\Dashboard\ManageEvents::class)->name('dashboard.manage-events');
    Route::get('dashboard/manage-founders', \App\Livewire\Dashboard\ManageFounders::class)->name('dashboard.manage-founders');
    Route::get('dashboard/manage-members', \App\Livewire\Dashboard\ManageMembers::class)->name('dashboard.manage-members');
    Route::get('dashboard/manage-libraries', \App\Livewire\Dashboard\ManageLibraries::class)->name('dashboard.manage-libraries');
    Route::get('dashboard/manage-call-to-action', \App\Livewire\Dashboard\ManageCallToAction::class)->name('dashboard.manage-call-to-action');
    Route::get('dashboard/manage-advocacies', \App\Livewire\Dashboard\ManageAdvocacies::class)->name('dashboard.manage-advocacies');
});

require __DIR__.'/auth.php';
