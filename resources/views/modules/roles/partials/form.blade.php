@php
    $permissionGroups = \Spatie\Permission\Models\Permission::get()
        ->groupBy(function ($permission) {
            $groupName = substr($permission->name, 0, strpos($permission->name, ':'));

            $snakeCase = str_replace(' ', '_', $groupName);

            return trans_choice('app.'.$snakeCase, 0);
        })->sortKeys();
@endphp

@csrf

@if ($errors->any())
    <x-ui.alert type="error" class="mb-6" :title="trans('crud.filling_errors_detected')">
        @lang('crud.review_marked_fields')
    </x-ui.alert>
@endif

<div class="mb-6">
    <x-forms.label for="name" :value="trans('app.name')"/>
    <x-forms.input id="name" name="name" type="text" class="w-full"
                   value="{{ old('name', $role->name ?? '') }}"/>
    <x-forms.input-error for="name" class="mt-2"/>
</div>

<x-forms.fieldset>
    <x-slot:legend>
        @choice('app.permissions', 0)
    </x-slot:legend>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($permissionGroups as $group => $permissions)
            <div class="mb-4 pb-4 permission-group">
                <div class="mb-1">
                    <label for="permissionsGroupToggle{{ $group }}" class="flex-inline items-center mb-2 gap-2">
                        <x-forms.checkbox id="permissionsGroupToggle{{ $group }}" class="permission-group-toggle"/>
                        <span class="font-semibold">{{ $group }}</span>
                    </label>
                </div>

                @foreach($permissions as $permission)
                    <div>
                        <label for="permissions{{ $permission->id }}" class="flex-inline items-center gap-2">
                            <x-forms.checkbox id="permissions{{ $permission->id }}" name="permissions[]"
                                              class="group-permission-checkbox"
                                              value="{{ $permission->id }}"
                                              :checked="in_array($permission->id, old('permissions', isset($role) ? $role->permissions->pluck('id')->toArray() : []))"/>
                            <span>{{ trim(substr($permission->name, strpos($permission->name, ':') + 1)) }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</x-forms.fieldset>

@push('scripts')
    <script>
        window.onload = function () {
            setSelectAllToggles('.permission-group', '.permission-group-toggle', '.group-permission-checkbox');
        };
    </script>
@endpush
