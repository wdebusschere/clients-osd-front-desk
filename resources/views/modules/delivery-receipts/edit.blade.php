@php
    $breadcrumbs = [
        trans_choice('app.delivery_receipts', 0) => route('delivery-receipts.index'),
        trans('crud.edit') => null,
    ];
@endphp
<x-app-layout :title="trans('crud.edit_resource', ['resource' => trans_choice('app.delivery_receipts', 1)])">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs :items="$breadcrumbs"/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header :title="trans('crud.edit_resource', ['resource' => trans_choice('app.delivery_receipts', 1)])"/>
    </x-slot:pageHeader>

    <form action="{{ route('delivery-receipts.update', $deliveryReceipt) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')

        <x-ui.card>
            <x-slot:heading>
                @lang('crud.edit'): @choice('app.delivery_receipts', 1) #{{ $deliveryReceipt->id }}
            </x-slot:heading>

            <x-slot:headerActions>
                <a class="btn btn-light" href="{{ route('delivery-receipts.index') }}">
                    @lang('crud.cancel')
                </a>
            </x-slot:headerActions>

            @include('modules.delivery-receipts.partials.form')

            <x-slot:footer>
                <x-button>
                    @lang('crud.save')
                </x-button>
            </x-slot:footer>
        </x-ui.card>
    </form>
</x-app-layout>
