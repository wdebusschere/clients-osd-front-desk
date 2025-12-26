@php
    $breadcrumbs = [
        trans_choice('app.activity_logs', 0) => route('activity-logs.index')
    ];
@endphp
<x-app-layout :title="trans_choice('app.activity_logs', 0)">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs :items="$breadcrumbs"/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header :title="trans_choice('app.activity_logs', 0)"/>
    </x-slot:pageHeader>

    <x-ui.card>
        <x-slot:heading>
            @choice('app.lists', 1)
        </x-slot:heading>

        <livewire:tables.activity-logs/>
    </x-ui.card>
</x-app-layout>
