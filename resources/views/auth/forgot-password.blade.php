<x-guest-layout :title="__('Forgot your password?')">
    <div class="mb-6">
        <h1 class="font-semibold text-lg text-gray-900 dark:text-slate-100">{{ __('Forgot your password?') }}</h1>

        <p class="text-sm">
            {{ __('Let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <x-validation-errors class="mb-4"/>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <div class="block">
            <x-forms.label for="email" :value="trans('app.email')"/>
            <x-forms.input id="email" class="block w-full" type="email" name="email" :value="old('email')" required
                           autofocus autocomplete="username"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button>
                {{ __('Email Password Reset Link') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
