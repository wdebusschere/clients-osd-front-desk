@props(['color' => 'cyan'])

@php
    switch($color){
        case 'amber':
            $bgClass = 'bg-amber-500';
            break;
        case 'lime':
            $bgClass = 'bg-lime-500';
            break;
        case 'slate':
            $bgClass = 'bg-slate-400';
            break;
        case 'red':
            $bgClass = 'bg-red-700';
            break;
        default:
            $bgClass = 'bg-cyan-500';
            break;
    }
@endphp

<span {{ $attributes->merge(['class' => $bgClass.' whitespace-nowrap text-white text-xs font-medium mr-2 px-2 py-0.5 rounded-sm']) }}>
    {{ $slot }}
</span>
