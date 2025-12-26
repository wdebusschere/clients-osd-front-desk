<?php

namespace App\Providers;

use App\Policies\DatabaseNotificationPolicy;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
        Gate::policy(DatabaseNotification::class, DatabaseNotificationPolicy::class);
    }
}
