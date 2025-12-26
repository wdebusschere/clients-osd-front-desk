<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-slate-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <x-validation-errors class="mb-4"/>

        <div>
            <x-forms.label for="password" :value="trans('app.password')"/>
            <x-forms.input id="password" class="block w-full" type="password" name="password" required
                           autocomplete="current-password" autofocus/>
        </div>

        <div class="flex justify-end mt-4">
            <x-button class="ml-4">
                @lang('crud.confirm')
            </x-button>
        </div>
    </form>
</x-guest-layout>
