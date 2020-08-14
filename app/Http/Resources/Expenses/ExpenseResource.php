<?php

namespace App\Http\Resources\Expenses;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Expense;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_requesting_expense' => $this->user_requesting_expense,
            'user' => $this->user->name,
            'content' => $this->content,
            'quantity' => $this->quantity,
            'amount' => $this->amount,

            'provider' => $this->provider,
            'measurement_unit' => $this->measurementunit,
            'payment_mode' => $this->paymentmode,
            'expense_cat' => $this->expensecat,

            'created_at' => $this->created_at
        ];
    }
}
