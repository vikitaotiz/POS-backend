<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Http\Resources\Expenses\ExpenseResource;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest()->get();

        return ExpenseResource::collection($expenses);
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
            'user_requesting_expense' => 'required',
            'content' => 'required',
            'amount' => 'required'
        ]);

        $expense = Expense::create([
            'user_requesting_expense' => $request->user_requesting_expense,
            'user_id' => $request->user_id,
            'content' => $request->content,
            'quantity' => $request->quantity,
            'amount' => $request->amount,
            'provider' => $request->provider,
            'payment_mode' => $request->payment_mode
        ]);

        return new ExpenseResource($expense);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $Expense
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::find($id);

        return $expense;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $Expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);

        $this->validate($request, [
            'user_requesting_expense' => 'required',
            'content' => 'required',
            'amount' => 'required'
        ]);

        $expense->update([
            'user_requesting_expense' => $request->user_requesting_expense,
            'user_id' => $request->user_id,
            'content' => $request->content,
            'quantity' => $request->quantity,
            'amount' => $request->amount,
            'provider' => $request->provider,
            'payment_mode' => $request->payment_mode
        ]);

        return new ExpenseResource($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $Expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);

        $expense->delete();

        return response()->json(['message' => 'Expense deleted successfully!']);

    }
}
