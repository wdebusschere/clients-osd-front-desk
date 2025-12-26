@props(['item', 'key'])
<div {{ $attributes->merge(['class' => 'rounded-lg shadow-lg overflow-hidden']) }}>
    <div class="relative cursor-pointer overflow-hidden bg-gray-600 dark:bg-slate-500 h-44 sm:h-36">
        @if(strpos($item->mime_type, 'image') !== false)
            <div class="h-full" x-on:click="openGallery({{ $key }})">
                <div class="absolute top right-0 p-1 bg-opacity-50 bg-black rounded-bl-md z-10">
                    <x-icons.outline.magnifying-glass-plus class="w-5 h-5 text-white"/>
                </div>

                <img
                    class="hover:scale-110 transition-scale duration-300 object-cover h-full w-full"
                    src="{{ $item->route }}" alt="{{ $item->file_name }}">
            </div>
        @else
            <a class="h-full w-full flex items-center justify-center hover:scale-110 transition-scale duration-300" href="{{ $item->download_route }}" target="_blank">
                <x-icons.outline.arrow-down-tray class="w-14 h-14 text-white"/>
            </a>
        @endif
    </div>

    <div class="bg-gray-50 dark:bg-slate-700 py-2 px-4">
        <div class="flex items-center justify-between gap-2 text-sm">
            <div class="font-semibold truncate">
                {{ $item->file_name }}
            </div>

            <div class="shrink-0 text-muted">
                {{ $item->size }} KB
            </div>
        </div>
    </div>
</div>
