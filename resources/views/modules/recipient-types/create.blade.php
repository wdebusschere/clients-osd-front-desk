@php
    $breadcrumbs = [
        trans_choice('app.recipient_types', 0) => route('recipient-types.index'),
        trans('crud.create') => null,
    ];
@endphp
<x-app-layout :title="trans('crud.add_resource', ['resource' => trans_choice('app.recipient_types', 1)])">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs :items="$breadcrumbs"/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header :title="trans('crud.add_resource', ['resource' => trans_choice('app.recipient_types', 1)])"/>
    </x-slot:pageHeader>

    <form action="{{ route('recipient-types.store') }}" method="POST">
        <x-ui.card>
            <x-slot:heading>
                @lang('crud.create')
            </x-slot:heading>

            <x-slot:headerActions>
                <a class="btn btn-light" href="{{ route('recipient-types.index') }}">
                    @lang('crud.cancel')
                </a>
            </x-slot:headerActions>

            @include('modules.recipient-types.partials.form')

            <x-slot:footer>
                <x-button>
                    @lang('crud.save')
                </x-button>
            </x-slot:footer>
        </x-ui.card>
    </form>
</x-app-layout>
