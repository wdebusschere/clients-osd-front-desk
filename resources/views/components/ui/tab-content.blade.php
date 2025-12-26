@props(['tab' => 0])

<div x-show="activeTab === {{ $tab }}">
    {{ $slot }}
</div>
