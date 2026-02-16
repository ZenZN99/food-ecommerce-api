<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateProductRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'restaurant_id' => ['sometimes', 'exists:restaurants,id'],

            'category_id' => ['sometimes', 'exists:categories,id'],

            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('products')
                    ->where('restaurant_id', $this->restaurant_id ?? $this->route('product')->restaurant_id)
                    ->ignore($this->route('product')->id),
            ],

            'description' => ['sometimes', 'nullable', 'string'],

            'price' => ['sometimes', 'numeric', 'min:0'],

            'image' => ['sometimes', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:2048'],

            'is_available' => ['sometimes', 'boolean'],
        ];
    }
}
