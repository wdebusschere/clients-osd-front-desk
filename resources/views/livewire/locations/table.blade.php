<div>
    <div class="mb-6" x-data="{ filtersCollapsed: true }">
        <x-button type="button" @click="filtersCollapsed = !filtersCollapsed">
            <x-icons.outline.funnel class="w-4 h-4 mr-2"/> @choice('app.filters', 0)
        </x-button>

        <div class="my-6" x-show="!filtersCollapsed" x-collapse>
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 mb-3">
                <x-forms.input wire:model.live.debounce.300ms="search" :placeholder="trans('app.search').'...'"/>

                <x-forms.select wire:model.live="responsibleId">
                    <option value="" selected>@lang('app.responsible')</option>
                    @include('partials.selectors.users')
                </x-forms.select>
            </div>

            <x-secondary-button wire:click="resetFilters()">
                <x-icons.outline.arrow-path class="w-4 h-4 mr-1"/> @lang('crud.reset')
            </x-secondary-button>
        </div>
    </div>

    <div class="h-0.5">
        <x-ui.progress class="rounded-none hidden h-full" wire:loading.class.remove="hidden" indeterminate/>
    </div>

    @if(!$locations->count())
        <x-ui.alert type="info" class="mt-2">
            <div class="flex items-center gap-2">
                <x-icons.outline.information-circle class="text-cyan-400"/>
                @lang('crud.no_records_found')
            </div>
        </x-ui.alert>
    @else
        <div class="relative overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        @include('livewire.tables.partials.col-header', ['title' => '#', 'class' => 'w-0', 'orderBy' => 'id'])
                        @include('livewire.tables.partials.col-header', ['title' => trans('app.name'), 'orderBy' => 'name'])
                        @include('livewire.tables.partials.col-header', ['title' => trans('app.responsible')])
                        @include('livewire.tables.partials.col-header', ['class' => 'w-0'])
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr wire:key="dt-row-key-{{ $location->id }}">
                            <td>{{ $location->id }}</td>
                            <td>{{ $location->name }}</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <img src="{{ $location->responsible->profile_photo_url }}"
                                         alt="{{ $location->responsible->name }}"
                                         class="rounded-full h-9 w-9 object-cover border border-gray-200 dark:border-transparent">
                                    {{ $location->responsible->name }}
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="flex gap-1">
                                    @can('update', $location)
                                        <a href="{{ route('locations.edit', $location) }}" class="btn btn-sm">
                                            <x-icons.outline.pencil-square class="w-4 h-4"/>
                                        </a>
                                    @endcan

                                    @can('delete', $location)
                                        <form method="POST"
                                              action="{{ route('locations.destroy', $location) }}"
                                              onsubmit="return confirm('{{ trans('crud.confirm_delete') }}')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm">
                                                <x-icons.outline.trash class="w-4 h-4"/>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-ui.pagination-controls :collection="$locations" class="mt-4"/>
    @endif
</div>
