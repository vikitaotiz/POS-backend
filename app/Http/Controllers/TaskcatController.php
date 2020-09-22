<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taskcat;
use App\Http\Resources\Tasks\TaskcatResource;

class TaskcatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskcats = Taskcat::latest()->get();

        return TaskcatResource::collection($taskcats);
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

        $taskcat = Taskcat::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new TaskcatResource($taskcat);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taskcat  $Taskcat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $taskcat = Taskcat::find($id);

        return $taskcat;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taskcat  $Taskcat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $taskcat = Taskcat::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $taskcat->update([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new TaskcatResource($taskcat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taskcat  $Taskcat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taskcat = Taskcat::find($id);

        $taskcat->delete();

        return response()->json(['message' => 'Taskcat deleted successfully!']);

    }
}
