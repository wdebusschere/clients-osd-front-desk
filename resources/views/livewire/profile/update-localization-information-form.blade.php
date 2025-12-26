<x-form-section submit="updateLocalizationInformation">
    <x-slot:title>
        {{ __('Locale Settings') }}
    </x-slot:title>

    <x-slot:description>
        {{ __('Personalize your account by updating language, country, and other localization preferences.') }}
    </x-slot:description>

    <x-slot:form>
        <div class="col-span-6 sm:col-span-4">
            <x-forms.label for="preferred_language" :value="trans('app.preferred_language')"/>
            <x-forms.select id="preferred_language" wire:model="state.preferred_language">
                @include('partials.selectors.available-locales')
            </x-forms.select>
            <x-forms.input-error for="form.preferred_language" class="mt-2"/>
        </div>
    </x-slot:form>

    <x-slot:actions>
        <x-action-message class="mr-3" on="saved">
            @lang('crud.saved').
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            @lang('crud.save')
        </x-button>
    </x-slot:actions>
</x-form-section>
