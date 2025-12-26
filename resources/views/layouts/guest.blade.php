<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-cloak
      x-data="{darkMode: localStorage.getItem('darkMode') === 'true'}"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      x-bind:class="{'dark': darkMode}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
        <meta name="theme-color" content="#000000">
        <link rel="manifest" href="{{ asset('manifest.json') }}">

        <title>{{ config('app.name', 'Laravel') }}{{ !empty($title) ? ' - '.$title : '' }}</title>

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

        {{-- Scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Styles --}}
        @livewireStyles
    </head>
    <body class="font-sans antialiased text-gray-700 dark:text-slate-400 bg-white dark:bg-slate-900">
        <div class="min-h-screen m-0 flex justify-center flex-1">
            <div class="w-full lg:w-1/2 xl:w-1/3 py-20 px-12 sm:px-20">
                <div class="flex items-center justify-between mb-28">
                    <a href="{{ route('login') }}">
                        <x-application-mark/>
                    </a>

                    <div class="flex items-center gap-6">
                        <button @click="darkMode = !darkMode">
                            <x-icons.outline.sun class="w-6 h-6" x-show="darkMode"/>
                            <x-icons.outline.moon class="w-6 h-6" x-show="!darkMode"/>
                        </button>

                        <x-dropdown>
                            <x-slot:trigger>
                                <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-slate-400 bg-white dark:bg-slate-700 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-hidden focus:bg-gray-50 dark:focus:bg-slate-600 active:bg-gray-50 dark:active:bg-slate-600 transition ease-in-out duration-150">
                                    <x-icons.outline.flag
                                        class="w-4 h-4 mr-2"/> @lang('settings.locales.'.app()->getLocale())

                                    <x-icons.mini.chevron-up-down class="ms-2 -me-0.5 h-4 w-4"/>
                                </button>
                            </x-slot:trigger>

                            <x-slot:content>
                                @foreach (config('app.available_locales') as $locale)
                                    <x-dropdown-link href="?lang={{ $locale }}"
                                                     class="{{ app()->getLocale() === $locale ? 'bg-gray-100 dark:bg-slate-600' : ''}}">
                                        @lang('settings.locales.'.$locale)
                                    </x-dropdown-link>
                                @endforeach
                            </x-slot:content>
                        </x-dropdown>
                    </div>
                </div>

                {{ $slot }}
            </div>

            <div class="flex-1 text-white hidden lg:flex flex-col justify-center p-28 bg-cover"
                 style="background-image: url('{{ asset('images/guest-bg.webp') }}');">
            </div>
        </div>

        @livewireScriptConfig
    </body>
</html>
