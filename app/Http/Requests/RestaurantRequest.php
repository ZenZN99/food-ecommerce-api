<?php

namespace App\Http\Requests;


class RestaurantRequest extends BaseRequest
{
    public function authorize(): bool
    {

        return $this->user() && $this->user()->role === 'restaurant_owner';
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_open' => ['boolean'],
            'delivery_fee' => ['required', 'numeric', 'min:0'],
            'min_order_price' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function failedAuthorization()
    {
        abort(403, 'Only restaurant owners can manage restaurants.');
    }
}
