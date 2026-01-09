@php
    $breadcrumbs = [
        trans_choice('app.locations', 0) => route('locations.index'),
        trans('crud.edit') => null,
    ];
@endphp
<x-app-layout :title="trans('crud.edit_resource', ['resource' => trans_choice('app.locations', 1)])">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs :items="$breadcrumbs"/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header :title="trans('crud.edit_resource', ['resource' => trans_choice('app.locations', 1)])"/>
    </x-slot:pageHeader>

    <form action="{{ route('locations.update', $location) }}" method="POST">
        @method('PATCH')

        <x-ui.card>
            <x-slot:heading>
                @lang('crud.edit'): @choice('app.locations', 1) #{{ $location->id }}
            </x-slot:heading>

            <x-slot:headerActions>
                <a class="btn btn-light" href="{{ route('locations.index') }}">
                    @lang('crud.cancel')
                </a>
            </x-slot:headerActions>

            @include('modules.locations.partials.form')

            <x-slot:footer>
                <x-button>
                    @lang('crud.save')
                </x-button>
            </x-slot:footer>
        </x-ui.card>
    </form>
</x-app-layout>
