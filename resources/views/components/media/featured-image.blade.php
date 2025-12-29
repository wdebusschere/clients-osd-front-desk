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
        <a class="btn btn-light" href="{{ route('media.render', $media) }}" target="_blank">@lang('crud.show')</a>
        <a class="btn btn-light" href="{{ route('media.download', $media) }}">@choice('app.downloads', 1)</a>
    </x-slot:footer>
</x-ui.card>
