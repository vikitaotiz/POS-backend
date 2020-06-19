<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ready;
use App\Http\Resources\Ready\ReadyResource;

class ReadyController extends Controller
{
    public function index()
    {
        $readys = Ready::all();
    
        return ReadyResource::collection($readys);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ready = Ready::create([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'amount' => $request->amount,
            'sold' => $request->sold,
            'freaze' => $request->freaze,
            'merged' => $request->merged,
            'split' => $request->split,
            'user_order' => $request->user_order,
            'user_id' => auth()->user()->id
        ]);

        return new ReadyResource($ready);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ready = Ready::findOrFail($id);
        
        return new ReadyResource($ready);
    }

    public function split_ready($id)
    {
        $ready = Ready::findOrFail($id);

        $ready->split = 1;
        $ready->save();

        return new ReadyResource($ready);
    }

    public function merge_ready($id)
    {
        $ready = Ready::findOrFail($id);
        $ready->merged = 1;
        $ready->save();

        return new ReadyResource($ready);
    }

    public function unmerge_ready()
    {
        $readys = Ready::where('split', 0)->get();

        foreach ($readys as $table) {
            $table->merged = 0;
            $table->save();
        }
    
        return ReadyResource::collection($readys);
    }

    public function undo_table_split_ready($id)
    {
        $ready = Ready::findOrFail($id);
        
        $ready->split = 0;
        $ready->save();

        return new ReadyResource($ready);
    }

    public function undo_table_merge_ready($id)
    {
        $ready = Ready::findOrFail($id);
        
        $ready->merged = 0;
        $ready->save();

        return new ReadyResource($ready);
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
        $ready = Ready::findOrFail($id);

        $ready->update([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'amount' => $request->amount,
            'sold' => $request->sold,
            'freaze' => $request->freaze,
            'merged' => $request->merged,
            'split' => $request->split,
            'user_order' => $request->user_order,
            'user_id' => auth()->user()->id
        ]);

        return new ReadyResource($ready);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ready = Ready::findOrFail($id);
        
        $ready->delete();

		return response()->json(['message' => 'Ready deleted successfully!']);
    }
}
