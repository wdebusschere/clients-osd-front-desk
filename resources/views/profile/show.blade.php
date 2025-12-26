@php
    $breadcrumbs = [
        trans('app.profile') => null
    ];
@endphp
<x-app-layout>
    <x-slot:pageHeader>
        <x-slot:breadcrumbs>
            <x-ui.breadcrumbs :items="$breadcrumbs"/>
        </x-slot:breadcrumbs>

        <x-ui.page-header :title="trans('app.profile')"/>
    </x-slot:pageHeader>

    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        @livewire('profile.update-profile-information-form')

        <x-section-border/>

        <livewire:profile.update-localization-information-form/>

        <x-section-border/>
    @endif


@if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="mt-10 sm:mt-0">
            @livewire('profile.update-password-form')
        </div>

        <x-section-border/>
    @endif

    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="mt-10 sm:mt-0">
            @livewire('profile.two-factor-authentication-form')
        </div>

        <x-section-border/>
    @endif

    <div class="mt-10 sm:mt-0">
        @livewire('profile.logout-other-browser-sessions-form')
    </div>

    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <x-section-border/>

        <div class="mt-10 sm:mt-0">
            @livewire('profile.delete-user-form')
        </div>
    @endif
</x-app-layout>
