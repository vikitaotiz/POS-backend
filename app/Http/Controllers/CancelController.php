<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancel;
use App\Http\Resources\Cancels\CancelResource;

class CancelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cancels = Cancel::latest()->get();

        return CancelResource::collection($cancels);
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
            'description' => 'required'
        ]);

        $cancel = Cancel::create([
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);

        return new CancelResource($cancel);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cancel  $Cancel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cancel = Cancel::find($id);

        return new CancelResource($cancel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cancel  $Cancel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cancel = Cancel::find($id);

        $this->validate($request, [
            'description' => 'required'
        ]);

        $cancel->update([
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);

        return new CancelResource($cancel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cancel  $Cancel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cancel = Cancel::find($id);

        $cancel->delete();

        return response()->json(['message' => 'Cancel deleted successfully!']);

    }
}
