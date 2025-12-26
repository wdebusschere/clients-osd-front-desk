<ul>
    @foreach($menuItems as $menuItem)
        <li class="mb-1" @isset($menuItem->items) x-data="{{ json_encode(['collapsed' => !$menuItem->active]) }}"
            @click="collapsed = !collapsed" @endisset>
            <a class="flex items-center py-2 px-1 gap-2 cursor-pointer rounded-sm transition-colors duration-200 hover:bg-gray-100 dark:hover:bg-slate-700 {{ $menuItem->active ? 'text-gray-900 dark:text-slate-100 bg-gray-100 dark:bg-slate-700' : '' }}"
               @isset($menuItem->route) href="{{ $menuItem->route }}" @endisset
            >
                <x-dynamic-component :component="$menuItem->icon" class="w-6 h-5" />

                <span class="grow">{{ $menuItem->label }}</span>

                @isset($menuItem->items)
                    <x-icons.outline.chevron-down class="w-5 h-4 self-right" x-show="collapsed"/>
                    <x-icons.outline.chevron-up class="w-5 h-4 self-right" x-show="!collapsed"/>
                @endisset
            </a>

            @isset($menuItem->items)
                <ul class="transition-all duration-75 py-2" x-show="!collapsed"
                    x-collapse>
                    @foreach($menuItem->items as $subMenuItem)
                        <li>
                            <a class="py-2 pl-9 block text-sm transition-colors duration-200 hover:text-gray-900 dark:hover:text-slate-100 {{ $subMenuItem->active ? 'text-gray-900 dark:text-slate-100' : '' }}"
                               href="{{ $subMenuItem->route }}">
                                {{ $subMenuItem->label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endisset
        </li>
    @endforeach
</ul>
