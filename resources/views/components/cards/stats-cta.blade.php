@props([
    'title',
    'action',
    'route',
])
<a href="{{ $route }}">
    <x-ui.panel {{ $attributes->merge(['class' => 'flex flex-col p-6 ring-2 ring-transparent hover:ring-gray-200 dark:hover:ring-slate-700 transition-all duration-300']) }}>
        <div class="flex items-center gap-2 text-xl mb-6">
            {{ $title }}
        </div>

        <div class="mb-6 grow">
            {{ $slot }}
        </div>

        <div class="font-semibold text-black dark:text-white">
            {{ $action }} <x-icons.solid.arrow-long-right class="w-5 h-5"/>
        </div>
    </x-ui.panel>
</a>
