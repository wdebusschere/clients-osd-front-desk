@props(['activeTab' => 0])

<div x-data="{ activeTab: {{ $activeTab }} }">
    {{ $menu ?? '' }}

    {{ $contents ?? ''}}
</div>
