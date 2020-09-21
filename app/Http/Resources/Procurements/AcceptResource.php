<?php

namespace App\Http\Resources\Procurements;

use Illuminate\Http\Resources\Json\JsonResource;

class AcceptResource extends JsonResource
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
            'provider_name' => $this->provider_name,
            'user_requesting' => $this->user_requesting,
            'content' => $this->content,
            'user' => $this->user->name,
            'created_at' => $this->created_at->format('H:m A, jS D M Y')
        ];
    }
}
