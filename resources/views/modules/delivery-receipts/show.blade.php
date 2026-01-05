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
        <div class="space-y-6">
            <x-cards.details :model="$deliveryReceipt">
                <x-slot:headerActions>
                    <a class="btn btn-primary" href="{{ route('delivery-receipts.edit', $deliveryReceipt) }}">
                        @lang('crud.edit')
                    </a>
                </x-slot:headerActions>

                <x-slot:headline>
                    {{ $deliveryReceipt->reference }}
                </x-slot:headline>

                <div class="grid lg:grid-cols-2 xl:grid-cols-3 gap-5">
                    <x-attr.display
                        :label="trans_choice('app.volumes', 0)">{{ $deliveryReceipt->volumes }}</x-attr.display>
                    <x-attr.display
                        :label="trans_choice('app.recipient_types', 1)">{{ $deliveryReceipt->recipientType->name }}</x-attr.display>
                    <x-attr.display
                        :label="trans('app.received_by')">{{ $deliveryReceipt->user->name }}</x-attr.display>
                    <x-attr.display class="col-span-full" :label="trans_choice('app.observations', 0)"
                                    :pre-line="true">{{ $deliveryReceipt->observations }}</x-attr.display>
                </div>
            </x-cards.details>

            @can('deliverToUser', $deliveryReceipt)
                <livewire:delivery-receipts.deliver-to-user :$deliveryReceipt/>
            @endcan

            <x-ui.card>
                <x-slot:heading>
                    @lang('app.delivery_history')
                </x-slot:heading>

                <livewire:delivery-notes.table :delivery-receipt-id="$deliveryReceipt->id"/>
            </x-ui.card>
        </div>

        <x-slot:aside>
            <div class="space-y-6">
                @if($label = $deliveryReceipt->getFirstMedia('label'))
                    <x-ui.card
                        x-data="printImage('{{ route('media.render', $label) }}', '{{ addslashes($label->file_name) }}')">
                        <x-slot:heading>
                            @choice('app.labels', 1)
                        </x-slot:heading>

                        <img class="border border-gray-300 dark:border-slate-800"
                             src="{{ route('media.render', $label) }}" alt="{{ $label->file_name }}">

                        <x-slot:footer>
                            <x-secondary-button @click="print" class="flex items-center gap-1">
                                <x-icons.outline.printer class="size-4"/>
                                @lang('app.print')
                            </x-secondary-button>
                        </x-slot:footer>
                    </x-ui.card>
                @endif

                @if($photo = $deliveryReceipt->getFirstMedia('photo'))
                    <x-media.featured-image :title="trans_choice('app.photos', 1)" :media="$photo"/>
                @endif
            </div>
        </x-slot:aside>
    </x-show-sections>
</x-app-layout>
