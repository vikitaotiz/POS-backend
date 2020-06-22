<?php

namespace App\Http\Controllers;
use App\LoggedInUser;
use Illuminate\Http\Request;
use App\Http\Resources\Logs\LoggedInUserResource;


class LoggedInUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedinusers = LoggedInUser::latest()->get();

        return LoggedInUserResource::collection($loggedinusers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loggedinuser = LoggedInUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'role' => $request->name,
            'time' => $request->time,
            'user_id' => $request->user_id
        ]);

        return new LoggedInUserResource($loggedinuser);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LoggedInUser  $LoggedInUser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loggedinuser = LoggedInUser::find($id);

        return $loggedinuser;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoggedInUser  $LoggedInUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $loggedinuser = LoggedInUser::find($id);

        $loggedinuser->update([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'role' => $request->name,
            'time' => $request->time,
            'user_id' => $request->user_id
        ]);

        return new LoggedInUserResource($loggedinuser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoggedInUser  $LoggedInUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loggedinuser = LoggedInUser::find($id);

        $loggedinuser->delete();

        return response()->json(['message' => 'LoggedInUser deleted successfully!']);

    }
}
