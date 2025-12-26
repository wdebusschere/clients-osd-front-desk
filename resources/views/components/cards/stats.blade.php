@props(['type' => 'number', 'value', 'label'])
<x-ui.panel
    class="max-md:flex max-md:items-center max-md:justify-between max-md:flex-row-reverse text-center px-4 md:px-5 py-4 lg:py-6 xl:py-8">
    <div class="text-gray-900 dark:text-slate-100 text-3xl lg:text-4xl xl:text-5xl md:mb-5">
        @switch($type)
            @case('money')
                @money($value)
                @break
            @default
                {{ $value }}
                @break
        @endswitch
    </div>

    <div class="text-lg">
        {{ $label }}
    </div>
</x-ui.panel>
