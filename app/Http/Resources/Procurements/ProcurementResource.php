<?php

namespace App\Http\Resources\Procurements;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcurementResource extends JsonResource
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
            'name' => $this->name,
            'user' => $this->user->name,
            'category' => $this->procurementcat->name,
            'measurementunit' => $this->measurementunit->name,
            'created_at' => $this->created_at->format('H:m A, jS D M Y')
        ];
    }
}
