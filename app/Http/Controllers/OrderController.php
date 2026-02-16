<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->with('restaurant')
            ->latest()
            ->get();

        return response()->json([
            'data' => $orders,
        ]);
    }


    public function show(Order $order, Request $request): JsonResponse
    {

        if ($order->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        return response()->json([
            'data' => $order->load(['restaurant', 'user']),
        ]);
    }

    public function store(OrderRequest $request): JsonResponse
    {
        $order = Order::create([
            'user_id'       => $request->user()->id,
            'restaurant_id' => $request->restaurant_id,
            'total_price'   => $request->total_price,
            'delivery_fee'  => $request->delivery_fee ?? 0,
            'status'        => $request->status ?? "pending",
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'data'    => $order,
        ], 201);
    }


    public function update(OrderRequest $request, Order $order): JsonResponse
    {
        $order->update([
            'status'       => $request->status ?? $order->status,
            'total_price'  => $request->total_price ?? $order->total_price,
            'delivery_fee' => $request->delivery_fee ?? $order->delivery_fee,
        ]);

        return response()->json([
            'message' => 'Order updated successfully',
            'data'    => $order,
        ]);
    }

    public function destroy(Order $order, Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->role !== 'Admin') {
            return response()->json(['error' => 'Forbidden. Admins only'], 403);
        }

        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully',
        ]);
    }

    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        $user = $request->user();

        if ($user->role !== 'Delivery') {
            return response()->json(['error' => 'Forbidden. Delivery only'], 403);
        }

        $allowedStatuses = ['pending', 'confirmed', 'delivered', 'canceled'];
        $status = $request->status;

        if (!in_array($status, $allowedStatuses)) {
            return response()->json(['error' => 'Invalid status value'], 422);
        }

        $order->update([
            'status' => $status,
        ]);

        return response()->json([
            'message' => 'Order status updated successfully',
            'data'    => $order,
        ]);
    }
}
