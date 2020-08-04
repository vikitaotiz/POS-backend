<?php

namespace App\Http\Resources\Picks;

use Illuminate\Http\Resources\Json\JsonResource;

class PickResource extends JsonResource
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
            'created_at' => $this->created_at,
            'table_name' => $this->table_name,
            'content' => $this->content,
            'amount' => $this->amount,
            'user_order' => $this->user_order,
            'user' => $this->user->name
        ];
    }
}
