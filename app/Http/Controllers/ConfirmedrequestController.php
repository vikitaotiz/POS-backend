<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Confirmedrequest;
use App\Http\Resources\Users\ConfirmedrequestResource;

class ConfirmedrequestController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $confirmedrequests = Confirmedrequest::latest()->get();

        return ConfirmedrequestResource::collection($confirmedrequests);
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

        $confirmedrequest = Confirmedrequest::create([
            'content' => $request->content,
            'amount' => $request->amount,
            'user_requesting' => $request->user_requesting,
            'provider_id' => $request->provider_id,
            'paymentmode_id' => $request->paymentmode_id,
            'user_id' => $request->user_id
        ]);

        return new ConfirmedrequestResource($confirmedrequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Confirmedrequest  $Confirmedrequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $confirmedrequest = Confirmedrequest::find($id);

        return $confirmedrequest;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Confirmedrequest  $Confirmedrequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $confirmedrequest = Confirmedrequest::find($id);

        $this->validate($request, [
            'content' => 'required'
        ]);

        $confirmedrequest->update([
            'content' => $request->content,
            'amount' => $request->amount,
            'user_requesting' => $request->user_requesting,
            'provider_id' => $request->provider_id,
            'paymentmode_id' => $request->paymentmode_id,
            'user_id' => $request->user_id
        ]);

        return new ConfirmedrequestResource($confirmedrequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Confirmedrequest  $Confirmedrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $confirmedrequest = Confirmedrequest::find($id);

        $confirmedrequest->delete();

        return response()->json(['message' => 'Confirmedrequest deleted successfully!']);

    }
}
