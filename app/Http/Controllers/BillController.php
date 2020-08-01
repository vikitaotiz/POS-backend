<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Http\Resources\Bills\BillResource;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::latest()->get();

        return BillResource::collection($bills);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bill = Bill::create([
            'amount' => $request->amount,
            'sold' => $request->sold,
            'freaze' => $request->freaze,
            'split' => $request->split,
            'merged' => $request->merged,
            'content' => $request->content,
            'user_order' => $request->user_order,
            'table' => $request->table,
            'user_id' => $request->user_id
        ]);

        return new BillResource($bill);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::findOrFail($id);

        return $bill;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bill = Bill::whereId($id)->update([
           	'amount' => $request->amount,
            'sold' => $request->sold,
            'freaze' => $request->freaze,
            'split' => $request->split,
            'merged' => $request->merged,
            'content' => $request->content,
            'user_id' => $request->user_id
        ]);

        return $bill;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill = Bill::findOrFail($id);

        $bill->delete();

		return response()->json(['message' => 'Bill deleted successfully!']);
    }
}
