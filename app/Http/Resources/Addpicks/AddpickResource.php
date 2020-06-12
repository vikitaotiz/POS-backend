<?php

namespace App\Http\Resources\Addpicks;

use Illuminate\Http\Resources\Json\JsonResource;

class AddpickResource extends JsonResource
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
            'table_name' => $this->table_name,
            'table_id' => $this->table_id,
            'content' => $this->content,
            'amount' => $this->amount,
            'user' => $this->user->name,
            'time' => $this->created_at->format('H:m A, jS D M Y')
        ];
    }
}
