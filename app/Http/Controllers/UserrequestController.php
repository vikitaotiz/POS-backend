<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userrequest;
use App\Http\Resources\Users\UserrequestResource;

class UserrequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userrequests = Userrequest::latest()->get();

        return UserrequestResource::collection($userrequests);
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

        $userrequest = Userrequest::create([
            'name' => $request->name,
            'qty' => $request->qty,
            'measurementunit' => $request->measurementunit,
            'user_id' => $request->user_id
        ]);

        return new UserrequestResource($userrequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Userrequest  $Userrequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userrequest = Userrequest::find($id);

        return $userrequest;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Userrequest  $Userrequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userrequest = Userrequest::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $userrequest->update([
            'name' => $request->name,
            'qty' => $request->qty,
            'measurementunit' => $request->measurementunit,
            'user_id' => $request->user_id
        ]);

        return new UserrequestResource($userrequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Userrequest  $Userrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userrequest = Userrequest::find($id);

        $userrequest->delete();

        return response()->json(['message' => 'Userrequest deleted successfully!']);

    }
}
