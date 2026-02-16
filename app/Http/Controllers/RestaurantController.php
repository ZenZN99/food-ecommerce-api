<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;

class RestaurantController extends Controller
{
    /**
     * Get all restaurants
     */
    public function index(): JsonResponse
    {
        $restaurants = Restaurant::query()
            ->with('user')
            ->where('is_open', true)
            ->latest()
            ->get();

        return response()->json([
            'data' => $restaurants,
        ]);
    }

    /**
     * Store new restaurant
     */
    public function store(RestaurantRequest $request): JsonResponse
    {
        $restaurant = Restaurant::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'is_open' => $request->is_open ?? true,
            'delivery_fee' => $request->delivery_fee,
            'min_order_price' => $request->min_order_price,
        ]);

        return response()->json([
            'message' => 'Restaurant created successfully',
            'data' => $restaurant,
        ], 201);
    }

    /**
     * Show single restaurant
     */
    public function show(Restaurant $restaurant): JsonResponse
    {
        return response()->json([
            'data' => $restaurant->load('user'),
        ]);
    }

    /**
     * Update restaurant
     */
    public function update(
        RestaurantRequest $request,
        Restaurant $restaurant
    ): JsonResponse {

        $this->authorize('update', $restaurant);

        $restaurant->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_open' => $request->is_open ?? true,
            'delivery_fee' => $request->delivery_fee,
            'min_order_price' => $request->min_order_price,
        ]);

        return response()->json([
            'message' => 'Restaurant updated successfully',
            'data' => $restaurant,
        ]);
    }

    /**
     * Delete restaurant
     */
    public function destroy(Restaurant $restaurant): JsonResponse
    {

        $this->authorize('delete', $restaurant);
        $restaurant->delete();

        return response()->json([
            'message' => 'Restaurant deleted successfully',
        ]);
    }
}
