@csrf

@if ($errors->any())
    <x-ui.alert type="error" class="mb-6" :title="trans('crud.filling_errors_detected')">
        @lang('crud.review_marked_fields')
    </x-ui.alert>
@endif

<div class="space-y-6">
    <div>
        <x-forms.label for="name" :value="trans('app.name')"/>
        <x-forms.input id="name"
                       name="name"
                       type="text"
                       class="w-full"
                       value="{{ old('name', $location->name ?? '') }}"
                       required/>
        <x-forms.input-error for="name" class="mt-2"/>
    </div>

    <div>
        <x-forms.label for="responsible_id">@lang('app.responsible')</x-forms.label>
        <x-forms.select id="responsible_id"
                        name="responsible_id"
                        required>
            <option value="" selected>@choice('app.users', 0)</option>
            @include(
                'partials.selectors.users',
                [
                   'selection' => old('responsible_id', $location->responsible_id ?? ''),
                ]
            )
        </x-forms.select>
        <x-forms.input-error for="responsible_id"/>
    </div>
</div>
