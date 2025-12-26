@csrf

@if ($errors->any())
    <x-ui.alert type="error" class="mb-6" :title="trans('crud.filling_errors_detected')">
        @lang('crud.review_marked_fields')
    </x-ui.alert>
@endif

<div class="mb-6">
    <x-forms.label for="name" :value="trans('app.name')"/>
    <x-forms.input id="name" name="name" type="text" class="w-full"
                   value="{{ old('name', $recipientType->name ?? '') }}"/>
    <x-forms.input-error for="name" class="mt-2"/>
</div>
