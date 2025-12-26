<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPreferredLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = config('app.available_locales');

        $preferredLanguage = $this->clientLanguage($request);

        $matches = array_filter($availableLocales, function ($locale) use ($preferredLanguage) {
            return str_starts_with($locale, $preferredLanguage);
        });

        $matches = array_values($matches);

        $preferredLanguage = count($matches) ? array_shift($matches) : config('app.locale');

        Cookie::queue('preferred_language', $preferredLanguage);

        app()->setLocale($preferredLanguage);

        setlocale(LC_TIME, $preferredLanguage);

        return $next($request);
    }

    /**
     * Return the client language by checking the preferred language, according to a list of priorities:
     * 1 - URL parameter (?lang=LOCALE)
     * 2 - User session (preferred language)
     * 3 - Cookie
     * 4 - Browser settings
     *
     * @param $request
     * @return string|null
     */
    protected function clientLanguage($request): ?string
    {
        if ($request->has('lang')) {
            return $request->get('lang');
        }

        if (Auth::check()) {
            return auth()->user()->preferred_language;
        }

        if (Cookie::has('preferred_language')) {
            return Cookie::get('preferred_language');
        }

        return $request->getPreferredLanguage();
    }
}
