<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Manually register livewire-quill component and views for cPanel deployment
        \Livewire\Livewire::component('livewire-quill', \Joelwmale\LivewireQuill\Http\Livewire\LivewireQuill::class);
        
        // Register the view namespace for livewire-quill
        $this->loadViewsFrom(base_path('vendor/joelwmale/livewire-quill/resources/views'), 'livewire-quill');
    }
}
