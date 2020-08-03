<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'created_at' => $this->created_at->format('H:m A D M Y'),
            'content' => $this->content,
            'payment_mode' => $this->payment_mode,
            'amount' => $this->amount,
            'user' => $this->user->name,
            'user_order' => $this->user_order
        ];
    }
}
