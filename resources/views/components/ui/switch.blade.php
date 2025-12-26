@props([
    'onColor' => '',
    'offColor' => 'bg-gray-300 dark:bg-gray-700',
])


@php
    switch($onColor){
        case 'amber':
            $onBgClass = 'peer-checked:bg-amber-500 peer-checked:ring-amber-500 peer-focus:ring-amber-500';
            break;
        case 'lime':
            $onBgClass = 'peer-checked:bg-lime-500 peer-checked:ring-lime-500 peer-focus:ring-lime-500';
            break;
        case 'slate':
            $onBgClass = 'peer-checked:bg-slate-400 peer-checked:ring-slate-400 peer-focus:ring-slate-400';
            break;
        default:
            $onBgClass = 'peer-checked:bg-cyan-500 peer-checked:ring-cyan-500 peer-focus:ring-cyan-500';
            break;
    }

    switch($offColor){
        case 'amber':
            $offBgClass = 'bg-amber-500';
            break;
        case 'lime':
            $offBgClass = 'bg-lime-500';
            break;
        case 'slate':
            $offBgClass = 'bg-slate-400';
            break;
        default:
            $offBgClass = 'bg-gray-300 dark:bg-gray-700';
            break;
    }
@endphp

<label class="inline-flex items-center gap-2 cursor-pointer w-fit">
    <div class="relative flex items-center">
        <input type="checkbox" id="ui-switch-{{ uniqid() }}" class="sr-only peer" {{ $attributes }}>

        <div
            class="w-9 h-5 transition-colors duration-300 peer-disabled:cursor-not-allowed peer-focus:outline-hidden rounded-full transition-all peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all after:drop-shadow-sm peer-focus:ring-1 peer-focus:ring-offset-2 peer-focus:ring-offset-gray-50 dark:peer-focus:ring-offset-slate-600 {{ $offBgClass }} {{ $onBgClass }}"></div>
    </div>

    {{ $label ?? null }}
</label>
