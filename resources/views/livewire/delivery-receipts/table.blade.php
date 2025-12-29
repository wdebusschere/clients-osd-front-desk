<div>
    <div class="mb-6" x-data="{ filtersCollapsed: true }">
        <x-button type="button" @click="filtersCollapsed = !filtersCollapsed">
            <x-icons.outline.funnel class="w-4 h-4 mr-2"/> @choice('app.filters', 0)
        </x-button>

        <div class="my-6" x-show="!filtersCollapsed" x-collapse>
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 mb-3">
                <x-forms.input wire:model.live.debounce.300ms="search" :placeholder="trans('app.search').'...'"/>

                <x-forms.select wire:model.live="recipientTypeId">
                    <option value="" selected>@choice('app.recipient_types', 0)</option>
                    @include('partials.selectors.recipient-types')
                </x-forms.select>

                <x-forms.select wire:model.live="userId">
                    <option value="" selected>@choice('app.users', 0)</option>
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

    @if(!$deliveryReceipts->count())
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
                        @include('livewire.tables.partials.col-header', ['title' => trans_choice('app.volumes', 1), 'orderBy' => 'volumes'])
                        @include('livewire.tables.partials.col-header', ['title' => trans_choice('app.recipient_types', 1)])
                        @include('livewire.tables.partials.col-header', ['title' => trans_choice('app.users', 1)])
                        @include('livewire.tables.partials.col-header', ['title' => trans_choice('app.dates', 1), 'orderBy' => 'created_at'])
                        @include('livewire.tables.partials.col-header', ['class' => 'w-0'])
                    </tr>
                </thead>
                <tbody>
                    @foreach($deliveryReceipts as $deliveryReceipt)
                        <tr wire:key="dt-row-key-{{ $deliveryReceipt->id }}">
                            <td>{{ $deliveryReceipt->id }}</td>
                            <td>{{ $deliveryReceipt->volumes }}</td>
                            <td>{{ $deliveryReceipt->recipientType->name }}</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <img src="{{ $deliveryReceipt->user->profile_photo_url }}"
                                         alt="{{ $deliveryReceipt->user->name }}"
                                         class="rounded-full h-9 w-9 object-cover border border-gray-200 dark:border-transparent">
                                    {{ $deliveryReceipt->user->name }}
                                </div>
                            </td>
                            <td>@date($deliveryReceipt->created_at, 'L')</td>
                            <td class="text-right">
                                <div class="flex gap-1">
                                    @can('view', $deliveryReceipt)
                                        <a href="{{ route('delivery-receipts.show', $deliveryReceipt) }}"
                                           class="btn btn-sm">
                                            <x-icons.outline.eye class="w-4 h-4"/>
                                        </a>
                                    @endcan

                                    @can('update', $deliveryReceipt)
                                        <a href="{{ route('delivery-receipts.edit', $deliveryReceipt) }}"
                                           class="btn btn-sm">
                                            <x-icons.outline.pencil-square class="w-4 h-4"/>
                                        </a>
                                    @endcan

                                    @can('delete', $deliveryReceipt)
                                        <form method="POST"
                                              action="{{ route('delivery-receipts.destroy', $deliveryReceipt) }}"
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

        <x-ui.pagination-controls :collection="$deliveryReceipts" class="mt-4"/>
    @endif
</div>
