<x-form-section submit="updatePassword">
    <x-slot:title>
        {{ __('Update Password') }}
    </x-slot:title>

    <x-slot:description>
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot:description>

    <x-slot:form>
        @if(!is_null($this->user->password))
            <div class="col-span-6 sm:col-span-4">
                <x-forms.label for="current_password" value="{{ __('Current Password') }}"/>
                <x-forms.input id="current_password" type="password" class="block w-full"
                               wire:model="state.current_password" autocomplete="current-password"/>
                <x-forms.input-error for="current_password" class="mt-2"/>
            </div>
        @endif

        <div class="col-span-6 sm:col-span-4">
            <x-forms.label for="password" value="{{ __('New Password') }}"/>
            <x-forms.input id="password" type="password" class="block w-full" wire:model="state.password"
                           autocomplete="new-password"/>
            <x-forms.input-error for="password" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-forms.label for="password_confirmation" :value="trans('app.confirm_password')"/>
            <x-forms.input id="password_confirmation" type="password" class="block w-full"
                           wire:model="state.password_confirmation" autocomplete="new-password"/>
            <x-forms.input-error for="password_confirmation" class="mt-2"/>
        </div>
    </x-slot:form>

    <x-slot:actions>
        <x-action-message class="mr-3" on="saved">
            @lang('crud.saved').
        </x-action-message>

        <x-button>
            @lang('crud.save')
        </x-button>
    </x-slot:actions>
</x-form-section>
