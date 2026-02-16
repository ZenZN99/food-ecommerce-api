<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Pay for a cart using user balance
     */
    public function pay(PaymentRequest $request): JsonResponse
    {
        $user = $request->user();
        $cart = Cart::with('items.product')->findOrFail($request->cart_id);

        if ($cart->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized cart access'], 403);
        }

        if ($cart->items->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $totalPrice = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });


        if ($user->balance < $totalPrice) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

        $balanceBefore = $user->balance;
        $balanceAfter  = $balanceBefore - $totalPrice;

        $user->update(['balance' => $balanceAfter]);

        $transaction = Transaction::create([
            'user_id'        => $user->id,
            'amount'         => $totalPrice,
            'type'           => 'debit',
            'balance_before' => $balanceBefore,
            'balance_after'  => $balanceAfter,
            'description'    => 'Cart payment',
        ]);

        $payment = Payment::create([
            'user_id'        => $user->id,
            'cart_id'        => $cart->id,
            'transaction_id' => $transaction->id,
            'amount'         => $totalPrice,
            'status'         => 'completed',
        ]);

        $cart->items()->delete();

        return response()->json([
            'message' => 'Payment completed successfully',
            'data'    => $payment,
        ], 201);
    }


    public function index(Request $request): JsonResponse
    {
        $payments = $request->user()->payments()->latest()->get();

        return response()->json(['data' => $payments]);
    }
}
