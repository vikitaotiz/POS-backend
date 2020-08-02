<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Addpick;
use App\Http\Resources\Addpicks\AddpickResource;

class AddpickController extends Controller
{
    public function index()
    {
        $addpicks = Addpick::all();

        return AddpickResource::collection($addpicks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addpick = Addpick::create([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'table_id' => $request->table_id,
            'amount' => $request->amount,
            'user_id' => auth()->user()->id,
            'user_order' => $request->user_order
        ]);

        return new AddpickResource($addpick);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $addpick = Addpick::findOrFail($id);

        return $addpick;
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
        $addpick = Addpick::whereId($id)->update([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'table_id' => $request->table_id,
            'amount' => $request->amount,
            'user_id' => auth()->user()->id,
            'user_order' => $request->user_order
        ]);

        return $addpick;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addpick = Addpick::findOrFail($id);

        $addpick->delete();

		return response()->json(['message' => 'Addpick deleted successfully!']);
    }
}
