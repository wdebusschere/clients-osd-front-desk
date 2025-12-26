<div>
    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <button
            class="flex text-sm border-2 border-transparent rounded-full focus:outline-hidden focus:border-gray-300 transition">
            <img class="h-8 w-8 rounded-full object-cover"
                 src="{{ Auth::user()->profile_photo_url }}"
                 alt="{{ Auth::user()->name }}"/>
        </button>
    @else
        <div class="inline-flex rounded-md">
            <button type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-slate-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-hidden focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                {{ Auth::user()->name }}

                <x-icons.outline.chevron-down class="ml-2 -mr-0.5 h-4 w-4"/>
            </button>
        </div>
    @endif
</div>
