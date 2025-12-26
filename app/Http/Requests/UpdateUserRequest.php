<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role_id' => [
                'required',
                'exists:roles,id'
            ],
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ],
            'preferred_language' => [
                'required',
                Rule::in(config('app.available_locales')),
            ],
            'active' => 'required|boolean',
        ];
    }
}
