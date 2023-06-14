<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::latest()->get();
        // return CategoryResource::collection($categories);
        return response()->json(CategoryResource::collection($categories));
    }

    public function getData(){
        $categories = Category::latest()->get();
        return DataTables::of($categories)
        // ->addColumn('action', 'admin.categories.actions')/
        ->addIndexColumn()
        ->make(true);

    }

    public function getActiveCategory(){
        $categories =Category::active()->latest()->get();
        return response()->json($categories);
    }

    public function store(CategoryRequest $request)
    {
        try{
        DB::beginTransaction();
        // $data =  $request->safe()->only('name', 'description');
        $data['status'] = 'active';
        $category =Category::create([
            'status'=>'active',
        ]);
        $category->translateOrNew('en')->name = $request->name_en ;
        $category->translateOrNew('en')->description = $request->description_en ;
        $category->save();
        $category->addMedia($request->image)->toMediaCollection('images','category');
        DB::commit();
        return true ;
        }catch(\Exception $ex){
            DB::rollback();
            return false ;
        }
    }

    public function show(Category $category) //
    {
        return response()->json(CategoryResource::make($category));
    }

    public function changeStatus(Category $category){
        $category->status = $category->status == 'active' ? 'notActive' :'active' ;
        $category->save();
        return ;
    }

    public function update(Category $category ,Request $request)
    {
        $category->translateOrNew('en')->name =$request->name_en ;
        $category->translateOrNew('en')->description =$request->description_en ;
        $category->save();
        if($request->has('image')){
            $category->clearMediaCollection('images');
            $category->addMedia($request->image)->toMediaCollection('images','product');
        }
        return ;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return ;
    }
}
