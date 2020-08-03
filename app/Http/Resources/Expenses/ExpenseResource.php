<?php

namespace App\Http\Resources\Expenses;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'payment_mode' => $this->payment_mode,
            'created_at' => $this->created_at->format('H:m A D M Y')
        ];
    }
}
