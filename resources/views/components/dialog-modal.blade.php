@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <x-ui.card class="flex flex-col max-h-full shadow shadow-lg! overflow-hidden">
        <x-slot:heading class="shrink-0">
            {{ $title }}
        </x-slot:heading>

        <div class="overflow-y-auto">
            {{ $slot }}
        </div>

        @isset($footer)
            <x-slot:footer class="shrink-0 flex items-center justify-end gap-1">
                {{ $footer }}
            </x-slot:footer>
        @endisset
    </x-ui.card>
</x-modal>
