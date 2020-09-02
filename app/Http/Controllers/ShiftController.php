<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shift;
use App\Http\Resources\Shifts\ShiftResource;


class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::latest()->get();

        return ShiftResource::collection($shifts);
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
            'cash_in_drawer' => 'required'
        ]);

        $shift = Shift::firstOrCreate([
            'daily_sale' => $request->daily_sale,
            'daily_expense' => $request->daily_expense,
            'cash' => $request->cash,
            'mpesa' => $request->mpesa,
            'card' => $request->card,
            'credit' => $request->credit,
            'cash_at_hand' => $request->cash_at_hand,
            'cash_in_drawer' => $request->cash_in_drawer,
            'user_id' => $request->user_id
        ]);

        return new ShiftResource($shift);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shift  $Shift
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shift = Shift::find($id);

        return $shift;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shift  $Shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shift = Shift::find($id);

        $this->validate($request, [
            'cash_in_drawer' => 'required'
        ]);

        $shift->update([
            'daily_sale' => $request->daily_sale,
            'daily_expense' => $request->daily_expense,
            'cash' => $request->cash,
            'mpesa' => $request->mpesa,
            'card' => $request->card,
            'credit' => $request->credit,
            'cash_at_hand' => $request->cash_at_hand,
            'cash_in_drawer' => $request->cash_in_drawer,
            'user_id' => $request->user_id
        ]);

        return new ShiftResource($shift);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shift  $Shift
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = Shift::find($id);

        $shift->delete();

        return response()->json(['message' => 'Shift deleted successfully!']);

    }
}
