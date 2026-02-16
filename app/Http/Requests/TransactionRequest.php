<?php

namespace App\Http\Requests;


class TransactionRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id'    => ['nullable', 'exists:orders,id'],
            'amount'      => ['required', 'numeric', 'min:0'],
            'type'        => ['required', 'in:debit,credit'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }
}
