@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <x-ui.card>
        <x-slot:heading>
            {{ $title }}
        </x-slot:heading>

        <x-slot:headerActions>
            <div class="shrink-0 flex items-center justify-center size-8 rounded-full bg-red-100">
                <x-icons.outline.exclamation-triangle class="size-5 text-red-500"/>
            </div>
        </x-slot:headerActions>

        {{ $slot }}

        @isset($footer)
            <x-slot:footer class="flex items-center justify-end gap-1">
                {{ $footer }}
            </x-slot:footer>
        @endisset
    </x-ui.card>
</x-modal>
