<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemOptionRequest;
use App\Models\CartItem;
use App\Models\CartItemOption;
use App\Models\ProductOption;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartItemOptionController extends Controller
{
    /**
     * Add option to cart item
     */
    public function store(
        CartItemOptionRequest $request,
        CartItem $cartItem
    ): JsonResponse {

        if ($cartItem->cart->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized cart access');
        }

        $productOption = ProductOption::where('id', $request->product_option_id)
            ->where('product_id', $cartItem->product_id)
            ->firstOrFail();

        $option = CartItemOption::firstOrCreate(
            [
                'cart_item_id' => $cartItem->id,
                'product_option_id' => $productOption->id,
            ],
            [
                'price_snapshot' => $productOption->price,
            ]
        );

        return response()->json([
            'message' => 'Option added to cart item',
            'data' => $option->load('productOption'),
        ], 201);
    }

    /**
     * Remove option from cart item
     */
    public function destroy(
        Request $request,
        CartItemOption $cartItemOption
    ): JsonResponse {

        if ($cartItemOption->cartItem->cart->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized cart access');
        }

        $cartItemOption->delete();

        return response()->json([
            'message' => 'Option removed from cart item',
        ]);
    }
}
