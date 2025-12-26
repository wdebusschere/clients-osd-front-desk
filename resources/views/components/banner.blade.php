@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')])

<div x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message]) }}"
     class="rounded-lg"
     :class="{ 'bg-lime-500': style == 'success', 'bg-red-700': style == 'danger', 'bg-gray-500 dark:bg-slate-600': style != 'success' && style != 'danger' }"
     style="display: none;"
     x-show="show && message"
     x-on:banner-message.window="
        style = event.detail.style;
        message = event.detail.message;
        show = true;">
    <div class="px-5 py-3 flex items-center justify-between flex-wrap">
        <div class="w-0 flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg"
                      :class="{ 'bg-lime-600': style == 'success', 'bg-red-600': style == 'danger', 'bg-gray-600 dark:bg-slate-700': style != 'success' && style != 'danger' }">
                    <x-icons.outline.check-circle x-show="style == 'success'" class="h-5 w-5 text-white"/>
                    <x-icons.outline.exclamation-circle x-show="style == 'danger'" class="h-5 w-5 text-white"/>
                    <x-icons.outline.information-circle x-show="style != 'success' && style != 'danger'" class="h-5 w-5 text-white"/>
                </span>

            <p class="ml-3 font-medium text-sm text-white truncate">
                {!! $message !!}
            </p>
        </div>

        <div class="shrink-0 sm:ml-3">
            <button
                type="button"
                class="-mr-1 flex p-2 rounded-md focus:outline-hidden sm:-mr-2 transition"
                :class="{ 'hover:bg-lime-600 focus:bg-lime-600': style == 'success', 'hover:bg-red-600 focus:bg-red-600': style == 'danger' }"
                aria-label="Dismiss"
                x-on:click="show = false">
                <x-icons.outline.x-mark class="h-5 w-5 text-white"/>
            </button>
        </div>
    </div>
</div>
