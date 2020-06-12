<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Products\CreateProduct;
use App\Http\Requests\Products\UpdateProduct;
use App\Product;
use App\Http\Resources\Products\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
    
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProduct $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'item_type' => $request->item_type,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id
        ]);

        if($request->hasFile('product_image')) {

            $this->validate($request, [
                'product_image' => 'file|image|mimes:jpeg,jpg,png,gif|max:10000'
            ]);

            $product_image = $request->product_image->store('product_images', 'public');

            $product->product_image = $product_image;

            $product->save();
        }


        return new ProductResource($product);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        return $product;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct $request, $id)
    {
        $product = Product::whereId($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'item_type' => $request->item_type,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id
        ]);

        if($request->has('product_image')) {

            $this->validate($request, [
                'product_image' => 'file|image|mimes:jpeg,jpg,png,gif|max:10000'
            ]);

            $product = Product::findOrFail($id);

            if($product->product_image){
                Storage::delete('public/'.$product->product_image);
            }

            $product_image = $request->product_image->store('product_images', 'public');

            $product->product_image = $product_image;

            $product->save();
        }

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if($product->product_image){
            Storage::delete('public/'.$product->product_image);
        }
        
        $product->delete();

		return response()->json(['message' => 'Product deleted successfully!']);
    }
}
