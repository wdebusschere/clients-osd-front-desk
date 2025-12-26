<x-ui.card>
    <x-slot:heading>
        @choice('app.lists', 1)
    </x-slot:heading>

    <x-slot:headerActions>
        <div class="flex gap-2">
            @can('importFromHQ', \App\Models\User::class)
                <form wire:submit.prevent="importFromHQ">
                    <x-button wire:loading.attr="disabled">
                        @lang('app.import_from_hq')
                    </x-button>
                </form>
            @endif

            @can('create', \App\Models\User::class)
                <a class="btn btn-primary" href="{{ route('users.create') }}">@lang('crud.create')</a>
            @endcan
        </div>
    </x-slot:headerActions>

    <div class="mb-6" x-data="{ filtersCollapsed: true }">
        <x-button type="button" @click="filtersCollapsed = !filtersCollapsed">
            <x-icons.outline.funnel class="w-4 h-4 mr-2"/> @choice('app.filters', 0)
        </x-button>

        <div class="my-6" x-show="!filtersCollapsed" x-collapse>
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 mb-3">
                <x-forms.input wire:model.live.debounce.300ms="search" :placeholder="trans('app.search').'...'"/>

                <x-forms.select wire:model.live="roleId">
                    <option value="" selected>@choice('app.roles', 1)</option>
                    @foreach(\App\Models\Role::pluck('name', 'id') as $roleOptionId => $roleOptionName)
                        <option value="{{ $roleOptionId }}"
                                wire:key="dt-role-option-key-{{ $roleOptionId }}">{{ $roleOptionName }}</option>
                    @endforeach
                </x-forms.select>

                <x-forms.select wire:model.live="active">
                    <option value="" selected>@choice('app.statuses', 1)</option>
                    @foreach(['inactive', 'active'] as $statusOptionKey => $statusOptionValue)
                        <option value="{{ $statusOptionKey }}"
                                wire:key="dt-status-option-key-{{ $statusOptionKey }}">@lang('app.'.$statusOptionValue)</option>
                    @endforeach
                </x-forms.select>
            </div>

            <x-secondary-button wire:click="resetFilters()">
                <x-icons.outline.arrow-path class="w-4 h-4 mr-1"/> @lang('crud.reset')
            </x-secondary-button>
        </div>
    </div>

    @if(!is_null($importedUsersCount))
        <div class="mb-6">
            <x-banner
                :message="trans_choice('crud.imported_resources', $importedUsersCount, ['resource' => strtolower(trans_choice('app.users', $importedUsersCount))])"/>
        </div>
    @endif

    <div class="h-0.5">
        <x-ui.progress class="rounded-none hidden h-full" wire:loading.class.remove="hidden" indeterminate/>
    </div>

    @if(!$users->count())
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
                        @include('livewire.tables.partials.col-header', ['title' => trans('app.email'), 'orderBy' => 'email'])
                        @include('livewire.tables.partials.col-header', ['title' => trans_choice('app.roles', 0)])
                        @include('livewire.tables.partials.col-header', ['title' => trans('app.active'), 'orderBy' => 'active'])
                        @include('livewire.tables.partials.col-header', ['class' => 'w-0'])
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr wire:key="dt-row-key-{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="flex gap-3 items-center">
                                    <img class="block rounded-full w-8 h-8 object-cover" alt="{{ $user->name }}"
                                         src="{{ $user->profile_photo_url }}"/>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <x-ui.badge>
                                        {{ $role->name }}
                                    </x-ui.badge>
                                @endforeach
                            </td>
                            <td>
                                <x-ui.switch wire:click="toggleActiveState({{ $user->id }})"
                                             wire:key="user-active-switch-{{ $user->id }}"
                                             wire:loading.attr="disabled"
                                             :checked="$user->active"
                                             :disabled="!auth()->user()->can('update', $user)"/>
                            </td>
                            <td class="text-right">
                                <div class="flex gap-1">
                                    @can('update', $user)
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm">
                                            <x-icons.outline.pencil-square class="w-4 h-4"/>
                                        </a>
                                    @endcan

                                    @can('delete', $user)
                                        <form method="POST" action="{{ route('users.destroy', $user) }}"
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

        <x-ui.pagination-controls :collection="$users" class="mt-4"/>
    @endif
</x-ui.card>
