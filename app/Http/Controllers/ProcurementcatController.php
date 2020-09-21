<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procurementcat;
use App\Http\Resources\Procurements\ProcurementcatResource;

class ProcurementcatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procurementcats = Procurementcat::latest()->get();

        return ProcurementcatResource::collection($procurementcats);
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

        $procurementcat = Procurementcat::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new ProcurementcatResource($procurementcat);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Procurementcat  $Procurementcat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $procurementcat = Procurementcat::find($id);

        return new ProcurementcatResource($procurementcat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procurementcat  $Procurementcat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $procurementcat = Procurementcat::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $procurementcat->update([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new ProcurementcatResource($procurementcat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procurementcat  $Procurementcat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $procurementcat = Procurementcat::find($id);

        $procurementcat->delete();

        return response()->json(['message' => 'Procurementcat deleted successfully!']);

    }
}
