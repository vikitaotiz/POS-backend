<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Resources\Roles\RoleResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->get();

        return RoleResource::collection($roles);
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

        $role = Role::create([
            'name' => $request->name
        ]);

        return new RoleResource($role);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $Role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        return $role;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $Role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return new RoleResource($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $Role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully!']);

    }
}
