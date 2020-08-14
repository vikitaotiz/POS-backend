<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Measurementunit;
use App\Http\Resources\Measurements\MeasurementResource;

class MeasurementunitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurementunits = Measurementunit::latest()->get();

        return MeasurementResource::collection($measurementunits);
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

        $measurementunit = Measurementunit::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new MeasurementResource($measurementunit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Measurementunit  $Measurementunit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $measurementunit = Measurementunit::find($id);

        return $measurementunit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Measurementunit  $Measurementunit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $measurementunit = Measurementunit::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $measurementunit->update([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new MeasurementResource($measurementunit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Measurementunit  $Measurementunit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $measurementunit = Measurementunit::find($id);

        $measurementunit->delete();

        return response()->json(['message' => 'Measurementunit deleted successfully!']);

    }
}
