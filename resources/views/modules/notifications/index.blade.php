@php
    $title = trans_choice('app.notifications', 0);

    $breadcrumbs = [
        $title => null,
    ];
@endphp
<x-app-layout :$title>
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs :items="$breadcrumbs"/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header :$title/>
    </x-slot:pageHeader>

    <x-ui.card>
        <x-slot:heading>
            @choice('app.lists', 1)
        </x-slot:heading>

        <livewire:notifications.table/>
    </x-ui.card>
</x-app-layout>
