@props(['title' => __('Confirm Password'), 'content' => __('For your security, please confirm your password to continue.'), 'button' => __('Confirm')])

@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span
    {{ $attributes->wire('then') }}
    x-data
    x-ref="span"
    x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
    x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    {{ $slot }}
</span>

@once
    <x-dialog-modal wire:model.live="confirmingPassword">
        <x-slot:title>
            {{ $title }}
        </x-slot:title>

        {{ $content }}

        <div class="mt-4" x-data="{}"
             x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
            <x-forms.input type="password" class="block w-3/4" :placeholder="trans('app.password')"
                           autocomplete="current-password"
                           x-ref="confirmable_password"
                           wire:model="confirmablePassword"
                           wire:keydown.enter="confirmPassword"/>

            <x-forms.input-error for="confirmable_password" class="mt-2"/>
        </div>

        <x-slot:footer>
            <x-secondary-button wire:click="stopConfirmingPassword" wire:loading.attr="disabled">
                @lang('crud.cancel')
            </x-secondary-button>

            <x-button class="ml-3" dusk="confirm-password-button" wire:click="confirmPassword"
                      wire:loading.attr="disabled">
                {{ $button }}
            </x-button>
        </x-slot:footer>
    </x-dialog-modal>
@endonce
