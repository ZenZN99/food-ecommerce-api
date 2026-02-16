<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductOptionRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'name'       => ['required', 'string', 'max:255'],
            'price'      => ['required', 'numeric', 'min:0'],
        ];
    }
}
