<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id'      => ['required', 'exists:orders,id'],
            'product_name'  => ['required', 'string', 'max:255'],
            'quantity'      => ['required', 'integer', 'min:1'],
            'price_snapshot'=> ['required', 'numeric', 'min:0'],
        ];
    }
}
