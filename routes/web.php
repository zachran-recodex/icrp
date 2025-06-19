<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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
});

require __DIR__.'/auth.php';
