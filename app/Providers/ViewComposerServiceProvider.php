<?php

namespace App\Providers;

use App\View\Composers\Selectors\LocationsOptionsComposer;
use App\View\Composers\Selectors\UsersOptionsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('partials.selectors.locations', LocationsOptionsComposer::class);
        View::composer('partials.selectors.users', UsersOptionsComposer::class);
    }
}
