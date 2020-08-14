<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use App\Http\Resources\Providers\ProviderResource;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::latest()->get();

        return ProviderResource::collection($providers);
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

        $provider = Provider::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new ProviderResource($provider);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $Provider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider = Provider::find($id);

        return $provider;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $Provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $provider = Provider::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $provider->update([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new ProviderResource($provider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $Provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);

        $provider->delete();

        return response()->json(['message' => 'Provider deleted successfully!']);

    }
}
