<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drink;
use App\Http\Resources\Drinks\DrinkResource;
use App\Http\Requests\Drinks\CreateDrink;
use App\Http\Requests\Drinks\UpdateDrink;

class DrinkController extends Controller
{
     public function index()
    {
        $drinks = Drink::latest()->get();

        return DrinkResource::collection($drinks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDrink $request)
    {
        $drink = Drink::create([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'amount' => $request->amount,
            'user_id' => auth()->user()->id
        ]);

        return new DrinkResource($drink);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drink = Drink::findOrFail($id);

        return $drink;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $drink = Drink::findOrFail($id);

        $drink->update([
            'content' => $request->content,
            'table_name' => $request->table_name,
            'amount' => $request->amount,
            'user_id' => auth()->user()->id
        ]);

        return new DrinkResource($drink);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drink = Drink::findOrFail($id);

        $drink->delete();

		return response()->json(['message' => 'Drink deleted successfully!']);
    }
}
