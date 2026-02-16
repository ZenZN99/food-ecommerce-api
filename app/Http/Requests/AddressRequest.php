<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city'   => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'notes'  => ['nullable', 'string'],
            'lat'    => ['nullable', 'numeric'],
            'lng'    => ['nullable', 'numeric'],
        ];
    }
}
