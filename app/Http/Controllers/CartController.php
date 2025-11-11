<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart($productId)
    {
        Product::findOrFail($productId);
        Auth::user()->products()->syncWithoutDetaching($productId);
        return response()->json(['message' => 'Product added to cart'], 200);
    }

    public function removeFromCart($productId)
    {
        Product::findOrFail($productId);
        Auth::user()->products()->detach($productId);
        return response()->json(['message' => 'Product removed from cart'], 200);
    }

    public function index()
    {
        $cartItems = Auth::user()->products()->withPivot('quantity')->get();
        return response()->json($cartItems, 200);
    }

    public function updateQuantity(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        Product::findOrFail($productId);
        Auth::user()->products()->updateExistingPivot($productId, ['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart item quantity updated'], 200);
    }
}
