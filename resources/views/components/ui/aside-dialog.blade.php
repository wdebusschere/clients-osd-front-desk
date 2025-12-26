@props([
    'size' => null,
    'title' => '',
    'footer',
    'closeOnEsc' => true,
    'keepScrolledDown' => false,
])
@php
    switch($size){
        case 'sm':
            $widthClass = 'sm:w-3/5 lg:w-2/5 xl:w-1/3';
            break;
        case 'lg':
            $widthClass = 'sm:w-5/6 lg:w-4/5 xl:w-3/4';
            break;
        default:
            $widthClass = 'sm:w-2/3 lg:w-3/5 xl:w-2/5';
            break;
    }
@endphp
<div x-data="{
        show: @entangle($attributes->wire('model')),
        keepScrolledDown: {{ $keepScrolledDown ? 'true' : 'false' }},
        close() {
            this.show = false;
        },
        scrollDown(){
            $nextTick(() => $refs.body.scrollTop = $refs.body.scrollHeight);
        },
        setScroll() {
            if(this.keepScrolledDown){
                if(this.show === true) {
                    $nextTick(() => this.scrollDown());

                    new MutationObserver(this.scrollDown).observe($refs.body, { childList: true, subtree: true });
                }
            }
        }
    }"
     @if($closeOnEsc)
         x-on:keydown.escape.window="close"
     @endif
     x-init="
        $watch('show', value => {
            $dispatch(`aside-dialog-${value === true ? 'opened' : 'closed'}`);
            setScroll();
        });

        setScroll();
    "
     x-show="show"
     class="fixed inset-0 overflow-y-auto z-50 overflow-hidden"
>
    <div x-show="show"
         class="fixed inset-0 transition-all"
         x-on:click="close"
         x-transition:enter="ease-out duration-400"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 dark:bg-slate-900 opacity-75"></div>
    </div>

    <div x-show="show"
         class="absolute inset-y-0 right-0 transition-all w-full {{ $widthClass }} h-full bg-white dark:bg-slate-800 shadow-l-2xl h-full flex flex-col overflow-y-auto"
         x-transition:enter="ease-in-out duration-400"
         x-transition:enter-start="opacity-0 translate-x-full"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="ease-out-in duration-300"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-full"
         x-trap.inert.noscroll.noautofocus="show">
        <div class="px-5 py-3 border-b border-gray-300 dark:border-slate-700 flex items-center justify-between">
            <div class="text-2xl font-medium">
                {{ $title }}
            </div>

            <x-secondary-button x-on:click="close()">
                @lang('app.close')
            </x-secondary-button>
        </div>

        <div class="min-h-48 p-5 grow overflow-y-auto" x-ref="body">
            {{ $slot }}
        </div>

        @isset($footer)
            <div {{ $footer->attributes->class(['px-5 py-3 border-t border-gray-300 dark:border-slate-700']) }}>
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
