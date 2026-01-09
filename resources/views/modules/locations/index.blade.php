@php
    $breadcrumbs = [
        trans_choice('app.locations', 0) => route('locations.index'),
    ];
@endphp
<x-app-layout :title="trans_choice('app.locations', 0)">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs :items="$breadcrumbs"/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header :title="trans_choice('app.locations', 0)"/>
    </x-slot:pageHeader>

    <x-ui.card>
        <x-slot:heading>
            @choice('app.lists', 1)
        </x-slot:heading>

        @can('create', \App\Models\Location::class)
            <x-slot:headerActions>
                <a class="btn btn-primary" href="{{ route('locations.create') }}">@lang('crud.create')</a>
            </x-slot:headerActions>
        @endcan

        <livewire:locations.table/>
    </x-ui.card>
</x-app-layout>
