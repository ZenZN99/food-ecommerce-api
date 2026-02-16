<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $addresses = $request->user()->addresses()->latest()->get();

        return response()->json([
            'data' => $addresses,
        ]);
    }


    public function store(AddressRequest $request): JsonResponse
    {
        $address = Address::create([
            'user_id' => $request->user()->id,
            'city'    => $request->city,
            'street'  => $request->street,
            'notes'   => $request->notes ?? null,
            'lat'     => $request->lat ?? 0,
            'lng'     => $request->lng ?? 0,
        ]);

        return response()->json([
            'message' => 'Address created successfully',
            'data'    => $address,
        ], 201);
    }


    public function update(AddressRequest $request, Address $address): JsonResponse
    {
        if ($address->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $address->update([
            'city'   => $request->city,
            'street' => $request->street,
            'notes'  => $request->notes,
            'lat'    => $request->lat,
            'lng'    => $request->lng,
        ]);

        return response()->json([
            'message' => 'Address updated successfully',
            'data'    => $address,
        ]);
    }


    public function destroy(Request $request, Address $address): JsonResponse
    {
        if ($address->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $address->delete();

        return response()->json([
            'message' => 'Address deleted successfully',
        ]);
    }
}
