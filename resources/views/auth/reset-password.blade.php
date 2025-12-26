<x-guest-layout :title="__('Password reset')">
    <div class="mb-6">
        <h1 class="font-semibold text-lg text-gray-900 dark:text-slate-100">{{ __('Password reset') }}!</h1>

        <p class="text-sm">
            {{ __('Set a new password for your account.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <x-validation-errors class="mb-4"/>

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="block">
            <x-forms.label for="email" :value="trans('app.email')"/>
            <x-forms.input id="email" class="block w-full" type="email" name="email"
                           :value="old('email', $request->email)" required autofocus autocomplete="username"/>
        </div>

        <div class="mt-4">
            <x-forms.label for="password" :value="trans('app.password')"/>
            <x-forms.input id="password" class="block w-full" type="password" name="password" required
                           autocomplete="new-password"/>
        </div>

        <div class="mt-4">
            <x-forms.label for="password_confirmation" :value="trans('app.confirm_password')"/>
            <x-forms.input id="password_confirmation" class="block w-full" type="password"
                           name="password_confirmation" required autocomplete="new-password"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button>
                {{ __('Reset Password') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
