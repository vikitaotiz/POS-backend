<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logger;
use App\Http\Resources\Logs\LoggerResource;

class LoggerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggers = Logger::latest()->get();

        return LoggerResource::collection($loggers);
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

        $logger = Logger::create([
            'user_requesting_void' => $request->user_requesting_void,
            'module' => $request->module,
            'user_id' => $request->user_id,
            'cancel_id' => $request->cancel_id,
            'content' => $request->content
        ]);

        return new LoggerResource($logger);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logger  $Logger
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logger = Logger::find($id);

        return $logger;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Logger  $Logger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $logger = Logger::find($id);

        $this->validate($request, [
            'module' => 'required'
        ]);

        $logger->update([
            'user_requesting_void' => $request->user_requesting_void,
            'module' => $request->module,
            'user_id' => $request->user_id,
            'cancel_id' => $request->cancel_id,
            'content' => $request->content
        ]);

        return new LoggerResource($logger);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logger  $Logger
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logger = Logger::find($id);

        $logger->delete();

        return response()->json(['message' => 'Logger deleted successfully!']);

    }
}
