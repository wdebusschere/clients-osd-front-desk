@php
    $breadcrumbs = [
        trans_choice('app.users', 0) => route('users.index'),
        trans('crud.edit') => null,
    ];
@endphp
<x-app-layout :title="trans('crud.edit_resource', ['resource' => trans_choice('app.users', 1)])">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs :items="$breadcrumbs"/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header :title="trans('crud.edit_resource', ['resource' => trans_choice('app.users', 1)])"/>
    </x-slot:pageHeader>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @method('PATCH')

        <x-ui.card>
            <x-slot:heading>
                @lang('crud.edit'): @choice('app.users', 1) #{{ $user->id }}
            </x-slot:heading>

            <x-slot:headerActions>
                <a class="btn btn-light" href="{{ route('users.index') }}">
                    @lang('crud.cancel')
                </a>
            </x-slot:headerActions>

            @include('modules.users.partials.form')

            <x-slot:footer>
                <x-button>
                    @lang('crud.save')
                </x-button>
            </x-slot:footer>
        </x-ui.card>
    </form>
</x-app-layout>
