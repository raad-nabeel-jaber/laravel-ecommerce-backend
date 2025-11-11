<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function processCheckout(Request $request)
    {
        $user = Auth::user();
        // Validate the request data
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:20',
            'message' => 'nullable|string|max:500',
        ]);
        if($user->products()->count() == 0){
            return response()->json(['message' => 'No products in cart'], 400);
        }
        $total = 0;
        foreach($user->products as $product){
            $total += $product->price * $product->pivot->quantity;
        }
        DB::beginTransaction();

        try{
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $validated['shipping_address'],
                'shipping_phone' => $validated['shipping_phone'],
                'message' => $validated['message'] ?? null,
            ]);

            foreach($user->products as $product){
                $order->products()->attach($product->id, [
                    'quantity' => $product->pivot->quantity,
                    'price' => $product->price,
                ]);
            }

            // Clear user's cart
            $user->products()->detach();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Checkout failed', 'error' => $e->getMessage()], 500);
        }

        // Process the checkout logic here (e.g., create order, reduce stock, etc.)

        return response()->json(['message' => 'Checkout processed successfully']);
    }
}
