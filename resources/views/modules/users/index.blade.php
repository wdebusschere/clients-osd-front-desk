@php
    $breadcrumbs = [
        trans_choice('app.users', 0) => route('users.index'),
    ];
@endphp
<x-app-layout :title="trans_choice('app.users', 0)">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs :items="$breadcrumbs"/>
    </x-slot:breadcrumbs>

    <x-slot:pageHeader>
        <x-ui.page-header :title="trans_choice('app.users', 0)"/>
    </x-slot:pageHeader>

    <livewire:users.table/>
</x-app-layout>
