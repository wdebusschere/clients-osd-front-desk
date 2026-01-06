@csrf

@if ($errors->any())
    <x-ui.alert type="error" class="mb-6" :title="trans('crud.filling_errors_detected')">
        @lang('crud.review_marked_fields')
    </x-ui.alert>
@endif

<div class="space-y-6">
    <div>
        <x-forms.label for="recipient_type_id" :value="trans_choice('app.recipient_types', 0)"/>
        <x-forms.select name="recipient_type_id"
                        id="recipient_type_id"
                        required>
            <option value="" selected>@choice('app.recipient_types', 0)</option>
            @include(
                'partials.selectors.recipient-types',
                [
                    'selection' => old('recipient_type_id', $deliveryReceipt->recipient_type_id ?? ''),
                ]
            )
        </x-forms.select>
        <x-forms.input-error for="recipient_type_id" class="mt-2"/>
    </div>

    <div>
        <x-forms.label for="volumes" :value="trans_choice('app.volumes', 0)"/>
        <x-forms.input type="number"
                       min="1"
                       id="volumes"
                       name="volumes"
                       value="{{ old('volumes', $deliveryReceipt->volumes ?? '') }}"
                       required/>
        <x-forms.input-error for="volumes" class="mt-2"/>
    </div>

    <div>
        <x-forms.label for="observations" :value="trans_choice('app.observations', 0)" :optional="true"/>
        <x-forms.textarea id="observations"
                          name="observations"
                          value="{{ old('observations', $deliveryReceipt->observations ?? '') }}"/>
        <x-forms.input-error for="observations"/>
    </div>

    <div>
        <div class="flex items-center gap-4">
            <x-forms.label for="photo" :value="trans_choice('app.photos', 1)"/>

            @if(isset($deliveryReceipt) && ($photo = $deliveryReceipt->getFirstMedia('photo')))
                <div class="mb-1">
                    <a class="btn btn-sm btn-light flex items-center gap-1"
                       href="{{ route('media.render', $photo) }}"
                       target="_blank">
                        <x-icons.outline.eye class="size-4"/>
                        {{ $photo->file_name }}
                    </a>
                </div>
            @endif
        </div>
        <x-forms.input type="file"
                       id="photo"
                       name="photo"
                       accept=".{{ implode(',.', config('settings.uploads.accepted_images')) }}"
                       required/>
        <x-forms.helper text="{{ trans('info.uploads.file_size_limit') }}"/>
        <x-forms.input-error for="photo"/>
    </div>
</div>
