<?php

use App\Http\Controllers\User\FavouriteController;
use App\Http\Controllers\User\CategoryController ;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController ;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Ite\IotCore\Context\UserActivityContext;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


##################### User api
Route::get('all-category',[CategoryController::class ,'getAllCategory']);
Route::get('get-By-Category/{category}',[ProductController::class ,'getProductByCategory']);
Route::get('product/show/{product}',[ProductController::class ,'show'])->middleware('role');
Route::get('get-spe-product',[ProductController::class ,'getSpecialProduct']);

Route::get('product/favourite/{product}',[FavouriteController::class,'toggleFavourite'])->middleware('role');
Route::get('product/get-favourite',[FavouriteController::class,'getFavourite'])->middleware('role');


Route::group(['prefix'=>'order'],function(){
    Route::post('check',[OrderController::class , 'checkOrder'])->middleware('role');    
    Route::post('payment',[OrderController::class , 'createOrder'])->middleware('role');    

});



Route::get('test',function(Request $request ,UserActivityContext $context){
    $product = Product::latest()->first();
    $spe_product = Product::find(44396);
    $image = $product->getFirstMedia('main_image');
    $image->copy($spe_product ,'main_image','product');
    $spe_product->save();
    dd();
    dd($context->getUsersActivities());
});

