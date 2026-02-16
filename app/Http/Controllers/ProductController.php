<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Categories;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Get products for restaurant
     */
    public function index(Restaurant $restaurant): JsonResponse
    {
        return response()->json([
            'data' => $restaurant->products()
                ->where('is_available', true)
                ->with('category')
                ->latest()
                ->get(),
        ]);
    }

    /**
     * Show single product
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'data' => $product->load(['restaurant', 'category']),
        ]);
    }

    /**
     * Store new product
     */

    public function store(ProductRequest $request): JsonResponse
    {
        $restaurant =  Restaurant::findOrFail($request->restaurant_id);
        $category   =  Categories::findOrFail($request->category_id);

        if ($category->restaurant_id !== $restaurant->id) {
            abort(422, 'Category does not belong to this restaurant.');
        }

        $this->authorize('update', $restaurant);

        $imagePath = $request->file('image')->store('products', 'public');

        $product = Product::create([
            'restaurant_id' => $restaurant->id,
            'category_id'   => $category->id,
            'name'          => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
            'image'         => $imagePath,
            'is_available'  => $request->is_available ?? true,
        ]);

        return response()->json([
            'message' => 'Product created successfully',
            'data'    => $product,
        ], 201);
    }


    /**
     * Update product
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $this->authorize('update', $product->restaurant);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product,
        ]);
    }


    /**
     * Delete product
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->authorize('delete', $product->restaurant);

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }
}
