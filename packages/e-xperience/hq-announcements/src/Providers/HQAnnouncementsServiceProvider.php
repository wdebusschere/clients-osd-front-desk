<?php

namespace EXperience\HQAnnouncements\Providers;

use Illuminate\Support\ServiceProvider;

class HQAnnouncementsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(ComposerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadFiles();

        $this->setPublishableFiles();
    }

    /**
     * Load migrations and resources.
     */
    private function loadFiles()
    {
        // Load views from custom path
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'hqannouncements');

        // Load translations from custom path
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'hqannouncements');
    }

    /**
     * Determines which files can be published.
     */
    private function setPublishableFiles()
    {
        // Publishes views
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/hqannouncements'),
        ], 'hq-announcements-views');
    }
}
