<?php

namespace App\Http\Resources\Ready;

use Illuminate\Http\Resources\Json\JsonResource;

class ReadyResource extends JsonResource
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
            'freaze' => $this->freaze,
            'merged' => $this->merged,
            'split' => $this->split,
            'user_order' => $this->user_order,
            'user' => $this->user->name
        ];
    }
}
