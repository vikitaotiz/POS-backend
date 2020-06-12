<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use App\Http\Resources\Tables\TableResource;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::latest()->get();

        return TableResource::collection($tables);
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
            'name' => 'required'
        ]);

        $table = Table::create([
            'name' => $request->name,
            'content' => $request->content,
            'user_id' => $request->user_id
        ]);

        return new TableResource($table);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Table  $Table
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Table::find($id);

        return $table;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Table  $Table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = Table::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $table->update([
            'name' => $request->name,
            'content' => $request->content,
            'user_id' => $request->user_id
        ]);

        return new TableResource($table);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Table  $Table
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::find($id);

        $table->delete();

        return response()->json(['message' => 'Table deleted successfully!']);

    }
}
