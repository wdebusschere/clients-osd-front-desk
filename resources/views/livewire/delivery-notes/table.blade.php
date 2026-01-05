<div>
    @if(!$deliveryNotes->count())
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
                        @include('livewire.tables.partials.col-header', ['title' => trans('app.delivered_to')])
                        @include('livewire.tables.partials.col-header', ['title' => trans_choice('app.dates', 1), 'orderBy' => 'created_at'])
                    </tr>
                </thead>
                <tbody>
                    @foreach($deliveryNotes as $deliveryNote)
                        <tr wire:key="dt-row-key-{{ $deliveryNote->id }}">
                            <td>
                                <div class="flex items-center gap-3">
                                    <img src="{{ $deliveryNote->user->profile_photo_url }}"
                                         alt="{{ $deliveryNote->user->name }}"
                                         class="rounded-full h-9 w-9 object-cover border border-gray-200 dark:border-transparent">
                                    {{ $deliveryNote->user->name }}
                                </div>
                            </td>
                            <td>@date($deliveryNote->created_at)</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-ui.pagination-controls :collection="$deliveryNotes" class="mt-4"/>
    @endif
</div>
