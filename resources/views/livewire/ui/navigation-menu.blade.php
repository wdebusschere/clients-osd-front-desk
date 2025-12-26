<nav x-data="{ open: false }">
    <div class="max-md:flex max-md:items-center max-md:justify-between md:mb-10">
        <div class="text-center">
            <a href="{{ route('dashboard') }}" class="inline-block">
                <x-application-mark/>
            </a>
        </div>

        {{-- Hamburger --}}
        <div class="-mr-2 flex items-center md:hidden">
            <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-slate-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-hidden focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                <x-icons.hamburguer class="w-6 h-6" x-show="!open"/>
                <x-icons.close class="w-6 h-6" x-show="open"/>
            </button>
        </div>
    </div>

    {{-- Navigation Links --}}
    <div class="space-y-3 hidden md:block mb-10">
        @include('layouts.partials.app-menu')
    </div>

    {{-- Responsive Navigation Menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="mt-6">
            @include('layouts.partials.app-menu')
        </div>
    </div>
</nav>
