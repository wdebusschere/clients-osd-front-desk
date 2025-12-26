<x-app-layout>
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header :title="trans_choice('app.api_tokens', 1)"/>
    </x-slot:pageHeader>

    @livewire('api.api-token-manager')
</x-app-layout>
