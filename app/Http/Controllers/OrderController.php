<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    public function store(StoreOrderRequest $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->validated();
        $data['user_id'] = $user_id;
        $order = Order::create($data);

        return response()->json($order, 201);
    }

    public function update(Request $request){
        $user_id=Auth::user()->id;
        $order=Order::where('user_id',$user_id)->first();
        if(!$order){
            return response()->json(['message'=>'Order not found'],404);
        }
        $order->status=$request->status;
        $order->save();
        return response()->json($order,200);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}

