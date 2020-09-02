<?php

namespace App\Http\Resources\Shifts;

use Illuminate\Http\Resources\Json\JsonResource;

class ShiftResource extends JsonResource
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
            'daily_sale' => $this->daily_sale,
            'daily_expense' => $this->daily_expense,
            'cash' => $this->cash,
            'mpesa' => $this->mpesa,
            'card' => $this->card,
            'credit' => $this->credit,
            'cash_at_hand' => $this->cash_at_hand,
            'cash_in_drawer' => $this->cash_in_drawer,
            'user' => $this->user->name,
            'created_at' => $this->created_at
        ];
    }
}
