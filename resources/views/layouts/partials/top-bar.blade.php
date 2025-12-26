@props([
    'breadcrumbs' => ''
])
<x-ui.panel class="px-5 py-4 flex items-center justify-between">
    <div>
        {{ $breadcrumbs }}
    </div>

    <div class="flex items-center gap-4">
        <button @click="darkMode = !darkMode">
            <x-icons.outline.sun class="w-5 h-5" x-show="darkMode"/>
            <x-icons.outline.moon class="w-5 h-5" x-show="!darkMode"/>
        </button>

        {{-- Notifications Dropdown --}}
        <livewire:notifications.aside-panel/>
        {{-- Notifications Dropdown --}}

        <x-dropdown align="right">
            <x-slot:trigger>
                <livewire:ui.user-avatar/>
            </x-slot:trigger>

            <x-slot:content class="w-48">
                <div class="block px-4 py-2 text-xs text-gray-400">
                    @lang('app.manage_account')
                </div>

                <x-dropdown-link href="{{ route('profile.show') }}">
                    @lang('app.profile')
                </x-dropdown-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                        @choice('app.api_tokens', 0)
                    </x-dropdown-link>
                @endif

                <x-dropdown-separator/>

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-dropdown-link href="{{ route('logout') }}"
                                     @click.prevent="$root.submit();">
                        @lang('app.log_out')
                    </x-dropdown-link>
                </form>
            </x-slot:content>
        </x-dropdown>
    </div>
</x-ui.panel>
