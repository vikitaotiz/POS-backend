<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Resources\Departments\DepartmentResource;
use App\Http\Resources\Departments\DepartmentsResource;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::latest()->get();

        return DepartmentsResource::collection($departments);
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
            'name' => 'required',
            'creator_id' => 'required'
        ]);

        $department = Department::create([
            'name' => $request->name,
            'creator_id' => $request->creator_id,
            'description' => $request->description
        ]);

        return new DepartmentsResource($department);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);

        return new DepartmentResource($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        $this->validate($request, [
            'name' => 'required',
            'creator_id' => 'required'
        ]);

        $department->update([
            'name' => $request->name,
            'creator_id' => $request->creator_id,
            'description' => $request->description
        ]);

        return new DepartmentResource($department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);

        $department->delete();

        return response()->json(['message' => 'department deleted successfully!']);

    }
}
