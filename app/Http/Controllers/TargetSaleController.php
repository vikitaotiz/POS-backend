<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TargetSale;

class TargetSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = TargetSale::latest()->first();

        return $sales;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'daily_target_sale' => 'required'
        ]);

        $sale = TargetSale::create([
            'daily_target_sale' => $request->daily_target_sale,
            'user_id' => $request->user_id
        ]);

        return $sale;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $Sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sale = TargetSale::find($id);

        $this->validate($request, [
            'daily_target_sale' => 'required'
        ]);

        $sale->update([
            'daily_target_sale' => $request->daily_target_sale,
            'user_id' => $request->user_id
        ]);

        return $sale;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $Sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = TargetSale::find($id);

        $sale->delete();

        return response()->json(['message' => 'Sale deleted successfully!']);

    }
}
