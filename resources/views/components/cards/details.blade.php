<x-ui.card {{ $attributes }}>
    <x-slot:heading>
        @choice('app.details', 0)
    </x-slot:heading>

    @isset($headerActions)
        <x-slot:headerActions>
            {{ $headerActions }}
        </x-slot:headerActions>
    @endisset

    <div>
        @if(isset($headline) || isset($headlineBadges))
            <div class="flex items-center gap-3 mb-5">
                @isset($headline)
                    <div class="font-normal text-3xl text-gray-600 dark:text-slate-400">
                        {{ $headline }}
                    </div>
                @endisset

                @isset($headlineBadges)
                    <div class="flex items-center gap-1">
                        {{ $headlineBadges }}
                    </div>
                @endisset
            </div>
        @endisset

        {{ $slot }}
    </div>

    @isset($model)
        <x-slot:footer>
            <div class="text-sm">
                <strong>@lang('crud.created_at'):</strong> @datetime($model->created_at)
            </div>

            <div class="text-sm">
                <strong>@lang('crud.updated_at'):</strong> @datetime($model->updated_at)
            </div>
        </x-slot:footer>
    @endisset
</x-ui.card>
