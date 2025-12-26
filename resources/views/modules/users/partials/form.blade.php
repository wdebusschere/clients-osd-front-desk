@csrf

@if ($errors->any())
    <x-ui.alert type="error" class="mb-6" :title="trans('crud.filling_errors_detected')">
        @lang('crud.review_marked_fields')
    </x-ui.alert>
@endif

<div class="mb-6">
    <x-forms.label for="role_id" :value="trans_choice('app.roles', 1)"/>
    <x-forms.select id="role_id" name="role_id" class="w-full" required>
        <option selected></option>
        @foreach(\App\Models\Role::pluck('name', 'id') as $roleId => $roleName)
            <option
                value="{{ $roleId }}" {{ old('role_id', isset($user) ? $user->roles->first()->id ?? '' : '') == $roleId ? 'selected' : '' }}>{{ $roleName }}</option>
        @endforeach
    </x-forms.select>
    <x-forms.input-error for="role_id" class="mt-2"/>
</div>

<div class="mb-6">
    <x-forms.label for="name" :value="trans('app.name')"/>
    <x-forms.input id="name" name="name" type="text" class="block w-full" value="{{ old('name', $user->name ?? '') }}"
             required/>
    <x-forms.input-error for="name" class="mt-2"/>
</div>

<div class="mb-6">
    <x-forms.label for="email" :value="trans('app.email')"/>
    <x-forms.input id="email" name="email" type="email" class="block w-full"
             value="{{ old('email', $user->email ?? '') }}" required/>
    <x-forms.input-error for="email" class="mt-2"/>
</div>

@if(!isset($user))
    <div class="mb-6">
        <x-forms.label for="password" :value="trans('app.password')"/>
        <x-forms.input id="password" name="password" type="password" class="block w-full"
                 minlength="{{ config('auth.passwords.settings.minlength') }}"
                 autocomplete="new-password"
                 required/>
        <x-forms.input-error for="password" class="mt-2"/>
    </div>

    <div class="mb-6">
        <x-forms.label for="password_confirmation" :value="trans('app.confirm_password')"/>
        <x-forms.input id="password_confirmation" name="password_confirmation" type="password" class="block w-full"
                 minlength="{{ config('auth.passwords.settings.minlength') }}"
                 autocomplete="new-password" required/>
        <x-forms.input-error for="password_confirmation" class="mt-2"/>
    </div>
@endif

<div class="mb-6">
    <x-forms.label for="preferred_language" :value="trans('app.preferred_language')"/>
    <x-forms.select name="preferred_language" id="preferred_language">
        @include('partials.selectors.available-locales', ['selection' => old('preferred_language', $user->preferred_language ?? '')])
    </x-forms.select>
</div>

<div class="mb-6">
    <label for="active" class="flex items-center gap-2">
        <x-forms.input type="hidden" name="active" value="0"/>
        <x-forms.checkbox id="active" name="active" value="1" :checked="old('active', $user->active ?? 0) == 1"/>
        <span>@lang('app.active')</span>
    </label>
    <x-forms.input-error for="active" class="mt-2"/>
</div>
