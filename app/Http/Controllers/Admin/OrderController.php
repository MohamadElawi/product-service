<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OrderItemResource;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::latest()->get();
        return response()->json(OrderResource::collection($orders));
    }

    public function show(Order $order){
        $order = Order::with(['items'=>function($q){
            $q->with('product');
        }])->find($order->id);
        return response()->json(OrderItemResource::collection($order->items));
    }
}
