<x-action-section>
    <x-slot:title>
        {{ __('Delete Account') }}
    </x-slot:title>

    <x-slot:description>
        {{ __('Permanently delete your account.') }}
    </x-slot:description>

    <x-slot:content>
        <div class="max-w-xl text-sm text-gray-600 dark:text-slate-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

        {{-- Delete User Confirmation Modal --}}
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot:title>
                {{ __('Delete Account') }}
            </x-slot:title>

            {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

            <div class="mt-4" x-data="{}"
                 x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-forms.input type="password" class="block w-3/4"
                               autocomplete="current-password"
                               :placeholder="trans('app.password')"
                               x-ref="password"
                               wire:model="password"
                               wire:keydown.enter="deleteUser"/>

                <x-forms.input-error for="password" class="mt-2"/>
            </div>

            <x-slot:footer>
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    @lang('crud.cancel')
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </x-slot:footer>
        </x-dialog-modal>
    </x-slot:content>
</x-action-section>
