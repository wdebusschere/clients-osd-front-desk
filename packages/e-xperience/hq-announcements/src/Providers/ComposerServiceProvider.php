<?php

namespace EXperience\HQAnnouncements\Providers;

use EXperience\HQAnnouncements\Http\View\Composers\HQAnnouncementsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        View::composer(['hqannouncements::list'], HQAnnouncementsComposer::class);
    }
}
