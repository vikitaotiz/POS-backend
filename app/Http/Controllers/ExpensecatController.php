<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expensecat;
use App\Http\Resources\Expenses\ExpensecatResource;

class ExpensecatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expensecats = Expensecat::latest()->get();

        return ExpensecatResource::collection($expensecats);
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

        $expensecat = Expensecat::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new ExpensecatResource($expensecat);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expensecat  $Expensecat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expensecat = Expensecat::find($id);

        return $expensecat;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expensecat  $Expensecat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expensecat = Expensecat::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $expensecat->update([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new ExpensecatResource($expensecat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expensecat  $Expensecat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expensecat = Expensecat::find($id);

        $expensecat->delete();

        return response()->json(['message' => 'Expensecat deleted successfully!']);

    }
}
