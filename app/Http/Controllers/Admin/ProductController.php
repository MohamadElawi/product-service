<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return response()->json(ProductResource::collection($products));
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->only('category_id', 'price','is_special','quantity');
            $product = Product::create($data);
            $product->translateOrNew('en')->name = $request->name_en;
            $product->translateOrNew('en')->description = $request->description_en;
            $product->translateOrNew('en')->details = $request->details_en;
            $product->addMedia($request->main_image)->toMediaCollection('main_image','product');
            foreach($request->images as $image){
                $product->addMedia($image)->toMediaCollection('product_images','product');
            }
            $product->save();
            DB::commit();
            return;
        } catch (\Exception $ex) {
            DB::rollback();
            // return response()->json('', 450);
            return $ex->getMessage();
        }
    }

    public function show(Product $product)
    {
        $product = Product::with('category')->find($product->id);
        return ProductResource::make($product);
    }

    public function update(Product $product, ProductRequest $request)
    {
        try {
            // dd($request->main_image);
            DB::beginTransaction();
            if ($product->is_special == 0 && $request->is_special == 1 && $product->quantity != $request->quantity_special_product)
                $data = $request->only('category_id','quantity');
            else
                $data = $request->only('category_id', 'price','is_special','quantity');

            foreach($data as $key=>$value){
                $product->$key =$value ;
            }

            $product->translateOrNew('en')->name = $request->name_en;
            $product->translateOrNew('en')->description = $request->description_en;
            $product->translateOrNew('en')->details = $request->details_en;

            if ($product->quantity != $request->quantity_special_product){
                $product->decrement('quantity',$request->quantity_special_product);
            }

            if ($request->main_image) {
                $product->clearMediaCollection('main_image');
                $product->addMedia($request->main_image)->toMediaCollection('main_image','product');
            }
            if($request->images){
                $product->clearMediaCollection('product_images');
                foreach($request->images as $image){
                    $product->addMedia($image)->toMediaCollection('product_images','product');
                }
            }
            $product->save();

            if ($product->is_special == 0 && $request->is_special == 1) {
                if ($product->quantity != $request->quantity_special_product) {
                    $spe_product = Product::create([
                        'category_id' => $product->category_id,
                        'price' => $request->price,
                        'quantity' => $request->quantity_special_product,
                        'is_special' => 1,
                        'product_id' => $product->id,
                    ]);
                    $spe_product->translateOrNew('en')->name = $product->name;
                    $spe_product->translateOrNew('en')->description = $product->description;
                    $spe_product->translateOrNew('en')->details = $product->details;
                    $spe_product->save();

                    // $spe_product->copy($product,'images','product');
                    // $image = $product->getMedia('main_image');
                    // dd($image);
                    // if($image != null)
                    //     $spe_product->copyMedia($image)->toMediaCollection('main_image','product');

                    // $images = $product->getMedia('product_images');
                    // if($images != null)
                    //     foreach($images as $image){
                    //         $spe_product->copyMedia($image)->toMediaCollection('product_images','product');
                    //     }

                    $spe_product->save();

                    // $images = DB::table('media')->where('model_type', 'App\Models\Product')->where('model_id', $product->id)->get();

                    // foreach ($images as $row) {
                    //     $duplicatedRow = (array) $row;
                    //     unset($duplicatedRow['id']);
                    //     unset($duplicatedRow['uuid']);
                    //     $duplicatedRow['model_id'] = $spe_product->id;
                    //     DB::table('media')->insert($duplicatedRow);
                    // }
                }
            }

            DB::commit();
            return;
        } catch (\Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function changeStatus(Product $product){
        $product->status = $product->status == 'active' ? 'notActive' :'active' ;
        $product->save();
        return ;
    }

    public function destroy(Product $product){
        $product->delete();
        return ;
    }
}
