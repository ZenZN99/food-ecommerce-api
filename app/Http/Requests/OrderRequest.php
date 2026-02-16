<?php

namespace App\Http\Requests;


class OrderRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'total_price'   => ['required', 'numeric', 'min:0'],
            'delivery_fee'  => ['nullable', 'numeric', 'min:0'],
            'status'        => ['nullable', 'in:pending,confirmed,delivered,canceled'], 
        ];
    }
}
