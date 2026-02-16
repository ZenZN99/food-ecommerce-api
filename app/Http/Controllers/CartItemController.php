<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Add product to cart OR increase quantity
     */
    public function store(
        CartItemRequest $request,
        Restaurant $restaurant
    ): JsonResponse {
        $user = $request->user();

        // get or create cart
        $cart = Cart::firstOrCreate([
            'user_id'       => $user->id,
            'restaurant_id' => $restaurant->id,
        ]);

        $product = Product::where('id', $request->product_id)
            ->where('restaurant_id', $restaurant->id)
            ->where('is_available', true)
            ->firstOrFail();

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->increment('quantity', $request->quantity ?? 1);
        } else {
            $item = CartItem::create([
                'cart_id'        => $cart->id,
                'product_id'     => $product->id,
                'quantity'       => $request->quantity ?? 1,
                'price_snapshot' => $product->price,
            ]);
        }

        return response()->json([
            'message' => 'Product added to cart',
            'data'    => $item->load('product'),
        ], 201);
    }

    /**
     * Update quantity
     */
    public function update(
        CartItemRequest $request,
        CartItem $cartItem
    ): JsonResponse {
        // security: ensure item belongs to current user
        if ($cartItem->cart->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'message' => 'Quantity updated',
            'data'    => $cartItem,
        ]);
    }

    /**
     * Remove item from cart
     */
    public function destroy(
        Request $request,
        CartItem $cartItem
    ): JsonResponse {
        if ($cartItem->cart->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $cartItem->delete();

        return response()->json([
            'message' => 'Item removed from cart',
        ]);
    }
}
