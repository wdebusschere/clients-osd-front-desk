<form wire:submit="save">
    <x-ui.card>
        <x-slot:heading>
            @choice('app.deliveries', 1)
        </x-slot:heading>

        <div>
            <x-forms.label for="recipient_id">@choice('app.recipients', 1)</x-forms.label>
            <x-forms.select name="recipient_id"
                            id="recipient_id"
                            wire:model="recipient_id">
                <option value="" selected>@choice('app.recipients', 0)</option>
                @include('partials.selectors.users')
            </x-forms.select>
            <x-forms.input-error for="recipient_id"/>
        </div>

        <x-slot:footer class="flex items-center gap-2">
            <x-button wire:loading.attr="disabled">
                @lang('crud.save')
            </x-button>

            <x-action-message class="mr-3" on="saved">
                @lang('crud.saved').
            </x-action-message>
        </x-slot:footer>
    </x-ui.card>
</form>
