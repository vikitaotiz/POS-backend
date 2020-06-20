<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Addon;
use App\Http\Resources\Addons\AddonsResource;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addons = Addon::latest()->get();

        return AddonsResource::collection($addons);
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

        $addon = Addon::create([
            'name' => $request->name,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'user_id' => $request->user_id
        ]);

        return new AddonsResource($addon);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $addon = Addon::find($id);

        return new AddonResource($addon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $addon = Addon::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $addon->update([
            'name' => $request->name,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'user_id' => $request->user_id
        ]);

        return new AddonResource($addon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addon = Addon::find($id);

        $addon->delete();

        return response()->json(['message' => 'addon deleted successfully!']);

    }
}
