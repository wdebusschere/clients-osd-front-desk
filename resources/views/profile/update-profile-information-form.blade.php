<x-form-section submit="updateProfileInformation">
    <x-slot:title>
        {{ __('Profile Information') }}
    </x-slot:title>

    <x-slot:description>
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot:description>

    <x-slot:form>
        {{-- Profile Photo --}}
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                {{-- Profile Photo File Input --}}
                <input type="file" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-forms.label for="photo" value="{{ __('Photo') }}" />

                {{-- Current Profile Photo --}}
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                {{-- New Profile Photo Preview --}}
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-forms.input-error for="photo" class="mt-2" />
            </div>
        @endif

        <div class="col-span-6 sm:col-span-4">
            <x-forms.label for="name" :value="trans('app.name')" />
            <x-forms.input id="name" type="text" class="block w-full" wire:model="state.name" required autocomplete="name" />
            <x-forms.input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-forms.label for="email" :value="trans('app.email')" />
            <x-forms.input id="email" type="email" class="block w-full" wire:model="state.email" required autocomplete="username" />
            <x-forms.input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="link" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
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
