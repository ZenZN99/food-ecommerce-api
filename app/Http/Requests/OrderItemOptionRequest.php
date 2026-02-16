<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'option_name'     => ['required', 'string', 'max:255'],
            'price_snapshot'  => ['required', 'numeric', 'min:0'],
        ];
    }
}
