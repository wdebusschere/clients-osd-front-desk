<nav class="flex text-gray-400 dark:text-slate-500 text-sm font-medium" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2">
        <li class="inline-flex items-center" @if(!count($items)) aria-current="page" @endif>
            @if(count($items))
                <a href="{{ route('dashboard') }}" class="inline-flex items-center hover:text-gray-900 dark:hover:text-slate-100">
                    <x-icons.outline.home class="w-4 h-4"/>
                </a>
            @else
                <span class="ml-1 text-gray-900 dark:text-slate-100 md:ml-2">
                    <x-icons.outline.home class="w-4 h-4"/>
                </span>
            @endif
        </li>
        @foreach($items as $label => $link)
            <li @if($loop->last) aria-current="page" @endif>
                <div class="flex items-center">
                    <x-icons.outline.chevron-right class="w-3 h-3"/>

                    @if($loop->last || $link === null)
                        <span class="ml-1 text-gray-900 dark:text-slate-100 md:ml-2">{{ $label }}</span>
                    @else
                        <a href="{{ $link }}"
                           class="ml-1 hover:text-gray-900 dark:hover:text-slate-100 md:ml-2">
                            {{ $label }}
                        </a>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
