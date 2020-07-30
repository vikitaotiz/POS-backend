<?php

namespace App\Http\Resources\Bills;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
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
            'user_order' => $this->user_order,
            'table' => $this->table,
            'amount' => $this->amount,
            'sold' => $this->sold,
            'freaze' => $this->freaze,
            'split' => $this->split,
            'merged' => $this->merged,
            'content' => $this->content,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('H:m A D M Y')
        ];
    }
}
