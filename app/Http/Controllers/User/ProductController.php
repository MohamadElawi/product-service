<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getProductByCategory(Category $category){
        $products =Product::byCategory($category->id)->active()->paginate();
        $pagination_data =pagination_collection($products);
        return returnData('products',ProductResource::collection($products),$pagination_data);
    }

    public function show(Product $product){
        abort_if($product->status != 'active',404);
        return returnData('product',ProductResource::make($product));
    }

}
