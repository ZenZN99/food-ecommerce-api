<?php

namespace App\Http\Requests;


class ProductRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return  true;
    }

    public function rules(): array
    {
        return [
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'category_id'   => ['required', 'exists:categories,id'],
            'name'          => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'price'         => ['required', 'numeric', 'min:0'],
            'image'         => ['required', 'file', 'max:2048'],
            'is_available'  => ['sometimes', 'boolean'],
        ];
    }
}
