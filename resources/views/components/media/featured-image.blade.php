@props(['item'])
<x-ui.card>
    <x-slot:heading>
        @lang('app.featured_image')
    </x-slot:heading>

    <div class="">
        <img
            class="h-full w-full"
            src="{{ $item->route }}" alt="{{ $item->file_name }}">
    </div>
</x-ui.card>
