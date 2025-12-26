@props([
    'type' => null,
    'boxClasses' => null,
    'headingClasses' => null,
    'collapsed' => false,
    'title'
])

@php
    switch($type){
        case 'info':
            $boxClasses = 'border-cyan-400';
            $headingClasses = 'text-cyan-500';
            break;
        case 'success':
            $boxClasses = 'border-teal-400';
            $headingClasses = 'text-teal-500';
            break;
        case 'warning':
            $boxClasses = 'border-amber-400';
            $headingClasses = 'text-amber-500';
            break;
        case 'error':
            $boxClasses = 'border-red-400';
            $headingClasses = 'text-red-500';
            break;
    }
@endphp

<x-ui.panel
    {{ $attributes->merge(['class' => $boxClasses.' border p-4']) }} x-data="{ expanded: {{ $collapsed ? 'false' : 'true' }} }">
    @isset($title)
        <div class="flex items-center justify-between text-lg font-semibold mb-2 {{ $headingClasses }}">
            {{ $title }}

            @if($collapsed !== null)
                <button @click="expanded = ! expanded">
                    <x-icons.outline.arrow-down-circle class="w-6 h-6" x-show="!expanded"/>
                    <x-icons.outline.arrow-up-circle class="w-6 h-6" x-show="expanded"/>
                </button>
            @endif
        </div>
    @endisset

    <div x-show="expanded" x-collapse>
        {{ $slot }}
    </div>
</x-ui.panel>
