<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartItemOptionRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'product_option_id' => ['required', 'exists:product_options,id'],
        ];
    }
}
