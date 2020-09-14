<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procurement;
use App\Http\Resources\Procurements\ProcurementResource;

class ProcurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procurements = Procurement::latest()->get();

        return ProcurementResource::collection($procurements);
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

        $procurement = Procurement::create([
            'name' => $request->name,
            'measurementunit_id' => $request->measurementunit_id,
            'user_id' => $request->user_id
        ]);

        return new ProcurementResource($procurement);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Procurement  $Procurement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $procurement = Procurement::find($id);

        return $procurement;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procurement  $Procurement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $procurement = Procurement::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $procurement->update([
            'name' => $request->name,
            'measurementunit_id' => $request->measurementunit_id,
            'user_id' => $request->user_id
        ]);

        return new ProcurementResource($procurement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procurement  $Procurement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $procurement = Procurement::find($id);

        $procurement->delete();

        return response()->json(['message' => 'Procurement deleted successfully!']);

    }
}
