<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')->get();
        return response()->json($orders);
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'price'      => $request->price,
            'date'       => $request->date ?? now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        broadcast(new OrderCreated($order))->toOthers();

        return response()->json(['message' => 'Order created successfully'], 201);
    }

}
