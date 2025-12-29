<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryReceiptRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'recipient_type_id' => [
                'required',
                'exists:recipient_types,id',
            ],
            'volumes' => [
                'required',
                'integer',
                'min:1',
            ],
            'observations' => [
                'nullable',
            ],
            'photo' => [
                'nullable',
                'max:'.config('media-library.max_file_size') / 1024,
                'mimes:'.implode(',', config('settings.uploads.accepted_images')),
            ],
        ];
    }
}
