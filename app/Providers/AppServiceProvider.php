<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\PageSetup;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
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
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        // Cache setting selama 2 jam (120 menit)
        $setting = Cache::remember('setting', 120, fn () => Setting::first());

        // Cache page setups
        $pageSetups = Cache::remember('page_setups', 120, function () {
            $allPageSetups = PageSetup::all();
            return $allPageSetups->keyBy('page');
        });

        // Share data ke semua views
        View::share([
            'setting' => $setting,
            'pageSetups' => $pageSetups,
        ]);
    }
}
