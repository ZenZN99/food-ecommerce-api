<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Categories;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Get categories for restaurant
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Categories::latest()->get(),
        ]);
    }


    /**
     * Show single category
     */
    public function show(Restaurant $restaurant): JsonResponse
    {
        return response()->json([
            'data' => $restaurant->categories()->latest()->get(),
        ]);
    }

    /**
     * Store new category
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $restaurant = Restaurant::findOrFail($request->restaurant_id);

        $this->authorize('update', $restaurant);

        $category = Categories::create([
            'restaurant_id' => $restaurant->id,
            'name' => $request->name,
            'is_active' => $request->is_active ?? true,
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category,
        ], 201);
    }

    /**
     * Update category
     */
    public function update(
        CategoryRequest $request,
        Categories $category
    ): JsonResponse {

        $this->authorize('update', $category->restaurant);

        $category->update([
            'name' => $request->name,
            'is_active' => $request->is_active ?? true,
        ]);

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category,
        ]);
    }

    /**
     * Delete category
     */
    public function destroy(Categories $category): JsonResponse
    {
        $this->authorize('delete', $category->restaurant);

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully',
        ]);
    }
}
