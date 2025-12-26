<x-app-layout :title="trans('app.dashboard')">
    <x-slot:breadcrumbs>
        <x-ui.breadcrumbs/>
    </x-slot:breadcrumbs>

    <div class="text-3xl font-semibold text-black dark:text-white mb-10">
        @lang('app.welcome_user', ['name' => auth()->user()->name])
    </div>

    @include('hqannouncements::list')
</x-app-layout>
