<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Recharge user balance only
     */
    public function store(TransactionRequest $request): JsonResponse
    {
        $user = $request->user();

        $balanceBefore = $user->balance ?? 0;
        $balanceAfter  = $balanceBefore + $request->amount;

        $user->update(['balance' => $balanceAfter]);

        $transaction = Transaction::create([
            'user_id'        => $user->id,
            'amount'         => $request->amount,
            'type'           => 'credit', 
            'balance_before' => $balanceBefore,
            'balance_after'  => $balanceAfter,
            'description'    => $request->description ?? 'Account recharge',
        ]);

        return response()->json([
            'message' => 'Account recharged successfully',
            'data'    => $transaction,
        ], 201);
    }

  
    public function index(Request $request): JsonResponse
    {
        $transactions = $request->user()->transactions()->latest()->get();

        return response()->json([
            'data' => $transactions,
        ]);
    }
}
