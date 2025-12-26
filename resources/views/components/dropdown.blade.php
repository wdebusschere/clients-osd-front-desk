@props([
    'align' => 'right',
    'dropdownClasses' => ''
])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'origin-top-left left-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'none':
        case 'false':
            $alignmentClasses = '';
            break;
        case 'right':
        default:
            $alignmentClasses = 'origin-top-right right-0';
            break;
    }
@endphp

<div {{ $attributes->merge(['class' => 'relative']) }}
     x-data="{ open: false }"
     @click.away="open = false"
     @close.stop="open = false">
    <div @click="open = ! open">
        @isset($trigger)
            {{ $trigger }}
        @else
            <button
                class="p-1 flex text-sm border-2 border-transparent rounded-full focus:outline-hidden focus:border-gray-900 dark:focus:border-slate-100 transition">
                <x-icons.outline.ellipsis-horizontal class="w-6 h-6"/>
            </button>
        @endisset
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute z-50 mt-2 rounded-md overflow-hidden bg-white dark:bg-slate-700 drop-shadow-md max-h-dvh overflow-y-auto {{ $alignmentClasses }}"
         style="display: none;"
         @click="open = false">
        <div {{ $content->attributes }}>
            {{ $content }}
        </div>
    </div>
</div>
