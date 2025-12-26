@props(['tab' => 0])

<button type="button"
        class="btn btn-sm btn-light flex items-center gap-1"
        :class="{ 'active': activeTab === {{ $tab }} }"
        @click="activeTab = {{ $tab }}"
>
    {{ $slot }}
</button>
