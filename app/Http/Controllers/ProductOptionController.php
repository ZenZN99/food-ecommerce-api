<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductOptionRequest;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Http\JsonResponse;

class ProductOptionController extends Controller
{
    /**
     * Get options for product
     */
    public function index(Product $product): JsonResponse
    {
        return response()->json([
            'data' => $product->product_options()->latest()->get(),
        ]);
    }

    /**
     * Store new option
     */
    public function store(ProductOptionRequest $request): JsonResponse
    {
        $product = Product::with('restaurant')->findOrFail($request->product_id);

        $this->authorize('update', $product->restaurant);

        $option = ProductOption::create([
            'product_id' => $product->id,
            'name'       => $request->name,
            'price'      => $request->price,
        ]);

        return response()->json([
            'message' => 'Product option created successfully',
            'data'    => $option,
        ], 201);
    }

    /**
     * Show single option
     */
    public function show(ProductOption $productOption): JsonResponse
    {
        return response()->json([
            'data' => $productOption->load('product'),
        ]);
    }

    /**
     * Update option
     */
    public function update(
        ProductOptionRequest $request,
        ProductOption $productOption
    ): JsonResponse {
        $this->authorize(
            'update',
            $productOption->product->restaurant
        );

        $productOption->update([
            'name'  => $request->name,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'Product option updated successfully',
            'data'    => $productOption,
        ]);
    }

    /**
     * Delete option
     */
    public function destroy(ProductOption $productOption): JsonResponse
    {
        $this->authorize(
            'delete',
            $productOption->product->restaurant
        );

        $productOption->delete();

        return response()->json([
            'message' => 'Product option deleted successfully',
        ]);
    }
}
