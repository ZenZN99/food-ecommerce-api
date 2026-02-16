<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Get current user's cart for a restaurant
     */
    public function show(Request $request, Restaurant $restaurant): JsonResponse
    {
        $cart = Cart::where('user_id', $request->user()->id)
            ->where('restaurant_id', $restaurant->id)
            ->first();

        return response()->json([
            'data' => $cart,
        ]);
    }

    /**
     * Create cart (if not exists)
     */
    public function store(CartRequest $request): JsonResponse
    {
        $cart = Cart::firstOrCreate([
            'user_id' => $request->user()->id,
            'restaurant_id' => $request->restaurant_id,
        ]);

        return response()->json([
            'message' => 'Cart ready',
            'data' => $cart,
        ], 201);
    }

    /**
     * Delete cart (clear cart)
     */
    public function destroy(Request $request, Restaurant $restaurant): JsonResponse
    {
        Cart::where('user_id', $request->user()->id)
            ->where('restaurant_id', $restaurant->id)
            ->delete();

        return response()->json([
            'message' => 'Cart deleted successfully',
        ]);
    }
}
