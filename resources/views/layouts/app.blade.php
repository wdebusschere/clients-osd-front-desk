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
    <body class="font-sans antialiased text-gray-600 dark:text-slate-400 bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen p-4 flex max-md:flex-col gap-5 md:gap-8">
            <x-ui.panel class="md:w-48 lg:w-56 p-5 shrink-0">
                <livewire:ui.navigation-menu/>
            </x-ui.panel>

            <div class="flex flex-col flex-1 md:w-52 lg:w-44 gap-5 md:gap-8">
                @include('layouts.partials.top-bar')

                {{ $pageHeader ?? '' }}

                <x-banner/>

                <main class="grow">
                    {{ $slot }}
                </main>

                <div class="flex items-center justify-between text-sm text-muted">
                    <div>
                        <a class="link" href="https://www.originalspotdesign.pt" target="_blank">Originalspotdesign</a>
                        &copy; {{ date('Y') }}. {{ __("All rights reserved.") }}
                    </div>
                </div>
            </div>
        </div>

        @stack('modals')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

        @livewireScriptConfig
        @stack('scripts')
    </body>
</html>
