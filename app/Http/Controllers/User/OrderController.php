<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderRequest;
use App\Http\Requests\User\PaymentRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkOrder(OrderRequest $request)
    {
        $data = $request->order;
        foreach ($data as $item) {
            $product = Product::where('id',$item['product_id'])->active()->available()->firstOrFail();
            if ($item['quantity'] > $product->quantity)
                return failure("There is not enough from $product->name required", 450);
        }

        return success(' order has been checked successfully');
    }

    public function createOrder(PaymentRequest $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->order as $item) {
                $product = Product::findOrFail($item['product_id']);
                if ($item['quantity'] > $product->quantity)
                    return failure("There is not enough from $product->name required", 450);
            }

            //TODO   integration with stripe 
            // Stripe::setApiKey(env('STRIPE_SECRET'));

            // $token = $request->input('stripe_token');

            // try {
            // $charge = Charge::create([
            //     'amount' => ($request->total_price * 100) /9000 , // amount in cents
            //     'currency' => 'usd',
            //     'source' => $token,
            // ]);

            $user = auth()->user() ;
            $data['user_id'] = $user->id;
            $data['user_name'] = $user->user_name;
            $data['user_phone'] = $user->phone;
            $data['user_email'] = $user->email;
            $data['total_amount'] = $request->total_price;
            $order = Order::create($data);
            $itmes = array();
            foreach ($request->order as $item) {
                $product = Product::where('id',$item['product_id'])->active()->available()->firstOrFail();
                $itmes[] = [
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                ];
                $product->decrement('quantity',$item['quantity']);
                $product->save();
            }
            OrderItem::insert($itmes);
            DB::commit();
            return success('order created successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            // return failure('sorry, some things worngs', 450);
            return $ex->getMessage();
        }
    }


    public function checkProductQuantity($order)
    {


        return true;
    }
}
