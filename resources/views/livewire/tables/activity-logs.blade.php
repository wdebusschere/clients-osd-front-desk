<div>
    <div class="mb-6" x-data="{ filtersCollapsed: true }">
        <x-button type="button" @click="filtersCollapsed = !filtersCollapsed">
            <x-icons.outline.funnel class="w-4 h-4 mr-2"/> @choice('app.filters', 0)
        </x-button>

        <div class="my-6" x-show="!filtersCollapsed" x-collapse>
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 mb-3">
                <x-forms.date-picker :placeholder="trans('app.start_date')"
                                     x-on:change-date.camel="$wire.$set('startDate', event.target.value)"
                                     wire:model.live="startDate"/>

                <x-forms.date-picker :placeholder="trans('app.end_date')"
                                     x-on:change-date.camel="$wire.$set('endDate', event.target.value)"
                                     wire:model.live="endDate"/>

                <x-forms.select wire:model.live="userId">
                    <option value="" selected>@choice('app.users', 1)</option>
                    @foreach(\App\Models\User::orderBy('name')->pluck('name', 'id') as $userOptionId => $userOptionName)
                        <option value="{{ $userOptionId }}"
                                wire:key="dt-user-option-key-{{ $userOptionId }}">{{ $userOptionName }}</option>
                    @endforeach
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

    @if(!$activityLogs->count())
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
                        @include('livewire.tables.partials.col-header', ['title' => trans_choice('app.users', 1)])
                        @include('livewire.tables.partials.col-header', ['title' => trans('app.description')])
                        @include('livewire.tables.partials.col-header', ['title' => trans_choice('app.resources', 1)])
                        @include('livewire.tables.partials.col-header', ['title' => trans('app.id'), 'orderBy' => 'subject_id'])
                        @include('livewire.tables.partials.col-header', ['title' => trans_choice('app.dates', 1), 'orderBy' => 'created_at'])
                        @include('livewire.tables.partials.col-header')
                    </tr>
                </thead>
                <tbody>
                    @foreach($activityLogs as $activityLog)
                        <tr wire:key="dt-row-key-{{ $activityLog->id }}">
                            <td>{{ $activityLog->id }}</td>
                            <td>
                                @if($activityLog->causer !== null)
                                    <div class="flex gap-3 items-center">
                                        <img class="block rounded-full w-8 h-8 object-cover"
                                             alt="{{ $activityLog->causer->name }}"
                                             src="{{ $activityLog->causer->profile_photo_url }}"/>
                                        {{ $activityLog->causer->name }}
                                    </div>
                                @else
                                    <i class="text-muted">@lang('app.system')</i>
                                @endif
                            </td>
                            <td>
                                {{ $activityLog->description }}
                            </td>
                            <td>@choice('app.'.$activityLog->getResourceName(), 1)</td>
                            <td>{{ $activityLog->subject_id }}</td>
                            <td>@datetime($activityLog->created_at)</td>
                            <td class="text-right">
                                @if(count($activityLog->changes()['old'] ?? []))
                                    <button type="button" class="btn btn-sm"
                                            wire:click="openUpdatesModal({{ $activityLog->id }})">
                                        <x-icons.outline.clipboard-document-list class="w-4 h-4"/>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-ui.pagination-controls :collection="$activityLogs" class="mt-4"/>
    @endif

    @teleport('body')
    <x-dialog-modal wire:model="updatesModalVisible">
        <x-slot:title>
            <div class="text-2xl font-medium">
                @choice('app.updates', 0): @choice('app.activity_logs', 1)

                @if($selectedActivityLog !== null)
                    #{{ $selectedActivityLog->id }}
                @endif
            </div>
        </x-slot:title>

        @if($selectedActivityLog !== null)
            <table class="table">
                <thead>
                    <tr>
                        <th>@choice('app.attributes', 1)</th>
                        <th>@lang('app.from')</th>
                        <th class="w-0">
                            <x-icons.outline.arrow-long-right class="w-4 h-4"/>
                        </th>
                        <th>@lang('app.to')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($selectedActivityLog->changes()['old'] ?? [] as $attribute => $value)
                        <tr>
                            <td>{{ $attribute }}</td>
                            <td>{{ $value }}</td>
                            <td class="w-0">
                                <x-icons.outline.arrow-long-right class="w-4 h-4"/>
                            </td>
                            <td>{{ $selectedActivityLog->changes()['attributes'][$attribute] ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <x-slot:footer>
            <div class="gap-2">
                <x-secondary-button wire:click="$set('updatesModalVisible', false)">
                    @lang('app.close')
                </x-secondary-button>
            </div>
        </x-slot:footer>
    </x-dialog-modal>
    @endteleport
</div>
