<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timer;
use App\Http\Resources\Timers\TimerResource;
use Carbon\Carbon;

class TimerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timers = Timer::latest()->get();

        return TimerResource::collection($timers);
    }

    public function timers_kitchen()
    {
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();
        $timers = Timer::whereBetween('created_at', [$from, $to])
                        ->where('module', 'Kitchen')->get();
        return TimerResource::collection($timers);
    }

    public function timers_barista()
    {
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();
        $timers = Timer::whereBetween('created_at', [$from, $to])
                        ->where('module', 'Barista')->get();
        return TimerResource::collection($timers);
    }

    public function timers_pick()
    {
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();
        $timers = Timer::whereBetween('created_at', [$from, $to])
                        ->where('module', 'Pick')->get();
        return TimerResource::collection($timers);
    }


    public function timers_kitchen_all()
    {
        $timers = Timer::where('module', 'Kitchen')->get();
        return TimerResource::collection($timers);
    }

    public function timers_barista_all()
    {
        $timers = Timer::where('module', 'Barista')->get();
        return TimerResource::collection($timers);
    }

    public function timers_pick_all()
    {
        $timers = Timer::where('module', 'Pick')->get();
        return TimerResource::collection($timers);
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
            'module' => 'required'
        ]);

        $timer = Timer::firstOrCreate([
            'module' => $request->module,
            'timer' => $request->timer,
            'user_order' => $request->user_order,
            'table_name' => $request->table_name,
            'content' => $request->content,
            'amount' => $request->amount,
            'user_id' => $request->user_id
        ]);

        return new TimerResource($timer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timer  $Timer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $timer = Timer::find($id);

        return $timer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timer  $Timer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $timer = Timer::find($id);

        $this->validate($request, [
            'module' => 'required'
        ]);

        $timer->update([
            'module' => $request->module,
            'timer' => $request->timer,
            'user_order' => $request->user_order,
            'table_name' => $request->table_name,
            'content' => $request->content,
            'amount' => $request->amount,
            'user_id' => $request->user_id
        ]);

        return new TimerResource($timer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timer  $Timer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timer = Timer::find($id);

        $timer->delete();

        return response()->json(['message' => 'Timer deleted successfully!']);

    }
}
