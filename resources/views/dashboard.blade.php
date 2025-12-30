<x-app-layout :title="trans('app.dashboard')">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs/>
    </x-slot:breadcrumbs>

    <div class="text-3xl font-semibold text-black dark:text-white mb-10">
        @lang('app.welcome_user', ['name' => auth()->user()->name])
    </div>

    <div class="space-y-6">
        @include('hqannouncements::list')

        <form action="{{ route('delivery-receipts.store') }}" method="POST" enctype="multipart/form-data">
            <x-ui.card>
                <x-slot:heading>
                    @choice('app.delivery_receipts', 1)
                </x-slot:heading>

                @include('modules.delivery-receipts.partials.form')

                <x-slot:footer>
                    <x-button>
                        @lang('crud.save')
                    </x-button>
                </x-slot:footer>
            </x-ui.card>
        </form>
    </div>
</x-app-layout>
