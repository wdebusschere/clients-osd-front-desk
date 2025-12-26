<x-action-section>
    <x-slot:title>
        {{ __('Browser Sessions') }}
    </x-slot:title>

    <x-slot:description>
        {{ __('Manage and log out your active sessions on other browsers and devices.') }}
    </x-slot:description>

    <x-slot:content>
        <div class="max-w-xl text-sm text-gray-600 dark:text-slate-400">
            {{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-6">
                {{-- Other Browser Sessions --}}
                @foreach ($this->sessions as $session)
                    <div class="flex items-center">
                        <div>
                            @if ($session->agent->isDesktop())
                                <x-icons.outline.computer-desktop class="w-8 h-8 text-gray-500"/>
                            @else
                                <x-icons.outline.device-phone-mobile class="w-8 h-8 text-gray-500"/>
                            @endif
                        </div>

                        <div class="ml-3">
                            <div class="text-sm text-gray-600 dark:text-slate-400">
                                {{ $session->agent->platform() ? $session->agent->platform() : __('Unknown') }}
                                - {{ $session->agent->browser() ? $session->agent->browser() : __('Unknown') }}
                            </div>

                            <div>
                                <div class="text-xs text-gray-500">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                    @else
                                        {{ __('Last active') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">
            <x-button wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Log Out Other Browser Sessions') }}
            </x-button>

            <x-action-message class="ml-3" on="loggedOut">
                @lang('crud.done').
            </x-action-message>
        </div>

        {{-- Log Out Other Devices Confirmation Modal --}}
        <x-dialog-modal wire:model.live="confirmingLogout">
            <x-slot:title>
                {{ __('Log Out Other Browser Sessions') }}
            </x-slot:title>

            {{ __('Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.') }}

            <div class="mt-4" x-data="{}"
                 x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-forms.input type="password" class="block w-3/4"
                               autocomplete="current-password"
                               :placeholder="trans('app.password')"
                               x-ref="password"
                               wire:model="password"
                               wire:keydown.enter="logoutOtherBrowserSessions"/>

                <x-forms.input-error for="password" class="mt-2"/>
            </div>

            <x-slot:footer>
                <x-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    @lang('crud.cancel')
                </x-secondary-button>

                <x-button class="ml-3"
                          wire:click="logoutOtherBrowserSessions"
                          wire:loading.attr="disabled">
                    {{ __('Log Out Other Browser Sessions') }}
                </x-button>
            </x-slot:footer>
        </x-dialog-modal>
    </x-slot:content>
</x-action-section>
