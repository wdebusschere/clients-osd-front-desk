@props([
    'heading' => null,
    'title' => null,
])
<x-ui.panel :attributes="$attributes">
    {{ $image ?? '' }}

    @if(isset($heading) || isset($headerActions))
        <div class="flex items-center justify-between py-4 px-5 border-b border-gray-200 dark:border-slate-600">
            @isset($heading)
                <div {{ $heading->attributes->class(['text-lg font-semibold text-gray-900 dark:text-slate-100']) }}>
                    {{ $heading }}
                </div>
            @endisset

            {{ $headerActions ?? '' }}
        </div>
    @endif

    <div class="p-5 grow">
        @isset($title)
            <div class="text-lg font-semibold">{{ $title }}</div>
        @endisset

        {{ $slot }}
    </div>

    @isset($footer)
        <div {{ $footer->attributes->merge(['class' => 'px-5 py-3 rounded-b-lg']) }}>
            {{ $footer }}
        </div>
    @endisset
</x-ui.panel>
