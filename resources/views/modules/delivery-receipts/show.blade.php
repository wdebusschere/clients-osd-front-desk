@php
    $breadcrumbs = [
        trans_choice('app.delivery_receipts', 0) => route('delivery-receipts.index'),
        trans('crud.show') => null,
    ];
@endphp
<x-app-layout :title="trans('crud.show_resource', ['resource' => trans_choice('app.delivery_receipts', 1)])">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs :items="$breadcrumbs"/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header
            :title="trans('crud.show_resource', ['resource' => trans_choice('app.delivery_receipts', 1)])"/>
    </x-slot:pageHeader>

    <x-show-sections>
        <x-cards.details :model="$deliveryReceipt">
            <x-slot:headerActions>
                <a class="btn btn-primary" href="{{ route('delivery-receipts.edit', $deliveryReceipt) }}">
                    @lang('crud.edit')
                </a>
            </x-slot:headerActions>

            <div class="grid lg:grid-cols-2 xl:grid-cols-3 gap-5">
                <x-attr.display :label="trans_choice('app.volumes', 0)">{{ $deliveryReceipt->volumes }}</x-attr.display>
                <x-attr.display
                    :label="trans_choice('app.recipient_types', 1)">{{ $deliveryReceipt->recipientType->name }}</x-attr.display>
                <x-attr.display
                    :label="trans_choice('app.users', 1)">{{ $deliveryReceipt->user->name }}</x-attr.display>
                <x-attr.display class="col-span-full" :label="trans_choice('app.observations', 0)"
                                :pre-line="true">{{ $deliveryReceipt->observations }}</x-attr.display>
            </div>
        </x-cards.details>

        <x-slot:aside>
            <div class="space-y-6">
                @if($photo = $deliveryReceipt->getFirstMedia('photo'))
                    <x-media.featured-image :title="trans_choice('app.photos', 1)" :media="$photo"/>
                @endif
            </div>
        </x-slot:aside>
    </x-show-sections>
</x-app-layout>
