<div>
    {{-- Generate API Token --}}
    <x-form-section submit="createApiToken">
        <x-slot:title>
            {{ __('Create API Token') }}
        </x-slot:title>

        <x-slot:description>
            {{ __('API tokens allow third-party services to authenticate with our application on your behalf.') }}
        </x-slot:description>

        <x-slot:form>
            {{-- Token Name --}}
            <div class="col-span-6 sm:col-span-4">
                <x-forms.label for="name" value="{{ __('Token Name') }}"/>
                <x-forms.input id="name" type="text" class="block w-full" wire:model="createApiTokenForm.name"
                               autofocus/>
                <x-forms.input-error for="name" class="mt-2"/>
            </div>

            {{-- Token Permissions --}}
            @if (Laravel\Jetstream\Jetstream::hasPermissions())
                <div class="col-span-6">
                    <x-forms.label for="permissions" value="{{ __('Permissions') }}"/>

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                            <label class="flex items-center">
                                <x-forms.checkbox wire:model="createApiTokenForm.permissions" :value="$permission"/>
                                <span class="ml-2 text-sm text-gray-600 dark:text-slate-400">{{ $permission }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
        </x-slot:form>

        <x-slot:actions>
            <x-action-message class="mr-3" on="created">
                {{ __('Created.') }}
            </x-action-message>

            <x-button>
                {{ __('Create') }}
            </x-button>
        </x-slot:actions>
    </x-form-section>

    @if ($this->user->tokens->isNotEmpty())
        <x-section-border/>

        {{-- Manage API Tokens --}}
        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot:title>
                    {{ __('Manage API Tokens') }}
                </x-slot:title>

                <x-slot:description>
                    {{ __('You may delete any of your existing tokens if they are no longer needed.') }}
                </x-slot:description>

                {{-- API Token List --}}
                <x-slot:content>
                    <div class="space-y-6">
                        @foreach ($this->user->tokens->sortBy('name') as $token)
                            <div class="flex items-center justify-between">
                                <div class="break-all dark:text-white">
                                    {{ $token->name }}
                                </div>

                                <div class="flex items-center ml-2">
                                    @if ($token->last_used_at)
                                        <div class="text-sm text-gray-400">
                                            {{ __('Last used') }} {{ $token->last_used_at->diffForHumans() }}
                                        </div>
                                    @endif

                                    @if (Laravel\Jetstream\Jetstream::hasPermissions())
                                        <button class="cursor-pointer ml-6 text-sm text-gray-400 underline"
                                                wire:click="manageApiTokenPermissions({{ $token->id }})">
                                            {{ __('Permissions') }}
                                        </button>
                                    @endif

                                    <button class="cursor-pointer ml-6 text-sm text-red-500"
                                            wire:click="confirmApiTokenDeletion({{ $token->id }})">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot:content>
            </x-action-section>
        </div>
    @endif

    {{-- Token Value Modal --}}
    <x-dialog-modal wire:model.live="displayingToken">
        <x-slot:title>
            {{ __('API Token') }}
        </x-slot:title>

        <div>
            {{ __('Please copy your new API token. For your security, it won\'t be shown again.') }}
        </div>

        <x-forms.input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                       class="mt-4 bg-gray-100 px-4 py-2 rounded-sm font-mono text-sm text-gray-500 w-full break-all"
                       autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                       @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)"
        />

        <x-slot:footer>
            <x-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot:footer>
    </x-dialog-modal>

    {{-- API Token Permissions Modal --}}
    <x-dialog-modal wire:model.live="managingApiTokenPermissions">
        <x-slot:title>
            {{ __('API Token Permissions') }}
        </x-slot:title>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                <label class="flex items-center">
                    <x-forms.checkbox wire:model="updateApiTokenForm.permissions" :value="$permission"/>
                    <span class="ml-2 text-sm text-gray-600 dark:text-slate-400">{{ $permission }}</span>
                </label>
            @endforeach
        </div>

        <x-slot:footer>
            <x-secondary-button wire:click="$set('managingApiTokenPermissions', false)" wire:loading.attr="disabled">
                @lang('crud.cancel')
            </x-secondary-button>

            <x-button class="ml-3" wire:click="updateApiToken" wire:loading.attr="disabled">
                @lang('crud.save')
            </x-button>
        </x-slot:footer>
    </x-dialog-modal>

    {{-- Delete Token Confirmation Modal --}}
    <x-confirmation-modal wire:model.live="confirmingApiTokenDeletion">
        <x-slot:title>
            {{ __('Delete API Token') }}
        </x-slot:title>

        {{ __('Are you sure you would like to delete this API token?') }}

        <x-slot:footer>
            <x-secondary-button wire:click="$toggle('confirmingApiTokenDeletion')" wire:loading.attr="disabled">
                @lang('crud.cancel')
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteApiToken" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot:footer>
    </x-confirmation-modal>
</div>
