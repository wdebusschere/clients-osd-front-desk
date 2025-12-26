<?php

namespace App\Providers;

use App\Actions\UpdateClientLocalizationInformation;
use App\Contracts\UpdatesClientLocalizationInformation;
use App\Oauth\OSDHQProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;

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
        $this->app->singleton(UpdatesClientLocalizationInformation::class, UpdateClientLocalizationInformation::class);

        Model::preventLazyLoading();

        JsonResource::withoutWrapping();

        Socialite::extend('osd-hq', function () {
            return Socialite::buildProvider(OSDHQProvider::class, config('services.osd-hq'));
        });
    }
}
