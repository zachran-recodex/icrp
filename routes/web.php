<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Livewire\Volt\Volt;

Route::controller(MainController::class)->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('beranda');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('manage-hero', \App\Livewire\Dashboard\ManageHero::class)->name('manage-hero');
        Route::get('manage-articles', \App\Livewire\Dashboard\ManageArticles::class)->name('manage-articles');
        Route::get('manage-events', \App\Livewire\Dashboard\ManageEvents::class)->name('manage-events');
        Route::get('manage-founders', \App\Livewire\Dashboard\ManageFounders::class)->name('manage-founders');
        Route::get('manage-members', \App\Livewire\Dashboard\ManageMembers::class)->name('manage-members');
        Route::get('manage-libraries', \App\Livewire\Dashboard\ManageLibraries::class)->name('manage-libraries');
        Route::get('manage-call-to-action', \App\Livewire\Dashboard\ManageCallToAction::class)->name('manage-call-to-action');
        Route::get('manage-advocacies', \App\Livewire\Dashboard\ManageAdvocacies::class)->name('manage-advocacies');
        Route::get('manage-programs', \App\Livewire\Dashboard\ManagePrograms::class)->name('manage-programs');
    });

    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
});

require __DIR__.'/auth.php';
