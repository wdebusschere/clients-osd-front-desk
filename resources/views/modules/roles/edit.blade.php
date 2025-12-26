@php
    $breadcrumbs = [
        trans_choice('app.roles', 0) => route('roles.index'),
        trans('crud.edit') => null,
    ];
@endphp
<x-app-layout :title="trans('crud.edit_resource', ['resource' => trans_choice('app.roles', 1)])">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs :items="$breadcrumbs"/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header :title="trans('crud.edit_resource', ['resource' => trans_choice('app.roles', 1)])"/>
    </x-slot:pageHeader>

    <form action="{{ route('roles.update', $role) }}" method="POST">
        @method('PATCH')

        <x-ui.card>
            <x-slot:heading>
                @lang('crud.edit'): @choice('app.roles', 1) #{{ $role->id }}
            </x-slot:heading>

            <x-slot:headerActions>
                <a class="btn btn-light" href="{{ route('roles.index') }}">
                    @lang('crud.cancel')
                </a>
            </x-slot:headerActions>

            @include('modules.roles.partials.form')

            <x-slot:footer>
                <x-button>
                    @lang('crud.save')
                </x-button>
            </x-slot:footer>
        </x-ui.card>
    </form>
</x-app-layout>
