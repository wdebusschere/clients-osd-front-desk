<?php

namespace App\Providers;

use App\View\Composers\Selectors\RecipientTypesOptionsComposer;
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
        View::composer('partials.selectors.recipient-types', RecipientTypesOptionsComposer::class);
        View::composer('partials.selectors.users', UsersOptionsComposer::class);
    }
}
