<?php

use App\Http\Controllers\User\FavouriteController;
use App\Http\Controllers\User\CategoryController ;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



##################### User api
Route::get('all-category',[CategoryController::class ,'getAllCategory'])->middleware('role');
Route::get('get-By-Category/{category}',[ProductController::class ,'getProductByCategory']);
Route::get('product/show/{product}',[ProductController::class ,'show'])->middleware('role');
Route::get('get-spe-product',[ProductController::class ,'getSpecialProduct']);

Route::get('product/favourite/{product}',[FavouriteController::class,'toggleFavourite']);
Route::get('product/get-favourite',[FavouriteController::class,'getFavourite'])->middleware('role');



Route::get('test',function(Request $request ,UserActivityContext $context){
    dd($context->getUsersActivities());
    dd(auth()->user());

    auth()->guard('admin');
    auth()->guard('admin')->user();

});



Route::post('tt',function(Request $request){
     $product  = Category::first();
    $product->addMediaFromUrl('http://127.0.0.1:8080/storage/product/209/287494689_541786067482991_1026455631942863110_n.jpg')->toMediaCollection('main_images');
});
