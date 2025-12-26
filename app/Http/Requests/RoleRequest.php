<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('roles')->ignore($this->role->id ?? null),
            ],
            'permissions' => 'nullable',
            'permissions.*' => 'exists:permissions,id',
        ];
    }
}
