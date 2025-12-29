@php
    $breadcrumbs = [
        trans_choice('app.delivery_receipts', 0) => route('delivery-receipts.index'),
    ];
@endphp
<x-app-layout :title="trans_choice('app.delivery_receipts', 0)">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs :items="$breadcrumbs"/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header :title="trans_choice('app.delivery_receipts', 0)"/>
    </x-slot:pageHeader>

    <x-ui.card>
        <x-slot:heading>
            @choice('app.lists', 1)
        </x-slot:heading>

        @can('create', \App\Models\DeliveryReceipt::class)
            <x-slot:headerActions>
                <a class="btn btn-primary" href="{{ route('delivery-receipts.create') }}">@lang('crud.create')</a>
            </x-slot:headerActions>
        @endcan

        <livewire:delivery-receipts.table/>
    </x-ui.card>
</x-app-layout>
