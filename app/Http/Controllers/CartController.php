<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Http\Resources\Carts\CartResource;
use App\Http\Requests\Carts\CreateCart;
use App\Http\Requests\Carts\UpdateCart;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::latest()->get();

        return CartResource::collection($carts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCart $request)
    {
        $cart = Cart::firstOrCreate([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'amount' => $request->amount,
            'user_id' => auth()->user()->id
        ]);

        return new CartResource($cart);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = Cart::findOrFail($id);

        return $cart;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCart $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->update([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'amount' => $request->amount,
            'user_id' => auth()->user()->id
        ]);

        return new CartResource($cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

		return response()->json(['message' => 'Cart deleted successfully!']);
    }
}
