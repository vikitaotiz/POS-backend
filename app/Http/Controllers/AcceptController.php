<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accept;
use App\Http\Resources\Procurements\AcceptResource;

class AcceptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accepts = Accept::latest()->get();

        return AcceptResource::collection($accepts);
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
            'content' => 'required'
        ]);

        $accept = Accept::create([
            'provider_name' => $request->provider_name,
            'user_requesting' => $request->user_requesting,
            'content' => $request->content,
            'user_id' => $request->user_id
        ]);

        return new AcceptResource($accept);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accept  $Accept
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accept = Accept::find($id);

        return $accept;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accept  $Accept
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $accept = Accept::find($id);

        $this->validate($request, [
            'content' => 'required'
        ]);

        $accept->update([
            'provider_name' => $request->provider_name,
            'user_requesting' => $request->user_requesting,
            'content' => $request->content,
            'user_id' => $request->user_id
        ]);

        return new AcceptResource($accept);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accept  $Accept
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accept = Accept::find($id);

        $accept->delete();

        return response()->json(['message' => 'Accept deleted successfully!']);

    }
}
