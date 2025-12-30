@props([
    'title' => trans('app.featured_image'),
    'media'
])
<x-ui.card>
    <x-slot:heading>
        {{ $title }}
    </x-slot:heading>

    <div class="">
        <img
            class="w-full"
            src="{{ route('media.render', $media) }}" alt="{{ $media->file_name }}">
    </div>

    <x-slot:footer>
        <div class="flex flex-wrap items-center gap-2">
            <a class="btn btn-light gap-1" href="{{ route('media.render', $media) }}" target="_blank">
                <x-icons.outline.eye class="size-4"/>
                @lang('crud.show')
            </a>
            <a class="btn btn-light gap-1" href="{{ route('media.download', $media) }}">
                <x-icons.outline.arrow-down-tray class="size-4"/>
                @choice('app.downloads', 1)
            </a>
        </div>
    </x-slot:footer>
</x-ui.card>
