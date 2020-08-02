<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Add;
use App\Http\Resources\Adds\AddResource;

class AddController extends Controller
{
    public function index()
    {
        $adds = Add::all();

        return AddResource::collection($adds);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = Add::create([
            'user_order' => $request->user_order,
            'content' => $request->content,
            'table_name' => $request->table_name,
            'table_id' => $request->table_id,
            'amount' => $request->amount,
            'user_id' => auth()->user()->id
        ]);

        return new AddResource($add);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $add = Add::findOrFail($id);

        return $add;
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
        $add = Add::whereId($id)->update([
            'user_order' => $request->user_order,
            'content' => $request->content,
            'table_name' => $request->table_name,
            'table_id' => $request->table_id,
            'amount' => $request->amount,
            'user_id' => auth()->user()->id
        ]);

        return $add;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $add = Add::findOrFail($id);

        $add->delete();

		return response()->json(['message' => 'Add deleted successfully!']);
    }
}
