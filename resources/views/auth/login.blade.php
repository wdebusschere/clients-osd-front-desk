<x-guest-layout :title="trans('app.log_in')">
    <div class="mb-6">
        <h1 class="font-semibold text-lg text-gray-900 dark:text-slate-100">{{ __('Welcome back!') }}</h1>

        <p class="text-sm">
            {{ __('Log in to continue to the Dashboard.') }}
        </p>
    </div>

    <x-validation-errors class="mb-4"/>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <div>
            <x-forms.label for="email" :value="trans('app.email')"/>
            <x-forms.input id="email" class="block w-full" type="email" name="email" :value="old('email')" required
                           autofocus autocomplete="username"/>
        </div>

        <div class="mt-4">
            <div class="flex items-center justify-between">
                <x-forms.label for="password" :value="trans('app.password')"/>

                @if (Route::has('password.request'))
                    <a class="link text-sm" href="{{ route('password.request') }}" tabindex="-1">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-forms.input id="password" class="block w-full" type="password" name="password" required
                           autocomplete="current-password"/>
        </div>

        <div class="flex items-center justify-between mt-4">
            <div class="block">
                <label for="remember_me" class="flex items-center">
                    <x-forms.checkbox id="remember_me" name="remember"/>
                    <span class="ml-2 text-sm text-gray-600 dark:text-slate-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <x-button class="ml-4">
                @lang('app.log_in')
            </x-button>
        </div>
    </form>

    <x-ui.hr class="my-12"/>

    <div class="mb-4 text-center">
        <a class="btn btn-light" href="{{ route('login.osd-hq') }}">{{ __('Login with OSD HQ') }}</a>
    </div>
</x-guest-layout>
