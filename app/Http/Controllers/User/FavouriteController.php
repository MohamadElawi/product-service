<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\FavouriteResource;
use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function toggleFavourite(Product $product){
        if($product->status == 'notActive')
            return failure('product not available',450);

        $user = auth()->user()->id ;

        $favourite = Favourite::byUser($user)->byProduct($product->id)->first();

        if($favourite){
            $favourite->delete();
            return success('removed from favourite successfully');
        }

        Favourite::create([
            'user_id' => $user ,
            'product_id' => $product->id
        ]);

        return success('added to favourite successfully');
    }

    public function getFavourite(){
        $user = auth()->user()->id;
        $favourites = Favourite::with(['product'=>function($q){
            $q->active();
        }])->byUser($user)->latest()->get();

        return returnData('products',FavouriteResource::collection($favourites));
    }
}
