<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemOptionRequest;
use App\Models\OrderItem;
use App\Models\OrderItemOption;
use Illuminate\Http\JsonResponse;

class OrderItemOptionController extends Controller
{
 
    public function store(OrderItemOptionRequest $request, OrderItem $orderItem): JsonResponse
    {
        $option = OrderItemOption::create([
            'order_item_id' => $orderItem->id,
            'option_name'   => $request->option_name,
            'price_snapshot'=> $request->price_snapshot,
        ]);

        return response()->json([
            'message' => 'Option added to order item',
            'data'    => $option,
        ], 201);
    }

   
    public function update(OrderItemOptionRequest $request, OrderItemOption $orderItemOption): JsonResponse
    {
        $orderItemOption->update([
            'option_name'   => $request->option_name,
            'price_snapshot'=> $request->price_snapshot,
        ]);

        return response()->json([
            'message' => 'Option updated successfully',
            'data'    => $orderItemOption,
        ]);
    }

    
    public function destroy(OrderItemOption $orderItemOption): JsonResponse
    {
        $orderItemOption->delete();

        return response()->json([
            'message' => 'Option removed from order item',
        ]);
    }
}
