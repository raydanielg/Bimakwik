<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('canAccess', function ($moduleCode, $permission = 'view') {
            if (!auth()->check()) {
                return false;
            }

            return auth()->user()->hasModulePermission($moduleCode, $permission);
        });

        Blade::if('role', function ($roleCode) {
            if (!auth()->check()) {
                return false;
            }

            return auth()->user()->hasRole($roleCode);
        });
    }
}
