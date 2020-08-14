<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paymentmode;
use App\Http\Resources\Payments\PaymentmodeResource;

class PaymentmodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentmodes = Paymentmode::latest()->get();

        return PaymentmodeResource::collection($paymentmodes);
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

        $paymentmode = Paymentmode::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new PaymentmodeResource($paymentmode);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paymentmode  $Paymentmode
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentmode = Paymentmode::find($id);

        return $paymentmode;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paymentmode  $Paymentmode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paymentmode = Paymentmode::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $paymentmode->update([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new PaymentmodeResource($paymentmode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paymentmode  $Paymentmode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentmode = Paymentmode::find($id);

        $paymentmode->delete();

        return response()->json(['message' => 'Paymentmode deleted successfully!']);

    }
}
