<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $name = str_replace(' ', '_', strtolower(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
            $fileName = $name . '_' . time() . '.' . $extension;
            $path = $file->storeAs('assets/img/products', $fileName, 'public');
            $data['image'] = $path;
        }
        $product = Product::create($data);
        return response()->json($product, 201);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();
        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assets/img/products', 'public');
        }
        $product->update($data);
        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
