<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Show all items of an order (Customer can see only their orders)
     */
    public function index(Order $order, Request $request): JsonResponse
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        return response()->json([
            'data' => $order->items()->get(),
        ]);
    }

    /**
     * Add item to an order (Customer only)
     */
    public function store(OrderItemRequest $request): JsonResponse
    {
        $order = Order::findOrFail($request->order_id);

        if ($order->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $item = OrderItem::create([
            'order_id'       => $order->id,
            'product_name'   => $request->product_name,
            'quantity'       => $request->quantity,
            'price_snapshot' => $request->price_snapshot,
        ]);

        return response()->json([
            'message' => 'Order item added successfully',
            'data'    => $item,
        ], 201);
    }

    /**
     * Update an order item (Customer only)
     */
    public function update(OrderItemRequest $request, OrderItem $orderItem): JsonResponse
    {
        if ($orderItem->order->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $orderItem->update([
            'product_name'   => $request->product_name,
            'quantity'       => $request->quantity,
            'price_snapshot' => $request->price_snapshot,
        ]);

        return response()->json([
            'message' => 'Order item updated successfully',
            'data'    => $orderItem,
        ]);
    }

    /**
     * Delete an order item (Customer only)
     */
    public function destroy(OrderItem $orderItem, Request $request): JsonResponse
    {
        if ($orderItem->order->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $orderItem->delete();

        return response()->json([
            'message' => 'Order item deleted successfully',
        ]);
    }
}
