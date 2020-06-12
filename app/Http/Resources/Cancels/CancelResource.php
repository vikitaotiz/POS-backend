<?php

namespace App\Http\Resources\Cancels;

use Illuminate\Http\Resources\Json\JsonResource;

class CancelResource extends JsonResource
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
            'description' => $this->description,
            'user' => $this->user->name,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
