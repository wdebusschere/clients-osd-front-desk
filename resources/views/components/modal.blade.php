@props(['id', 'maxWidth'])

@php
    $id = $id ?? md5($attributes->wire('model'));

    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth ?? '2xl'];
@endphp

<div x-data="{
        show: @entangle($attributes->wire('model')),
        close(){
            this.show = false;
        },
    }"
     x-on:close.stop="close()"
     x-on:keydown.escape.window="close()"
     x-show="show"
     id="{{ $id }}"
     class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-60"
     style="display: none;"
>
    <x-ui.backdrop x-show="show"
                   x-on:click="close()"
                   x-transition:enter="ease-out duration-300"
                   x-transition:enter-start="opacity-0"
                   x-transition:enter-end="opacity-100"
                   x-transition:leave="ease-in duration-75"
                   x-transition:leave-start="opacity-100"
                   x-transition:leave-end="opacity-0"/>

    <div x-show="show"
         class="transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto h-full flex flex-col justify-center relative"
         x-trap.inert.noscroll="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-75"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        {{ $slot }}
    </div>
</div>
