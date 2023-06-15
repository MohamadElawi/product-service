<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProduct(Product $product){
        $user = auth()->user()->id ;
        $record = Cart::firstOrNew(['user_id'=>$user , 'product_id'=>$product->id]);
        $record->increment('quantity') ;
        $record->save();
        return success('added to cart successfully');
    }

    public function removeProduct(Product $product){
        $user =auth()->user()->id ;
        $record = Cart::byUser($user)->byProduct($product->id)->firstOrfail();
        if($record->quantity > 1){
            $record->decrement('quantity');
            $record->save();
        }else
            $record->delete();

        return success('removed from cart successfully');
    }

    public function getCart(){
        $user =auth()->user()->id;
        $cart = Cart::byUser($user)->latest()->get();
        
    }
}
