<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategory(){
        $category = Category::active()->latest()->paginate();
        $pagination_data = pagination_collection($category);
        return returnData('category',CategoryResource::collection($category),$pagination_data);
    }

}
