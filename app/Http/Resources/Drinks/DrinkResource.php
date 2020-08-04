<?php

namespace App\Http\Resources\Drinks;

use Illuminate\Http\Resources\Json\JsonResource;

class DrinkResource extends JsonResource
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
            'content' => $this->content,
            'table_name' => $this->table_name,
            'user' => $this->user->name,
            'amount' => $this->amount,
            'sold' => $this->sold,
            'created_at' => $this->created_at
        ];
    }
}
