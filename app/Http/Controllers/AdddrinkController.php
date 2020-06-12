<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adddrink;
use App\Http\Resources\Adds\AdddrinkResource;

class AdddrinkController extends Controller
{
     public function index()
    {
        $adddrinks = Adddrink::all();
    
        return AdddrinkResource::collection($adddrinks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adddrink = Adddrink::create([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'table_id' => $request->table_id,
            'amount' => $request->amount,
            'user_id' => auth()->user()->id
        ]);

        return new AdddrinkResource($adddrink);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adddrink = Adddrink::findOrFail($id);
        
        return $adddrink;
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
        $adddrink = Adddrink::whereId($id)->update([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'table_id' => $request->table_id,
            'amount' => $request->amount,
            'user_id' => auth()->user()->id
        ]);

        return $adddrink;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adddrink = Adddrink::findOrFail($id);
        
        $adddrink->delete();

		return response()->json(['message' => 'Adddrink deleted successfully!']);
    }
}
