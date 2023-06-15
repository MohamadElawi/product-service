<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductObserver
{

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        if ($product->is_special == 0 && $this->request->is_special == 1) {
            if ($product->quantity != $this->request->quantity_special_product) {
                $spe_product = Product::create([
                    'category_id' => $product->category_id,
                    'price' => $this->request->price,
                    'quantity' => $this->request->quantity_special_product,
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
    }
    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
