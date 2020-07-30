<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pick;
use App\Http\Resources\Picks\PickResource;

class PickController extends Controller
{
    public function index()
    {
        $picks = Pick::latest()->get();

        return PickResource::collection($picks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pick = Pick::create([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'amount' => $request->amount,
            'sold' => $request->sold,
            'user_order' => $request->user_order,
            'user_id' => auth()->user()->id
        ]);

        return new PickResource($pick);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pick = Pick::findOrFail($id);

        return $pick;
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
        $pick = Pick::whereId($id)->update([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'amount' => $request->amount,
            'sold' => $request->sold,
            'user_order' => $request->user_order,
            'user_id' => auth()->user()->id
        ]);

        return $pick;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pick = Pick::findOrFail($id);

        $pick->delete();

		return response()->json(['message' => 'Pick deleted successfully!']);
    }
}
