<th scope="col" class="px-6 py-3 @isset($orderBy) cursor-pointer @endisset {{ $class ?? '' }}"
    @isset($orderBy) wire:click="setOrder('{{ $orderBy }}')" @endisset>
    <div class="inline-flex items-center gap-2">
        {{ $title ?? '' }}

        @isset($orderBy)
            @if(!isset($order[$orderBy]))
                <x-icons.solid.arrows-up-down class="w-4 h-4 text-gray-400 dark:text-slate-500"/>
            @elseif($order[$orderBy] === 'ASC')
                <div class="flex items-center">
                    <x-icons.mini.arrow-up class="w-4 h-4 text-gray-900 dark:text-slate-100"/>

                    <small>{{ array_search($orderBy, array_keys($order)) + 1 }}</small>
                </div>
            @else
                <div class="flex items-center">
                    <x-icons.mini.arrow-down class="w-4 h-4 text-gray-900 dark:text-slate-100"/>

                    <small>{{ array_search($orderBy, array_keys($order)) + 1 }}</small>
                </div>
            @endif
        @endisset
    </div>
</th>
