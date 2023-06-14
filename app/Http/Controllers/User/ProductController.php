<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Product\IndexResource;
use App\Http\Resources\User\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getProductByCategory(Category $category){
        $products =Product::byCategory($category->id)->active()->paginate();
        $pagination_data =pagination_collection($products);
        return returnData('products',IndexResource::collection($products),$pagination_data);
    }

    public function show(Product $product){
        abort_if($product->status != 'active',404);
        return returnData('product',ProductResource::make($product));
    }

    public function getSpecialProduct(){
        $spe_products =Product::isSpecial()->latest()->paginate();
        $pagination_data =pagination_collection($spe_products);
        return returnData('special_products',IndexResource::collection($spe_products),$pagination_data);
    }

}
