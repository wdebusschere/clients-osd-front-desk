<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            $errors = [];

            if ($user && $user->active && Hash::check($request->password, $user->password)) {
                return $user;
            }

            if ($user && ! $user->active) {
                $errors[] = trans('auth.inactive');
            } else {
                $errors[] = trans('auth.failed');
            }

            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            RateLimiter::hit($throttleKey);

            $maxAttempts = config('fortify.throttling.login.max_attempts');

            $remainingAttempts = RateLimiter::remaining($throttleKey, $maxAttempts);

            $errors[] = trans_choice('auth.remaining_attempts', $remainingAttempts, ['attempts' => $remainingAttempts]);

            throw ValidationException::withMessages([Fortify::username() => $errors]);
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            $maxAttempts = config('fortify.throttling.login.max_attempts');

            return Limit::perMinute($maxAttempts)->by($throttleKey)
                ->response(function () use ($throttleKey) {
                    $seconds = RateLimiter::availableIn($throttleKey);

                    throw ValidationException::withMessages([
                        Fortify::username() => trans_choice('auth.throttle', $seconds, ['seconds' => $seconds]),
                    ]);
                });
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(config('fortify.throttling.two-factor.max_attempts'))
                ->by($request->session()->get('login.id'));
        });
    }
}
